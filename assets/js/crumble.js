$("#launch_game").click(function(){
  turn = true; // Déterminer qui doit jouer
  GLOB_DEPTH = parseInt($("#sel1").val());
  $("#lvl").html(GLOB_DEPTH);
  //distribution_carte(6);
    $('#form').modal('hide');
    $('#launch').hide();
    //$('#title_card').removeClass('hidden');
    //$('#card_name').removeClass('hidden');
    //$('#debut_partie').removeClass('hidden');
    $("#debut_partie").click();
    /*setTimeout(function(){
      ctrl();
    }, 1000);*/
});

$("#debut_partie").click(function(){
  console.log("partie commencee");
  $('#plateau').show();
  S = parseInt($("#plateausize").val());
  CASES = S * S;
  for (var i = 0; i < S; i++)
       PLATEAU[i] = [];
  determine_equilibre();
  launch_game();
  $("#domination").removeClass('hidden');
  $("#level").removeClass('hidden');
  $("#launch").hide();
  $('.carte').hide();
  $(this).hide();
  $('#card_name').hide();
  $('#title_card').hide();
});

$("#playagain").click(function(){
  launch_game();
  $("#playagain").addClass("hidden");
  $("#resultat").html("");

    $("#prog_cerise").css({
    width : "50%"
    });

    $("#prog_meringue").css({
      width : "50%"
    });
});

$("#animation_checkbox").click(function(){
  if($(this).hasClass('enabled')){
    $(this).removeClass('enabled');
    animate_time = 0;
    ia_time = 350;
    animations = false;
  }
  else{
    $(this).addClass('enabled');
    animate_time = 600;
    ia_time = 0;
    animations = true;
  }
});

$("#simule_game").click(function(){
  if($("#nivj1").val() != null && $("#nivj2").val() != null){
    $("#launch_game").click();
    var lvlj1 = parseInt($("#nivj1").val());
    var lvlj2 = parseInt($("#nivj2").val());
    setTimeout(function(){
      simule_game(lvlj1, lvlj2);
    }, 500);
  }
});

// variables partie
var animate_time = 600;
var ia_time = 350;
var animations = true;

// simulate games
var vic_cerise = 0;
var vic_meringue = 0;
var duree = 0;

var game=true;
var GLOB_DEPTH;
var coupj=0;
var CERISE = 1;
var MERINGUE = 2;
var VIDE = 0;
var CONTROL = CERISE;
var IA = true;
var S;
var CASES;
var PLATEAU = [];
// for (var i = 0; i < S; i++)
//     PLATEAU[i] = [];

var nb_cerise;
var nb_meringue;

var mouvementType = {"g":0, "h":1, "d":2, "b":3};

/*var poids_plateau = [];
for (var i = 0; i < 7; i++)
    poids_plateau[i] = [];*/
// Poids plateau
var poids_plateau = [[0, 0, 0, 0, 0, 0, 0],
                     [0, 2, 2, 2, 2, 2, 0],
                     [0, 2, 4, 4, 4, 2, 0],
                     [0, 4, 6, 6, 6, 4, 0],
                     [0, 2, 4, 4, 4, 2, 0],
                     [0, 2, 2, 2, 2, 2, 0],
                     [0, 0, 0, 0, 0, 0, 0]];

var poids_plateau2 = [[0, 0, 0, 0, 0, 0, 0],
                     [0, 2, 2, 2, 2, 2, 0],
                     [0, 2, 200, 200, 200, 2, 0],
                     [0, 4, 200, 200, 200, 4, 0],
                     [0, 2, 200, 200, 200, 2, 0],
                     [0, 2, 2, 2, 2, 2, 0],
                     [0, 0, 0, 0, 0, 0, 0]];



function determine_equilibre(){
  if (CASES % 2 == 0) {
      nb_cerise = CASES / 2;
      nb_meringue = CASES / 2;
  } else {
      nb_cerise = (CASES + 1) / 2;
      nb_meringue = (CASES + 1) / 2 - 1;
  }
}

function ctrl(){
  $('.img-card').hover(
  function(){
      $('#card_name').html($(this).attr('data-name'));
  },
  function(){
      $('#card_name').html("Nom");
  }
  );
}

function affiche_plateau() {
    var aff = "";
    aff += "<h3>cerises : " + nb_cerise + " meringues : " + nb_meringue + "</h3>"
    aff += "<table>";
    for (var i = 0; i < PLATEAU.length; i++) {
        aff += "<tr>"
        for (var j = 0; j < PLATEAU.length; j++) {
            aff += "<td>"
            if (PLATEAU[i][j] == 1) {
                aff += "<img src = 'http://puu.sh/rWK8f/00da11545e.png'/>";
            } else if (PLATEAU[i][j] == 2) {
                aff += "<img src = 'http://puu.sh/rWK9O/1419cf7b70.png'/>";
            } else if (PLATEAU[i][j] == 0) {
                aff += "<img src = 'http://puu.sh/rWLu9/ff062a5c5e.png'/>";
            }
            aff += "</td>";
        }
        aff += "</tr>"
    }
    aff += "</table>";
    $("#resultat").html(aff);
}

