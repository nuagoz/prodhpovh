<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crumble extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('membre_model');
    $this->load->model('crumble_model');
	}

	public function index()
	{
   // $this->layout->add_js('app');
    $this->layout->add_js('crumble');
    $this->layout->add_css('crumble');
    $this->layout->view('crumble');
    $_SESSION['cartes'] = array();
	}

  public function get_cartes()
  {
    $this->load->model('crumble_model');
    $this->load->helper('jsonresponse_helper');
    $compteur = 0;
    $cartes = $this->crumble_model->get_crumble_cartes();
    $nbcartes = $this->crumble_model->count_crumble_cartes();

    $liste_cartes = array();

    while($compteur < $this->input->post('quantite')){
        $res = mt_rand(0, $nbcartes-1);
        $carte = $cartes[$res]['id'];
        array_push($_SESSION['cartes'], $carte);
        $compteur++;
    }
    //$_SESSION['cartes'] = $liste_cartes;
    $liste_session = $_SESSION['cartes'];
    $jsonResponse = new JsonResponse();

    json_encode($liste_session);

    $jsonResponse->addOption('liste', $liste_session);
    $jsonResponse->render();

  }
// Fonction renvoyant uniquement la liste des cartes générées.
  public function get_liste_cartes()
  {
      $this->load->helper('jsonresponse_helper');
      $liste_session = $_SESSION['cartes'];
      $jsonResponse = new JsonResponse();
      $jsonResponse->addOption('liste', $liste_session);
      $jsonResponse->render();
  }

  public function get_info_carte()
  {
    $this->load->model('crumble_model');
    $this->load->helper('jsonresponse_helper');

    $infos = $this->crumble_model->get_crumble_carte($this->input->post('id'));

    $jsonResponse = new JsonResponse();
    $jsonResponse->addOption('nom', $infos[0]['nom']);
    $jsonResponse->addOption('description', $infos[0]['description']);
    $jsonResponse->addOption('url', $infos[0]['url']);
    $jsonResponse->render();
  }

  public function multiplayer()
  {
    $this->layout->add_js('crumblemulti');
    $this->layout->add_css('crumble');
    $this->layout->view('crumblemulti');
    $_SESSION['cartes'] = array();
  }

}
