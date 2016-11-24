//
// $( document ).ready(function() {
//   S = 2;
// });


$("#launch_game").click(function(){
  turn = true; // Déterminer qui doit jouer
  distribution_carte(6);
    $('#form').modal('hide');
    $('#launch').hide();
    $('#title_card').removeClass('hidden');
    $('#card_name').removeClass('hidden');
    $('#debut_partie').removeClass('hidden');

    setTimeout(function(){
      ctrl();
    }, 1000);
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
  $("#launch").hide();
  $('.carte').hide();
  $(this).hide();
  $('#card_name').hide();
  $('#title_card').hide();

});

var CERISE = 1;
var MERINGUE = 2;
var VIDE = 0;
var CONTROL = CERISE;

var S;
var CASES;
var PLATEAU = [];
// for (var i = 0; i < S; i++)
//     PLATEAU[i] = [];

var nb_cerise;
var nb_meringue;

var mouvementType = {"g":0, "h":1, "d":2, "b":3};



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
      print += "<div class='"+i+"x"+j+"' id='case'>";
      if (PLATEAU[i][j] == -1){
          print += "<img class='case' src = 'assets/img/crumble/broken2.png'/></div>";
      }
      else{
        print += "<img class='case' src = 'assets/img/crumble/case.png'/>";
        if (PLATEAU[i][j] == CERISE)
          print += "<img class='pion' src = 'assets/img/crumble/cerise.png'/>";
        else if (PLATEAU[i][j] == MERINGUE)
          print += "<img class='pion' src = 'assets/img/crumble/meringue.png'/>";
        print += "</div>";
      }
    }
  }

  $("#plateau").html(print);

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

function move(direction){
  if (direction == mouvementType.g)
    deplacer_gauche(0, PLATEAU.length-1, 0, false, PLATEAU);
  if (direction == mouvementType.h)
    deplacer_haut(PLATEAU.length-1, 0, 0, false, PLATEAU);
  if (direction == mouvementType.d)
    deplacer_droite(0, 0, 0, false, PLATEAU);
  if (direction == mouvementType.b)
    deplacer_bas(0, 0, 0, false, PLATEAU);
}

function deplacer_droite(x, y, val, treatment, tableau){

  var tmp;
  if(y == tableau.length-1){
    if (val != 0 && tableau[x][y] != -1)
      tableau[x][y] = val;
    else if(tableau[x][y] == CONTROL)
        tableau[x][y] = 0;
    if(x < tableau.length-1) // S'il est inférieur, il reste forcément des cases du tableau à traiter. Sinon c'est que c'est terminé
      deplacer_droite(x+1, 0, 0, false, tableau);
  }
  else { // Si la case actuelle ne correspond pas au CONTROL et qu'il n'y a pas de traitement en cours
    if(tableau[x][y] != CONTROL && !treatment){
      if (val != 0 && tableau[x][y] != -1)
        tableau[x][y] = val;
      deplacer_droite(x, y+1, 0, false, tableau);
    }
    else if (treatment){ // Si un traitement est en cours
      tmp = tableau[x][y];
      tableau[x][y] = val;
      val = tmp;
      if (tableau[x][y+1] == 0 || tableau[x][y+1] == -1){ // Si la prochaine case est vide ou cassée
        treatment = false; // On sort du traitement
      }
      deplacer_droite(x, y+1, val, treatment, tableau);
    }
    else{ // Si CONTROL a été trouvé sur la ligne, on commence à traiter
      val = tableau[x][y];
      tableau[x][y] = 0; // On met une case vide car ce premier pion a été poussé
      if (tableau[x][y+1] != 0 && tableau[x][y+1] != -1)
        treatment = true;
      deplacer_droite(x, y+1, val, treatment, tableau);
    }
  }

}

