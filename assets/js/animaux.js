$(window).on('resize', centerModals);
var id_hibou;

function send_animal(idhibou) {

	$("#envoi_"+idhibou).attr( "disabled", "disabled" );
	$("#envoi_"+idhibou).addClass('disabled');
	$.ajax({
        type:'POST',
        data : {"idhibou":idhibou},
        url : 'management/check_envoi',
        success: function(data){
        	
        	if (data.response.options.verif !== "ok"){

        		$("#notif_envoi").fadeTo(200,0.1,function()
				{
					$(this).html(data.response.options.notification).addClass('messageboxok').fadeTo(900,1,function(){});
				});
        	}
        	else{
        		// Reconstruction de la fiche
				$("#textepigeon_"+idhibou ).append("<div class='repos2' id='repos_"+idhibou+"'>Repos</div><span class ='timer' id= 'timer_div_"+idhibou+"'></span> <img src='assets/img/chrono.gif' height='16' width='16' id='img_"+idhibou+"'>");
				$("#envoi_"+idhibou).addClass('disabled button');
				$("div").remove("#dispo_"+idhibou);
				$("#dispo2").empty();

				window["seconds_left_"+idhibou] = data.response.options.cd;
				window["interval_"+idhibou] = setInterval(function() {
					window["temps_"+idhibou] = new Date(--window["seconds_left_"+idhibou]*1000);
					document.getElementById('timer_div_'+idhibou).innerHTML = "";
					document.getElementById('timer_div_'+idhibou).innerHTML = window["temps_"+idhibou].getHours()-1+':'+('0'+window["temps_"+idhibou].getMinutes()).substr(-2)+':'+('0'+window["temps_"+idhibou].getSeconds()).substr(-2);

					if (window["seconds_left_"+idhibou] <= 0)
					{
						document.getElementById('timer_div_'+idhibou).innerHTML = '0';

						$('#textepigeon_'+idhibou).append('<div class=\'dispo2\' id=\'dispo_'+idhibou+'\'>Disponible</div>'); //$('#timer_div_'+idhibou).remove();
						$('#img_'+idhibou).remove();
						$('#timer_div_'+idhibou).remove();
						$('#repos_'+idhibou).remove();
						$('#br_'+idhibou).remove();
						$('#envoi_'+idhibou).removeClass('disabled');
						$('#envoi_'+idhibou).removeAttr('disabled');
						clearTimeout(window['interval_'+idhibou]); // Arrêter le décompte.

						// Reset animation
						$('.animation_reward_'+idhibou).remove();
						$('.hibou_'+idhibou).prepend("<div id = 'animation_reward' class='animation_reward_"+idhibou+"' style='display:none;'></div>");

						$('.animation_ingredient_'+idhibou).remove();
						$('.hibou_'+idhibou).prepend("<div id = 'animation_ingredient' class='animation_ingredient_"+idhibou+"' style='display:none;'></div>");

						//$("#img_"+idhibou).css("display","none");
						//$('#boost_hibou_279').fadeOut(1000);
					}

				}, 1000);
				
				if (data.response.options.result_send === "ok")
				{
					add_animation(data.response.options.message, 'ok', idhibou, data.response.options.img_ingredient);
					bandeau('ok');
				}
				else
				{
					add_animation(data.response.options.message, 'fail', idhibou, data.response.options.img_ingredient);
					bandeau('fail');
				}

				if (data.response.options.gain_xp !== 0)
					gain_xp(data.response.options.gain_xp);


				// Notification haut de page
				// Vérification si elle est déjà affichée
				function bandeau(type){

					if (!($('body').children().hasClass('overhang'))){

						var debut = '<span class="col-xs-12 col-sm-8 col-sm-offset-2">';
						var count_g = '<span class="col-xs-4 col-sm-3" id="count_gallion">';
							count_g += '<span id="val_g">0</span> <img id = "stat_g" class="img-responsive" src = "assets/img/gallion2.png" /></span>';

						var count_s = '<span class="col-xs-4 col-sm-3" id ="count_success" style="color:green;">';
							count_s += '<i class="fa fa-check" aria-hidden="true"></i> <span id = "stat_s"> 0</span></span>';

						var count_f = '<span class="col-xs-4 col-sm-3" id ="count_fail" style="color:red;">';
							count_f +='<i class="fa fa-times" aria-hidden="true"></i> <span id = "stat_f"> 0</span></span>';

						var list_ingr = '<button type="button" class="col-xs-12 col-sm-3 btn btn-primary" data-toggle="modal" data-target="#ingredient_list">Ingrédients : <span id="qty_ingr">0</button>';
						var fin = '</span>';

						$("body").overhang({
							type: "info",
							message: "",
							html: true,
							closeConfirm: true
						});
						$('.message').append(debut+count_g+count_s+count_f+list_ingr+fin);
					}
					var total_win = (parseInt($('#val_g').text()) + parseInt(data.response.options.earned));
					// Ajoute les stats
					if (type === "ok"){
						var compteur = parseInt($('#stat_s').text()) + 1;
						$('#stat_s').text(compteur);
					}

					else{
						var compteur = parseInt($('#stat_f').text()) + 1;
						$('#stat_f').text(compteur);
					}

					if (data.response.options.ingredient !== '')
					{
						var compteur = parseInt($('#qty_ingr').text()) +1;
						$('#qty_ingr').text(compteur);

						// Ajouter ingrédient dans le modal
						if ( $('.modal-body').children().hasClass("zone_"+data.response.options.ingredient) ){
							var resultat = parseInt($('.qty_'+data.response.options.ingredient).text()) + 1;
							$('.qty_'+data.response.options.ingredient).html(resultat);
						}
						else{
							$('.modal-body').append('<div data-toggle="tooltip" data-placement="top" title="'+data.response.options.nom_ingredient+'" class="col-xs-4 col-sm-2 zone_'+data.response.options.ingredient+'"><img id="modal_ingredient" src = "'
								+data.response.options.img_ingredient+' "/><span class="badge qty_'+data.response.options.ingredient+'">1</span></div>');
							$('.zone_'+data.response.options.ingredient).tooltip();
						}
					}

					$('#val_g').text(total_win);
					
				}

				$('.g_value').html(data.response.options.argent);
        	}
		}
	});
}

