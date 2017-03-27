<div class="container-fluid">
	<div class="row">
	<?php include('sidebar.php'); ?>
		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 right-zone">
			<input type="hidden" id='linksrcanimal' value="<?= img_url('animaux') ?>"/>
			<!-- Modal achat animal -->
			<div class="modal fade" id="buy_eeylops" tabindex="-1" role="dialog">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title">Donnez un nom à votre <span id='namehibouspan'></span></h4>
			      </div>
			      <div class="modal-body col-xs-12">

			      	<!-- alertes -->
			     	<div id='erreur_achat' class="alert alert-danger" style="display:none;">
						<strong>Erreur !</strong> <span id='texterror'></span>
					</div>

			      	<div class = "col-xs-5">
			      		<span id='imghibouspan'></span> <!-- zone image hibou -->
			      	</div>
			      	<div class = "col-xs-7">
			      			<div id="info_name_hibou" class="oswald">Le nom doit faire exactement 6 caractères.</div><br/></br/>
			      			<div class="input-group hidden-xs">
								<input type="text" class="form-control" id="animal_input_name" maxlength="6" placeholder="Nom de l'animal">
								<div id='random_name' class="input-group-addon"><i class="fa fa-refresh" aria-hidden="true"></i></div>
							</div>
			      	</div>
			      	<!-- mobile -->
			      	<div class="visible-xs">
				      	<div class="input-group">
							<input type="text" class="form-control" id="animal_input_name_mobile" maxlength="6" placeholder="Nom">
							<div id='random_name_mobile' class="input-group-addon"><i class="fa fa-refresh" aria-hidden="true"></i></div>
						</div>
					</div>

			      </div>
			      <div class="modal-footer">
			      	<div class="col-xs-12 col-sm-9">
			        	<button disabled id="buy_hibou" type="button" class="oswald green-success font21 btn btn-success btn-block achat_buttons">
			        	Acheter (<span id='valeur_achat'></span> <img class='print_gallion_min' src='<?= img_url('gallion2.png'); ?>'/>)

			        	</button>
			        </div>
			        <div class="col-xs-12 col-sm-3">
			        	<button type="button" class="oswald font21 btn btn-danger btn-block achat_buttons" data-dismiss="modal">Annuler</button>
			        </div>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

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
					        			<span id='nb_hibou_<?= $value['id']; ?>'> <?= $animal_qty[$key]; ?></span> / <?= $res = isset($value['limite']) ? $value['limite'] : 'illimité'; ?>
					        		</div>

					        </div>
				        	<div class="card-footer_eeylops">
				        		<button data-price="<?= $value['prix']; ?>" data-name="<?= $value['nom']; ?>" data-hibou="<?= $value['id']; ?>" class="btn btn-primary btn-block buy_hibou">Acheter</button>
				        	</div>
				        </div>
					

				<?php endif;
			}
			?>
			</div>
		</div>
	</div>
</div>

