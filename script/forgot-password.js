$(document).ready(function(){
    $("#forgot-btn").click(function(){
        $("#login-box").hide();
        $("#forgot-box").show();
    });
});

$(document).ready(function(){
    $("#login-btn").click(function(){
        $("#forgot-box").hide();
        $("#login-box").show();
    });
});