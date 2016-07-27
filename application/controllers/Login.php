<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->lang->load('auth');
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->model('membre_model');
		$this->load->helper(array('url','language','form'));
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
	}

	public function index()
	{
		/*$this->form_validation->set_rules('conn_pseudo', 'Pseudo','required');
		$this->form_validation->set_rules('conn_mdp', 'Mot de passe','required');*/

		$this->form_validation->set_rules('conn_pseudo', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('conn_mdp', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

		if ($this->form_validation->run() == true)
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('conn_pseudo'), $this->input->post('conn_mdp'), $remember))
			{
				// Identifiants correct -> redirection vers la Home.
				$this->session->set_flashdata('confirmation', $this->ion_auth->messages());
				redirect('home', 'location');
			}
			else
			{
				// Identifiants incorrects -> affichage de la page de connexion.
				$this->session->set_flashdata('error', $this->ion_auth->errors());
				$this->layout->views('header')->view('connexion');
			}
		}
		else{
			$this->layout->views('header')->view('connexion');
		}

	}

	public function logout()
	{
		// log the user out
		$logout = $this->ion_auth->logout();

		// redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('connexion', 'location');
	}

}
