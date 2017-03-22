<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quidditch extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('membre_model', 'quidditch_model'));
		$this->load->helper(array('form','membre_helper', 'quidditch_helper'));
	}

	public function index()
	{
		$this->layout->add_js('quidditch');

		if ($this->ion_auth->logged_in()){

			$puissance1 = 1000;
			$puissance2 = 100;
			$score1 = 310;
			$score2 = 200;

			$diffscore = max($score1, $score2) - min($score1, $score2);
			$diffpuissance = max($puissance1, $puissance2) - min($puissance1, $puissance2) + 1;
			$calcul = $diffscore/max($score1, $score2);
			$calcul = round($calcul, 1); // Arrondi dixieme
			//echo $calcul;

			$data['pseudo'] = $this->session->userdata('pseudo');
			$data['info_membre'] =  $this->membre_model->get_membre_by_id($this->session->userdata('user_id'));
			$data['date'] = $this->quidditch_model->get_quidditch_variables();

			$data['matches'] = $this->quidditch_model->get_matches($data['date']['semaine']);

			foreach($data['matches'] as $key => $value)
			{
				$data['equipe1'][$key] = $this->quidditch_model->get_team($data['matches'][$key]['idequipe1']);
				$data['equipe2'][$key] = $this->quidditch_model->get_team($data['matches'][$key]['idequipe2']);
			}

			$this->layout->view('quidditch', $data);
			//date('Y-m-d', strtotime('+7 day')) . ' 20:00:00';
		}
		else{
			redirect('auth/login', 'location');
		}
	}

	// Page de la liste des équipes
	public function teams()
	{
		if ($this->ion_auth->logged_in()){
			$data['pseudo'] = $this->session->userdata('pseudo');
			$data['info_membre'] =  $this->membre_model->get_membre_by_id($this->session->userdata('user_id'));
			$data['equipes'] = $this->quidditch_model->get_teams();

			$this->layout->view('quidditch_teams', $data);
		}
		else{
			redirect('quidditch', 'location');
		}
	}

	public function rank()
	{
		if ($this->ion_auth->logged_in()){
			$this->load->model(array('membre_model', 'quidditch_model'));
			$data['pseudo'] = $this->session->userdata('pseudo');
			$data['info_membre'] =  $this->membre_model->get_membre_by_id($this->session->userdata('user_id'));

			$data['equipes_stats'] = $this->quidditch_model->get_teams_stats();

			$this->layout->view('quidditch_rank', $data);
		}
		else{
			redirect('quidditch', 'location');
		}
	}

	public function team($id=null)
	{

		$data['equipe'] = $this->quidditch_model->get_team($id);

		if($id && $data['equipe'] && $this->ion_auth->logged_in()){
			$data['pseudo'] = $this->session->userdata('pseudo');
			$data['info_membre'] =  $this->membre_model->get_membre_by_id($this->session->userdata('user_id'));
			$this->layout->view('quidditch_team', $data);
		}
		else{
			redirect('quidditch', 'location');
		}
	}

	// Fonction pour le CRON
	public function cron_simule_matchs($pass)
	{
		if($pass == "9b9c865533b3c0ab395d47c4725b37befa6afda3")
		{
			$this->load->model(array('quidditch_model'));
			$this->load->helper('quidditch_helper');

			$infos_match = $this->quidditch_model->get_quidditch_variables();
			$this->quidditch_model->get_matches($infos_match['semaine']);

			$puiss_t1 = 1000;
			$puiss_t2 = 1000;
			$proba_t1 = (puiss_t1*100)/(puiss_t1+puiss_t2);
			$proba_t2 = (puiss_t2*100)/(puiss_t1+puiss_t2);

		}
		else
		{
			redirect('home', 'location');
		}
	}
}
