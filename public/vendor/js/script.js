$(document).ready(function(){ 
	/*$("#mailbtn").on("click",function(){
	    $("#divloader").css("display", "block");
	    $("#mailbtn").attr("disabled","true");
    });

    if ($("#rmail").val() != null) {
    	$("#mailbtn").on("submit",function(){
	    	$("#divloader").css("display", "block");
	    	$("#mailbtn").attr("disabled","true");
    	});
	}*/

	$("#rgform").submit(function(event){
	  	$("#divloader").css("display", "block");
		$("#mailbtn").attr("disabled","true");
	});

    $("#question-div").on("click", function(){
    	$("#panel-login").fadeOut("slow");
    	$("#question-div").fadeOut("slow");
    	$("#panel-register").fadeIn("slow");
    });


});