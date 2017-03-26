<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->lang->load('auth');
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->model(array('membre_model', 'management_model'));
		$this->load->helper(array('form','membre_helper'));
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
}
