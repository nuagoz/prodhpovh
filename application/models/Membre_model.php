<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Membre_model extends CI_Model
{

	public function update_membre($idmembre, $data)
	{

		$this->db->where('id', $idmembre);
		return $this->db->update($this->db->protect_identifiers(MEMBRES), $data);
	}
	/*
	 * Fonction permettant de récupérer les informations de tous les membres
	 */
	public function get_all_membres()
	{
		return $this->db->get($this->db->protect_identifiers(MEMBRES))->result_array();
	}

	/*
	 * Fonction permettant de récupérer les informations d'un membre en particulier
	 */
	public function get_membre_by_id($id_membre)
	{
		$this->db->where('id', $id_membre);
		return $this->db->get($this->db->protect_identifiers(MEMBRES))->row_array();
	}

	public function get_membre_by_pseudo($pseudo)
	{
		$this->db->where('pseudo', $pseudo);
		return $this->db->get($this->db->protect_identifiers(MEMBRES))->row_array();
	}

	public function classement()
	{
		$this->db->select('id, pseudo, points');
		$this->db->order_by("points", "desc");
		return $this->db->get($this->db->protect_identifiers(MEMBRES))->result_array();
	}

	public function get_argent($idmembre)
	{
		$this->db->select('argent');
		$this->db->where('id', $idmembre);
		$valeur = $this->db->get($this->db->protect_identifiers(MEMBRES))->row_array();
		return $valeur['argent'];
	}
}