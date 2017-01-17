<nav class="navbar navbar-default navbar-custom">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">Multisistemas</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
      {% if session.has('manual') or session.has('opauth') %}
      {% set auth = session.get('manual') %}
        <li class="active"><a href="">{{ auth.name }}</a></li>
        <li><a href="/dashboard/login/logout">Cerrar sesión</a></li>
      {% else %}
        <li><a href="/dashboard/index/login">Iniciar sesión / Registrarse</a></li>
      {% endif %}      
      </ul>
    </div>
  </div>
</nav>

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

