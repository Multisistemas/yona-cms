<div class="container">
    <div class="row">
	    <div class="col-md-3"></div>    
	    <div class="col-md-6">                  
	        <div class="panel panel-info" id="panel-login">
	            <div class="panel-heading">
	                <div class="panel-title">Invitar equipo</div>
	            </div>
	        	<div class="panel-body">
	                <form class="form-horizontal" id="inviteform" onsubmit="showLoader();" method="post" action="{{ url.get() }}dashboard/register/sendInvitations/{{ id }}">
	                	<div class="form-group">
	                        <label for="mail1" class="col-sm-2 control-label">Correo:</label>
	                        <div class="col-sm-10">
	                            {{ inviteForm.render('email1') }}
	                        </div>
	                    </div>
                        <div class="form-group">
	                        <label for="mail2" class="col-sm-2 control-label">Correo:</label>
	                        <div class="col-sm-10">
	                            {{ inviteForm.render('email2') }}
	                        </div>
                        </div>
                        <div class="form-group">
	                        <label for="mail3" class="col-sm-2 control-label">Correo:</label>
	                        <div class="col-sm-10">
	                            {{ inviteForm.render('email3') }}
	                        </div>
                        </div>
                        
                        <div class="submitbtn">
                        	<a href="/"><button type="button" class="btn btn-default">Omitir</button></a>
                            <button type="submit" class="btn btn-warning" id="mailbtn">Siguiente</button>
                        </div>
	                </form>
	            </div>
	        </div>

	        <div id="divloader">
                <p><b>Espere mientras se le envía el correo de verificación</b></p>
                <br>
                <span><div class="loader"></div></span>
            </div>
	    </div>
	    <div class="col-md-3"></div>
   	</div>
   	<div class="clear"></div>
    <div class="row">
	    <div class="col-md-3"></div>
	    <div class="col-md-6">
	       {{ flash.output() }}
	    </div>
        <div class="col-md-3"></div>
    </div>
</div>