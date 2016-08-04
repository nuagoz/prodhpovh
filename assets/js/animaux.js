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
				$('.g_value').html(data.response.options.argent);
        	}
		}
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
