<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Management extends CI_Controller {

	public function index()
	{
		if($this->ion_auth->logged_in())
		{
			$this->load->model(array('management_model','ingredient_model','membre_model'));
			$this->layout->add_js('animaux');


			// Chargement de la liste des animaux du membre

			$data['animaux'] = $this->management_model->get_animaux_membre($this->session->userdata('user_id'));


			$this->layout->views('header')->view('animaux', $data);
			//$this->output->enable_profiler(TRUE);

		}
		else
		{
			redirect('auth/login', 'location');
		}
	}

	public function release($idanimal)
	{
		// $('#hibou_281').fadeOut()
	}

	// Fonction qui gère l'envoi du courrier
	public function check_envoi()
	{
		if($this->ion_auth->logged_in() && !empty($_POST))
		{
			$this->load->model(array('management_model', 'ingredient_model', 'membre_model'));
			$this->load->helper(array('animaux_helper', 'jsonresponse_helper'));

			$jsonResponse = new JsonResponse();

			$resultat_ingredient = '';
			$res = '';
			$idmembre = $this->session->userdata('user_id');
			$argent = $this->membre_model->get_argent($idmembre);
			$newargent = $argent;
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
						$resultat_ingredient = "<script>toastr.info('Ingrédient gagné : <br/><strong>".$nom."</strong><br/><center> <img src=\'".img_url('ingredients')."/".$ingredient_drop['url'].".png\' width=\'50px\' height=\'50px\'/></center> ', {timeOut: 3000})</script>";

						// Ajout de l'ingredient
						$this->ingredient_model->add_ingredient($ingredient_drop['id'], $idmembre);
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
						$notification = "<script>toastr.success('".$animal['nickname']." vous a rapporté ".$argentwin." <img src=\"".img_url('gallion2.png')."\" height=\"30\" width=\"30\"/>', 'Courrier livré !', {timeOut: 3000})</script>";	
					}
					else{
						$argentwin = $argent;
						// Ajout un courrier raté à l'animal
						$info['courriersfail'] = $animal['courriersfail'] + 1;
						$notification = "<script>toastr.error('".$animal['nickname']." a égaré le courrier durant le trajet...', 'Échec !', {timeOut: 3000})</script>";
					}
					$verification = "ok";
					// Ajoute timestamp à l'animal
					$info['date_utilisation'] = time();
					$this->management_model->update_animal($this->input->post('idhibou'), $info);
					$info_fiche['idhibou'] = $this->input->post('idhibou');
					$info_fiche['idh'] = $animal['idanimal'];
					$info_fiche['gainmin'] = $animal['gainmin'];
					$info_fiche['gainmax'] = $animal['gainmax'];
					$info_fiche['nickname'] = $animal['nickname'];
					$info_fiche['succes'] = $animal['succes'];
					$info_fiche['rare'] = $animal['rare'];

					$animal = $this->management_model->get_infos_animaux_membre($idmembre, $this->input->post('idhibou'));
					$info_fiche['calcul'] = $animal['cooldown']-(time()-$animal['date_utilisation']);

					$newargent = $argent + $argentwin;

					$res = build_fiche_cd($info_fiche);
					$jsonResponse->addOption('cd', $info_fiche['calcul']);
					$jsonResponse->addResponseHtml($res);
					$jsonResponse->addOption('argent', $newargent);
					$jsonResponse->addOption('ingredient', $resultat_ingredient);

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