function affiche_new_plateau(){
  var print = "";
  for (var i = 0; i < PLATEAU.length; i++) {
    if(i != 0)
      print += "<br/>";
    for (var j = 0; j < PLATEAU.length; j++) {
      print += "<div class='"+i+"x"+j+" plateaucase' id='case'>";
      if (PLATEAU[i][j] == -1){
          print += "<img class='case' src = 'assets/img/crumble/broken2.png'/></div>";
      }
      else{
        print += "<img id='case_"+i+j+"' class='case' src = 'assets/img/crumble/case.png'/>";
        if (PLATEAU[i][j] == CERISE)
          print += "<img class='pion' id='"+i+j+"' src = 'assets/img/crumble/cerise.png'/>";
        else if (PLATEAU[i][j] == MERINGUE)
          print += "<img class='pion' id='"+i+j+"' src = 'assets/img/crumble/meringue.png'/>";
        print += "</div>";
      }
    }
  }

  $("#plateau").html(print);

}

function print_plateau_debug(tab){
  var print = "";
  for (var i = 0; i < tab.length; i++) {
    if(i != 0)
      print += "<br/>";
    for (var j = 0; j < tab.length; j++) {
      print += "<div class='"+i+"x"+j+"' id='case'>";
      if (tab[i][j] == -1){
          print += "<img class='case' src = 'assets/img/crumble/broken2.png'/></div>";
      }
      else{
        print += "<img class='case' src = 'assets/img/crumble/case.png'/>";
        if (tab[i][j] == CERISE)
          print += "<img class='pion' src = 'assets/img/crumble/cerise.png'/>";
        else if (tab[i][j] == MERINGUE)
          print += "<img class='pion' src = 'assets/img/crumble/meringue.png'/>";
        print += "</div>";
      }
    }
  }

  $("#debug").html(print);

}

function print_plateau_debug2(tab){
  var print = "";
  for (var i = 0; i < tab.length; i++) {
    if(i != 0)
      print += "<br/>";
    for (var j = 0; j < tab.length; j++) {
      print += "<div class='"+i+"x"+j+"' id='case'>";
      if (tab[i][j] == -1){
          print += "<img class='case' src = 'assets/img/crumble/broken2.png'/></div>";
      }
      else{
        print += "<img class='case' src = 'assets/img/crumble/case.png'/>";
        if (tab[i][j] == CERISE)
          print += "<img class='pion' src = 'assets/img/crumble/cerise.png'/>";
        else if (tab[i][j] == MERINGUE)
          print += "<img class='pion' src = 'assets/img/crumble/meringue.png'/>";
        print += "</div>";
      }
    }
  }

  $("#debug2").html(print);

}

function print_plateau_debug3(tab){
  var print = "";
  for (var i = 0; i < tab.length; i++) {
    if(i != 0)
      print += "<br/>";
    for (var j = 0; j < tab.length; j++) {
      print += "<div class='"+i+"x"+j+"' id='case'>";
      if (tab[i][j] == -1){
          print += "<img class='case' src = 'assets/img/crumble/broken2.png'/></div>";
      }
      else{
        print += "<img class='case' src = 'assets/img/crumble/case.png'/>";
        if (tab[i][j] == CERISE)
          print += "<img class='pion' src = 'assets/img/crumble/cerise.png'/>";
        else if (tab[i][j] == MERINGUE)
          print += "<img class='pion' src = 'assets/img/crumble/meringue.png'/>";
        print += "</div>";
      }
    }
  }

  $("#debug3").html(print);

}

function affiche_plateau2() {
    var aff = "<br/>";
    aff += "<table>";
    for (var i = 0; i < PLATEAU.length; i++) {
        aff += "<tr>"
        for (var j = 0; j < PLATEAU.length; j++) {
            aff += "<td>"
            if (PLATEAU[i][j] == 1) {
                aff += "<img src = 'http://puu.sh/rWK8f/00da11545e.png'/>";
            } else if (PLATEAU[i][j] == 2) {
                aff += "<img src = 'http://puu.sh/rWK9O/1419cf7b70.png'/>";
            } else if (PLATEAU[i][j] == 0) {
                aff += "<img src = 'http://puu.sh/rWLu9/ff062a5c5e.png'/>";
            }
            aff += "</td>";
        }
        aff += "</tr>"
    }
    aff += "</table>";
    $("#resultat2").html(aff);
}

function choix_carte(){


}


