<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

	public function index()
	{
		$this->load->helper('form');
		$this->load->model(array('membre_model'));

		if ($this->ion_auth->logged_in()){

			$data['pseudo'] = $this->session->userdata('pseudo');
			$data['argent'] = $argent = $this->membre_model->get_argent($this->session->userdata('user_id'));
			//$this->layout->view('inventaire', $data);
			$this->layout->view('sidebar', $data);
		}
		else{
			redirect('auth/login', 'location');
		}
	}
}
