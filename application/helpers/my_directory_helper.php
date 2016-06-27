<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('create_dir'))
{
	/*
	 * Fonction create_dir($path)
	 * -----
	 * Fonction permettant de créer un répertoire à un endroit précis, s'il n'existe pas déjà
	 * -----
	 * @param   String 		$path 				Chemin du répertoire					
	 * -----
	 * $Author: Dimythos $
	 * $Copyright: PocPic $
	 */
	function create_dir($path)
	{
		$CI =& get_instance();
		$CI->load->helper('file');
		if(!is_dir($path))
		{
			// Création du répertoire
			mkdir($path);
			// Création d'un fichier index.html dans le répertoire afin d'empêcher de voir ce qu'il contient
			$data = '<html><head><title>403 Forbidden</title></head><body></body></html>';
			write_file($path.'/index.html', $data);
		}
	}
}