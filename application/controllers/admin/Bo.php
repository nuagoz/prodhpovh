<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Grocery_CRUD');
		//$this->load->helper('admin_helper');
		$this->crud = new Grocery_CRUD();
		$this->data  = array();
	}

	public function index()
	{
		$this->membre_management();
	}

	/*
	 * Fonction _grocery_layout()
	 * -----
	 * Fonction permettant d'afficher la vue avec les JS grocery
	 * -----
	 */	
	private function _grocery_layout()
	{
		// On charge le thème 'admin'
		$this->layout->set_theme('admin');
		// Récupération du rendu de Grocery
		$render = $this->crud->render();
		// Ajout des fichiers JS
		foreach ($render->js_files as $js) {
			$this->layout->add_js_grocery($js);
		}
		// Ajout des fichiers CSS
		foreach ($render->css_files as $css) {
			$this->layout->add_css_grocery($css);
		}
		$this->data['grocery_output'] = $render->output;
		// Chargement de la vue avec les données
		$this->layout->view('admin/layout',$this->data);
	}

	/*
	 * Fonction _unique_field_name($field_name)
	 * -----
	 * Fonction bugfix lorsque l'on veut appliquer une règle sur un champ d'une relation
	 * -----
	 */	
	private function _unique_field_name($field_name) {
		return 's'.substr(md5($field_name),0,8); //This s is because is better for a string to begin with a letter and not with a number
	}

	/*
	 * Fonction launch_management()
	 * -----
	 * Fonction permettant de créer la vue pour la gestion des inscrits
	 * -----
	 */
    public function membre_management()
	{
		// Themes
    	$this->crud->set_theme('datatables');
		// Table
		$this->crud->set_table(MEMBRES);
		// Titre
		$this->layout->set_title('Admin | Config');
		// Affichage colonne
		$this->crud->columns('id', 'ip_address', 'pseudo', 'password', 'email', 'created_on', 'last_login', 'active');

		$this->crud->add_fields('pseudo', 'password', 'email');
		$this->crud->edit_fields('id', 'ip_address', 'pseudo', 'password', 'email', 'created_on', 'last_login', 'active');

		$this->crud->field_type('active', 'true_false');

		// Génération de la vue
		$this->_grocery_layout();
	}

	public function players_management()
	{
		// Themes
    	$this->crud->set_theme('datatables');
		// Table
		$this->crud->set_table(MEMBRES);
		// Titre
		$this->layout->set_title('Admin | Joueurs');
		// Affichage colonne
		$this->crud->set_relation('id', MEMBRE_STATISTIQUE, 'idmembre');

		$this->crud->columns('pseudo', 'argent', 'points', 'avatar');
		$this->crud->edit_fields('pseudo', 'argent', 'points', 'avatar');
		// Génération de la vue
		$this->_grocery_layout();
	}
}