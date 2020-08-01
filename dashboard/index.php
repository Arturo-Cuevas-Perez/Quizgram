
<?php include_once 'includes/navbar.php'; ?>


  <div id="layoutSidenav">

		<?php include_once 'includes/sidebar.php'; ?>

    <div id="layoutSidenav_content">
      
      <?php if (isset($_GET['errorTitulo'])): ?>
      <div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
        <strong>¡Vaya!</strong> Hubo un error al crear tu curso, ya tienes uno con el mismo titulo.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php endif; ?>

        <div class="container-fluid">
          <h1 class="mt-4">Inicio</h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Inicio</li>
          </ol>

          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cursos incompletos</h1>
          </div>

          <div class="row">

  					<?php if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM progresocursos WHERE id_usuario = '".$row['id']."'")) != 0):
  						$consulta = mysqli_query($mysqli, "SELECT DISTINCT id_modulo FROM progresocursos WHERE id_usuario = '".$row['id']."' ORDER BY id DESC");
  						while ($curs_hist = mysqli_fetch_array($consulta)) {
  							$curso = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM modulos WHERE id = '".$curs_hist['id_modulo']."'"));
  							$historico_id_submodulo = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM progresocursos WHERE id_modulo = '".$curso['id']."' ORDER BY id DESC LIMIT 1"));
  							$id_submodulo_orden = mysqli_fetch_array(mysqli_query($mysqli, "SELECT orden FROM submodulos WHERE id = '".$historico_id_submodulo['id_submodulo']."'"));
  							$num_submodulos = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM submodulos WHERE id_modulo = '".$curso['id']."'"));

  							$cursos_pendientes = 0;
  							$porcentaje_progreso = ($id_submodulo_orden['orden'] * 100) / $num_submodulos;
  							if ($porcentaje_progreso != 100) {
  								$cursos_pendientes = 1;
  								?>


            <div class="col-xl-4 col-md-6 mb-4 course-card" onclick="window.location='curso.php?idm=<?php echo $curso['id']; ?>&ids=<?php echo $id_submodulo_orden['orden'] + 1; ?>';">
              <div class="card border-left-primary h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo $curso['tema']; ?></div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $curso['titulo']; ?></div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col text-center">
                      <div class="progress progress-sm mr-2 mt-3">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $porcentaje_progreso; ?>%" aria-valuenow="<?php echo $porcentaje_progreso; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <small class="text-primary"><?php echo intval($porcentaje_progreso); ?> % completado</small>
                    </div>
                    <?php if ($porcentaje_progreso == 100): ?>
                    <div class="col-auto">
                      <i class="fas fa-check-double fa-2x text-success"></i>
                    </div>
                    <?php else: ?>
                    <div class="col-auto">
                      <i class="fas fa-check-double fa-2x text-gray-300"></i>
                    </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>

            <?php
            }
          }
          if ($cursos_pendientes == 0) {
          ?>
            <h5 class="col-sm-12">Parece que ya has terminado todos los cursos que tenías pendiente, que no te limite aun puedes seguir aprendiendo con nosotros. <i data-feather="smile"></i></h5>
          <?php
          }
          ?>

        <?php else: ?>
          <!-- Page Heading -->
          <h1 class="col h5 mb-4 text-gray-800">¿Qué esperas para aprender? Busca un curso en la barra superior.</h1>

        <?php endif; ?>

        </div>

        <div class="mt-4 mb-4">
            <h3 class="text-gray-800">Mis clases</h3>
          </div>

          <div class="row">
            <?php
            $clases = mysqli_query($mysqli, "SELECT * FROM clases WHERE id_alumnos LIKE '%".$row['id']."%'");
            if (mysqli_num_rows($clases) != 0) {
              while ($clase = mysqli_fetch_array($clases)) {
                ?>
                <div class="col-xl-4 col-md-6 mb-4 course-card" onclick="window.location='clase.php?id=<?php echo $clase['id']; ?>';">
                  <div class="card h-100 bg-gray-300">
                    <img src="https://source.unsplash.com/500x400/?study&sig=<?php echo rand(1,999); ?>" class="card-img" style="filter: brightness(0.65); border-radius: 12px;">
                    <div class="card-img-overlay">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="font-weight-bold text-white mb-1"> <span>Asignatura: <?php echo $clase['asignatura']; ?></span> </div>
                          <div class="font-weight-bold text-white mb-1"> <span>Clase: <?php echo $clase['nombreClase']; ?></span> </div>
                          <p class="text-white font-weight-bold"> <span>Curso: <?php echo $clase['curso']; ?></span> </p>
                          <p class="text-white font-weight-bold"> <span>Grupo: <?php echo $clase['grupo']; ?></span> </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <?php
              }

            } else {
              ?>
              <p class="col-sm-12 h5">Vaya ¿No te has inscrito a una clase? Deberias hacerlo y sacar provecho de Quizgram.</p>
              <?php
            }
            ?>
  				</div>
        </div>
        <?php include_once 'includes/footer.php'; ?>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript" src="javascript/scripts.js"></script>
	<script type="text/javascript" src="javascript/bootstrap.min.js"></script>
</body>

</html>
