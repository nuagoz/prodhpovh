<div class="container-fluid">
  <div class="row">
  <?php include('sidebar.php'); ?>

  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 right-zone">

	<div id ='notif_envoi' style='display:none;'></div>
	<div id ='notif_ingredient' style='display:none;'></div>
	<input type='hidden' id='message_confirm' value='Voulez vous vraiment relâcher cet animal ?'/>

	<div class="modal fade" id="ingredient_list" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Liste des ingrédients récoltés</h4>
	      </div>
	      <div class="modal-body col-xs-12">
	      	<!-- zone des ingrédients -->
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<h1 class='zone_title'>Vos animaux</h1>

	<div class = 'hidden-sm hidden-xs'>
		<div id = 'zone_container' class='col-xs-12 line-center'>
			<div class='col-xs-4 text-center'>
				<div id='count-pigeonnier' class='oswald'>15/20</div>
			</div>
			<div class='col-xs-4 text-center'>
				<div id = 'count-pigeonnier' class='oswald'>
					Pigeonnier niveau 3
				</div>
			</div>
			<div class='col-xs-4 text-center'>
				<button type="button" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Améliorer le pigeonnier</button>
			</div>

		</div>
	</div>


	<div id='list_hibou'>
	<?php
	foreach($animaux as $animal){

		if ($animal['rare'] == 1){
			$cadre = "cadrehibou2";
			$texte = "textepigeonrare";
		}
		else{
			$cadre = "cadrehibou";
			$texte = "textepigeon";
		}

		echo "<div class='".$cadre."' id='hibou_".$animal['id']."'>
				<input class='croix' type='button' onclick='confirmMessage(".$animal['id'].")' title='Relâcher votre animal' id='".$animal['id']."' name='id' value='".$animal['id']."' />
				<div id='hibou' class='hibou_".$animal['id']."'>
					<div id = 'animation_reward' class='animation_reward_".$animal['id']."' style='display:none;'></div>
					<div id = 'animation_ingredient' class='animation_ingredient_".$animal['id']."' style='display:none;'></div>
					<img src='".img_url('animaux/'.$animal['idanimal'].'.jpg')."' 'height='120' width='120' data-toggle='tooltip' data-placement='top' id='img_hibou_".$animal['id']."' title ='[ ".$animal['gainmin']." ; ".$animal['gainmax']." ] - ".$animal['succes']." %'>
				</div>

				<div class='textepigeon' id='lien_".$animal['id']."'>
				<span id = 'textepigeon_".$animal['id']."'>
					<span class='".$texte."'>".$animal['nickname']."</span>
				</span>
			</div>";
			
		// Si l'animal est disponible
		if (time() - $animal['date_utilisation'] >= $animal['cooldown']){
			echo "<div class ='dispo2' id='dispo_".$animal['id']."'>Disponible</div>
				<input type='button' id='envoi_".$animal['id']."' class='btn btn-primary send_button' onclick='send_animal(".$animal['id'].")' value='Livrer le courrier' id='envoi_".$animal['id']."'/>";
		}
		// Si l'animal est en CD
		else{
			$calcul=$animal['cooldown']-(time()-$animal['date_utilisation']);
			date_default_timezone_set('UTC');
			$final = date('H:i:s', $calcul);
			echo "<div class ='repos2' id='repos_".$animal['id']."'>Repos</div>
				<span class ='timer' id= 'timer_div_".$animal['id']."'></span>
				<img src='".img_url('chrono.gif')."' height='16' width='16' id='img_".$animal['id']."'><span id='br_".$animal['id']."'><br/></span>

					<input type='button' id='envoi_".$animal['id']."' class='btn btn-primary send_button disabled' onclick='send_animal(".$animal['id'].")' value='Livrer le courrier' id='envoi_".$animal['id']."'/>";

				echo "<script>
						var seconds_left_".$animal['id']." =".$calcul.";
						var interval_".$animal['id']." = setInterval(function() {
						var temps_".$animal['id']." = new Date(--seconds_left_".$animal['id']."*1000);
						document.getElementById('timer_div_".$animal['id']."').innerHTML = temps_".$animal['id'].".getHours()-1+':'+('0'+temps_".$animal['id'].".getMinutes()).substr(-2)+':'+('0'+temps_".$animal['id'].".getSeconds()).substr(-2);

						if (seconds_left_".$animal['id']." <= 0)
						{
							document.getElementById('timer_div_".$animal['id']."').innerHTML = '0';					
							$('#textepigeon_".$animal['id']."' ).append('<div class=\'dispo2\' id=\'dispo_".$animal['id']."\'>Disponible</div>');						
																										
							$('div').remove('#repos_".$animal['id']."');
							$('span').remove('#timer_div_".$animal['id']."');
							$('span').remove('#br_".$animal['id']."');
							$('img').remove('#img_".$animal['id']."');
							$('#envoi_".$animal['id']."').removeClass('disabled');
							$('#envoi_".$animal['id']."').removeAttr('disabled');
							clearTimeout(window['interval_".$animal['id']."']); // Arrêter le décompte.

						}
					}, 1000);
				</script>";
		}
		echo "</div>";




	} ?>
	
	</div>

		</div>
	</div>
</div>
