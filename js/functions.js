$(document).ready(function(){
    $(".menuDesp span").click(function(){
        $(".menuDesp ul ul").slideUp();
        if(! $(this).next().is(":visible")){
            $(this).next().slideDown();
        }
    })
})