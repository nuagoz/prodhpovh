<div class="container-fluid">
    <div class="row">
    <?php include('sidebar.php'); ?>
	   <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 right-zone">

	   	<h1 class='zone_title'>Inventaire</h1>

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

		<div class = "col-xs-12">
			<div class = "inventory_card">
				<div class = "inventory_img">
					<?php echo "<img class='card-img-top' src = '".img_url('objets')."/choco.png'/>"; ?>
				</div>
				<div class = "inventory_content">
				
				</div>
			</div>
		</div>

	   </div>
    </div>
</div>