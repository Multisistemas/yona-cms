<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="panel-title">Información de la cuenta</div>
          </div>
        <div class="panel-body">
          <p>Nombre:</p>
          <p>Empresa:</p>
          <p>Correo:</p>
          <p>Rol:</p>
        </div>
      </div>
    </div>
    <div class="col-sm-8">
      <div class="panel panel-success">
        <div class="panel-heading">
          {% if session.has('manual') %}
          {% set auth = session.get('manual') %}
            <div class="panel-title">{{ auth.name }}</div>
            {% elseif session.has('opauth') %}
            {% set opauth = session.get('opauth') %}
            <div class="panel-title">{{ opauth['auth']['raw']['name'] }}</div>
            {% endif %}
        </div>
          <div class="panel-body" >                        
            {% if system != null %}
            <p>Sistemas:</p>
              {% if system == "ERP" %}
              <a href="#"><button type="button" class="btn btn-lg btn-primary">Ir a ERP</button></a>
              {% elseif system == "DMS" %}
              <a href="#"><button type="button" class="btn btn-lg btn-warning">Ir a DMS</button></a>
              {% elseif system == "LMS" %}
              <a href="#"><button type="button" class="btn btn-lg btn-info">Ir a LMS</button></a>
              {% endif %}
            {% else %}
              <p>No hay sistemas disponibles</p>
            {% endif %}
          </div>
        </div>
      </div>
  </div>
</div>