// Fonction pour créer l'animation du gain du hibou
function add_animation(texte, type, id, ingredient){

	$('.animation_reward_'+id).html(texte);

	if (type == 'ok'){
		$('.animation_reward_'+id).css({'color':'#05c320'});
	}
	else{
		$('.animation_reward_'+id).css({'color':'#de0304'});
	}
	
	if (ingredient !== ""){
		$('.animation_ingredient_'+id).html("<img class='ingredient_home' src='"+ingredient+"'/>");
		$('.animation_ingredient_'+id).show();
		$('.animation_ingredient_'+id).addClass('animated fadeOutUp visible');
	}

	$('.animation_reward_'+id).show();
	$('.animation_reward_'+id).addClass('animated fadeOutUp visible');

}

function gain_xp(value)
{
	var old_value = parseInt($("#actual_xp").html());
	var new_value = old_value + value;
	var max_value = parseInt($("#needed_xp").html());
	var bonus_value = 0;

	if(value > 1)
		bonus_value = value - 1;

	if (new_value == max_value) // level up
	{
		$("#actual_xp").html(0+bonus_value);
		var old_lvl = parseInt($("#value_lvl").html());
		$("#value_lvl").html(old_lvl+1);
	}
	else{
		$("#actual_xp").html(new_value);	
	}

	// Progress bar
	var pourcentage = (parseInt($("#actual_xp").html())/parseInt($("#needed_xp").html()))*100;

	$("#progress_level").css({
	    width : pourcentage+"%"
	});
}


function confirmMessage(idhibou){
    if (confirm($('#message_confirm').val())) {
    	$.ajax({
	        type:'POST',
	        data : {"idhibou":idhibou},
	        url : 'management/release',
	        success: function(data){

	        	$("#notif_envoi").fadeTo(200,0.1,function()
				{
					$(this).html(data.response.options.notification).addClass('messageboxok').fadeTo(900,1,function(){});
				});

	        	if(data.response.options.verif){
	        		$('#hibou_'+idhibou).fadeOut();
	        	}
	        }
	    });
    }
}

