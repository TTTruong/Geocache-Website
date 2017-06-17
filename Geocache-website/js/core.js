$(document).ready(function(){
    console.log("DOM Loaded!");
    //Initializing some dom elements
    $("#loginForm").css("visibility","hidden");

    //*********HEADER LOGIN***********
    $("#loginButton").click(function(){
        $("#login").addClass("hvr-pulse");
	    $("#loginForm").css("visibility","visible");
        $("#loginButton").css("visibility","hidden");
    });

    $("#signupButton").click(function(){
	   $("#registerEmail").focus();
    });

    $("#addButton").click(function(){

    });

    $("#logoutButton").click(function(){
//	window.location = "php/logout.php";
    });

    // **********MAIN BODY 1*************
    //coin slider welcome    
    $('#gallery').coinslider({
        hoverPause: true,
        delay: 5000,
        opacity: 0.7
    });

    //welcome Register Form
    $("#registerButton").button();
    
    //temp
    $("#createButton").button();
    $("#login").button();
    $('[data-toggle="tooltip"]').tooltip(); 
});





























