$('.img-card').hover(
function(){
    $('#card_name').html($(this).attr('data-name'));
},
function(){
    $('#card_name').html("Nom");
}
);
