<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quidditch extends CI_Controller {

	public function index()
	{
		$this->load->helper('form');
		$this->load->model(array('membre_model'));

		if ($this->ion_auth->logged_in()){

			$data['pseudo'] = $this->session->userdata('pseudo');
			$data['argent'] = $argent = $this->membre_model->get_argent($this->session->userdata('user_id'));
			$this->layout->view('quidditch', $data);
		}
		else{
			redirect('auth/login', 'location');
		}
	}

	// Page de la liste des équipes
	public function teams()
	{
		$this->load->model(array('membre_model', 'quidditch_model'));
		$this->load->helper('quidditch_helper');

		$data['pseudo'] = $this->session->userdata('pseudo');
		$data['argent'] = $argent = $this->membre_model->get_argent($this->session->userdata('user_id'));
		$data['equipes'] = $this->quidditch_model->get_teams();

		$this->layout->view('quidditch_teams', $data);
	}

	public function rank()
	{
		$this->load->model(array('membre_model', 'quidditch_model'));
		$data['pseudo'] = $this->session->userdata('pseudo');
		$data['argent'] = $argent = $this->membre_model->get_argent($this->session->userdata('user_id'));

		$data['equipes_stats'] = $this->quidditch_model->get_teams_stats();

		$this->layout->view('quidditch_rank', $data);
	}

	public function team($id=null)
	{
		$this->load->model(array('membre_model', 'quidditch_model'));
		$this->load->helper('quidditch_helper');
		$data['equipe'] = $this->quidditch_model->get_team($id);

		if($id && $data['equipe']){
			$data['pseudo'] = $this->session->userdata('pseudo');
			$data['argent'] = $argent = $this->membre_model->get_argent($this->session->userdata('user_id'));
			$this->layout->view('quidditch_team', $data);
		}
		else{
			redirect('quidditch', 'location');
		}
	}
}
