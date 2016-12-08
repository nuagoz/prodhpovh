<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
		$this->load->helper('form');
		$this->load->model(array('membre_model'));

		if ($this->ion_auth->logged_in()){

			$this->load->model('management_model');
			$data['pseudo'] = $this->session->userdata('pseudo');
			$data['argent'] = $argent = $this->membre_model->get_argent($this->session->userdata('user_id'));
			$data['animaux'] = $this->management_model->get_animaux_membre($this->session->userdata('user_id'));
			$this->layout->view('home_connected', $data);
		}
		else{
			//$this->layout->add_css('menu_offline');
			$this->layout->views('header')->view('home');
		}
	}
}
