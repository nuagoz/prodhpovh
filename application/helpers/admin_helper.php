<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*
 * Fonction tshirt_url()
 * -----
 * Récupère le chemin où sont stockés les images des t-shirt
 * -----
 * -----
 * @return  String 			Chemin
 * -----
 * $Author: Dimitri $
 * $Copyright: Tidda $
 */
if ( ! function_exists('tshirt_url'))
{
    function tshirt_url()
    {
        $CI =& get_instance();
        return base_url() . $CI->config->item('tshirt_path');
    }
}

/*
 * Fonction tshirt($filename, $atts)
 * -----
 * Génère la balise <img> d'un t-shirt
 * -----
 * @param 	String   $filename 			Nom de l'image du t-shirt
 * @param 	Array    $attrs 			Attribut à appliquer sur la balise <img>
 * -----
 * @return  String 				balise <img>
 * -----
 * $Author: Dimitri $
 * $Copyright: Tidda $
 */
if ( ! function_exists('tshirt'))
{
	function tshirt($filename,  $atts = array())
	{
		$url = '<img src="' . tshirt_url() . $filename . '"';
		foreach ( $atts as $key => $val )
		$url .= ' ' . $key . '="' . $val . '"';
		$url .= " />\n";
		return $url;
	}
}

/*
 * Fonction campaign_url()
 * -----
 * Récupère le chemin où sont stockés les images des campagnes
 * -----
 * -----
 * @return  String 			Chemin
 * -----
 * $Author: Dimitri $
 * $Copyright: Tidda $
 */
if ( ! function_exists('campaign_url'))
{
    function campaign_url()
    {
        $CI =& get_instance();
        return base_url() . $CI->config->item('campaign_path');
    }
}

/*
 * Fonction campaign($filename, $atts)
 * -----
 * Génère la balise <img> d'un t-shirt
 * -----
 * @param 	String   $path 			Chemin de l'image de campagne
 * @param 	Array    $attrs 		Attribut à appliquer sur la balise <img>
 * -----
 * @return  String 				balise <img>
 * -----
 * $Author: Dimitri $
 * $Copyright: Tidda $
 */
if ( ! function_exists('campaign'))
{
	function campaign($path,  $atts = array())
	{
		$url = '<img src="' . campaign_url() . $path . '"';
		foreach ( $atts as $key => $val )
		$url .= ' ' . $key . '="' . $val . '"';
		$url .= " />\n";
		return $url;
	}
}

/*
 * Fonction create_html_model_img($filename, $atts)
 * -----
 * Génère le HTML pour un t-shirt dans la partie admin
 * -----
 * @param 	String   $filename 			Nom de l'image du t-shirt
 * @param 	Array    $attrs 			Attribut à appliquer sur la balise <img>
 * -----
 * @return  String 				HTML généré
 * -----
 * $Author: Dimitri $
 * $Copyright: Tidda $
 */
if ( ! function_exists('create_html_model_img'))
{
	function create_html_model_img($filename=null, $atts=array())
	{
		$html = '';
		if($filename != '')
		{
			$html = tshirt($filename, $atts);
		}
		return $html;
	}
}

/*
 * Fonction add_admin_img($files, $id_model, $titre, $field, $prefix)
 * -----
 * Ajoute l'image d'un t-shirt en base, et sauvegarde l'image sur le serveur
 * -----
 * @param 	Array   	$files 			Tableau des images uploadées
 * @param 	int    		$id_model 		Id du modèle
 * @param 	String   	$titre 			Nom donné au modèle
 * @param 	String    	$field 			Nom du champ (image_face ou image_dos)
 * @param 	String   	$prefix 		(front ou back)
 * -----
 * $Author: Dimitri $
 * $Copyright: Tidda $
 */
if ( ! function_exists('add_admin_img'))
{
	function add_admin_img($files, $id_model, $titre, $field, $prefix)
	{
		$CI =& get_instance();

		$CI->load->model('admin_model');
		$CI->load->model('modele_model');
		// Ajout de l'image sur le serveur
		$image = $CI->admin_model->upload_img_tshirt($field, str_replace('.', '_',$prefix.'_'.$titre));

		if(is_array($image))
		{
			// MAJ du modèle
			$model_infos = array(
				$field 			=> $image[0]['file_name']
			);
			$CI->modele_model->update_modele($id_model, $model_infos);
		}
	}
}

