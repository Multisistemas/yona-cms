<nav class="navbar navbar-default navbar-custom">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">Multisistemas</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
      {% if session.has('manual') or session.has('opauth') %}
        {% if session.has('manual') %}
          {% set auth = session.get('manual') %}
          <li><a class="dropdown-toggle profile-image"><img src="/static/images/user-default.png" class="img-circle special-img">{{ auth.name }}</a></li>
          <li><a href="/dashboard/login/logout"><i class="fa fa-sign-out"></i> Cerrar sesión</a></li>
        {% elseif session.has('opauth') %}
          {% set opauth = session.get('opauth') %}
          <li><a class="dropdown-toggle profile-image"><img src="{{ opauth['auth']['raw']['picture'] }}" class="img-circle special-img">{{ opauth['auth']['raw']['name'] }}</a></li>
          <li><a href="/dashboard/login/logout"><i class="fa fa-sign-out"></i> Cerrar sesión</a></li>
        {% endif %}
      {% else %}
        <li class="active"><a href="/dashboard/index/login">Iniciar sesión / Registrarse</a></li>
      {% endif %}      
      </ul>
    </div>
  </div>
</nav>

{% set languages = helper.languages() %}
{% if languages|length > 1 %}
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="languages">
        {% for language in languages %}
            <div class="lang">
                {{ helper.langSwitcher(language['iso'], language['name']) }}
            </div>
        {% endfor %}
    </div>
      </div>
    </div>
  </div>
{% endif %}

