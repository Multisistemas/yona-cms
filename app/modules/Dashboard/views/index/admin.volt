<div class="container">
  <div class="row">
    {% if session.has('opauth') or session.has('manual') %}
      <div class="col-md-12">
          <div class="col-sm-4">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <div class="panel-title">Panel de administración</div>
              </div>
              <div class="panel-body">
                <div class="list-group">
                  <a href="#" onclick="viewUsers();" class="list-group-item">Administrar usuarios <i class="fa fa-user fa-lg" aria-hidden="true"></i></a>
                  <a href="#" onclick="viewSystems();" class="list-group-item">Agregar otro sistema <i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i></a>
                  <a href="#" class="list-group-item">Enviar otra invitación <i class="fa fa-envelope-o fa-lg" aria-hidden="true"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-8">
            <div class="panel panel-info">
              <div class="panel-heading">
                {% if session.has('manual') %}
                  {% set auth = session.get('manual') %}
                  <div class="panel-title">{{ auth.name }}</div>
                {% elseif session.has('opauth') %}
                  {% set opauth = session.get('opauth') %}
                  <div class="panel-title">{{ opauth['auth']['raw']['name'] }}</div>
                {% endif %}
              </div>                          
              {% if system != null %}
              <div class="panel-body">
                <p>Acceso a los sistemas:</p>
                {% if system == "ERP" %}
                  <a href="#"><button type="button" class="btn btn-lg btn-primary">Ir a ERP</button></a>
                {% elseif system == "DMS" %}
                  <a href="#"><button type="button" class="btn btn-lg btn-warning">Ir a DMS</button></a>
                {% elseif system == "LMS" %}
                  <a href="#"><button type="button" class="btn btn-lg btn-info">Ir a LMS</button></a>
                {% endif %}
              </div>
                {% else %}
                  <a href="/dashboard/index/show"><button type="button" class="btn btn-lg btn-success">Ver mi dashboard</button>
                {% endif %}
            </div>
          </div>

<!-- /////////////////////////////////////////  Users  /////////////////////////////////////////////////////////-->

          <div class="col-sm-12" id="hidden-users-div">
            <div class="panel panel-success">
              <div class="panel-heading">
                <div class="panel-title">Administración de usuarios</div>
              </div>
              <div class="panel-body">
                {% if users != false %}
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Estado actual</th>
                        <th>Acciones</th>
                      </tr>
                    {% for user in users %}
                      <tr>
                        <td>{{ user.getName() }}</td>
                        <td>{{ user.getEmail() }}</td>
                        <td>Invitado</td>
                        {% if user.isActive() === true %}
                          <td>Activo</td>
                        {% else %}
                          <td>Inactivo</td>
                        {% endif %}
                        <td>
                          <a href="#"><button class="btn btn-success" id="myBtn" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit fa-lg"></i></button></a>
                          <a href="#"><button class="btn btn-warning"><i class="fa fa-eye fa-lg"></i></button></a>
                          <a href="#"><button class="btn btn-danger"><i class="fa fa-close fa-lg"></i></button></a>
                        </td>
                      </tr>
                      {% endfor %}
                    </table>
                  </div>
                {% else %}
                  <p>Aún no se ha enviado ninguna invitación</p>
                {% endif %}
              </div>
            </div>
          </div>



<!-- /////////////////////////////////////////// Systems ///////////////////////////////////////////////////////////////////-->

            <div class="col-sm-12" id="hidden-systems-div">
              <div class="panel panel-success">
                <div class="panel-heading">
                  <div class="panel-title">Agregar sistemas</div>
                  </div>
                <div class="panel-body">
                  <h4>Sistemas contratados</h4>
                  {% if systems != false %}
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <tr>
                        <th>Nombre</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha en que finaliza</th>
                        <th>Acciones</th>
                      </tr>
                      {% for system in systems %}
                      <tr>
                        {% if system.getSystemId() == 1 %}
                          <td>Enterprise Resource Planning</td>
                        {% elseif system.getSystemId() == 2 %}
                          <td>Document Management System</td>
                        {% elseif system.getSystemId() == 3 %}
                          <td>Learning Management System</td>
                        {% endif %}                             
                        <td>{{ system.getCreatedAt() }}</td>
                        <td>Pendiente</td>
                        <td>
                          <a href="#"><button class="btn btn-success"><i class="fa fa-shopping-cart fa-lg"></i> Comprar</button></a>
                          <a href="#"><button class="btn btn-danger"><i class="fa fa-close fa-lg"></i> Quitar</button></a>
                        </td>
                      </tr>
                      {% endfor %}
                    </table>
                  </div>
                  {% endif %} 
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <form class="form-horizontal" method="post" id="" action="{{ url.get() }}dashboard/register/">
                        <div class="form-group">
                          <label for="systems" class="col-sm-12">Seleccione el sistema que desea agregar:</label>
                          <div class="col-sm-9">
                            <select class="form-control" id="" name="system">
                              <option value="1">Enterprise Resource Planning</option>
                              <option value="2">Document Management System</option>
                              <option value="3">Learning Management System</option>
                            </select>
                          </div>
                          <div class="col-sm-3">
                            <button type="submit" class="btn btn-info" id="">Agregar <i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i></button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

<!-- /////////////////////////////////////////// Modals ///////////////////////////////////////////////////////////-->

          <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog">
                                                                       
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar usuario</h4>
                  </div>
                  <div class="modal-body">
                      <form class="form-horizontal" method="post" id="" action="{{ url.get() }}dashboard/register/">
                          <div class="form-group">
                              <label for="name" class="col-sm-2 control-label">Nombre:</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" id="exampleInputName2" placeholder="">
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-2 control-label">Correo:</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" id="exampleInputName2" placeholder="correo@example" readonly />
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-sm-12 control-label" style="text-align:left;">Sistemas que puede utilizar:</label>
                              <div class="col-sm-12">
                                  <div class="col-sm-5">
                                      <select multiple class="form-control" id="sel2">
                                         <option>Enterprise Resource Planning</option>
                                         <option>Document Management System</option>
                                         <option>Learning Management System</option>
                                      </select>
                                  </div>
                                  <div class="col-sm-2">
                                      <button class="btn btn-default"><i class="fa fa-angle-right fa-lg"></i></button>
                                      <button class="btn btn-default"><i class="fa fa-angle-left fa-lg"></i></button>
                                      <button class="btn btn-default"><i class="fa fa-angle-double-right fa-lg"></i></button>
                                      <button class="btn btn-default"><i class="fa fa-angle-double-left fa-lg"></i></button>
                                  </div>
                                  <div class="col-sm-5">
                                      <select multiple class="form-control" id="sel2">
                                         <option></option>
                                         <option></option>
                                         <option></option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Guardar</button>
                  </div>
                </div>
                
              </div>
            </div>
    </div>
  </div>
</div>