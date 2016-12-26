<!-- <script src="node_modules/socket.io-client/dist/socket.io.js"></script> -->

<nav class="navbar navbar-default navbar-inverse">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="true" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Crumble</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse in" aria-expanded="true">
            <ul class="nav navbar-nav">
              <li><a>Simuler une partie :</a></li>
            </ul>
            <form class="navbar-form navbar-left">
		        <div class="form-group">
		          <select class="form-control" id="nivj1">
		          		<option value="" disabled selected>J1</option>
		          		<option value="1">Niv. 1</option>
						<option value="2">Niv. 2</option>
						<option value="3">Niv. 3</option>
						<option value="4">Niv. 4</option>
						<option value="5">Niv. 5</option>
						<option value="6">Niv. 6</option>
						<option value="7">Niv. 7</option>
						<option value="8">Niv. 8</option>
						<option value="9">Niv. 9</option>
		          </select>
		          <select class="form-control" id="nivj2">
		          		<option value="" disabled selected>J2</option>
		          		<option value="1">Niv. 1</option>
						<option value="2">Niv. 2</option>
						<option value="3">Niv. 3</option>
						<option value="4">Niv. 4</option>
						<option value="5">Niv. 5</option>
						<option value="6">Niv. 6</option>
						<option value="7">Niv. 7</option>
						<option value="8">Niv. 8</option>
						<option value="9">Niv. 9</option>
		          </select>
		        </div>
		        <button type="button" id="simule_game" class="btn btn-default">Simuler</button>
      		</form>
            <ul class="nav navbar-nav navbar-right">
              <li>
              <div id="anim_option" class="checkbox">
				  <label><input id='animation_checkbox' class='enabled' type="checkbox" checked=checked value="">Activer les animations</label>
			  </div>
			  </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

<!-- -->
<button type="button" id="launch" data-toggle="modal" data-target="#form" class="btn btn-warning">Lancer une partie</button>
<h1 id = 'title_card' class='hidden' >Choisissez vos cartes</h1>
<p id = 'card_name' class="bg-primary hidden">Nom</p>

		<!-- Modal -->
	<div class="modal fade" id="form" tabindex="-1" role="dialog"
	     aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <!-- Modal Header -->
	            <div class="modal-header">
	                <button type="button" class="close"
	                   data-dismiss="modal">
	                       <span aria-hidden="true">&times;</span>
	                       <span class="sr-only">Close</span>
	                </button>
	                <h4 class="modal-title" id="myModalLabel">
	                    Lancer une partie 
	                </h4>
	            </div>

	            <!-- Modal Body -->
	            <div class="modal-body">

	                <form role="form">
	                  <div class="form-group">
	                    <label for="plateausize">Nombre de lignes / colonnes</label>
	                      <input type="number" class="form-control"
	                      id="plateausize" value="7"/>
	                  </div>
	                  <div class="form-group">
	                    <label for="sel1">Niveau de l'ordinateur</label>
											<select class="form-control" id="sel1">
												<option>1</option>
												<option>2</option>
												<option>3</option>
												<option>4</option>
												<option>5</option>
												<option>6</option>
												<option>7</option>
												<option>8</option>
												<option>9</option>
											</select>
	                  </div>
	            </div>

	            <!-- Modal Footer -->
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default"
	                        data-dismiss="modal">
	                            Fermer
	                </button>
	                <button id = "launch_game" type="button" class="btn btn-primary">
	                    Lancer
	                </button>
	            </div>
	        </div>
	    </div>
	</div>

		<div id = "plateau"></div>

		<div id='mobile_controls' class = "visible-xs visible-sm">
			<button type="button" id="btn_left" class="btn btn-default" aria-label="Left Align">
  				Gauche
			</button>
			<button type="button" id="btn_right" class="btn btn-default" aria-label="Left Align">
  				Droite
			</button>
			<button type="button" id="btn_top" class="btn btn-default" aria-label="Left Align">
  				Haut
			</button>
			<button type="button" id="btn_bottom" class="btn btn-default" aria-label="Left Align">
  				Bas
			</button>
		</div>
		<div id = "resultat"></div>
		<button type="button" id="playagain" class="btn btn-primary hidden">Rejouer</button>
		<div id = "cartes"></div>


		<div class="bg-primary col-xs-4 col-xs-offset-4 hidden" id = "level">Niveau <span id='lvl'></span></div>

		<div id='domination' class="col-xs-4 col-xs-offset-4 hidden">
			<h4 class="text-center">Domination du plateau : <i class="fa fa-snowflake-o" aria-hidden="true"></i></h4>
			<!-- evaluation de la partie -->
			<div class="progress">
			  <div id="prog_cerise" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" style="width:50%">
			    Cerises : <span id='nbc'>25</span>
			  </div>
			  <div id="prog_meringue" class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" style="width:50%">
			    Meringues : <span id='nbm'>24</span>
			  </div>
			</div>
		</div>

    <button type="button" id="debut_partie"class="btn btn-warning hidden">Passer l'étape des cartes</button>

		<button class="btn btn-primary hidden control" id='left'>Gauche</button>
		<button class="btn btn-primary hidden control" id='right'>Droite</button>
		<button class="btn btn-primary hidden control" id='top'>Haut</button>
		<button class="btn btn-primary hidden control" id='bottom'>Bas</button>
