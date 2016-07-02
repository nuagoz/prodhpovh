<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Membre_model extends CI_Model
{

	/*
	 * Fonction add_membre($infos)
	 * -----
	 * Fonction permettant de créer un membre en base de données
	 * -----
	 * @param 	Array 		$infos 			Tableau contenant les informations du membre
	 * -----
	 * @return  int 						Id du membre créé
	 * -----
	 * $Author: Etienne $
	 */
	public function add_membre($infos)
	{
		$this->db->insert($this->db->protect_identifiers(MEMBRE), $infos);
		return $this->db->insert_id();
	}

	/*
	 * Fonction permettant de récupérer les informations de tous les membres
	 */
	public function get_all_membres()
	{
		return $this->db->get($this->db->protect_identifiers(MEMBRE))->result_array();
	}

	/*
	 * Fonction permettant de récupérer les informations d'un membre en particulier
	 */
	public function get_membre($id_membre)
	{
		$this->db->where('id', $id_membre);
		return $this->db->get($this->db->protect_identifiers(MEMBRE))->row_array();
	}

	public function classement()
	{
		$this->db->select('id, pseudo, points');
		$this->db->order_by("points", "desc");
		return $this->db->get($this->db->protect_identifiers(MEMBRE))->result_array();
	}
}