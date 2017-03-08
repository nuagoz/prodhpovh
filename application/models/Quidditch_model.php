<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quidditch_model extends CI_Model
{
	/*
	 * Fonction permettant de récupérer les informations de toutes les équipes
	 */
	public function get_teams()
	{
		return $this->db->get($this->db->protect_identifiers(EQUIPES_QUIDDITCH))->result_array();
	}

	public function get_team($idteam)
	{
		$this->db->where('id', $idteam);
		$result = $this->db->get($this->db->protect_identifiers(EQUIPES_QUIDDITCH));

		if($result->num_rows() === 1)
			return $result->row_array();
		return false;
	}

	/*
	 * Fonction permettant de récupérer les informations des équipes et leurs points/stats
	 */
	public function get_teams_stats()
	{
		$this->db->join(EQUIPES_QUIDDITCH, QUIDDITCH_RANK.'.idequipe = '.EQUIPES_QUIDDITCH.'.id');
		return $this->db->get($this->db->protect_identifiers(QUIDDITCH_RANK))->result_array();
	}

	public function get_quidditch_variables()
	{
		return $this->db->get($this->db->protect_identifiers(QUIDDITCH_VARIABLES))->row_array();
	}

	// Renvoie les matchs pour la semaine passée en paramètre
	public function get_matches($semaine)
	{
		$this->db->where('idsemaine', $semaine);
		return $this->db->get($this->db->protect_identifiers(QUIDDITCH_PLANNING))->result_array();
	}
}