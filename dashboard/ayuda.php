
<?php include_once 'includes/navbar.php'; ?>


<div id="layoutSidenav">

	<?php include_once 'includes/sidebar.php'; ?>

  <style>
  a.faq
  {
    color: #000000;
  }
  .ayuda-accord .nav-link:after {
  font-family: 'FontAwesome';
  content: "\f068";
  float: right;
}
.ayuda-accord .nav-link.collapsed:after {
  /* symbol for "collapsed" panels */
  content: "\f067";
}
</style>


	<div id="layoutSidenav_content">

			<div class="container-fluid">

				<h2 class="mt-4">Acerca de Quizgram</h2>
				<ol class="breadcrumb mb-4">
					<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
					<li class="breadcrumb-item active">Ayuda</li>
				</ol>
          <h5 class="col-lg-8 order-lg-2 mx-auto">Preguntas frecuentes</h5>
          <br>
				<div class="row">

          <div class="card col-lg-8 order-lg-2 mx-auto">
            <div id="accordion" class="ayuda-accord">
							<div class="card">
                <div class="card-header">
                  <a class="nav-link collapsed faq" data-toggle="collapse" href="#collapseZero">
                    ¿Como puedo reportar un error o bug de la aplicacion?
                  </a>
                </div>
                <div id="collapseZero" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                    <span>La retroalimentacion siempre es bienvenida nos ayudaras a mejorar, con este email puedes contactarnos: <a href="mailto:project.quizgram@gmail.com">project.quizgram@gmail.com</a></span>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header">
                  <a class="nav-link collapsed faq" data-toggle="collapse" href="#collapseOne">
                    ¿Como creo una clase?
                  </a>
                </div>
                <div id="collapseOne" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                    <span>Puedes crear una clase dando clic en el icono de maletin en la parte superior de la pagina. Se abrira un menu con la opcion deseada.</span>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header">
                  <a class="nav-link collapsed faq" data-toggle="collapse" href="#collapseTwo">
                    ¿Como creo un curso?
                  </a>
                </div>
                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                  <span>Al igual que las clases tendras que dar clic en el icono de maletin en la parte superior de la pagina. Se abrira un menu con la opcion deseada.</span>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header">
                  <a class="nav-link collapsed faq" data-toggle="collapse" href="#collapseThree">
                    ¿Como pueden unirse a mi clase?
                  </a>
                </div>
                <div id="collapseThree" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                  <span>Al crear una clase obtendras un codigo unico el cual podras copiar y compartirlo con tus alumnos.</span>
                  </div>
                </div>
              </div>

							<div class="card">
                <div class="card-header">
                  <a class="nav-link collapsed faq" data-toggle="collapse" href="#collapseFour">
                    ¿Cuantas personas se pueden unir a mi clases?
                  </a>
                </div>
                <div id="collapseFour" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                  <span>No hay limite usuarios inscritos.</span>
                  </div>
                </div>
              </div>

							<div class="card">
                <div class="card-header">
                  <a class="nav-link collapsed faq" data-toggle="collapse" href="#collapseFive">
                    ¿Pueden unirse otros maestros a mi clase?
                  </a>
                </div>
                <div id="collapseFive" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                  <span>Actualmente no, debido que fue pensado a que el docente de la materia sea el unico que pueda impartir el contenido y
										sea una experiencia mas personalizada.</span>
                  </div>
                </div>
              </div>

							<div class="card">
                <div class="card-header">
                  <a class="nav-link collapsed faq" data-toggle="collapse" href="#collapseSix">
                    ¿Puedo dar de baja mi cuenta?
                  </a>
                </div>
                <div id="collapseSix" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                  <span>En la parte superior se encuentra el icono de usuario con el submenu de configuracion donde podras dar de baja tu cuenta.
										Lamentamos que decidas irte, ¿antes podrias decirnos cual fue el motivo?.</span>
                  </div>
                </div>
              </div>

            </div>
          </div>

				</div>
			</div>

		<?php include_once 'includes/footer.php'; ?>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="javascript/scripts.js"></script>
<script src="javascript/bootstrap.min.js"></script>
</body>

</html>