function affiche_carte(){
  $.ajax({
        type:'POST',
        url : 'crumble/get_liste_cartes',
        success: function(data){
          var liste = data.response.options.liste;
          var taille = liste.length;
          var id;
          var nom;
          var description;
          var url;
          var cartes = "";
          $('#cartes').html(cartes);
          for (var i = 0; i < taille; i++){
            id = parseInt(liste[i]);

            $.ajax({
                  type:'POST',
                  data : {"id":id},
                  url : 'crumble/get_info_carte',
                  success: function(data){
                    nom = data.response.options.nom;
                    description = data.response.options.description;
                    url = data.response.options.url;
                    cartes += "<div class = 'carte'>";
                    cartes += "<img class='img-card' id='"+i+"' data-name = '"+nom+"' src = 'assets/img/crumble/"+url+"'>";
                    cartes += "</div>";
                    $('#cartes').html(cartes);
                  }
            });
          }
        }
  });



}
function distribution_carte(quantite){
  $.ajax({
        type:'POST',
        data : {"quantite":quantite},
        url : 'crumble/get_cartes',
        success: function(data){
          affiche_carte();
        }
  });
}

function animate_move(){
  var time = 500;
  if($('.plateaucase').children().hasClass('right_move')){
    $(".right_move").animate({
      "margin-left": "0px"
    }, time);
  }
  else if ($('.plateaucase').children().hasClass('left_move')){
    $(".left_move").animate({
      "margin-left": "-64px"
    }, time);
  }

  else if ($('.plateaucase').children().hasClass('top_move')){
    $(".top_move").animate({
      "margin-top": "-34px"
    }, time);
  }

  else if ($('.plateaucase').children().hasClass('bottom_move')){
    $(".bottom_move").animate({
      "margin-top": "30px"
    }, time);
  }
  $(".over").hide("fast");

  $(".break").animate({
    "opacity": 0
  }, time);

}

function move(direction){
  if (direction == mouvementType.g)
    deplacer_gauche(0, PLATEAU.length-1, 0, false, PLATEAU, CONTROL, animations);
  if (direction == mouvementType.h)
    deplacer_haut(PLATEAU.length-1, 0, 0, false, PLATEAU, CONTROL, animations);
  if (direction == mouvementType.d)
    deplacer_droite(0, 0, 0, false, PLATEAU, CONTROL, animations);
  if (direction == mouvementType.b)
    deplacer_bas(0, 0, 0, false, PLATEAU, CONTROL, animations);
}

function deplacer_droite(x, y, val, treatment, tableau, control, real){

  var tmp;
  if(y == tableau.length-1){
    if (val != 0 && tableau[x][y] != -1){
      tableau[x][y] = val;
      if(real)
        $("#"+x+y).addClass("right_move over");
    }
    else if(tableau[x][y] == control){
      tableau[x][y] = 0;
      if(real)
        $("#"+x+y).addClass("right_move over");
    }
    if(x < tableau.length-1) // S'il est inférieur, il reste forcément des cases du tableau à traiter. Sinon c'est que c'est terminé
      deplacer_droite(x+1, 0, 0, false, tableau, control, real);
  }
  else { // Si la case actuelle ne correspond pas au CONTROL et qu'il n'y a pas de traitement en cours
    if(tableau[x][y] != control && !treatment){
      if (val != 0 && tableau[x][y] != -1)
        tableau[x][y] = val;
      deplacer_droite(x, y+1, 0, false, tableau, control, real);
    }
    else if (treatment){ // Si un traitement est en cours
      tmp = tableau[x][y];
      if(real)
        $("#"+x+y).addClass("right_move");
      tableau[x][y] = val;
      val = tmp;
      if (tableau[x][y+1] == 0 || tableau[x][y+1] == -1){ // Si la prochaine case est vide ou cassée
        treatment = false; // On sort du traitement
        if(tableau[x][y+1] == -1 && real)
          $("#"+x+y).addClass("over");
      }
      deplacer_droite(x, y+1, val, treatment, tableau, control, real);
    }
    else{ // Si CONTROL a été trouvé sur la ligne, on commence à traiter
      val = tableau[x][y];
      if(real)
        $("#"+x+y).addClass("right_move");
      tableau[x][y] = 0; // On met une case vide car ce premier pion a été poussé
      if (tableau[x][y+1] != 0 && tableau[x][y+1] != -1)
        treatment = true;
      else if (tableau[x][y+1] == -1 && real)
        $("#"+x+y).addClass("over");
      deplacer_droite(x, y+1, val, treatment, tableau, control, real);
    }
  }

}

