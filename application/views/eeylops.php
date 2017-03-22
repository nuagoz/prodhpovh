<div class="container-fluid">
	<div class="row">
	<?php include('sidebar.php'); ?>
		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 right-zone">
		<img class="img-responsive img-center" src = "<?php echo img_url('eeylops_background.jpg'); ?>">
		<?php
		foreach($liste as $key => $value)
		{
			if($value['dispo'] == 1) // affichage uniquement des animaux disponibles
			{
				echo "<div class = 'fiche_hibou'>";
					echo "<div class = 'harrypotter eeylops_name'>".$value['nom']."</div>";
					echo "<img class='eeylops_list' src = '".img_url('animaux')."/".$value['id'].".jpg'/>";
				echo "</div>";
			}
		}
		?>
		</div>
	</div>
</div>