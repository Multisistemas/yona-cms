<br/>
<div class="container">
	<div class="row">
        <div class="col-md-12">
            <div class="mseilogo">
                <a href="/">
                    <img src="/static/images/mseilogo.png" alt="Multisistemas Logo">
                </a>
            </div>

            {% if auth != null %}
                <div class="jumbotron">
                    <h1>Bienvenido</h1>
                    <h2>{{ auth.name }}</h2>
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

