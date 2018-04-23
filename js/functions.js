jQuery(document).ready(function(){      
    $( ".navbar-toggle" ).click(function() {
        $(".navbarmobile").toggleClass("toggle");
        if($(".navbarmobile").is(".toggle")){
            $(this).find("i").removeClass("glyphicon-menu-hamburger").addClass("glyphicon-remove");
        } else {
            $(this).find("i").removeClass("glyphicon-remove").addClass("glyphicon-menu-hamburger");
        }
    });  
    $( "[role='back-to-top']" ).click(function() {
        $('html, body').stop(true, false).animate({
            scrollTop: $("header").offset().top
        }, 500);
    });  
    $('<a role="scrolldown" href="javascript:void(0)"><i class="glyphicon glyphicon-menu-down"><!-- --></i></a>').appendTo( ".pg-home #hero" ).click(function() {
        // var nextId = '#'+$(this).closest("section").attr("id");
        // var nextSection = '#'+$(nextId).nextAll("section").first().attr("id");
        $('html, body').stop(true, false).animate({
            scrollTop: $("#search-box").offset().top
        }, 1000);
    });  
    $('.testimonials').flexslider({
        animation: "fade",
        smoothHeight: true,
        touch: true,
        controlNav: true,
        directionNav: false,
        prevText:"",
        nextText:"",
        selector:".lvca-testimonials > .lvca-testimonial"
    }); 
});        