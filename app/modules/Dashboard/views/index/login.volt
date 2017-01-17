<div class="container">
    <div class="row">
    <div class="col-md-3"></div>    
    <div class="col-md-6">                  
        <div class="panel panel-info" id="panel-login">
            <div class="panel-heading">
                <div class="panel-title">Iniciar sesión</div>
            </div>
                <div class="panel-body" >
                    <form class="form-horizontal" method="post" action="{{ url.get() }}dashboard/login/loginManual">
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Correo:</label>
                            <div class="col-sm-10">
                                {{ loginform.render('email') }}
                            </div>
                            </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Contraseña:</label>
                            <div class="col-sm-10">
                                {{ loginform.render('password') }}
                            </div>
                        </div>
                        <div class="submitbtn">
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                        </div>
                    </form>
                    <br>
                    <hr>
                    <br>
                    <form method="get" action="{{ url.get() }}dashboard/login/loginOpauth/google">
                        <button type="submit" class="btn btn-success">
                           <i class="fa fa-google" aria-hidden="true"></i>
                            Ingresar con Google
                        </button>
                    </form>  
                </div>
            </div>
        </div>
        <div class="col-md-3"></div> 
    </div>

    <div class="clear"></div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="center-text" id="question-div">
                <p>¿Aún no posee una cuenta?</p>
                <button class="btn btn-info">Por favor, quiero una cuenta con Multisistemas</button>
            </div>
            <br>
            <div class="panel panel-info" id="panel-register">
            <div class="panel-heading">
                <div class="panel-title">Registrarse</div>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" id="rgform" action="{{ url.get() }}dashboard/register/sendMail">
                    <div class="form-group">
                        <label for="rmail" class="col-sm-2 control-label">Correo:</label>
                        <div class="col-sm-10">
                            {{ registerform.render('rmail') }}
                        </div>
                    </div>
                    <div class="submitbtn">
                        <button type="submit" class="btn btn-warning" id="mailbtn">Siguiente</button>
                    </div>
                </form>
            </div>
            </div>
            <div id="divloader">
                <p><b>Espere mientras se le envía el correo de verificación</b></p>
                <br>
                <span><div id="loader"></div></span>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

                