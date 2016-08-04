<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*
* Fonction ingredientOk($ratio, $bonus)
* -----
* Détermine si le hibou a gagné un ingrédient ou pas
*
* -----
* -----
* @return  Bool 		true si oui, false si non.
* -----
* $Author: Psylaw $
*/
if ( ! function_exists('ingredientOk')){

	function ingredientOk($ratio, $bonus)
	{
		$max=100;
		$nb=$ratio;

		if($bonus)
			$nb = $nb*3;

		if(is_float($ratio))
		{
			$max=$max*1000;
			$nb=$nb*1000;
		}
		$rand=mt_rand(0,$max);
		return $rand<=$nb;
	}
}

if ( ! function_exists('trouverIngredient')){
	
	function trouverIngredient($ingredients)
	{
		$verif=[];
		$j=0;
		$somme=0;
		foreach($ingredients as $ingredient)
		{
			$somme+=$ingredient['taux'];
			$verif[$j]['id']=$ingredient['id'];
			$verif[$j]['taux']=$somme;
			$verif[$j]['nom']=$ingredient['nom'];
			$verif[$j]['url']=$ingredient['url'];
			$j++;
		}
		$rand=rand(1,$somme);
		$j=0;
		foreach($verif as $ver)
		{
			if($rand<$ver['taux'])
			{
				break;
			}
			$j++;
		}
		return $verif[$j];
	}
}
if ( ! function_exists('build_fiche_cd')){

	function build_fiche_cd($info)
	{
		$texte = $info['rare'] == 1 ? "textepigeonrare" : "textepigeon";

		$cadre = "<input class='croix' type='button' onclick='confirmMessage(".$info['idhibou'].")' title='Relâcher votre animal' id='".$info['idhibou']."' name='id' value='".$info['idhibou']."'/>";
		$cadre .= "<div id='hibou'>";
			$cadre .= "<img src='".img_url('animaux/'.$info['idh'].'.jpg')."' 'height='120' width='120' id='img_hibou_".$info['idhibou']."' title ='[ ".$info['gainmin']." ; ".$info['gainmax']." ] - ".$info['succes']." %'>";
		$cadre .= "</div>";
		$cadre .= "<div class = 'textepigeon' id = 'lien_".$info['idhibou']."'>";
			$cadre .= "<span id = 'textepigeon_".$info['idhibou']."'>";
				$cadre .= "<span class='".$texte."'>".$info['nickname']."</span>";
			$cadre .= "</span>";
		$cadre .= "</div>";
		$cadre .= "<div class = 'repos2' id='repos_".$info['idhibou']."''>Repos</div>";
		$cadre .= "<span class ='timer' id= 'timer_div_".$info['idhibou']."'></span>";
			$cadre .= " <img src='".img_url('chrono.gif')."' height='16' width='16' id='img_".$info['idhibou']."'><span id='br_".$info['idhibou']."'><br/>";
		$cadre .= "</span>";
		$cadre .= "<span id ='disabl_".$info['idhibou']."'>";
			$cadre .= "<input type='button' id='envoi_".$info['idhibou']."' onclick='send_animal(".$info['idhibou'].")' class='btn btn-primary send_button disabled' value='Livrer le courrier' id='envoi_".$info['idhibou']."'/>";
		$cadre .= "</span>";

		$cadre .= "<script>
			var seconds_left_".$info['idhibou']." =".$info['calcul'].";
			var interval_".$info['idhibou']." = setInterval(function() {
			var temps_".$info['idhibou']." = new Date(--seconds_left_".$info['idhibou']."*1000);
			document.getElementById('timer_div_".$info['idhibou']."').innerHTML = temps_".$info['idhibou'].".getHours()-1+':'+('0'+temps_".$info['idhibou'].".getMinutes()).substr(-2)+':'+('0'+temps_".$info['idhibou'].".getSeconds()).substr(-2);

				if (seconds_left_".$info['idhibou']." <= 0)
				{
					document.getElementById('timer_div_".$info['idhibou']."').innerHTML = '0';										

					$('#textepigeon_".$info['idhibou']."' ).append('<div class=\'dispo2\' id=\'dispo_".$info['idhibou']."\'>Disponible</div>');
					$('#timer_div_".$info['idhibou']."').remove();
					$('#img_".$info['idhibou']."').remove();
					$('#repos_".$info['idhibou']."').remove();
					$('#br_".$info['idhibou']."').remove();
					$('#envoi_".$info['idhibou']."').removeClass('disabled');
					$('#envoi_".$info['idhibou']."').removeAttr('disabled');
					clearTimeout(window['interval_".$info['idhibou']."']); // Arrêter le décompte.
				}
			}, 1000);
		</script>";

		return $cadre;
	}
}
