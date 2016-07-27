$(document).ready(function() {

    var category_base;

    $('a[rel="relativeanchor"]').click(function(){
        $('html, body').animate({
            scrollTop: $( $.attr(this, 'href') ).offset().top
        }, 500);
        return false;
    });

    // Animation apparition du titre principal
    $( "#home-title" ).animate({
        opacity: 1
    }, 1000);

    $('.update-nag').click(function(){
        $('#menu_guide').hide();
        $('#menu_guide_x4').fadeIn(800);
    });

    $('.main_category').click(function(){
        category_base = $(this).attr('title');
    });

    $('.main_category').hover(
    function(){
        $('.guide-text-category').html($(this).attr('title'));
    },
    function(){
        $('.guide-text-category').html(category_base);
    }
    );

});

