<br/>
<div class="container">
	<div class="row">
        <div class="col-md-12">
            <div class="mseilogo">
                <a href="/">
                    <img src="/static/images/mseilogo.png" alt="Multisistemas Logo">
                </a>
            </div>

            {% if session.has('opauth') %}
                {% set opauth = session.get('opauth') %}
                    <div class="jumbotron">
                        <h1>Bienvenido</h1>
                        <h2>{{ opauth['auth']['raw']['name'] }}</h2>
                        <p>Comienza a utilizar tus sistemas</p>
                        <a href="/dashboard/index/show"><button type="button" class="btn btn-success">Ver sistemas</button></a>
                    </div>
            {% elseif session.has('manual') %}
                {% set manual = session.get('manual') %}
                    <div class="jumbotron">
                        <h1>Bienvenido</h1>
                        <h2>{{ manual.name }}</h2>
                        <p>Comienza a utilizar tus sistemas</p>
                        <a href="/dashboard/index/show"><button type="button" class="btn btn-success">Ver sistemas</button></a>
                    </div>
            {% else %}
            <div class="jumbotron">
                <h1>Bienvenido a Multisistemas</h1>
                <p>Antes que nada debe identificarse</p>
                <a href="/dashboard/index/login"><button type="button" class="btn btn-lg btn-primary">Iniciar sesión / Registrarse</button></a>
            </div>
            {% endif %}
        </div>
    </div>
</div>