function deplacer_gauche(x, y, val, treatment, tableau){

  var tmp;
  if(y == 0){
    if (val != 0 && tableau[x][y] != -1)
      tableau[x][y] = val;
    else if(tableau[x][y] == CONTROL)
        tableau[x][y] = 0;
    if(x < tableau.length-1) // S'il est inférieur, il reste forcément des cases du tableau à traiter. Sinon c'est que c'est terminé
      deplacer_gauche(x+1, tableau.length-1, 0, false, tableau);
  }
  else { // Si la case actuelle ne correspond pas au CONTROL et qu'il n'y a pas de traitement en cours
    if(tableau[x][y] != CONTROL && !treatment){
      if (val != 0 && tableau[x][y] != -1)
        tableau[x][y] = val;
      deplacer_gauche(x, y-1, 0, false, tableau);
    }
    else if (treatment){ // Si un traitement est en cours
      tmp = tableau[x][y];
      tableau[x][y] = val;
      val = tmp;
      if (tableau[x][y-1] == 0 || tableau[x][y-1] == -1){ // Si la prochaine case est vide ou cassée
        treatment = false; // On sort du traitement
      }
      deplacer_gauche(x, y-1, val, treatment, tableau);
    }
    else{ // Si CONTROL a été trouvé sur la ligne, on commence à traiter
      val = tableau[x][y];
      tableau[x][y] = 0; // On met une case vide car ce premier pion a été poussé
      if (tableau[x][y-1] != 0 && tableau[x][y-1] != -1)
        treatment = true;
      deplacer_gauche(x, y-1, val, treatment, tableau);
    }
  }

}

function deplacer_haut(x, y, val, treatment, tableau){

  var tmp;
  if(x == 0){
    if (val != 0 && tableau[x][y] != -1)
      tableau[x][y] = val;
    else if(tableau[x][y] == CONTROL)
        tableau[x][y] = 0;
    if(y < tableau.length-1) // S'il est inférieur, il reste forcément des cases du tableau à traiter. Sinon c'est que c'est terminé
      deplacer_haut(tableau.length-1, y+1, 0, false, tableau);
  }
  else { // Si la case actuelle ne correspond pas au CONTROL et qu'il n'y a pas de traitement en cours
    if(tableau[x][y] != CONTROL && !treatment){
      if (val != 0 && tableau[x][y] != -1)
        tableau[x][y] = val;
      deplacer_haut(x-1, y, 0, false, tableau);
    }
    else if (treatment){ // Si un traitement est en cours
      tmp = tableau[x][y];
      tableau[x][y] = val;
      val = tmp;
      if (tableau[x-1][y] == 0 || tableau[x-1][y] == -1){ // Si la prochaine case est vide ou cassée
        treatment = false; // On sort du traitement
      }
      deplacer_haut(x-1, y, val, treatment, tableau);
    }
    else{ // Si CONTROL a été trouvé sur la ligne, on commence à traiter
      val = tableau[x][y];
      tableau[x][y] = 0; // On met une case vide car ce premier pion a été poussé
      if (tableau[x-1][y] != 0 && tableau[x-1][y] != -1)
        treatment = true;
      deplacer_haut(x-1, y, val, treatment, tableau);
    }
  }

}

function deplacer_bas(x, y, val, treatment, tableau){

  var tmp;
  if(x == tableau.length-1){
    if (val != 0 && tableau[x][y] != -1)
      tableau[x][y] = val;
    else if(tableau[x][y] == CONTROL)
        tableau[x][y] = 0;
    if(y < tableau.length-1) // S'il est inférieur, il reste forcément des cases du tableau à traiter. Sinon c'est que c'est terminé
      deplacer_bas(0, y+1, 0, false, tableau);
  }
  else { // Si la case actuelle ne correspond pas au CONTROL et qu'il n'y a pas de traitement en cours
    if(tableau[x][y] != CONTROL && !treatment){
      if (val != 0 && tableau[x][y] != -1)
        tableau[x][y] = val;
      deplacer_bas(x+1, y, 0, false, tableau);
    }
    else if (treatment){ // Si un traitement est en cours
      tmp = tableau[x][y];
      tableau[x][y] = val;
      val = tmp;
      if (tableau[x+1][y] == 0 || tableau[x+1][y] == -1){ // Si la prochaine case est vide ou cassée
        treatment = false; // On sort du traitement
      }
      deplacer_bas(x+1, y, val, treatment, tableau);
    }
    else{ // Si CONTROL a été trouvé sur la ligne, on commence à traiter
      val = tableau[x][y];
      tableau[x][y] = 0; // On met une case vide car ce premier pion a été poussé
      if (tableau[x+1][y] != 0 && tableau[x+1][y] != -1)
        treatment = true;
      deplacer_bas(x+1, y, val, treatment, tableau);
    }
  }

}


