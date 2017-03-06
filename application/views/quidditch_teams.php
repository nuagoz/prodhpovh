<div class="container-fluid">
  <div class="row">
	  <?php include('sidebar.php'); ?>
	  <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 right-zone">
		<?php
			$cartes = affiche_carte_equipe($equipes);
			echo $cartes;
		?>
	  </div>
	</div>
</div>