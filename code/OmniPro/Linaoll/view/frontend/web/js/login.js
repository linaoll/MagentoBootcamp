require(['jquery'], function($){ 
    $( document ).ready(function() {
        // alert("primer alerta");
        $( ".container .tabs .tab-content " ).on( "click", function() {

            if($(this).hasClass("login")){
                $(this).find('a').addClass("active");
                $(".container .tab-content").removeClass("active");
                $(".tab-content #tab-login").addClass("active");
                $(".tab-content #tab-register").removeClass("active");
            }
            else if($(this).hasClass("register")){
                $(this).find('a').addClass("active");
                $(".container.tab-content.login").removeClass("active");
                $(".tab-content #tab-register").addClass("active");
                $(".tab-content #tab-login").removeClass("active");
            }
        });



        
    });    
 });