/*
 * Fonction delete_admin_img($id_model, $field)
 * -----
 * Supprime une image d'un modèle sur le serveur
 * -----
 * @param 	int    		$id_model 		Id du modèle
 * @param 	String    	$field 			Nom du champ (image_face ou image_dos)
 * -----
 * $Author: Dimitri $
 * $Copyright: Tidda $
 */
if ( ! function_exists('delete_admin_img'))
{
	function delete_admin_img($id_model, $field)
	{
		$CI =& get_instance();
		$CI->load->model('modele_model');
		$infos_modele = $CI->modele_model->get_infos_modele($id_model);

		if(isset($infos_modele[0][$field]))
		{
			// Suppression du fichier sur le serveur
			array_map('unlink', glob($CI->config->item('tshirt_path').$infos_modele[0][$field]));
		}
	}
}

/*
 * Fonction add_admin_header($files, $id_header, $titre, $field, $prefix)
 * -----
 * Ajoute l'image d'un logo header en base, et sauvegarde l'image sur le serveur
 * -----
 * @param 	Array   	$files 			Tableau des images uploadées
 * @param 	int    		$id_header 		Id du header
 * @param 	String   	$titre 			Nom du header
 * @param 	String    	$field 			Nom du champ (logo)
 * @param 	String   	$prefix 		(front ou back)
 * -----
 * $Author: Dimitri $
 * $Copyright: Tidda $
 */
if ( ! function_exists('add_admin_header'))
{
	function add_admin_header($files, $id_header, $titre, $field, $prefix)
	{
		$CI =& get_instance();

		$CI->load->model('admin_model');
		$CI->load->model('store_model');
		$CI->load->helper('my_directory_helper');
		// Création si nécessaire du répertoire des images de la boutique
		create_dir($CI->config->item('header_path').$titre);
		// Ajout de l'image sur le serveur
		$image = $CI->admin_model->upload_img_header($field, $titre);
		if(is_array($image))
		{
			// MAJ du header
			$header_infos = array(
				'dir' 			=> $titre,
				$field 			=> $image[0]['file_name']
			);
			$CI->store_model->update_header($id_header, $header_infos);
		}
	}
}

/*
 * Fonction delete_admin_header($id_header, $field)
 * -----
 * Supprime une image d'un header sur le serveur
 * -----
 * @param 	int    		$id_header 		Id du header
 * @param 	String    	$field 			Nom du champ
 * -----
 * $Author: Dimitri $
 * $Copyright: Tidda $
 */
if ( ! function_exists('delete_admin_header'))
{
	function delete_admin_header($id_header, $field)
	{
		$CI =& get_instance();
		$CI->load->model('store_model');
		$infos_header = $CI->store_model->get_header_infos($id_header);

		if(isset($infos_header[$field]))
		{
			// Suppression du fichier sur le serveur
			array_map('unlink', glob($CI->config->item('header_path').$infos_header['dir'].'/'.$infos_header[$field]));
		}
	}
}

/*
 * Fonction header_url()
 * -----
 * Récupère le chemin où sont stockés les images des header
 * -----
 * -----
 * @return  String 			Chemin
 * -----
 * $Author: Dimitri $
 * $Copyright: Tidda $
 */
if ( ! function_exists('header_url'))
{
    function header_url()
    {
        $CI =& get_instance();
        return base_url() . $CI->config->item('header_path');
    }
}

/*
 * Fonction logo_header($directory, $filename, $atts)
 * -----
 * Génère la balise <img> d'un logo header
 * -----
 * @param 	String   $directory 		Nom du répertoire du header
 * @param 	String   $filename 			Nom de l'image du logo header
 * @param 	Array    $attrs 			Attribut à appliquer sur la balise <img>
 * -----
 * @return  String 				balise <img>
 * -----
 * $Author: Dimitri $
 * $Copyright: Tidda $
 */
if ( ! function_exists('logo_header'))
{
	function logo_header($directory, $filename,  $atts = array())
	{
		$url = '<img src="' . header_url().$directory.'/'. $filename . '"';
		foreach ( $atts as $key => $val )
		$url .= ' ' . $key . '="' . $val . '"';
		$url .= " />\n";
		return $url;
	}
}

