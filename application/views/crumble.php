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
												<option>Facile</option>
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

		<div id = "cartes"></div>
    <button type="button" id="debut_partie"class="btn btn-warning hidden">Passer l'étape des cartes</button>

		<button class="btn btn-primary hidden control" id='left'>Gauche</button>
		<button class="btn btn-primary hidden control" id='right'>Droite</button>
		<button class="btn btn-primary hidden control" id='top'>Haut</button>
		<button class="btn btn-primary hidden control" id='bottom'>Bas</button>
