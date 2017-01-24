function showPanel(){
    var panelRegister = document.getElementById("panel-register");
    var questionDiv = document.getElementById("question-div");

    questionDiv.style.display = "none";
    panelRegister.style.display = "block";

}

function showLoader(){
    var loader = document.getElementById("divloader");
    var mailbtn = document.getElementById("mailbtn");

    loader.style.display = "block";
    mailbtn.disabled = "true";
}

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