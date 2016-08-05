<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Management_model extends CI_Model
{

	/*
	 * Fonction get_animaux_membre($infos)
	 * -----
	 * Fonction permettant de récupérer les animaux d'un membre
	 * -----
	 * @param 	String 		$idmembre 		ID du membre
	 * -----
	 * @return  Array 						Liste des animaux
	 * -----
	 * Je n'ai pas mis de SELECT * parce que ça récupérerait trop d'infos inutiles. Il faudra
	 * donc mettre à jour la fonction si on rajoute des infos aux animaux.
	 * $Author: Etienne $
	 */
	public function get_animaux_membre($idmembre)
	{
		$this->db->select(POSSEDEANIMAL.'.id, date_utilisation, idanimal, cooldown, gainmin, gainmax, nickname, rare, succes, bonus_gx2');
		$this->db->from(POSSEDEANIMAL);
		$this->db->join(ANIMAL, POSSEDEANIMAL.'.idanimal = '.ANIMAL.'.id');
		$this->db->where('idmembre', $idmembre);
		$this->db->order_by('cooldown, idanimal');
		return $this->db->get()->result_array();
	}
	/*
    $requete = $bdd->prepare('SELECT possedeanimal.id, date_utilisation, idanimal, cooldown, gainmin, gainmax, nickname, rare, succes, bonus_gx2
                          FROM possedeanimal
                          LEFT JOIN animal
                          ON possedeanimal.idanimal = animal.id
                          WHERE idmembre = :idmembre order by cooldown, idanimal' );*/
    public function get_animal_membre($idanimal, $idmembre)
	{
		$this->db->select(POSSEDEANIMAL.'.id, date_utilisation, idanimal, cooldown, gainmin, gainmax, courriers, courriersfail, nickname, rare, succes, bonus_gx2');
		$this->db->from(POSSEDEANIMAL);
		$this->db->join(ANIMAL, POSSEDEANIMAL.'.idanimal = '.ANIMAL.'.id');
		$this->db->where('idmembre', $idmembre);
		$this->db->order_by('cooldown, idanimal');
		return $this->db->get()->result_array();
	}

	/*
	 * Fonction get_infos_animaux_membre($idmembre, $idanimal)
	 * -----
	 * Fonction permettant de récupérer les infos d'un animal d'un membre
	 * -----
	 * @param 	String 		$idmembre 		ID du membre
	 * @param 	String 		$idanimal 		ID de l'animal
	 * -----
	 * @return  Array 						Liste des animaux
	 * 
	 * Si la fonction renvoie false, c'est que l'animal n'appartient pas 
	 * au membre (vérification/sécurité).
	 * -----
	 * $Author: Etienne $
	 */
	public function get_infos_animaux_membre($idmembre, $idanimal)
	{
		$this->db->select(POSSEDEANIMAL.'.id, courriers, courriersfail, pp, date_utilisation, idanimal, cooldown, gainmin, gainmax, nickname, rare, succes, bonus_gx2');
		$this->db->join(ANIMAL, POSSEDEANIMAL.'.idanimal = '.ANIMAL.'.id');
		$this->db->where(POSSEDEANIMAL.'.id', $idanimal);
		$this->db->where('idmembre', $idmembre);
		$result = $this->db->get($this->db->protect_identifiers(POSSEDEANIMAL));

		if($result->num_rows() === 1)
		{
			return $result->row_array();
		}
		return false;
	}

	/*
	 * Fonction update_animal($idmembre, $idanimal, $data)
	 * -----
	 * Fonction permettant d'update les infos d'un animal d'un membre
	 * -----
	 * @param 	String 		$idmembre 		ID du membre
	 * @param 	String 		$idanimal 		ID de l'animal
	 * @param   Array       $data 			Liste des infos à update
	 * -----
	 * @return  Bool 						
	 * 
	 * -----
	 * $Author: Etienne $
	 */
	public function update_animal($idanimal, $data)
	{
		$this->db->where('id', $idanimal);
		return $this->db->update($this->db->protect_identifiers(POSSEDEANIMAL), $data);
	}

	public function delete_animal($idanimal)
	{
		$this->db->where('id', $idanimal);
		return $this->db->delete($this->db->protect_identifiers(POSSEDEANIMAL));
	}

	public function count_animal($idmembre)
	{
		$this->db->select('id');
		$this->db->where('idmembre', $idmembre);
		return $this->db->get($this->db->protect_identifiers(POSSEDEANIMAL))->num_rows();
	}

	/* Vérifie si l'utilisateur a un felix felicis et récupère le temps */
	public function get_felix($idmembre)
	{
		$this->db->select('temps');
		$this->db->where('idmembre', $idmembre);
		$result = $this->db->get($this->db->protect_identifiers(BONUS_MEMBRE));

		if($result->num_rows() === 1)
		{
			return $result->row_array();
		}
		return false;
	}

	/* Retourne une stat d'un membre */
	public function get_stat($idmembre, $idstat)
	{	
		$this->db->join(STATISTIQUE, MEMBRE_STATISTIQUE.'.idstatistique = '.STATISTIQUE.'.id');
		$this->db->where(MEMBRE_STATISTIQUE.'.idmembre', $idmembre);
		$this->db->where(MEMBRE_STATISTIQUE.'.idstatistique', $idstat);
		$result = $this->db->get($this->db->protect_identifiers(MEMBRE_STATISTIQUE));
		if($result->num_rows() > 0)
		{
			return $result->row_array();
		}
		return false;
	}

	/* retourne toutes les stats d'un membre */
	public function get_stats($idmembre)
	{	
		$this->db->join(STATISTIQUE, MEMBRE_STATISTIQUE.'.idstatistique = '.STATISTIQUE.'.id');
		$this->db->where(MEMBRE_STATISTIQUE.'.idmembre', $idmembre);
		$result = $this->db->get($this->db->protect_identifiers(MEMBRE_STATISTIQUE));
		if($result->num_rows() > 0)
		{
			return $result->row_array();
		}
		return false;
	}

	public function get_cards($idmembre, $count=false)
	{
		$this->db->join(CARTE, POSSEDECARTE.'.idcarte = '.CARTE.'.id');
		$this->db->where(POSSEDECARTE.'.idmembre', $idmembre);
		if($count){
			return $this->db->get($this->db->protect_identifiers(POSSEDECARTE))->num_rows();
		}
		else{
			$result = $this->db->get($this->db->protect_identifiers(POSSEDECARTE));
			if($result->num_rows() > 0)
			{
				return $result->result_array();
			}
			return false;
		}
	}

	public function get_all_cards($count=false)
	{
		if($count){
			return $this->db->get($this->db->protect_identifiers(CARTE))->num_rows();
		}
		else{
			return $this->db->get($this->db->protect_identifiers(CARTE));
		}
	}

	public function add_stat($idmembre, $idstat, $valeur)
	{
		$this->db->select('id');
		$this->db->where('idmembre', $idmembre);
		$this->db->where('idstatistique', $idstat);
		$result = $this->db->get($this->db->protect_identifiers(MEMBRE_STATISTIQUE));

		if($result->num_rows() === 1)
		{
			$this->db->where('idmembre', $idmembre);
			$this->db->where('idstatistique', $idstat);
			$this->db->set('valeur', $valeur);
			return $this->db->update($this->db->protect_identifiers(MEMBRE_STATISTIQUE));
		}
		else
		{
			$data = array (
				'valeur' 		=> $valeur,
				'idmembre'		=> $idmembre,
				'idstatistique'	=> $idstat
			);
			$this->db->where('idmembre', $idmembre);
			$this->db->where('idstatistique', $idstat);
			return $this->db->insert($this->db->protect_identifiers(MEMBRE_STATISTIQUE), $data);
		}
	}
}