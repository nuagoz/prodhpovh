<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('affiche_carte_equipe')){

	function affiche_carte_equipe($data)
	{
		$carte = "<div id='list_team' class = 'col-xs-12'>";
		foreach($data as $key => $value){
			$carte .= "<div class = 'col-xs-12 col-sm-6 col-md-3 col-lg-3 text-center'>";
				$carte .= "<img class='card_quidditch' src = '".img_url('quidditch')."/".$value['logo']."' id = 'card_".$key."' data-name='".$value['nom']."'/>";
			$carte .= "</div>";
		}
		$carte .= "</div>";
		return $carte;
	}
}

if ( ! function_exists('affiche_classement')){

	function affiche_classement($data)
	{
	}
}