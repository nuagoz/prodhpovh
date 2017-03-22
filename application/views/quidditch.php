<div class="container-fluid">
	<div class="row">
	<?php include('sidebar.php'); ?>
		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 right-zone">
			<img class="img-responsive img-center" src = "<?php echo img_url('quidditch_background2.jpg'); ?>">
			<input type="hidden" id='date_next_match' value="<?=$date['next_match_date']; ?>"/>
			<input type="hidden" id='match_en_cours' value="<?=$date['match_en_cours']; ?>"/>

			<?php if($date['match_en_cours'] == 0): // Affichage du compteur s'il n'y a pas de match en cours?>
				<h1 class="oswald text-center">Début des matchs dans : </h1>
				<div id="timer_quidditch" class="oswald text-center">
					<span id="quidditch_days">00</span>
					<span id="quidditch_hours">00</span>
					<span id="quidditch_minutes">00</span>
					<span id="quidditch_seconds">00</span>
				</div>
				<div id="infos_timer" class="oswald text-center">
					<span id="timer_day">Jours</span>
					<span id="timer_hours">Heures</span>
					<span id="timer_minutes">Minutes</span>
					<span id="timer_seconds">Secondes</span>
				</div>
			<br/>
			<div class="container">
				<div class="row">
					<?php foreach ($matches as $key => $value): ?>
						<div class="versus_quidditch">
							<div class="col-md-6 col-md-offset-3">
					          <div class="update-nag no-margin">
					            <div class="update-split">
						        <?php
						        	$carte = "<img class='logo_quidditch' src = '".img_url('quidditch')."/".$equipe1[$key]['logo']."' id = 'card_".$key."'/>";
						        	echo $carte;
						        ?>
					            </div>
					            <div class="update-text"><?= $equipe1[$key]['nom'] ?></div>
					          </div>
					        </div>
					    
					        <div class="col-md-6 col-md-offset-3">
					          <div class="update-nag">
					            <div class="update-split">
						        <?php
						        	$carte = "<img class='logo_quidditch' src = '".img_url('quidditch')."/".$equipe2[$key]['logo']."' id = 'card_".$key."'/>";
						        	echo $carte;
						        ?>
					            </div>
					            <div class="update-text"><?= $equipe2[$key]['nom'] ?></div>
					          </div>
					        </div>
				    	</div>
					<?php endforeach; ?>
				</div>
			</div>
			<?php 
			else: // Sinon affichage de la visualisation des matchs ?>
				<h1 class="oswald text-center">Des matchs sont en cours : </h1>
				<div id="container_but" class="text-center">
					<button type="button" id="directmatches" class="btn btn-primary">Voir les matchs en direct</button>
				</div>
			<?php endif; ?>
			<br/><br/>
			<div id = "option_quidditch" class="text-center">
				<a href="<?=base_url('quidditch/teams'); ?>"><button type="button" class="btn btn-primary">Liste des équipes</button></a>
				<a href="<?=base_url('quidditch/rank'); ?>"><button type="button" class="btn btn-primary">Classement</button></a>
			</div>
  		</div>
	</div>
</div>