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

function autocollapse() {
  var navbar = $('.navbar-autocollapse');
  navbar.removeClass('collapsed');
  if(navbar.innerHeight() > 113)
    navbar.addClass('collapsed');
}

function viewUsers() {
    var user_div = $('#hidden-users-div');

    if (user_div.css('display') == 'none') {
        user_div.css('display', 'block');
    } else if (user_div.css('display') == 'block') {
        user_div.css('display', 'none');
    }
}

function viewSystems() {
    var system_div = $('#hidden-systems-div');

    if (system_div.css('display') == 'none') {
        system_div.css('display', 'block');
    } else if (system_div.css('display') == 'block') {
        system_div.css('display', 'none');
    }
}


