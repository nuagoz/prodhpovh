<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crumble_model extends CI_Model
{
	public function get_crumble_cartes()
	{
		return $this->db->get($this->db->protect_identifiers(CRUMBLE_CARTES))->result_array();
	}

  public function get_crumble_carte($idcarte)
  {
    $this->db->where('id', $idcarte);
    return $this->db->get($this->db->protect_identifiers(CRUMBLE_CARTES))->result_array();
  }

  public function count_crumble_cartes(){
    return $this->db->get($this->db->protect_identifiers(CRUMBLE_CARTES))->num_rows();
  }
}
