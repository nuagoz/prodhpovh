<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->lang->load('auth');
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->model(array('membre_model', 'management_model'));
		$this->load->helper(array('form','membre_helper','animaux_helper'));
	}

	public function index()
	{		
		if ($this->ion_auth->logged_in()){

			$data['pseudo'] = $this->session->userdata('pseudo');
			$data['info_membre'] =  $this->membre_model->get_membre_by_id($this->session->userdata('user_id'));
		}
		else{
			redirect('auth/login', 'location');
		}
	}

	public function eeylops()
	{
		if ($this->ion_auth->logged_in()){
			$this->layout->add_js('animaux');
			$data['pseudo'] = $this->session->userdata('pseudo');
			$data['info_membre'] =  $this->membre_model->get_membre_by_id($this->session->userdata('user_id'));

			$data['liste'] = $this->management_model->get_animaux();
			$data['animal_qty'] = $this->management_model->get_animal_quantity($this->session->userdata('user_id'));

			$this->layout->view('eeylops', $data);
		}
		else{
			//$this->layout->add_css('menu_offline');
			redirect('auth/login', 'location');
		}
	}

	public function bonbec()
	{
		if ($this->ion_auth->logged_in()){

			$data['pseudo'] = $this->session->userdata('pseudo');
			$data['info_membre'] =  $this->membre_model->get_membre_by_id($this->session->userdata('user_id'));

			// Infos classement
			//$data['rank'] = $this->membre_model->classement();
			$this->layout->view('bonbec', $data);
		}
		else{
			redirect('auth/login', 'location');
		}
	}

	public function buy_owl()
	{
		if($this->ion_auth->logged_in() && !empty($_POST))
		{
			$this->load->helper('jsonresponse_helper');
			$jsonResponse = new JsonResponse();

			$nb_hibou = $this->management_model->get_qty_animal_by_id($_POST['idhibou'], $this->session->userdata('user_id'));
			$nb_total_hibou = $this->management_model->get_qty_animal_membre($this->session->userdata('user_id'));

			$taille_ok = true;
			$argent_ok = true;
			$stock_ok = true;
			$qty_limite_ok = true;
			$traitement_ok = true; 

			if(strlen($_POST['hibouname']) != 6)
				$taille_ok = false;

			$info_membre = $this->membre_model->get_membre_by_id($this->session->userdata('user_id'));
			$info_hibou = $this->management_model->get_animal($_POST['idhibou']);

			$price = $info_hibou['prix'];

			if($info_membre['argent'] < $price) // Pas assez d'argent
				$argent_ok = false;

			if(isset($info_hibou['limite'])){ // Cette condition s'applique uniquement aux animaux qui ont une quantité limite
				if($nb_hibou >= $info_hibou['limite']) // Déjà atteint la quantité max d'un type d'animal
					$qty_limite_ok = false;
			}

			if($nb_total_hibou >= $info_membre['stock'])
				$stock_ok = false;

			if($taille_ok && $argent_ok && $stock_ok && $qty_limite_ok){ // achat possible
				$infos['idanimal'] = $_POST['idhibou'];
				$infos['idmembre'] = $this->session->userdata('user_id');
				$infos['new'] = 1;
				$infos['nickname'] = $_POST['hibouname'];
				$this->management_model->add_animal($infos);
			}
			else
				$traitement_ok = false;

			$jsonResponse->addOption('traitement_ok', $traitement_ok);
			$jsonResponse->addOption('taille_ok', $taille_ok);
			$jsonResponse->addOption('argent_ok', $argent_ok);
			$jsonResponse->addOption('stock_ok', $stock_ok);
			$jsonResponse->addOption('qty_limite_ok', $qty_limite_ok);
			$jsonResponse->addOption('price', $price);
			$jsonResponse->addOption('nb_hibou', $nb_hibou);
			$jsonResponse->render();
		}
		else{
			redirect('auth/login', 'location');
		}
	}

	public function generate_name()
	{
		
			$this->load->helper('jsonresponse_helper');
			$jsonResponse = new JsonResponse();

			$name = genere_nom();

			$jsonResponse->addOption('name', $name);
			$jsonResponse->render();

	}
}
