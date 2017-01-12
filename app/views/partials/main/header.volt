<nav class="navbar navbar-default navbar-custom">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">Multisistemas</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
      {% set tsession = session.has('opauth') %}
      {% if tsession == true %}
        <li><a href="/auth/login/logout">Cerrar sesión</a></li>
      {% else %}
        <li><a href="/auth/index/login">Iniciar sesión / Registrarse</a></li>
      {% endif %}      
      </ul>
    </div>
  </div>
</nav>
{% if tsession == true %}
  <p>Sesion iniciada</p>
{% else %}
  <p>No hay sesiones iniciadas</p>
{% endif %} 

{% set languages = helper.languages() %}
{% if languages|length > 1 %}
    <div class="languages">
        {% for language in languages %}
            <div class="lang">
                {{ helper.langSwitcher(language['iso'], language['name']) }}
            </div>
        {% endfor %}
    </div>
{% endif %}

