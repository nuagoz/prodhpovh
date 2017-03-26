<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rank extends CI_Controller {

	public function index()
	{

		$this->load->helper(array('form','membre_helper'));
		$this->load->model(array('membre_model'));
		if ($this->ion_auth->logged_in()){

			$data['pseudo'] = $this->session->userdata('pseudo');
			$data['info_membre'] =  $this->membre_model->get_membre_by_id($this->session->userdata('user_id'));

			// Infos classement
			$data['rank'] = $this->membre_model->classement();
			$this->layout->view('rank', $data);
		}
		else{
			//$this->layout->add_css('menu_offline');
			$this->layout->views('header')->view('rankdc');
		}
	}

}
