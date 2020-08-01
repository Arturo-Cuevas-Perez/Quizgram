

<?php include_once 'includes/navbar.php'; ?>

<?php
  include('secretInfo/conexion_BD.php');

  $id_modulo = $_GET['idm'];
  $orden_submodulo = $_GET['ids'];

  if (mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM progresocursos WHERE id_usuario = '".$_SESSION['id_usuario']."' AND id_modulo = '".$id_modulo."'")))
  {
    $consulta = mysqli_fetch_array(mysqli_query($mysqli, "SELECT id_submodulo FROM progresocursos WHERE id_usuario = '".$_SESSION['id_usuario']."' AND id_modulo = '".$id_modulo."' ORDER BY id DESC"));
    $orden_submodulo_historico = mysqli_fetch_array(mysqli_query($mysqli, "SELECT orden FROM submodulos WHERE id = '".($consulta['id_submodulo'] - 1)."'"));
    if ($orden_submodulo > $orden_submodulo_historico['orden'])
    {
      $num_submodulos = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM submodulos WHERE id_modulo = '".$id_modulo."'"));
      if ($num_submodulos > $orden_submodulo)
      {
        $orden_nuevo = $orden_submodulo + 1;
        $id_submodulo_nuevo = mysqli_fetch_array(mysqli_query($mysqli, "SELECT id FROM submodulos WHERE id_modulo = '".$id_modulo."' AND orden = '".$orden_nuevo."'"));
        mysqli_query($mysqli, "INSERT INTO progresocursos SET id_usuario = '".$_SESSION['id_usuario']."', id_modulo = '".$id_modulo."', id_submodulo = '".$id_submodulo_nuevo['id']."'");
      }
      else if ($num_submodulos == $orden_submodulo)
      {
        $id_submodulo_nuevo = mysqli_fetch_array(mysqli_query($mysqli, "SELECT id FROM submodulos WHERE id_modulo = '".$id_modulo."' AND orden = '".$orden_submodulo."'"));
        mysqli_query($mysqli, "INSERT INTO progresocursos SET id_usuario = '".$_SESSION['id_usuario']."', id_modulo = '".$id_modulo."', id_submodulo = '".$id_submodulo_nuevo['id']."'");
      }
    }
  }
  else
  {
    $id_submodulo = mysqli_fetch_array(mysqli_query($mysqli, "SELECT id FROM submodulos WHERE id_modulo = '".$id_modulo."' AND orden = '1'"));
    mysqli_query($mysqli, "INSERT INTO progresocursos SET id_usuario = '".$_SESSION['id_usuario']."', id_modulo = '".$id_modulo."', id_submodulo = '".$id_submodulo['id']."'");
  }

?>


<div id="layoutSidenav">

	<?php include_once 'includes/sidebar.php'; ?>

	<div id="layoutSidenav_content">

			<div class="container-fluid">
        <br>

        <!-- Page Heading -->
        <?php
        $modulo = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM modulos WHERE id='".$id_modulo."'"));
        ?>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800"><?php echo $modulo['titulo']; ?></h1>
        </div>

        <!-- Content Row -->
        <div class="row">
          <!-- Panel de submódulos -->
          <div class="list-group col-xl-3 col-md-12 mb-4">
            <?php
            $query_submodulos = mysqli_query($mysqli, "SELECT * FROM submodulos WHERE id_modulo = '".$id_modulo."' ORDER BY orden ASC");
            while ($submodulo = mysqli_fetch_array($query_submodulos)) {
            ?>
            <a href="curso.php?idm=<?php echo $id_modulo; ?>&ids=<?php echo $submodulo['orden']; ?>" class="list-group-item list-group-item-action"><?php if ($orden_submodulo == $submodulo['orden']): ?>
              <b><?php echo $submodulo['orden'].". ".$submodulo['titulo']; ?></b>
              <?php else: ?>
                <?php echo $submodulo['orden'].". ".$submodulo['titulo']; ?>
            <?php endif; ?></a>
            <?php
            }
            ?>
          </div>

          <!-- Panel de curso -->
          <?php
          $showsubmodulo = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM submodulos WHERE id_modulo = '".$id_modulo."' AND orden = '".$orden_submodulo."'"));
          ?>
          <div class="col-xl-9 col-md-12 card shadow mb-4">
            <div class="card-body">
              <style>
              pre {
                font-size: 87.5%;
                /*color: #e83e8c;*/
                word-break: break-word;
                background-color: #f1f1f1;
                border-radius: 0.5rem;
                border-left: solid 5px danger;
                padding: 0.5em;
                padding-left: 1.5em;
              }
              code {
                display: block;
                font-family: monospace;
                white-space: pre;
                margin: 1em 0px;
              }
              h1 {font-size: 2rem;}
              h2 {font-size: 1.5rem;}
              h3 {font-size: 1rem;}
              h4 {font-size: 0.75rem;}
              h5 {font-size: 0.5rem;}
              h6 {font-size: 0.2rem;}
              
              </style>
              <div class="card-title mt-2">
                <h1 class="card-title font-weight-bold text-warning"><?php echo $showsubmodulo['orden'].". ".$showsubmodulo['titulo']; ?></h1><hr>
              </div>
              <div class="card-text">
                <?php
                echo $showsubmodulo['contenido'];
                ?>

                <!-- Botones -->
                <div class="row mt-2 mb-1">
                  <div class="col-sm">
                    <?php if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM submodulos WHERE id_modulo = '".$id_modulo."' AND orden = '".($orden_submodulo - 1)."'")) != 0): ?>
                      <a class="btn btn-secondary btn-block btn-icon mt-2" href="curso.php?idm=<?php echo $_GET['idm']; ?>&ids=<?php echo ($_GET['ids'] - 1); ?>">
                        <span class="icon text-white">
                          <i data-feather="arrow-left"></i>
                        </span>
                        <span class="text">&nbsp;Anterior</span>
                      </a>
                    <?php endif; ?>
                  </div>
                  <div class="col-sm">
                    <?php if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM submodulos WHERE id_modulo = '".$id_modulo."' AND orden = '".($orden_submodulo + 1)."'")) != 0): ?>
                      <a class="btn btn-success btn-block btn-icon mt-2" href="curso.php?idm=<?php echo $_GET['idm']; ?>&ids=<?php echo $_GET['ids'] + 1; ?>">
                        <span class="text">Siguiente&nbsp;</span>
                        <span class="icon text-white">
                          <i data-feather="arrow-right"></i>
                        </span>
                      </a>
                    <?php else: ?>
                      <a class="btn btn-warning btn-block btn-icon mt-2" href="terminarcurso.php?idm=<?php echo $_GET['idm']; ?>">
                        <span class="text">Terminar curso&nbsp;</span>
                        <span class="icon text-white">
                          <i data-feather="check"></i>
                        </span>
                      </a>
                    <?php endif; ?>
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

<script src="javascript/scripts.js"></script>
<script src="javascript/bootstrap.min.js"></script>
<script src="javascript/summernote-es-ES.js"></script>

<script>
  // Summernote
  $(document).ready(function() {
  $('#summernote').summernote({
    placeholder: 'Comparte el contenido del curso...',
    lang: 'es-ES'
  });
});
</script>
</body>

</html>
