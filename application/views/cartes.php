<div class="container-fluid">
	<div class="row">
	<?php include('left_part.php'); ?>
		<div class="col-sm-9 col-lg-10">

		Nombre de carte : <?php echo $nb_cartes_membre; ?> / <?php echo $nb_cartes; ?> <br/>

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