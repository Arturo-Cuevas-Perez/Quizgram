

<div id="layoutSidenav_nav">
  <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
      <?php if ($row['id_tipo'] == "1"): ?>
      <div class="nav">
        <div class="sb-sidenav-menu-heading">Menu del Maestro</div>
        <a class="nav-link" href="index.php">
          <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>Inicio
        </a>

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
          <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>Mis Datos<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="perfil.php">Mi Perfil</a>
          </nav>
        </div>

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
          <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>Cursos<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="cursos.php">Mis Cursos</a>
          </nav>
        </div>

        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGrupos" aria-expanded="false" aria-controls="collapseGrupos">
          <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>Clases<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseGrupos" aria-labelledby="headingThree" data-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="clases.php">Mis Clases</a>
          </nav>
        </div>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHistorico" aria-expanded="false" aria-controls="collapseHistorico">
          <div class="sb-nav-link-icon"><i class="fas fa-tasks"></i></div>Historico<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseHistorico" aria-labelledby="headingFour" data-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="registrar_asistencias.php">Registrar Asistencias</a>
            <a class="nav-link" href="mostrar_asistencias.php">Mostrar Asistencias</a>
            <a class="nav-link" href="#">Registrar Calificaciones</a>
            <a class="nav-link" href="#">Mostrar Calificaciones</a>
          </nav>
        </div>

        <a class="nav-link" href="#">
          <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
          Mensajes
        </a>
        <a class="nav-link" href="#">
          <div class="sb-nav-link-icon"><i class="fas fa-folder"></i></div>
          Biblioteca
        </a>
        <a class="nav-link" href="ayuda.php">
          <div class="sb-nav-link-icon"><i class="fas fa-question-circle"></i></div>
          Ayuda
        </a>
      </div>
      <?php else: ?>
        <div class="nav">
          <div class="sb-sidenav-menu-heading">Menu del Estudiante</div>
          <a class="nav-link" href="index.php">
            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>Inicio
          </a>

          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>Mis Datos<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link" href="perfil.php">Mi Perfil</a>
              <a class="nav-link" href="#">Mis Calificaciones</a>
              <a class="nav-link" href="mostrar_asistencias.php">Mis Asistencias</a>
            </nav>
          </div>

          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
            <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>Cursos<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link" href="cursos.php">Mis Cursos</a>
            </nav>
          </div>

          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGrupos" aria-expanded="false" aria-controls="collapseGrupos">
            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>Clases<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
          </a>
          <div class="collapse" id="collapseGrupos" aria-labelledby="headingThree" data-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
              <a class="nav-link" href="clases.php">Mis Clases</a>
            </nav>
          </div>

          <a class="nav-link" href="#">
            <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
            Mensajes
          </a>
          <a class="nav-link" href="#">
            <div class="sb-nav-link-icon"><i class="fas fa-folder"></i></div>
            Biblioteca
          </a>
          <a class="nav-link" href="ayuda.php">
            <div class="sb-nav-link-icon"><i class="fas fa-question-circle"></i></div>
            Ayuda
          </a>
        </div>
        <?php endif; ?>

    </div>
    <div class="sb-sidenav-footer">
      <div class="small">Bienvenido: <?php echo ($row['user']); ?> <?php echo ($row['last_name']); ?></div>
    </div>
  </nav>
</div>
