<div class="container">
    <div class="row">
    <div class="col-md-3"></div>    
    <div class="col-md-6">                  
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Iniciar sesión</div>
            </div>
                <div class="panel-body" >
                    <form class="form-horizontal" method="post" action="{{ url.get() }}dashboard/login/loginManual">
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Correo</label>
                            <div class="col-sm-10">
                                {{ form.render('email') }}
                            </div>
                            </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Contraseña</label>
                            <div class="col-sm-10">
                                {{ form.render('password') }}
                            </div>
                        </div>
                        <div class="submitlogin">
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
            <div>¿Aún no posee una cuenta?</div>
            <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Registrarse</div>
            </div>
            <div class="panel-body">
                <form class="form-inline" method="post" action="{{ url.get() }}dashboard/register/sendMail">
                    <div class="form-group">
                        <label for="rmail">Correo</label>
                        <input type="email" class="form-control" name="email" id="rmail" placeholder="Ingrese su correo">
                    </div>
                    <button type="submit" class="btn btn-primary">Siguiente</button>
                </form>
            </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
                