<div class="container-fluid">
	<div class="row">
  <?php include('sidebar.php'); ?>
		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 right-zone">
	    	

		    <div class="card hovercard">
		        <div class="card-background">
		            <img class="card-bkimg" alt="" src="http://www.konbini.com/fr/files/2016/02/harry-potter.jpg">
		        </div>
		        <div class="useravatar">
		            <img alt="" src="http://www.konbini.com/fr/files/2016/02/harry-potter.jpg">
		        	<div class="rank-label-container">
                    	<span id="zone_points" class="label label-default rank-label">1023 points</span>
                	</div>
		        </div>
		        <div class="card-info"> <span id="pseudo_profile" class="harrypotter"><?=$pseudo?></span>
		        <div class="card-titre"> <span id="member_title" class="card-title">"Propriétaire de Gringotts"</span></div>
		        </div>
		    </div>



		    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
		        <div class="btn-group" role="group">
		            <button type="button" id="stars" class="btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>
		                <div class="hidden-xs">Vue d'ensemble</div>
		            </button>
		        </div>
		        <div class="btn-group" role="group">
		            <button type="button" id="favorites" class="btn btn-default" href="#tab2" data-toggle="tab"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>
		                <div class="hidden-xs">Animaux</div>
		            </button>
		        </div>
		        <div class="btn-group" role="group">
		            <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
		                <div class="hidden-xs">Cartes</div>
		            </button>
		        </div>
		    </div>

		        <div class="well">
		      <div class="tab-content">
		        <div class="tab-pane fade in active" id="tab1">
		        </div>

		        <!-- ZONE DES HIBOUX -->
		        <div class="tab-pane fade in" id="tab2">
		        	<div id="list_profile_hibou">
			          <?php
			          foreach($animaux as $animal){
			          	if ($animal['rare'] == 1){

							echo "<div id = 'cadreview_hibou2'>
								<div id ='imageview_hibou'>
									<img src='".img_url('animaux/'.$animal['idanimal'].'.jpg')." 'height='120' width='120'>
								</div>
								<div id = 'nameview_hibou' class='text-center'>
								<span class='textepigeonrare'>
									".$animal['nickname']."
								</span>
								</div>
							</div>";
						}
						else{
							echo "<div id = 'cadreview_hibou'>
								<div id ='imageview_hibou'>
									<img src='".img_url('animaux/'.$animal['idanimal'].'.jpg')." 'height='120' width='120'>
								</div>
								<div id = 'nameview_hibou' class='text-center'>
									".$animal['nickname']."
								</div>
							</div>";
						}
			          }
		        	?>
		        	</div>
		        </div>

		        <div class="tab-pane fade in" id="tab3">
		          <h3>This is tab 3</h3>
		        </div>
		      </div>
		    </div>


	    </div>
	</div>
</div>

