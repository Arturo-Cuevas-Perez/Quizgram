
<?php

  include('secretInfo/conexion_BD.php');

  $id = $_GET['id'];

  $respuesta = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM respuestas WHERE id = '".$id."'"));
  $autor_respuesta = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM usuarios WHERE id = '".$respuesta['id_alumno']."'"));
  $tarea = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM tareas WHERE id = '".$respuesta['id_tarea']."'"));

?>

<?php include_once 'includes/navbar.php'; ?>


<div id="layoutSidenav">

	<?php include_once 'includes/sidebar.php'; ?>

	<div id="layoutSidenav_content">

			<div class="container-fluid">
				<h2 class="mt-4">Gestiona tus clases</h2>
				<ol class="breadcrumb mb-4">
					<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
					<li class="breadcrumb-item active">Respuestas</li>
				</ol>
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <h5 class="mt-2">Enunciado de la tarea:</h5>
            <div class="card card-body shadow mt-2">
              <p><?php echo $tarea['descripcion']; ?></p>
              <?php if ($tarea['archivo'] != NULL): ?>
              <span>Archivo enviado: <a href="server/download.php?filename=<?php echo $tarea['archivo'];?>"><?php echo $tarea['archivo']; ?></a> <br> </span>
              <?php else: ?>
            <?php endif; ?>
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <h5 class="mt-2">Respuesta de <?php echo $autor_respuesta['user']." ".$autor_respuesta['last_name']; ?> a la tarea:</h5>
            <div class="card card-body shadow mt-2">
              <p><?php echo $respuesta['respuesta']; ?></p>
              <?php if ($respuesta['archivo_respuesta'] != NULL): ?>
              <span>Archivo recibido: <a href="server/download.php?filename=<?php echo $respuesta['archivo_respuesta'];?>"><?php echo $respuesta['archivo_respuesta']; ?></a> <br> </span>
              <?php else: ?>
            <?php endif; ?>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 offset-sm-6 offset-md-8 mt-4">
            <form action="server/evaluar.php" method="post">
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="100" aria-label="Puntuación" aria-describedby="" required name="puntuacion" value="<?php echo $respuesta['puntuacion']; ?>">
                <div class="input-group-append">
                  <span class="input-group-text bg-light">/100</span>
                  <input type="hidden" name="id_respuesta" value="<?php echo $id; ?>">
                  <button class="btn btn-primary" type="submit" id="button-addon2">Evaluar</button>
                </div>
              </div>
            </form>
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
