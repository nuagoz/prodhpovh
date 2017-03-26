<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

	public function index()
	{
		$this->load->helper(array('form','membre_helper'));
		$this->load->model(array('membre_model'));

		if ($this->ion_auth->logged_in()){

			$data['pseudo'] = $this->session->userdata('pseudo');
			$data['info_membre'] =  $this->membre_model->get_membre_by_id($this->session->userdata('user_id'));
			$this->layout->view('inventaire', $data);
		}
		else{
			redirect('auth/login', 'location');
		}
	}
}
