$(window).load(function(){
    $('.mobile_nav_bar').css("display","none");
    $('#mobileLink').click(function(){
        navSwingIn();
        console.log('clicked icon');
    });
    $('.close_mobile_nav').click(function(){
        navSwingOut();
    });
});

function navSwingIn(){
    $('.mobile_nav_bar').css("left","-60vw");
    $('.mobile_nav_bar').css("display","block");
    $('.mobile_nav_bar').animate({left : "0px"}, "10000", "swing");
    //$('.content').animate({marginLeft : "205px"},"10000","linear");
    //$('.content').animate({marginRight : "-205px"},"10000","linear");
    $('#mobileLink').css("display","none");
    $('.content').click(function(){
        navSwingOut();  
        $('.content').off('click');
    });
}

function navSwingOut(){
    $('.content').off('click');
    console.log('clicked content');
    $('.mobile_nav_bar').animate({left : "-100%"}, "10000", "swing");
    $('#mobileLink').css("display","block");
}