function deplacer_gauche(x, y, val, treatment, tableau, control, real){

  var tmp;
  if(y == 0){
    if (val != 0 && tableau[x][y] != -1){
      tableau[x][y] = val;
      if(real)
        $("#"+x+y).addClass("left_move over");
    }
    else if(tableau[x][y] == control){
      tableau[x][y] = 0;
      if(real)
        $("#"+x+y).addClass("left_move over");
    }
    if(x < tableau.length-1) // S'il est inférieur, il reste forcément des cases du tableau à traiter. Sinon c'est que c'est terminé
      deplacer_gauche(x+1, tableau.length-1, 0, false, tableau, control, real);
  }
  else { // Si la case actuelle ne correspond pas au CONTROL et qu'il n'y a pas de traitement en cours
    if(tableau[x][y] != control && !treatment){
      if (val != 0 && tableau[x][y] != -1)
        tableau[x][y] = val;
      deplacer_gauche(x, y-1, 0, false, tableau, control, real);
    }
    else if (treatment){ // Si un traitement est en cours
      tmp = tableau[x][y];
      if(real)
        $("#"+x+y).addClass("left_move");
      tableau[x][y] = val;
      val = tmp;
      if (tableau[x][y-1] == 0 || tableau[x][y-1] == -1){ // Si la prochaine case est vide ou cassée
        treatment = false; // On sort du traitement
        if(tableau[x][y-1] == -1 && real)
          $("#"+x+y).addClass("over");
      }
      deplacer_gauche(x, y-1, val, treatment, tableau, control, real);
    }
    else{ // Si CONTROL a été trouvé sur la ligne, on commence à traiter
      val = tableau[x][y];
      if(real)
          $("#"+x+y).addClass("left_move");
      tableau[x][y] = 0; // On met une case vide car ce premier pion a été poussé
      if (tableau[x][y-1] != 0 && tableau[x][y-1] != -1)
        treatment = true;
      else if (tableau[x][y-1] == -1 && real)
        $("#"+x+y).addClass("over");
      deplacer_gauche(x, y-1, val, treatment, tableau, control, real);
    }
  }

}

function deplacer_haut(x, y, val, treatment, tableau, control, real){

  var tmp;
  if(x == 0){
    if (val != 0 && tableau[x][y] != -1){
      tableau[x][y] = val;
      if(real)
        $("#"+x+y).addClass("top_move over"); 
    }
    else if(tableau[x][y] == control){
      tableau[x][y] = 0;
      if(real)
        $("#"+x+y).addClass("top_move over");
    }
    if(y < tableau.length-1) // S'il est inférieur, il reste forcément des cases du tableau à traiter. Sinon c'est que c'est terminé
      deplacer_haut(tableau.length-1, y+1, 0, false, tableau, control, real);
  }
  else { // Si la case actuelle ne correspond pas au CONTROL et qu'il n'y a pas de traitement en cours
    if(tableau[x][y] != control && !treatment){
      if (val != 0 && tableau[x][y] != -1)
        tableau[x][y] = val;
      deplacer_haut(x-1, y, 0, false, tableau, control, real);
    }
    else if (treatment){ // Si un traitement est en cours
      tmp = tableau[x][y];
      if(real)
        $("#"+x+y).addClass("top_move");
      tableau[x][y] = val;
      val = tmp;
      if (tableau[x-1][y] == 0 || tableau[x-1][y] == -1){ // Si la prochaine case est vide ou cassée
        treatment = false; // On sort du traitement
        if(tableau[x-1][y] == -1 && real)
          $("#"+x+y).addClass("over");
      }
      deplacer_haut(x-1, y, val, treatment, tableau, control, real);
    }
    else{ // Si CONTROL a été trouvé sur la ligne, on commence à traiter
      val = tableau[x][y];
      if(real)
        $("#"+x+y).addClass("top_move");
      tableau[x][y] = 0; // On met une case vide car ce premier pion a été poussé
      if (tableau[x-1][y] != 0 && tableau[x-1][y] != -1)
        treatment = true;
      else if (tableau[x-1][y] == -1 && real)
        $("#"+x+y).addClass("over");
      deplacer_haut(x-1, y, val, treatment, tableau, control, real);
    }
  }

}

function deplacer_bas(x, y, val, treatment, tableau, control, real){

  var tmp;
  if(x == tableau.length-1){
    if (val != 0 && tableau[x][y] != -1){
      tableau[x][y] = val;
      if(real)
        $("#"+x+y).addClass("bottom_move over");
    }
    else if(tableau[x][y] == control){
      tableau[x][y] = 0;
      if(real)
        $("#"+x+y).addClass("bottom_move over");
    }
    if(y < tableau.length-1) // S'il est inférieur, il reste forcément des cases du tableau à traiter. Sinon c'est que c'est terminé
      deplacer_bas(0, y+1, 0, false, tableau, control, real);
  }
  else { // Si la case actuelle ne correspond pas au CONTROL et qu'il n'y a pas de traitement en cours
    if(tableau[x][y] != control && !treatment){
      if (val != 0 && tableau[x][y] != -1)
        tableau[x][y] = val;
      deplacer_bas(x+1, y, 0, false, tableau, control, real);
    }
    else if (treatment){ // Si un traitement est en cours
      tmp = tableau[x][y];
      if(real)
        $("#"+x+y).addClass("bottom_move");
      tableau[x][y] = val;
      val = tmp;
      if (tableau[x+1][y] == 0 || tableau[x+1][y] == -1){ // Si la prochaine case est vide ou cassée
        treatment = false; // On sort du traitement
        if(tableau[x+1][y] == -1 && real)
          $("#"+x+y).addClass("over");
      }
      deplacer_bas(x+1, y, val, treatment, tableau, control, real);
    }
    else{ // Si CONTROL a été trouvé sur la ligne, on commence à traiter
      val = tableau[x][y];
      if(real)
        $("#"+x+y).addClass("bottom_move");
      tableau[x][y] = 0; // On met une case vide car ce premier pion a été poussé
      if (tableau[x+1][y] != 0 && tableau[x+1][y] != -1)
        treatment = true;
      else if (tableau[x+1][y] == -1 && real)
        $("#"+x+y).addClass("over");
      deplacer_bas(x+1, y, val, treatment, tableau, control, real);
    }
  }

}


