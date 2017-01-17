<div class="container">
    <div class="row">
	    <div class="col-md-3"></div>    
	    <div class="col-md-6">                  
	        <div class="panel panel-info" id="panel-login">
	            <div class="panel-heading">
	                <div class="panel-title">Invitar equipo</div>
	            </div>
	        	<div class="panel-body">
	                <form class="form-horizontal" method="post" action="{{ url.get() }}dashboard/register/sendInvitations/1">
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
                        </div>
                        <div class="submitbtn">
                            <button type="submit" class="btn btn-warning">Siguiente</button>
                        </div>
                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	    <div class="col-md-3"></div>
   	</div>
</div>