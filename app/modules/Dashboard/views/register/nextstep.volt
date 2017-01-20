<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Registrarse</div>
                </div>
                {% if opauthID == false %}
                <div class="panel-body">
                    <form class="form-horizontal" method="post" id="rgform" action="{{ url.get() }}dashboard/register/update">
                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="text" value="{{ id }}" name="id" class="form-control" id="input-hidden" readonly/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nombre:</label>
                            <div class="col-sm-10">
                                {{ registerform.render('name') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Correo:</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ email }}" class="form-control" name="email" readonly/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="company" class="col-sm-2 control-label">Empresa:</label>
                            <div class="col-sm-10">
                                {{ registerform.render('company') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="systems" class="col-sm-12">Seleccione el sistema que desea probar:</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="systems" name="system">
                                    <option value="1">Enterprise Resource Planning</option>
                                    <option value="2">Document Management System</option>
                                    <option value="3">Learning Management System</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Contraseña:</label>
                            <div class="col-sm-10">
                                {{ registerform.render('password') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password2" class="col-sm-2 control-label">Repita:</label>
                            <div class="col-sm-10">
                                {{ registerform.render('password2') }}
                            </div>
                        </div>
                        <div class="submitbtn">
                            <button type="submit" class="btn btn-warning" id="nextbtn">Siguiente</button>
                        </div>
                    </form>
                    <br>
                    <div id="msgPass" class="alert alert-danger">
                        <strong>Error: </strong>Las contraseñas aún no coinciden
                    </div>
                    <div id="msgPass2" class="alert alert-success">
                        <strong>Las contraseñas coinciden</strong>
                    </div>
                </div>
                {% elseif opauthID == true %}
                    <div class="panel-body">
                    <form class="form-horizontal" method="post" id="rgform" action="{{ url.get() }}dashboard/register/updateOpauth">
                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="text" value="{{ id }}" name="id" class="form-control" id="input-hidden" readonly/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="company" class="col-sm-2 control-label">Empresa:</label>
                            <div class="col-sm-10">
                                {{ registerform.render('company') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="systems" class="col-sm-12">Seleccione el sistema que desea probar:</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="systems" name="system">
                                    <option value="1">Enterprise Resource Planning</option>
                                    <option value="2">Document Management System</option>
                                    <option value="3">Learning Management System</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Contraseña:</label>
                            <div class="col-sm-10">
                                {{ registerform.render('password') }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password2" class="col-sm-2 control-label">Repita:</label>
                            <div class="col-sm-10">
                                {{ registerform.render('password2') }}
                            </div>
                        </div>
                        <div class="submitbtn">
                            <button type="submit" class="btn btn-warning" id="nextbtn">Siguiente</button>
                        </div>
                    </form>
                    <br>
                    <div id="msgPass" class="alert alert-danger">
                        <strong>Error: </strong>Las contraseñas aún no coinciden
                    </div>
                    <div id="msgPass2" class="alert alert-success">
                        <strong>Las contraseñas coinciden</strong>
                    </div>
                </div>

                {% endif %}
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>