// Fonction pour détruire les parties lignes et colonnes vides
function check_destruction(tableau, real){

  var gauche = tableau.length-1;
  var droite = 0;
  var haut = tableau.length-1;
  var bas = 0;
  for (var i = 0; i < tableau.length; i++){
    for (var j = 0; j < tableau.length; j++){
      if (tableau[i][j] == CERISE || tableau[i][j] == MERINGUE){
        if (i < haut)
          haut = i;
        if (i > bas)
          bas = i;
        if (j < gauche)
          gauche = j;
        if (j > droite)
          droite = j;
      }
    }
  }

  for (var i = 0; i < tableau.length; i++){
    for (var j = 0; j < tableau.length; j++){
      if (tableau[i][j] != -1 && (i < haut || i > bas)){
        tableau[i][j] = -1;
        if(real)
          $("#case_"+i+j).addClass('break');
      }
      if (tableau[i][j] != -1 && (j < gauche || j > droite)){
        tableau[i][j] = -1;
        if(real)
          $("#case_"+i+j).addClass('break');
      }
    }
  }

}

console.log("ok")

function copy_tab(new_tab, tab){
  for (var i = 0; i < tab.length; i++){
    for (var j = 0; j < tab.length; j++){
      new_tab[i][j] = tab[i][j];
    }
  }
}

/* Alpha Beta */

/* Fin Alpha Beta */


/* Min-Max */

function simule_coups(tab, depth, control){
  var debug=true;
  var val, type, opponent;
  var max_val = -10000;
  var temp_tab = [];
    for (var i = 0; i < S; i++)
        temp_tab[i] = [];
  copy_tab(temp_tab, tab);
  if(control == MERINGUE)
    opponent = CERISE;
  else
    opponent = MERINGUE;

  for (var i = 0; i < 4; i++){
    if (i == 0){
      deplacer_gauche(0, tab.length-1, 0, false, tab, control, false);
      type = mouvementType.g;
    }
    else if (i == 1){
      deplacer_haut(tab.length-1, 0, 0, false, tab, control, false);
      type = mouvementType.h;
    }
    else if (i == 2){
      deplacer_droite(0, 0, 0, false, tab, control, false);
      type = mouvementType.d
    }
    else{
      deplacer_bas(0, 0, 0, false, tab, control, false);
      type = mouvementType.b;
    }
    check_destruction(tab, false);

    val = min(tab, depth, opponent);

    if (val > max_val){
      max_val = val;
      meilleur_coup = type;
    }

    copy_tab(tab, temp_tab); // Annule le coup
    coupj++;
  }
  //console.log("minmax terminé, meilleur coup : "+meilleur_coup+" pour une max_val de : "+max_val);
  return meilleur_coup;
}

function min(tab, depth, control){
  var min_val;
  var temp_tab = [];
  var opponent;
    for (var i = 0; i < S; i++)
        temp_tab[i] = [];
  copy_tab(temp_tab, tab);
  if(control == MERINGUE)
    opponent = CERISE;
  else
    opponent = MERINGUE;

  if (depth == 0 || !check_etat_game(tab, false)){
    return eval(tab, opponent);
  }
  min_val = 10000;

  for (var i = 0; i < 4; i++){
    if (i == 0){
      deplacer_gauche(0, tab.length-1, 0, false, tab, control, false);
    }
    else if (i == 1){
      deplacer_haut(tab.length-1, 0, 0, false, tab, control, false);
    }
    else if (i == 2){
      deplacer_droite(0, 0, 0, false, tab, control, false);
    }
    else{
      deplacer_bas(0, 0, 0, false, tab, control, false);
    }
    check_destruction(tab, false);

    val = max(tab, depth-1, opponent);

    if (val < min_val)
      min_val = val;

    copy_tab(tab, temp_tab); // Annule le coup
    coupj++;
  }
  return min_val;
}

function max(tab, depth, control){
  var max_val;
  var temp_tab = [];
  var opponent;
    for (var i = 0; i < S; i++)
        temp_tab[i] = [];
  copy_tab(temp_tab, tab);
  if(control == MERINGUE)
    opponent = CERISE;
  else
    opponent = MERINGUE;

  if (depth == 0 || !check_etat_game(tab, false)){
    return eval(tab, control);
  }
  max_val = -10000;

  for (var i = 0; i < 4; i++){
    if (i == 0){
      deplacer_gauche(0, tab.length-1, 0, false, tab, control, false);
    }
    else if (i == 1){
      deplacer_haut(tab.length-1, 0, 0, false, tab, control, false);
    }
    else if (i == 2){
      deplacer_droite(0, 0, 0, false, tab, control, false);
    }
    else{
      deplacer_bas(0, 0, 0, false, tab, control, false);
    }

    check_destruction(tab, false);

    val = min(tab, depth-1, opponent);

    if (val > max_val)
      max_val = val;

    copy_tab(tab, temp_tab); // Annule le coup
    coupj++;
  }
  return max_val;
}

