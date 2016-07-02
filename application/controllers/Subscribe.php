<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscribe extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('membre_model');
		$this->load->library('form_validation');
		$this->load->helper('form');
	}

	public function index()
	{

		$this->form_validation->set_rules('pseudo', 'Pseudo', 'trim|required|is_unique[membre.pseudo]|min_length[5]|max_length[16]|alpha_numeric', array('is_unique' =>'Un utilisateur utilise déjà ce pseudo', 'min_length' => 'Le pseudo doit contenir au moins 5 caractères', 'max_length' => 'Le pseudo ne doit pas contenir plus que 16 caractères'));
		$this->form_validation->set_rules('pass1', 'Mot de passe', 'trim|required|min_length[6]', array('min_length' => 'Le mot de passe doit contenir au moins 6 caractères'));
		$this->form_validation->set_rules('pass2', 'Mot de passe', 'trim|required|matches[pass1]', array('matches' => 'Les deux mots de passe doivent être identiques'));
		$this->form_validation->set_rules('mail', 'Adresse email', 'trim|valid_email', array('valid_email' => 'Le format de l\'adresse email doit être valide.'));

		// Si les règles du formulaire sont respectées
		if ($this->form_validation->run())
		{
			// Toutes les règles sont respectées, on créé un nouvel utilisateur

			$info_membre['pseudo'] = $this->input->post('pseudo');
			$info_membre['mdp'] = sha1($this->input->post('pass1'));
			if (!empty($this->input->post('email'))){
				$info_membre['mail'] = $this->input->post('email');
			}
			$info_membre['argent'] = 40;

			if($this->membre_model->add_membre($info_membre))
			{
				$this->session->set_flashdata('confirmation', "Bienvenue ".$info_membre['pseudo']." ! Votre compte a été créé, vous pouvez vous connecter.");
			}
		}

		$this->layout->views('header')->view('subscribe');
	}


}