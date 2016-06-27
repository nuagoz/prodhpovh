<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*
* Fonction preview_html()
* -----
* Génère le HTML des items de la popup de la page produit
* -----
* -----
* @return  String 			HTML généré
* -----
* $Author: Dimitri $
* $Copyright: Tidda $
*/
if ( ! function_exists('preview_html'))
{
	function preview_html($items)
	{
		$CI =& get_instance();
		$CI->load->model('reference_model');

		$html = '';

		foreach ($items as $item) {
			// Récupération des tailles de l'item courant
			$tailles = $CI->reference_model->get_taille_reference($item['options']['re_id']);

			$array_tailles = array();
			foreach ($tailles as $value) {
				$array_tailles[$value['libelle']] = $value['libelle'];
			}

			$input_quantite = array(
				'name' 			=> 'quantite-'.$item['row_id'],
				'id'			=> 'quantite-'.$item['row_id'],
				'type' 			=> 'number',
				'class'			=> 'col-xs-12 input_quantite',
				'value' 		=> $item['quantity'],
				'onchange'		=> 'changePrice(this);'
			);

			$html .= '<div class="col-xs-12">';
				$html .= '<div class="col-xs-4 no-padding-left modal_items">'.$item['options']['description'].'</div>';
				$html .= '<div class="col-xs-2 no-padding-left modal_items">';
					$html .= '<label class="color-preview color-modal" style=\''.$item['options']['couleur_html'].'\'></label>';
				$html .= '</div>';
				$html .= '<div class="col-xs-2 no-padding-left modal_items">'.form_dropdown('taille-'.$item['row_id'], $array_tailles, $item['taille'], array('class' => 'col-xs-12')).'</div>';
				$html .= '<div class="col-xs-2 no-padding-left modal_items text-center">'.form_input($input_quantite).'</div>';
				$html .= '<div class="col-xs-2 modal_items"><span class="price" id="price-'.$item['row_id'].'">'.($item['internal_price']*$item['quantity']).'</span>&euro;</div>';
				$html .= '<input type="hidden" value="'.$item['internal_price'].'" name="'.$item['row_id'].'" id="'.$item['row_id'].'"/>';
			$html .= '</div>';
		}
		return $html;
	}
}