/* alternate min-max algorithm */


/* end */

function eval(tab, control)
{
  var opponent;

  if(control == MERINGUE)
    opponent = CERISE;
  else
    opponent = MERINGUE;


  var compteur = 0;
  if(!check_etat_game(tab, false) && is_winner(control, tab)){
    compteur += 1000;
  }
  else if (!check_etat_game(tab, false) && is_winner(opponent, tab)){
    compteur -= 1000;
  }

for (var i = 0; i < tab.length; i++){
    for (var j = 0; j < tab.length; j++){
      if(tab[i][j] == opponent){
        compteur -= 100;
        compteur -= poids_plateau[i][j]; // Favorise les cases au centre
      }
      else if (tab[i][j] == control){
        compteur += 100;
        compteur += poids_plateau[i][j]; // Favorise les cases au centre
      }
      
    }
  }
  return compteur;
}

/* Fin Min-Max */

// Fonction qui permet de voir si la partie est terminée et qui a gagné
function check_etat_game(tab, print_result){ // renvoie true si la partie est en cours
  var cerises = false;
  var meringues = false;

  for (var i = 0; i < tab.length; i++){
    for (var j = 0; j < tab.length; j++){
      if (tab[i][j] == CERISE)
        cerises = true;
      if (tab[i][j] == MERINGUE)
        meringues = true;
    }
    if (cerises && meringues) // On arrête de chercher si on a trouvé au moins une cerise et une meringue
      break;
  }

  if (cerises && !meringues){
    if (print_result){
      game=false;
      vic_cerise++;
      $("#resultat").html("<div id='victoire'>Victoire !</div>");
      $("#playagain").removeClass("hidden");
    }
    //console.log("Victoire des cerises");
    return false;
  }
  else if (!cerises && meringues){
    if (print_result){
      game=false;
      vic_meringue++;
      $("#resultat").html("<div id='defaite'>Défaite !</div>");
      $("#playagain").removeClass("hidden");
    }
    //console.log("Victoire des meringues");
    return false;
  }
  else{
    return true;
  }
}

// Fonction qui retourne "true" si le joueur entré en paramètre est gagnant
function is_winner(player, tab){

  var cerises = false;
  var meringues = false;

  for (var i = 0; i < tab.length; i++){
    for (var j = 0; j < tab.length; j++){
      if (tab[i][j] == CERISE)
        cerises = true;
      if (tab[i][j] == MERINGUE)
        meringues = true;
    }
    if (cerises && meringues) // On arrête de chercher si on a trouvé au moins une cerise et une meringue
      break;
  }

  if (cerises && !meringues){
    if(player == CERISE)
      return true;
  }
  else if (!cerises && meringues){
    if(player == MERINGUE)
      return true;
  }

  return false;

}

function launch_manual_game(){
/*  PLATEAU = [[-1, -1, -1, -1, -1, -1, -1],
            [-1, -1, -1, -1, -1, -1, -1],
            [-1, -1, -1, -1, -1, -1, -1],
            [-1, -1, 1, 0, 0, 0, -1],
            [-1, -1, 0, 0, 0, 1, -1],
            [-1, -1, 0, 2, 0, 0, -1],
            [-1, -1, -1, -1, -1, -1, -1]];*/
    PLATEAU = [[-1, -1, -1, -1, -1, -1, -1],
            [-1, -1, -1, -1, -1, -1, -1],
            [-1, -1, -1, -1, -1, -1, -1],
            [-1, -1, -1, -1, -1, -1, -1],
            [-1, -1, 2, 0, 0, 0, -1],
            [-1, -1, 0, 1, 0, 2, -1],
            [-1, -1, -1, -1, -1, -1, -1]];
  affiche_new_plateau();
}

function evalue_etat_game(tab){
  var nb_meringue = 0;
  var nb_cerise = 0;
  var cpt_meringue = 0;
  var cpt_cerise = 0;
  var total, val_meringue, val_cerise;

  for (var i = 0; i < tab.length; i++){
    for (var j = 0; j < tab.length; j++){
      if(tab[i][j] == CERISE){
        nb_cerise++;
        cpt_cerise += 20;
        cpt_meringue += poids_plateau[i][j]; // Favorise les cases au centre
      }
      else if (tab[i][j] == MERINGUE){
        nb_meringue++;
        cpt_meringue += 20;
        cpt_meringue += poids_plateau[i][j]; // Favorise les cases au centre
      }
      
    }
  }
  total = nb_cerise+nb_meringue;

  val_meringue = nb_meringue*100/total;
  val_cerise = 100 - val_meringue;
  $("#nbc").html(nb_cerise);
  $("#nbm").html(nb_meringue);
  $("#prog_cerise").css({
    width : val_cerise+"%"
  });

  $("#prog_meringue").css({
    width : val_meringue+"%"
  });

}

