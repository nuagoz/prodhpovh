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
if ( ! function_exists('create_campaign_html'))
{
	function create_campaign_html($campaigns)
	{
		$CI =& get_instance();
		$infos_campaigns = array('html_campaign' => '', 'total_commandes' => 0, 'total_profits' => 0, 'amount_due' => 0);

		if($campaigns)
		{
			$html_campaign = '';
			foreach ($campaigns as $campaign) {
				$infos_campaigns['total_commandes'] += $campaign['nbCommandes'];
				$infos_campaigns['total_profits'] += $campaign['profits'];
				$date_end = new DateTime($campaign['date_fin']);
				$current_date = new DateTime();
				$difference = $current_date->diff($date_end);
				// Génération du HTML
				$html_campaign .= '<div class="row row_campaign">';
					$html_campaign .= '<div class="col-sm-4">';
						$html_campaign .= '<img alt="140x140" class="img-rounded" data-src="holder.js/140x140" style="width: 70px; height: 70px;" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzE0MHgxNDAKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNTFiMmFiYmM1YyB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1MWIyYWJiYzVjIj48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjQ0LjA0MTY2NjAzMDg4Mzc5IiB5PSI3NC44Ij4xNDB4MTQwPC90ZXh0PjwvZz48L2c+PC9zdmc+" data-holder-rendered="true">';
						$html_campaign .= '<a href="'.base_url($campaign['url']).'" >'.$campaign['titre'].'</a>';
					$html_campaign .= '</div>';
					$html_campaign .= '<div class="col-sm-2 col_campaign">'.$campaign['nbCommandes'].' / '.$campaign['objectif_vente'].'</div>';
					$html_campaign .= '<div class="col-sm-2 col_campaign">';
						if($difference->invert === 0)
							$html_campaign .= sprintf($CI->lang->line('myaccount_time_rem'),$difference->d, $difference->h);
						else
							$html_campaign .= $CI->lang->line('myaccount_campaign_finished');
					$html_campaign .='</div>';
					$html_campaign .= '<div class="col-sm-2 col_campaign">'.$campaign['profits'].'€</div>';
					$html_campaign .= '<div class="col-sm-2 btn btn-edit_campaign">';
						$html_campaign .= '<a href="'.base_url('myaccount/edit_campaign/'.$campaign['url']).'" class="col-xs-12">';
							$html_campaign .= '<span>'.$CI->lang->line('myaccount_edit_campaign').'</span>';
						$html_campaign .= '</a>';
					$html_campaign .= '</div>';
				$html_campaign .= '</div>';
			}
			$infos_campaigns['html_campaign'] = $html_campaign;
		}
		return $infos_campaigns;
	}
}

/*
* Fonction subdomain()
* -----
* Enlève les accents et remplace les espaces par des tirets.
* -----
* -----
* @return  String
* -----
* $Author: Etienne $
* $Copyright: Tidda $
*/
if ( ! function_exists('subdomain'))
{
	function subdomain($str, $charset='utf-8')
	{
	    $str = htmlentities($str, ENT_NOQUOTES, $charset);
	    
	    $str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
	    $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
	    $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères
	    
	    return strtolower(str_replace(' ', '-', $str));
	}
}