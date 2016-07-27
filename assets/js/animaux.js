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
        		$("#notif_envoi").fadeTo(200,0.1,function()
				{
					$(this).html(data.response.options.notification).addClass('messageboxok').fadeTo(900,1,function(){});
				});
				$("#notif_ingredient").fadeTo(200,0.1,function()
				{
					$(this).html(data.response.options.ingredient).addClass('messageboxok').fadeTo(900,1,function(){});
				});
				$('#hibou_'+idhibou).html(data.response.html);
        	}
		}
	});
}
