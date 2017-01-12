<br/>
<div class="container">
	<div class="row">
        <div class="col-md-12">
            <div class="mseilogo">
                <a href="/">
                    <img src="/static/images/mseilogo.png" alt="Multisistemas Logo">
                </a>
            </div>

            {% if thesession == true %}
            <div class="jumbotron">
                <h1>Bienvenido a Multisistemas</h1>
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

