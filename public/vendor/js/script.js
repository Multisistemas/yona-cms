$(document).ready(function(){
	$("#rgform").submit(function(event){
	  	$(".divloader").css("display", "block");
		$("#mailbtn").attr("disabled","true");
	});

    $("#inviteform").submit(function(event){
        $(".divloader").css("display", "block");
        $("#invitebtn").attr("disabled","true");
    });

    $("#question-div").on("click", function(){
    	$("#panel-login").fadeOut("slow");
    	$("#question-div").fadeOut("slow");
    	$("#panel-register").fadeIn("slow");
    });  
});

function validatePass(){
    var p1 = document.getElementById("pass").value;
    var p2 = document.getElementById("pass2").value;
    var msgPass = document.getElementById("msgPass");
    var msgPass2 = document.getElementById("msgPass2");
	    
    if (p2 != p1) {
    	msgPass.style.display = "block";
    	msgPass2.style.display = "none";
    } else if (p2 === p1) {
    	msgPass2.style.display = "block";
    	msgPass.style.display = "none";
    }
}