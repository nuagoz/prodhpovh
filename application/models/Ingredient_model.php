<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ingredient_model extends CI_Model
{
	/*
	 * Fonction get_ingredients($infos)
	 * -----
	 * Fonction permettant de récupérer les infos ingrédients
	 * -----
	 * -----
	 * @return  Array 						Liste des ingrédients
	 * -----
	 * $Author: Etienne $
	 */
	public function get_ingredients()
	{
		return $this->db->get($this->db->protect_identifiers(INGREDIENT))->result_array();
	}

	public function add_ingredient($idingredient, $idmembre)
	{
		$this->db->select('id');
		$this->db->where('idingredient', $idingredient);
		$this->db->where('idmembre', $idmembre);
		$result = $this->db->get($this->db->protect_identifiers(POSSEDEINGREDIENT));

		if($result->num_rows() === 1) // Si une ligne existe déjà, on update
		{
			$this->db->set('quantite', 'quantite+1', FALSE);
			$this->db->where('idmembre', $idmembre);
			$this->db->where('idingredient', $idingredient);
			return $this->db->update($this->db->protect_identifiers(POSSEDEINGREDIENT));
		}
		else{ // Si pas de ligne -> insert

			$data = array(
				'idmembre' => $idmembre,
				'idingredient' => $idingredient,
				'quantite' => 1
			);
			return $this->db->insert($this->db->protect_identifiers(POSSEDEINGREDIENT), $data);
		}
	}
}