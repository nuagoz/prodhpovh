function send_animal(idhibou){

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

						//$("#img_"+idhibou).css("display","none");
						//$('#boost_hibou_279').fadeOut(1000);
					}

				}, 1000);
/*
        		$("#notif_envoi").fadeTo(200,0.1,function()
				{
					$(this).html(data.response.options.notification).addClass('messageboxok').fadeTo(900,1,function(){});
				});
				$("#notif_ingredient").fadeTo(200,0.1,function()
				{
					$(this).html(data.response.options.ingredient).addClass('messageboxok').fadeTo(900,1,function(){});
				});*/
				
				if (data.response.options.result_send === "ok")
				{
					add_animation(data.response.options.message, 'ok', idhibou);
					bandeau('ok');
				}
				else
				{
					add_animation(data.response.options.message, 'fail', idhibou);
					bandeau('fail');
				}

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

						var list_ingr = '<button type="button" class="col-xs-12 col-sm-3 btn btn-primary">Ingrédients : <span id="qty_ingr">0</button>';
						var fin = '</span>';

						$("body").overhang({
							type: "info",
							message: "",
							html: true,
							closeConfirm: true
						});
						
						$('.message').append(debut+count_g+count_s+count_f+list_ingr+fin);
						$('.close').hide();
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
					}

					$('#val_g').text(total_win);
					
				}

				$('.g_value').html(data.response.options.argent);
        	}
		}
	});
}

function add_animation(texte, type, id){
	
	$('.animation_reward_'+id).html(texte);
	if (type == 'ok'){
		$('.animation_reward_'+id).css({'color':'#05c320'});
	}
	else{
		$('.animation_reward_'+id).css({'color':'#de0304'});
	}
	
	$('.animation_reward_'+id).show();
	$('.animation_reward_'+id).addClass('animated fadeOutUp visible');
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

function alertoverhang(){
	$("body").overhang({
		type: "info",
		message: "",
		upper: true
	});


}

function close(){
	$overhang.slideDown(attributes.speed, attributes.easing).delay(attributes.duration * 1000).slideUp(attributes.speed, function () {
        raise(true);
      });
}