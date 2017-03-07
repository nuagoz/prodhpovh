function dateDiff(date1, date2){
    var diff = {}                           // Initialisation du retour
    var tmp = date2 - date1;
 
    tmp = Math.floor(tmp/1000);             // Nombre de secondes entre les 2 dates
    diff.sec = tmp % 60;                    // Extraction du nombre de secondes
    if(diff.sec < 10) diff.sec = "0" + diff.sec;
 
    tmp = Math.floor((tmp-diff.sec)/60);    // Nombre de minutes (partie entière)
    diff.min = tmp % 60;                    // Extraction du nombre de minutes
    if(diff.min < 10) diff.min = "0" + diff.min;
 
    tmp = Math.floor((tmp-diff.min)/60);    // Nombre d'heures (entières)
    diff.hour = tmp % 24;                   // Extraction du nombre d'heures
    if(diff.hour < 10) diff.hour = "0" + diff.hour;
     
    tmp = Math.floor((tmp-diff.hour)/24);   // Nombre de jours restants
    diff.day = tmp;
    if(diff.day < 10) diff.day = "0" + diff.day;

    return diff;
}

// sachant que les matchs sont tous les vendredis
function get_remaining_days(date){
    var res = 5 - date.getDay();
    return res != -1 ? res : 6;
}

function affiche_temps()
{
    var current = new Date(); // Date courante
    var match_date = new Date($("#date_next_match").val());
    var diff = dateDiff(current, match_date);
    $("#quidditch_days").html(diff.day);
    $("#quidditch_hours").html(diff.hour);
    $("#quidditch_minutes").html(diff.min);
    $("#quidditch_seconds").html(diff.sec);
    setTimeout(function(){ affiche_temps(); }, 1000);
}

// S'il n'y a pas de match en cours, afficher le compteur
if($("#match_en_cours").val() == 0)
    affiche_temps();
