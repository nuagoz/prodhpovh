$(document).ready(function() {

    // Ajout classe active pour chaque catégorie du menu sur laquelle on se trouve
    // -> Créer controleur principal qui renvoie nom du controleur actuel + fonction si utilisée

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

    $(".btn-pref .btn").click(function () {
        $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
        // $(".tab").addClass("active"); // instead of this do the below 
        $(this).removeClass("btn-default").addClass("btn-primary");   
    });


});

