<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Membre_model extends CI_Model
{


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