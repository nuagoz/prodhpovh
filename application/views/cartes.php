<div class="container-fluid">
	<div class="row">
	<?php include('left_part.php'); ?>
		<div class="col-sm-9 col-lg-10">

		<input type='hidden' id='nb_total_cards' value='<?php echo $nb_cartes; ?>'/>
		<input type='hidden' id='nb_total_bronze' value='<?php echo $nb_bronze; ?>'/>
		<input type='hidden' id='nb_total_silver' value='<?php echo $nb_argent; ?>'/>
		<input type='hidden' id='nb_total_gold' value='<?php echo $nb_or; ?>'/>

		<h1 class='zone_title'>Votre collection</h1>
		<div id = 'zone_container'>
			<div id="doughnutChart" class="chart"></div>
		</div>

		<?php
		$cartes = array();
		foreach($cartes_membre as $carte){
			array_push($cartes, $carte['idcarte']);
		}
		?>
		
			<div id = "list_card">
				<?php for($i=0; $i<=$nb_cartes; $i++): ?>

					<?php if(in_array($i, $cartes)): ?>
						<img class='image_card' src='<?php echo img_url('cards/'.$i.'.png'); ?>' />
					<?php else: ?>
						<img class='image_card' src='<?php echo img_url('cards/150.png'); ?>' />
					<?php endif; ?>

				<?php endfor; ?>
			</div>

  		</div>
	</div>
</div>