function load_plateau() {
    var i, j, value;
    var nbc = nb_cerise;
    var nbm = nb_meringue;
    for (i = 0; i < S; i++) {
        for (j = 0; j < S; j++) {
            value = Math.floor((Math.random() * (nbc + nbm)) + 1);
            if (value <= nbc) {
                value = CERISE;
                nbc--;
            } else {
                value = MERINGUE;
                nbm--;
            }

            PLATEAU[i][j] = value;
        }
    }
}

function simule_game(lvlj1, lvlj2){
  turn = false;
  simule_j1(lvlj1, lvlj2);
}

function simule_j1(lvlj1, lvlj2){
  if(IA && game){
    console.log(lvlj1)
    CONTROL = CERISE;
    dir = alpha_beta_search(PLATEAU, lvlj1, -10000, 10000, CONTROL);

    move(dir);
    check_destruction(PLATEAU, animations);
    animate_move();
    setTimeout(function(){
      affiche_new_plateau();
      check_etat_game(PLATEAU, true);
      evalue_etat_game(PLATEAU);
      IA=false;
      simule_j2(lvlj1, lvlj2);
    }, animate_time);
  }
}


function simule_j2(lvlj1, lvlj2){
  if(!IA && game){
    CONTROL = MERINGUE;
    dir = alpha_beta_search(PLATEAU, lvlj2, -10000, 10000, CONTROL);

    move(dir);
    check_destruction(PLATEAU, animations);
    animate_move();
    setTimeout(function(){
      affiche_new_plateau();
      check_etat_game(PLATEAU, true);
      evalue_etat_game(PLATEAU);
      IA=true;
      simule_j1(lvlj1, lvlj2);
    }, animate_time);
  }
}

function simule_x_game(x, next){
  if (x == 0){
    console.log("Partie terminée : "+duree+" coups joués");
    console.log("tests terminés. Cerises : "+vic_cerise+ " - " +vic_meringue+ " Meringues")
  }else{
  if(!next){
    launch_game_ia();
    vic_meringue=0;
    vic_cerise=0;
    turn = false;
    j1(x);
  }
  else{
    console.log("Partie terminée : "+duree+" coups joués");
    launch_game_ia();
    game=true;
    duree = 0;
    j1(x);
  }
  }
}

function j1(x){

  if(game && duree < 40){
    CONTROL = CERISE;
    dir = alpha_beta_search(PLATEAU, 9, -10000, 10000, CONTROL);
    
    move(dir);
    duree++;
    check_destruction(PLATEAU, true);
    check_etat_game(PLATEAU, true);
    IA=false;
    j2(x);
  }
  else{
    simule_x_game(x-1, true);
  }
}

function j2(x){
  if(game && duree < 40){
    CONTROL = MERINGUE;
    
    dir = simule_coups(PLATEAU, 9, CONTROL);
    move(dir);
    duree++;
    check_destruction(PLATEAU, true);
    check_etat_game(PLATEAU, true);
    IA=true;
    j1(x);
}
  else{
    simule_x_game(x-1, true);
  }
}


function coup(direction){
  if (turn){
    turn = false;
    move(direction);
    check_destruction(PLATEAU, animations);
    animate_move();
    setTimeout(function(){
      affiche_new_plateau();
      check_etat_game(PLATEAU, true);
      evalue_etat_game(PLATEAU);
      bot();
    }, animate_time); 
  }
  else{
    console.log("Pas à votre tour de jouer");
  }
}

function bot(){
  
    CONTROL = MERINGUE;
    setTimeout(function(){
    // Mesure temps d'execution de l'IA
    var startTime = new Date().getTime();
    var elapsedTime = 0;

    //dir = simule_coups(PLATEAU, GLOB_DEPTH, MERINGUE);
    dir = alpha_beta_search(PLATEAU, GLOB_DEPTH, -10000, 10000, MERINGUE);

    // Calcul résultat temps d'execution de l'IA
    elapsedTime = new Date().getTime() - startTime;
    console.log("IA time exec : " + elapsedTime + "ms");
    
    move(dir);
    check_destruction(PLATEAU, animations);
    animate_move();
    setTimeout(function(){
      affiche_new_plateau();
      check_etat_game(PLATEAU, true);
      evalue_etat_game(PLATEAU);
      CONTROL = CERISE;
      turn = true;
    }, animate_time);
    
  }, ia_time);
}

function launch_game(){
  load_plateau();
  affiche_new_plateau();
}

function launch_game_ia(){
  load_plateau();
}

document.onkeydown = checkKey;

