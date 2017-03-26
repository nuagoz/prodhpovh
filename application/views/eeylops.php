<div class="container-fluid">
	<div class="row">
	<?php include('sidebar.php'); ?>
		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 right-zone">
		<img class="img-responsive img-center" src = "<?php echo img_url('eeylops_background.jpg'); ?>">
			<div class="text-center">
			<?php
			foreach($liste as $key => $value)
			{
				if($value['dispo'] == 1): // affichage uniquement des animaux disponibles

					if($value['succes'] == 100)
						$progress_color = "#5cb85c";
					else if($value['succes'] >= 85 && $value['succes'] <= 99)
						$progress_color = "#f19007";
					else
						$progress_color = "#f15d07";
				 ?>

					
				    	<div class="card_eeylops">
				    		<div class="card-top_zone harrypotter">
				    		<?= $value['nom'] ?>
				    		</div>
				    		<div class="card_price oswald">
				    		<?= $value['prix'] ?> <img class='print_gallion' src='<?= img_url('gallion2.png'); ?>'/>
				    		</div>
					    <?php
					    	echo "<img class='img-rounded card-img-top_eeylops print_animal' src = '".img_url('animaux')."/".$value['id'].".jpg'/>";
						?>
					        <div class="card-block_eeylops">
					        	<div class = "stat1">Temps de relance</div>
					        	<div class = "stat2">Gains</div>
					        	<div class = "stat3">Taux de réussite</div>
					        		<div class="progress-succes progress">
										<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" style="background-color:<?= $progress_color ?>;width:<?= $value['succes']; ?>%"><?= $value['succes']; ?> %</div>
									</div>
					        	<div class = "stat4">En votre possession</div>
					        		<div>
					        			<?= $animal_qty[$key]; ?> / <?= $res = isset($value['limite']) ? $value['limite'] : 'illimité'; ?>
					        		</div>

					        </div>
				        	<div class="card-footer_eeylops">
				        		<button class="btn btn-primary btn-block">Acheter</button>
				        	</div>
				        </div>
					

				<?php endif;
			}
			?>
			</div>
		</div>
	</div>
</div>

