<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Titre_model extends CI_Model
{
	/*
	 * Fonction permettant de récupérer tous les titres
	 */
	public function get_titres()
	{
		return $this->db->get($this->db->protect_identifiers(TITRE))->result_array();
	}

	/*
	 * Fonction permettant d'ajouter un titre à un membre.
	 * Il faut inclure l'id du membre et l'id du titre dans le tableau en paramètre.
	 */
	public function add_titre($infos)
	{
		$this->db->insert($this->db->protect_identifiers(POSSEDETITRE), $infos);
		return $this->db->insert_id();
	}

	public function get_
}