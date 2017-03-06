<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function index($idmembre=null)
	{
		if ($this->ion_auth->logged_in()){

			$this->load->model(array('management_model','membre_model'));
			$membre = $this->membre_model->get_membre_by_id($this->session->userdata('user_id'));

			$data['pseudo_membre'] = $this->session->userdata('pseudo');
			$data['points_membre'] = $membre['points'];

			$data['pseudo'] = $data['pseudo_membre'];
			$data['argent'] = $argent = $this->membre_model->get_argent($this->session->userdata('user_id'));
			$data['animaux'] = $this->management_model->get_animaux_membre($this->session->userdata('user_id'));

			$this->layout->view('profile', $data);
		}
		else{
			// Redirection vers la page de connexion
			redirect('auth/login', 'location');

		}
	}

	public function member($idmembre=null)
	{
		if ($idmembre != null){

			$this->load->model(array('management_model','membre_model'));
			$membre = $this->membre_model->get_membre_by_id($idmembre);

			// Variables membre actuel pour le menu
			$data['pseudo'] = $this->session->userdata('pseudo');
			$data['argent'] = $argent = $this->membre_model->get_argent($this->session->userdata('user_id'));

			// Variables pour l'utilisateur visualisé
			$data['pseudo_membre'] = $membre['pseudo'];
			$data['points_membre'] = $membre['points'];

			// Récupération des animaux de l'utilisateur visualisé
			$data['animaux'] = $this->management_model->get_animaux_membre($idmembre);

			$this->layout->view('profile', $data);
		}
		else{
			redirect('profile', 'location');
		}
	}
}