// Fonction pour détruire les parties lignes et colonnes vides
function check_destruction(tableau){

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
      if (tableau[i][j] != -1 && (i < haut || i > bas))
        tableau[i][j] = -1;
      if (tableau[i][j] != -1 && (j < gauche || j > droite))
        tableau[i][j] = -1;
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

function IA (){

    var temp_tab = [];
    for (var i = 0; i < S; i++)
        temp_tab[i] = [];
    copy_tab(temp_tab, PLATEAU);
    deplacer_gauche(0, temp_tab.length-1, 0, false, temp_tab);
    var gauche = eval_tab(temp_tab);

    copy_tab(temp_tab, PLATEAU);
    deplacer_haut(temp_tab.length-1, 0, 0, false, temp_tab);
    var haut = eval_tab(temp_tab);

    copy_tab(temp_tab, PLATEAU);
    deplacer_droite(0, 0, 0, false, temp_tab);
    var droite = eval_tab(temp_tab);

    copy_tab(temp_tab, PLATEAU);
    deplacer_bas(0, 0, 0, false, temp_tab);
    var bas = eval_tab(temp_tab);
    var rand = Math.floor((Math.random() * 100) + 1);
    console.log("gauche : "+gauche);
    console.log("haut : "+haut);
    console.log("droite : "+droite);
    console.log("bas : "+bas);

    if (gauche > haut && gauche > droite && gauche > bas)
      return mouvementType.g;
    else if (haut > gauche && haut > droite && haut > bas)
      return mouvementType.h;
    else if (droite > gauche && droite > haut && droite > bas)
      return mouvementType.d;
    else if (bas > gauche && bas > haut && bas > droite)
      return mouvementType.b;

    // Double égalité
    else if (gauche > haut && gauche > bas && gauche == droite)
      return rand < 50 ? mouvementType.g : mouvementType.d;
    else if (gauche > droite && gauche > bas && gauche == haut)
        return rand < 50 ? mouvementType.g : mouvementType.h;
    else if (gauche > haut && gauche > droite && gauche == bas)
        return rand < 50 ? mouvementType.g : mouvementType.b;
    else if (haut > gauche && haut > bas &&  haut == droite)
        return rand < 50 ? mouvementType.h : mouvementType.d;
    else if (haut > gauche && haut > droite && haut == bas)
        return rand < 50 ? mouvementType.h : mouvementType.b;
    else if (droite > haut && droite > gauche && droite == bas)
        return rand < 50 ? mouvementType.d : mouvementType.b;
    else
        return mouvementType.h;


}

function eval_tab(tableau){
  var player;
  var opponent;
  if (CONTROL == CERISE){
    player = CERISE;
    opponent = MERINGUE
  }
  else{
    player = MERINGUE;
    opponent = CERISE
  }

  var compteur = 0;
  for (var i = 0; i < tableau.length; i++){
    for (var j = 0; j < tableau.length; j++){
      if(tableau[i][j] == player)
        compteur+= 100;
      else if (tableau[i][j] == opponent)
        compteur-= 110;
    }
  }
  return compteur;
}

/* Min-Max */

function simule_coups(plateau, profondeur){

}

function min(){
  return 0;
}

function max(){
  return 0;
}
/* Fin Min-Max */

// Fonction qui permet de voir si la partie est terminée et qui a gagné
function check_etat_game(){
  var cerises = false;
  var meringues = false;

  for (var i = 0; i < PLATEAU.length; i++){
    for (var j = 0; j < PLATEAU.length; j++){
      if (PLATEAU[i][j] == CERISE)
        cerises = true;
      if (PLATEAU[i][j] == MERINGUE)
        meringues = true;
    }
    if (cerises && meringues) // On arrête de chercher si on a trouvé au moins une cerise et une meringue
      break;
  }

  if (cerises && !meringues){
    alert("Victoire des cerises");
    return false;
  }
  else if (!cerises && meringues){
    alert("Victoire des meringues");
    return false;
  }
  else{
    return true;
  }


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

function bot(){
  setTimeout(function(){
    CONTROL = MERINGUE;
    dir = IA();
    move(dir);
    check_destruction(PLATEAU);
    //affiche_plateau();
    affiche_new_plateau();
    check_etat_game();
    CONTROL = CERISE;
    turn = true;
  }, 1000);
}

function coup(direction){
  if (turn){
    turn = false;
    move(direction);
    check_destruction(PLATEAU);
    //affiche_plateau();
    affiche_new_plateau();
    check_etat_game();
    bot();
  }
  else{
    console.log("Pas à votre tour de jouer");
  }
}


function launch_game(){
  load_plateau();
  affiche_new_plateau();
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


  $("#right").click(function(){
    coup(mouvementType.d);
  });

  $("#left").click(function(){
    coup(mouvementType.g);
  });

  $("#top").click(function(){
    coup(mouvementType.h);
  });

  $("#bottom").click(function(){
    coup(mouvementType.b);
  });
