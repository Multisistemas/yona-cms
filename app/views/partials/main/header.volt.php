<nav class="navbar navbar-default navbar-custom">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-multisis">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/"><img src="/static/images/logo.ico" alt="Logo" /><span class="inline">Multisistemas</span></a>
    </div>
    <div class="navbar-collapse collapse" id="navbar-multisis">
      <ul class="nav navbar-nav navbar-right">
      <?php $languages = $this->helper->languages(); ?>
      <?php $en = '<img src="/static/images/flags/en.png">'; ?>
      <?php $es = '<img src="/static/images/flags/es.png">'; ?>


      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
          Idioma
          <span class="caret"></span>
        </a>
          <ul class="dropdown-menu">
          <?php if ($this->length($languages) > 1) { ?>
            <?php foreach ($languages as $language) { ?>
                <li><?= $this->helper->langSwitcher($language['iso'], $language['name']) ?></li>
            <?php } ?>
          <?php } ?>
          </ul>
      </li>
   
      <?php if ($this->session->has('manual') || $this->session->has('opauth')) { ?>
        <?php if ($this->session->has('manual')) { ?>
          <?php $auth = $this->session->get('manual'); ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle profile-image" data-toggle="dropdown" role="button" aria-expanded="false">
              <img src="/static/images/user-default.png" class="img-circle special-img"><?= $auth->name ?><span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="/dashboard/login/logout">Cerrar sesión</a></li>
            </ul>
          </li>
        <?php } elseif ($this->session->has('opauth')) { ?>
          <?php $opauth = $this->session->get('opauth'); ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle profile-image" data-toggle="dropdown" role="button" aria-expanded="false">
              <img src="<?= $opauth['auth']['raw']['picture'] ?>" class="img-circle special-img"><?= $opauth['auth']['raw']['name'] ?><span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="/dashboard/login/logout">Cerrar sesión</a></li>
            </ul>
          </li>
        <?php } ?>
      <?php } else { ?>
        <li class="active"><a href="/dashboard/index/login">Iniciar sesión / Registrarse</a></li>
      <?php } ?>      
      </ul>
    </div>
  </div>
</nav>


