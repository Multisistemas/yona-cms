<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Multisistemas</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
          <li><a href="/auth/index/login">Iniciar sesión / Registrarse</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
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