/*
 * Fonction create_html_logo_header($filename, $atts)
 * -----
 * Génère le HTML pour un logo header
 * -----
 * @param 	String   $directory 		Nom du répertoire du header
 * @param 	String   $filename 			Nom de l'image du logo header
 * @param 	Array    $attrs 			Attribut à appliquer sur la balise <img>
 * -----
 * @return  String 				HTML généré
 * -----
 * $Author: Dimitri $
 * $Copyright: Tidda $
 */
if ( ! function_exists('create_html_logo_header'))
{
	function create_html_logo_header($directory, $filename=null, $atts=array())
	{
		$html = '';
		if($filename != '')
		{
			$html = logo_header($directory, $filename, $atts);
		}
		return $html;
	}
}

/*
 * Fonction admin_url()
 * -----
 * Retourne l'URL admin
 * -----
 * @param 	String 		$rest_path 		Reste du chemin
 * -----
 * @return  String 			Chemin
 * -----
 * $Author: Dimitri $
 * $Copyright: Tidda $
 */
if ( ! function_exists('admin_url'))
{
    function admin_url($rest_path)
    {
        return base_url().'admin/bo/'.$rest_path;
    }
}

/*
 * Fonction admin_language()
 * -----
 * Retourne l'URL admin
 * -----
 * @param 	String 		$rest_path 		Reste du chemin
 * -----
 * @return  String 			Chemin
 * -----
 * $Author: Dimitri $
 * $Copyright: Tidda $
 */
if ( ! function_exists('admin_language_url'))
{
	function admin_language_url()
	{
		$CI =& get_instance();
		return base_url().$CI->config->item('admin_language_path');
	}
}

/*
 * Fonction create_html_color_image($filename, $atts)
 * -----
 * Génère le HTML pour l'image de la couleur
 * -----
 * @param   String   $filename          Nom de l'image de la couleur
 * @param   Array    $attrs             Attribut à appliquer sur la balise <img>
 * -----
 * @return  String              HTML généré
 * -----
 * $Author: Dimitri $
 * $Copyright: Tidda $
 */
if ( ! function_exists('create_html_color_image'))
{
    function create_html_color_image($filename=null, $atts=array())
    {
        $html = '';
        if($filename != '')
        {
            $html = color_image($filename, $atts);
        }
        return $html;
    }
}

/*
 * Fonction delete_admin_couleur($id_color, $field)
 * -----
 * Supprime une image d'une couleur sur le serveur
 * -----
 * @param 	int    		$id_color 		Id de la couleur
 * @param 	String    	$field 			Nom du champ
 * -----
 * $Author: Dimitri $
 * $Copyright: Tidda $
 */
if ( ! function_exists('delete_admin_couleur'))
{
	function delete_admin_couleur($id_color, $field)
	{
		$CI =& get_instance();
		$CI->load->model('couleur_model');
		$infos_couleur = $CI->couleur_model->get_infos_couleur($id_color);

		if(isset($infos_couleur[$field]))
		{
			// Suppression du fichier sur le serveur
			array_map('unlink', glob($CI->config->item('color_path').$infos_couleur[$field]));
		}
	}
}

/*
 * Fonction add_admin_couleur($files, $id_color, $titre, $field, $prefix)
 * -----
 * Ajoute l'image d'un logo header en base, et sauvegarde l'image sur le serveur
 * -----
 * @param 	Array   	$files 			Tableau des images uploadées
 * @param 	int    		$id_color 		Id de la couleur
 * @param 	String    	$field 			Nom du champ (image)
 * @param 	String   	$prefix 		
 * -----
 * $Author: Dimitri $
 * $Copyright: Tidda $
 */
if ( ! function_exists('add_admin_couleur'))
{
	function add_admin_couleur($files, $id_color, $titre, $field, $prefix)
	{
		$CI =& get_instance();

		$CI->load->model('admin_model');
		$CI->load->model('couleur_model');
		$CI->load->helper('my_directory_helper');
		// Création si nécessaire du répertoire des images de couleur
		create_dir($CI->config->item('color_path'));
		// Ajout de l'image sur le serveur
		$image = $CI->admin_model->upload_img_couleur($field, $titre);
		if(is_array($image))
		{
			// MAJ de la couleur
			$couleur_infos = array(
				$field 			=> $image[0]['file_name']
			);
			$CI->couleur_model->update_couleur($id_color, $couleur_infos);
		}
	}
}