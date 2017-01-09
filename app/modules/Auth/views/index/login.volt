 <body>
        <div class="container">    
            <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">                    
                <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Iniciar sesión</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px">
                            <a href="#">Olvidó su contraseña?</a>
                        </div>
                    </div>     
                    <div style="padding-top:30px" class="panel-body" >
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            <form id="loginform" class="form-horizontal" role="form">      
                                <div style="margin-bottom: 25px; width: 100%;" class="input-group">
                                    <p>Correo</p>
                                    <div class="ui icon input" style="width:100%;">
                                        {{ form.render('email') }}
                                        <i class="user icon"></i>
                                    </div>                                        
                                </div>
                                <div style="margin-bottom: 25px; width: 100%;" class="input-group">
                                    <p>Contraseña</p>
                                    <div class="ui icon input" style="width:100%;">
                                        {{ form.render('password') }}
                                        <i class="lock icon"></i>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <div class="checkbox">
                                        <label>
                                            <input id="login-remember" type="checkbox" name="remember" value="1"> Recordarme
                                        </label>
                                    </div>
                                </div>
                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->
                                    <div class="col-sm-12 controls">
                                        <div class="col-sm-4">
                                            <a id="btn-login" href="#" class="btn btn-primary">Ingresar</a>
                                        </div>
                                        <div class="col-sm-4">
                                            O si prefiere
                                        </div>
                                        <div class="col-sm-4">
                                            {{link_to('auth/login/loginOpauth/google','class':'btn btn-primary', '<i class="fa fa-google-plus fa-3x"></i>')}}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            No posee una cuenta? 
                                        <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                            Registrarse aquí!
                                        </a>
                                        </div>
                                    </div>
                                </div>    
                            </form>     
                        </div>                     
                    </div>  
                </div>

                
                <div id="signupbox" style="display:none; margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Registrarse</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Iniciar sesión</a></div>
                        </div>  
                        <div class="panel-body" >
                            <form id="signupform" class="form-horizontal" role="form">
                                
                                <div id="signupalert" style="display:none" class="alert alert-danger">
                                    <p>Error:</p>
                                    <span></span>
                                </div>                  
                                <div class="form-group">
                                    <label for="email" class="col-md-3 control-label">Correo</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="email" placeholder="Email Address">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Contraseña</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="passwd" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Repetir contraseña</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="passwd" placeholder="Password">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                <!-- Button -->                                        
                                <div class="col-md-offset-3 col-md-9">
                                            <button id="btn-signup" type="button" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Registrar</button>
                                        <span style="margin-left:8px;">o</span>  
                                    </div>
                                </div>        
                                <div style="border-top: 1px solid #999; padding-top:20px"  class="form-group">        
                                    <div class="col-md-offset-3 col-md-9">
                                        <div class="g-signin2" data-onsuccess="onSignIn"></div>
                                    </div>                
                                </div>                
                            </form>
                        </div>
                    </div>     
                </div> 
            </div>
    </body>
</html>
