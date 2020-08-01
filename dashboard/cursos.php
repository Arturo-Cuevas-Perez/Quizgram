

<?php include_once 'includes/navbar.php'; ?>

<?php

	include('secretInfo/conexion_BD.php');

?>


<div id="layoutSidenav">

	<?php include_once 'includes/sidebar.php'; ?>

	<div id="layoutSidenav_content">

			<div class="container-fluid">

        <h2 class="mt-4">Gestiona tus cursos</h2>
				<ol class="breadcrumb mb-4">
					<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
					<li class="breadcrumb-item active">Mis cursos</li>
				</ol>

				<div class="mt-4 mb-4">
					<h3 class="text-gray-800">Cursos incompletos</h3>
				</div>

        <!-- Content Row -->
        <div class="row">

					<?php if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM progresocursos WHERE id_usuario = '".$row['id']."'")) != 0):
						$consulta = mysqli_query($mysqli, "SELECT DISTINCT id_modulo FROM progresocursos WHERE id_usuario = '".$row['id']."' ORDER BY id DESC");
						while ($curs_hist = mysqli_fetch_array($consulta))
						{
							$curso = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM modulos WHERE id = '".$curs_hist['id_modulo']."'"));
							$historico_id_submodulo = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM progresocursos WHERE id_modulo = '".$curso['id']."' ORDER BY id DESC LIMIT 1"));
							$id_submodulo_orden = mysqli_fetch_array(mysqli_query($mysqli, "SELECT orden FROM submodulos WHERE id = '".$historico_id_submodulo['id_submodulo']."'"));
							$num_submodulos = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM submodulos WHERE id_modulo = '".$curso['id']."'"));

							$cursos_pendientes = 0;

							$porcentaje_progreso = ($id_submodulo_orden['orden'] * 100) / $num_submodulos;
							if ($porcentaje_progreso != 100)
							{
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
        if ($cursos_pendientes == 0)
				{
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
        <h3 class="text-gray-800">Todos tus cursos</h3>
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
							?>

        <div class="col-xl-4 col-md-6 mb-4 course-card" onclick="window.location='curso.php?idm=<?php echo $curso['id']; ?>&ids=<?php echo $id_submodulo_orden['orden'] ?>';">
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
                  <i class="fas fa-check-double text-success"></i>
                </div>
                <?php else: ?>
                <div class="col-auto">
                  <i class="fas fa-check-double text-gray"></i>
                </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>

        <?php
        }


    else: ?>
      <!-- Page Heading -->
      <h1 class="col h5 mb-4 text-gray-800">¿Qué esperas para aprender? Busca un curso en la barra superior.</h1>

    <?php endif; ?>

    </div>

			</div>

		<?php include_once 'includes/footer.php'; ?>
	</div>
</div>

<script src="javascript/scripts.js"></script>
<script src="javascript/bootstrap.min.js"></script>

</body>

</html>
