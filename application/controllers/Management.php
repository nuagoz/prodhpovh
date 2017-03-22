<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Management extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->lang->load('auth');
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->model(array('membre_model', 'management_model'));
		$this->load->helper(array('membre_helper'));
	}

	public function index()
	{
		if($this->ion_auth->logged_in())
		{
			$this->load->model('ingredient_model');
			$this->layout->add_js('animaux');
			$this->layout->add_js('vendor/overhang.min');
			$this->layout->add_js('vendor/prism.min');
			$this->layout->add_css('overhang.min');

			// récupération du pseudo et de l'argent du membre
			$data['pseudo'] = $this->session->userdata('pseudo');
			$data['info_membre'] =  $this->membre_model->get_membre_by_id($this->session->userdata('user_id'));

			// Chargement de la liste des animaux du membre
			$data['animaux'] = $this->management_model->get_animaux_membre($this->session->userdata('user_id'));

			$this->layout->view('animaux', $data);
			//$this->output->enable_profiler(TRUE);
		}
		else
		{
			redirect('auth/login', 'location');
		}
	}

	public function cards()
	{
		$this->layout->add_css('cards');
		$this->layout->add_js('cards');


		$data['pseudo'] = $this->session->userdata('pseudo');
		$data['info_membre'] =  $this->membre_model->get_membre_by_id($this->session->userdata('user_id'));

		$data['cartes_membre'] = $this->management_model->get_cards($this->session->userdata('user_id'));
		$data['nb_cartes_membre'] = $this->management_model->get_cards($this->session->userdata('user_id'), true);

		// Comptage de chaque type de carte
		$data['nb_bronze'] = $this->management_model->get_cards($this->session->userdata('user_id'), true, "bronze");
		$data['nb_argent'] =  $this->management_model->get_cards($this->session->userdata('user_id'), true, "argent");
		$data['nb_or'] =  $this->management_model->get_cards($this->session->userdata('user_id'), true, "or");

		$data['cartes'] = $this->management_model->get_all_cards();
		$data['nb_cartes'] = $this->management_model->get_all_cards(true);

		$this->layout->view('cartes', $data);

	}

	public function potions()
	{
		$data['pseudo'] = $this->session->userdata('pseudo');
		$data['info_membre'] =  $this->membre_model->get_membre_by_id($this->session->userdata('user_id'));
		$this->layout->view('potions', $data);
	}

	public function release()
	{
		if($this->ion_auth->logged_in() && !empty($_POST))
		{
			$this->load->helper('jsonresponse_helper');

			$jsonResponse = new JsonResponse();

			$idmembre = $this->session->userdata('user_id');
			$animal = $this->management_model->get_infos_animaux_membre($idmembre, $this->input->post('idhibou'));

			if ($this->management_model->count_animal($idmembre) > 1){ // Le membre ne peut pas libérer s'il n'a plus qu'un animal
				if ($animal){ // Si l'animal appartient bien au membre

					if (time() - $animal['date_utilisation'] >= $animal['cooldown']){ // Si l'animal n'est pas en CD
						$verification = true;
						$this->management_model->delete_animal($this->input->post('idhibou')); // On supprime l'animal
						$notification = "<script>toastr.success('".$animal['nickname']." a bien été relâché !', 'Félicitation !', {timeOut: 3000})</script>"; 
					}
					else{
						$verification = false;
						$notification = "<script>toastr.error('Vous ne pouvez pas relâcher un animal pendant qu\'il se repose', 'Action impossible !', {timeOut: 3000})</script>"; 
					}

				}
				else{
					$verification = false;
					$notification = "<script>toastr.error('Cet animal ne vous appartient pas', 'Action impossible !', {timeOut: 3000})</script>"; 
				}
			}
			else{
				$verification = false;
				$notification = "<script>toastr.error('Vous ne pouvez pas libérer votre seul animal !', 'Action impossible !', {timeOut: 3000})</script>";
			}
			$jsonResponse->addOption('verif', $verification);
			$jsonResponse->addOption('notification', $notification);
			$jsonResponse->render();

		}
		else{
			redirect('auth/login', 'location');
		}
	}

	// Fonction qui gère l'envoi du courrier
	public function check_envoi()
	{
		if($this->ion_auth->logged_in() && !empty($_POST))
		{
			$this->load->model('ingredient_model');
			$this->load->helper(array('animaux_helper', 'jsonresponse_helper'));

			$jsonResponse = new JsonResponse();
			$gain_xp = 0;
			$resultat_ingredient = '';
			$res = '';
			$checktime='';
			$result_send = '';
			$img_ingredient = '';
			$nom_ingredient = '';
			$idmembre = $this->session->userdata('user_id');
			$argent = $this->membre_model->get_argent($idmembre);
			//$newargent = $argent;
			$animal = $this->management_model->get_infos_animaux_membre($idmembre, $this->input->post('idhibou'));

			if ($animal) // Si le hibou appartient bien au membre
			{
				if (time() - $animal['date_utilisation'] >= $animal['cooldown']){ // Si l'animal n'est pas en CD
					$checktime = time() - $animal['date_utilisation'];
					$bonus_felix = false;
					$bonus = $this->management_model->get_felix($idmembre);

					if($bonus) // Si l'utilisateur a déjà eu un felix felicis (que la ligne existe)
					{
						if (time() - $bonus['temps'] <= 86400){ // S'il a un felix felicis actif
							$bonus_felix = true;
						}
					}

					if(ingredientOk($animal['pp'], $bonus_felix)){

						$ingredient = $this->ingredient_model->get_ingredients();
						$ingredient_drop = trouverIngredient($ingredient);
						$nom = addslashes($ingredient_drop['nom']);

						// Statistique total_drop
						//$resultat_ingredient = "<script>toastr.info('Ingrédient gagné : <br/><strong>".$nom."</strong><br/><center> <img src=\'".img_url('ingredients')."/".$ingredient_drop['url'].".png\' width=\'50px\' height=\'50px\'/></center> ', {timeOut: 3000})</script>";

						$resultat_ingredient = $ingredient_drop['url'];
						$img_ingredient = img_url('ingredients')."/".$ingredient_drop['url'].".png";
						$nom_ingredient = $nom;

						// Ajout de l'ingredient
						$this->ingredient_model->add_ingredient($ingredient_drop['id'], $idmembre);

						// Ajout xp
						$this->membre_model->add_xp($idmembre, 1);
						$gain_xp = 1; // JS preview
					}

					$testreussite = rand(1,100); // Random pour voir si courrier réussi
					if ($testreussite <= $animal['succes']){ // Si réussite du courrier

						$argentwin = rand($animal['gainmin'], $animal['gainmax']);

						if ($animal['bonus_gx2'] > 0){
							// Double l'argent
							$argentwin = $argentwin*2;
							// Enlève 1 au bonus_gx2
							$info['bonus_gx2'] = $animal['bonus_gx2'] - 1;
							$bonus_gx2_text = "Les gains apportés par ".$animal['nickname']." sont doublés pour ".$info['bonus_gx2']." envoi(s)";
						}
						// Ajoute l'argent au membre :
						$info_membre['argent'] = $argent + $argentwin;
						$this->membre_model->update_membre($idmembre, $info_membre);

						// Ajoute les statistiques (total argent et total courrier)
						$stat['total_argent'] = $this->management_model->get_stat($idmembre, 2);
						$stat['total_courrier'] = $this->management_model->get_stat($idmembre, 6);
						$this->management_model->add_stat($idmembre, 2, $stat['total_argent']['valeur'] + $argentwin);
						$this->management_model->add_stat($idmembre, 6, $stat['total_courrier']['valeur'] + 1);

						// Ajoute un courrier réussi à l'animal
						$info['courriers'] = $animal['courriers'] + 1;

						$result_send = 'ok';
						$message = $argentwin." <img src=\"".img_url('gallion2.png')."\" height=\"30\" width=\"30\"/>";
						//$message="ok";
						$notification = "<script>toastr.success('".$animal['nickname']." vous a rapporté ".$argentwin." <img src=\"".img_url('gallion2.png')."\" height=\"30\" width=\"30\"/>', 'Courrier livré !', {timeOut: 3000})</script>";	
					}
					else{
						$argentwin = 0;
						// Ajout un courrier raté à l'animal
						$info['courriersfail'] = $animal['courriersfail'] + 1;

						$result_send = 'fail';
						$message = "Échec";
						$notification = "<script>toastr.error('".$animal['nickname']." a égaré le courrier durant le trajet...', 'Échec !', {timeOut: 3000})</script>";
					}

					$verification = "ok";
					// Ajoute timestamp à l'animal
					$info['date_utilisation'] = time();
					$this->management_model->update_animal($this->input->post('idhibou'), $info);
					$info_fiche['idhibou'] = $this->input->post('idhibou');

					$animal = $this->management_model->get_infos_animaux_membre($idmembre, $this->input->post('idhibou'));
					$info_fiche['calcul'] = $animal['cooldown']-(time()-$animal['date_utilisation']);

					$newargent = $argent + $argentwin;

					
					$jsonResponse->addOption('result_send', $result_send);
					$jsonResponse->addOption('message', $message);
					$jsonResponse->addOption('cd', $info_fiche['calcul']);
					$jsonResponse->addOption('earned', $argentwin);
					$jsonResponse->addOption('argent', $newargent);
					$jsonResponse->addOption('ingredient', $resultat_ingredient);
					$jsonResponse->addOption('img_ingredient', $img_ingredient);
					$jsonResponse->addOption('nom_ingredient', $nom_ingredient);
					$jsonResponse->addOption('gain_xp', $gain_xp);

				}
				else // Si l'animal est en CD
				{
					$verification = false;
					$notification = "<script>toastr.error('".$animal['nickname']." se repose...', 'Action impossible !', {timeOut: 3000})</script>";
				}
			}
			else // Hibou n'appartient pas au membre
			{
				$verification = false;
				$notification = "<script>toastr.error('Cet animal ne vous appartient pas', 'Action impossible !', {timeOut: 3000})</script>";
			}
			
			$jsonResponse->addOption('time', $checktime);
			$jsonResponse->addOption('notification', $notification);
			$jsonResponse->addOption('verif', $verification);
			$jsonResponse->render();
		}
		else
		{
			redirect('home', 'location');
		}
	}
}