// Fonction pour centrer verticalement le modal bootstrap
var modalVerticalCenterClass = ".modal";
function centerModals($element) {
    var $modals;
    if ($element.length) {
        $modals = $element;
    } else {
        $modals = $(modalVerticalCenterClass + ':visible');
    }
    $modals.each( function(i) {
        var $clone = $(this).clone().css('display', 'block').appendTo('body');
        var top = Math.round(($clone.height() - $clone.find('.modal-content').height()) / 2);
        top = top > 0 ? top : 0;
        $clone.remove();
        $(this).find('.modal-content').css("margin-top", top);
    });
}
$(modalVerticalCenterClass).on('show.bs.modal', function(e) {
    centerModals($(this));
});
$(window).on('resize', centerModals);var modalVerticalCenterClass = ".modal";
function centerModals($element) {
    var $modals;
    if ($element.length) {
        $modals = $element;
    } else {
        $modals = $(modalVerticalCenterClass + ':visible');
    }
    $modals.each( function(i) {
        var $clone = $(this).clone().css('display', 'block').appendTo('body');
        var top = Math.round(($clone.height() - $clone.find('.modal-content').height()) / 2);
        top = top > 0 ? top : 0;
        $clone.remove();
        $(this).find('.modal-content').css("margin-top", top);
    });
}
$(modalVerticalCenterClass).on('show.bs.modal', function(e) {
    centerModals($(this));
});

$(".buy_hibou").click(function(){

	var link = $("#linksrcanimal").val();
	id_hibou = $(this).attr('data-hibou');
	$("#namehibouspan").html($(this).attr('data-name'));

	var image = "<img class = 'center-block print_animal img-rounded img-responsive' src  = '";
	image += link + "/" + id_hibou +'.jpg';
	image += "'/>";

	$("#imghibouspan").html(image);
	$("#valeur_achat").html($(this).attr('data-price'));

	$("#erreur_achat").hide();
	$("#texterror").html("");
	$('#buy_eeylops').modal('show');
});

$('#random_name').hover(
    function(){
        $(this).css({'background-color': '#cfcfcf'});
    },
    function(){
        $(this).css({'background-color': '#eee'});
    }
);

$('#random_name, #random_name_mobile').click(function(){
	$.ajax({
        type:'POST',
        data : {"idhibou":"ok"},
        url : 'generate_name',
        success: function(data){
        	$("#animal_input_name").val(data.response.options.name);
        	$("#animal_input_name_mobile").val(data.response.options.name);
        	$('#buy_hibou').prop('disabled', false);
        }
    });
});

$("#animal_input_name, #animal_input_name_mobile").keyup(function(){
		if(check_input_length($(this)))
			$('#buy_hibou').prop('disabled', false);
		else
			$('#buy_hibou').prop('disabled', true);	
});

function check_input_length(element)
{
	if(element.val().length == 6 || element.val().length == 6)
		return true;
	return false;
}

$("#buy_hibou").click(function(){
	var hibouname;
	if($("#animal_input_name").val().length == 0)
		hibouname = $("#animal_input_name_mobile").val();
	else
		hibouname = $("#animal_input_name").val();

	$.ajax({
        type:'POST',
        data : {"idhibou":id_hibou, "hibouname":hibouname},
        url : 'buy_owl',
        success: function(data){
        	if(data.response.options.traitement_ok) // achat effectué
        	{
        		var link = $("#linksrcanimal").val();
        		var image = "<img class = 'center-block alert_mobile img-rounded img-responsive' src  = '";
				image += link + "/" + id_hibou +'.jpg';
				image += "'/>";

				var title = "<div class='text-center oswald titletoastr'>";
					title += "Achat effectué !";
				title += "</div><br/>";

				var content = image;        		

        		toastr.success(content, title, {timeOut: 3000}); // Notification de l'achat

        		// Ajout +1 possédé.
        		$("#nb_hibou_"+id_hibou).html(parseInt($("#nb_hibou_"+id_hibou).html())+1);

        		// Enlever argent
        		$(".g_value").html(parseInt($(".g_value").html()) - parseInt(data.response.options.price));
        		$('#buy_eeylops').modal('hide');	
        	}
        	else{ // Au moins une erreur
        		if(!data.response.options.taille_ok)
        			$("#texterror").html("Le nom de votre animal doit faire 6 caractères.");
        		else if(!data.response.options.argent_ok)
        			$("#texterror").html("Vous n'avez pas assez de gallions.");
        		else if(!data.response.options.stock_ok)
        			$("#texterror").html("Vous n'avez pas assez de place dans votre volière.");
        		else if(!data.response.options.qty_limite_ok)
        			$("#texterror").html("Vous ne pouvez pas posséder plus de <strong>" + $("#namehibouspan").html() + "</strong>");
        		$("#erreur_achat").show();
        	}
        }
    });
});