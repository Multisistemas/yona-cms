<div class="container">
    <div class="row">   
    <div class="col-md-6">                  
        <div class="panel panel-primary" id="panel-login">
            <div class="panel-heading">
                <div class="panel-title">Iniciar sesión</div>
            </div>
                <div class="panel-body" >
                    <form class="form-horizontal" method="post" action="<?= $this->url->get() ?>dashboard/login/loginManual">
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Correo:</label>
                            <div class="col-sm-9">
                                <?= $loginform->render('email') ?>
                            </div>
                            </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">Contraseña:</label>
                            <div class="col-sm-9">
                                <?= $loginform->render('password') ?>
                            </div>
                        </div>
                        <div class="submitbtn">
                            <input type="hidden" name="<?= $this->security->getTokenKey() ?>" value="<?= $this->security->getToken() ?>"/>
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                        </div>
                    </form>
                    <br>
                    <hr>
                    <br>
                    <form method="get" action="<?= $this->url->get() ?>dashboard/login/loginOpauth/google">
                        <button type="submit" class="btn btn-success">
                           <i class="fa fa-google" aria-hidden="true"></i>
                            Ingresar con Google
                        </button>
                    </form>  
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-sm-12 center-text" id="question-div">
                <p>¿Aún no posee una cuenta?</p>
                <button class="btn btn-info" id="show-btn" onclick="showPanel();">Por favor, quiero una cuenta con Multisistemas</button>
            </div>
            <br>
            <div class="panel panel-info" id="panel-register">
                <div class="panel-heading">
                    <div class="panel-title">Registrarse</div>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="post" onsubmit="showLoader();" id="rgform" action="<?= $this->url->get() ?>dashboard/register/sendMail">
                        <div class="form-group">
                            <label for="rmail" class="col-sm-3 control-label">Correo:</label>
                            <div class="col-sm-9">
                                <?= $registerform->render('rmail') ?>
                            </div>
                        </div>
                        <div class="submitbtn">
                            <button type="submit" class="btn btn-warning" id="mailbtn">Siguiente</button>
                        </div>
                    </form>
                </div>
            </div>
            <div id="divloader">
                <span><div class="loader"></div></span>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <?= $this->flash->output() ?>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

                