function checkKey(e) {

    e = e || window.event;

    var mvtType;

    if (e.keyCode == '38') {
    	mvtType = mouvementType.h;
    }
    else if (e.keyCode == '40') {
    	mvtType = mouvementType.b;
    }
    else if (e.keyCode == '37') {
    	mvtType = mouvementType.g;
    }
    else if (e.keyCode == '39') {
    	mvtType = mouvementType.d;
    }

    if(mvtType != null){
	    coup(mvtType);
	}
}

  $("#btn_left").click(function(){
    coup(mouvementType.g);
  });

  $("#btn_right").click(function(){
    coup(mouvementType.d);
  });

  $("#btn_top").click(function(){
    coup(mouvementType.h);
  });

  $("#btn_bottom").click(function(){
    coup(mouvementType.b);
  });

  function mini(a,b){
    return a < b ? a : b;
  }
  function maxi(a,b){
    return a > b ? a : b;
  }

  // Alpha Beta
// call alpha_beta_search(PLATEAU, 8, -10000, 10000, CONTROL),
  function alpha_beta_search(tab, depth, alpha, beta, control){

  var val, type, opponent;
  var max_val = -10000;
  var temp_tab = [];
    for (var i = 0; i < S; i++)
        temp_tab[i] = [];
  copy_tab(temp_tab, tab);
  if(control == MERINGUE)
    opponent = CERISE;
  else
    opponent = MERINGUE;

  for (var i = 0; i < 4; i++){
    if (i == 0){
      deplacer_gauche(0, tab.length-1, 0, false, tab, control, false);
      type = mouvementType.g;
    }
    else if (i == 1){
      deplacer_haut(tab.length-1, 0, 0, false, tab, control, false);
      type = mouvementType.h;
    }
    else if (i == 2){
      deplacer_droite(0, 0, 0, false, tab, control, false);
      type = mouvementType.d
    }
    else{
      deplacer_bas(0, 0, 0, false, tab, control, false);
      type = mouvementType.b;
    }
    check_destruction(tab, false);

    val = min_ab(tab, depth, alpha, beta, opponent);

    if (val > max_val){
      max_val = val;
      meilleur_coup = type;
    }

/*    val = maxi(val, min_ab(tab, depth-1, val, beta, opponent));
    alpha = maxi(alpha, val);
    meilleur_coup = type;

    if (beta <= alpha)
      break;*/

    copy_tab(tab, temp_tab); // Annule le coup
  }
  //console.log("minmax terminé, meilleur coup : "+meilleur_coup+" pour une max_val de : "+max_val);
  return meilleur_coup;
}

function min_ab(tab, depth, alpha, beta, control){
  var val;
  var temp_tab = [];
  var opponent;
    for (var i = 0; i < S; i++)
        temp_tab[i] = [];
  copy_tab(temp_tab, tab);
  if(control == MERINGUE)
    opponent = CERISE;
  else
    opponent = MERINGUE;

  if (depth == 0 || !check_etat_game(tab, false)){
    return eval(tab, opponent);
  }
  val = 10000;

  for (var i = 0; i < 4; i++){
    if (i == 0){
      deplacer_gauche(0, tab.length-1, 0, false, tab, control, false);
    }
    else if (i == 1){
      deplacer_haut(tab.length-1, 0, 0, false, tab, control, false);
    }
    else if (i == 2){
      deplacer_droite(0, 0, 0, false, tab, control, false);
    }
    else{
      deplacer_bas(0, 0, 0, false, tab, control, false);
    }
    check_destruction(tab, false);

    //val = max(tab, depth-1, opponent);
    val = mini(val, max_ab(tab, depth-1, alpha, val, opponent));
    
    if(val <= alpha)
      return val;

    beta = mini(beta, val);
    copy_tab(tab, temp_tab); // Annule le coup
  }
  return val;
}

function max_ab(tab, depth, alpha, beta, control){
  var val;
  var temp_tab = [];
  var opponent;
    for (var i = 0; i < S; i++)
        temp_tab[i] = [];
  copy_tab(temp_tab, tab);
  if(control == MERINGUE)
    opponent = CERISE;
  else
    opponent = MERINGUE;

  if (depth == 0 || !check_etat_game(tab, false)){
    return eval(tab, control);
  }
  val = -10000;

  for (var i = 0; i < 4; i++){
    if (i == 0){
      deplacer_gauche(0, tab.length-1, 0, false, tab, control, false);
    }
    else if (i == 1){
      deplacer_haut(tab.length-1, 0, 0, false, tab, control, false);
    }
    else if (i == 2){
      deplacer_droite(0, 0, 0, false, tab, control, false);
    }
    else{
      deplacer_bas(0, 0, 0, false, tab, control, false);
    }

    check_destruction(tab, false);

    val = maxi(val, min_ab(tab, depth-1, val, beta, opponent));
    
    if (val >= beta)
      return val;

    alpha = maxi(alpha, val);
    copy_tab(tab, temp_tab); // Annule le coup
  }
  return val;
}


