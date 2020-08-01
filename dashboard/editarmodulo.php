

<?php include_once 'includes/navbar.php'; ?>

<?php

  include('secretInfo/conexion_BD.php');
  if ($row['id_tipo'] != "1") {
    header('Location: index.php');
  }

  if (isset($_POST['id_modulo'])) {
    $id_modulo_input = $_POST['id_modulo'];
  } else {
    $id_modulo_input = $_GET['id'];
  }

  $sql = mysqli_query($mysqli, "SELECT * FROM modulos WHERE id = '".$id_modulo_input."'");
  $micurso = mysqli_fetch_array($sql);

?>

<div id="layoutSidenav">

	<?php include_once 'includes/sidebar.php'; ?>

	<div id="layoutSidenav_content">

			<div class="container-fluid">
        <?php if (isset($_GET['editado'])): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>¡Genial!</strong> Los cambios se han guardado perfectamente.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>

				<h2 class="mt-4">Crea tus modulos</h2>
				<ol class="breadcrumb mb-4">
					<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
					<li class="breadcrumb-item active">Modulos</li>
				</ol>

				<!-- Page Heading -->
				<div class="d-sm-flex align-items-center justify-content-between mb-4">
					<h1 class="h3 mb-0 text-gray-800"><span class="badge badge-warning">Editando</span> <?php echo $micurso['titulo']; ?></h1>
				</div>
				<div class="d-sm-flex align-items-center justify-content-between mb-4">
					<h5 class="h5 mb-0 text-gray-800">Módulos del curso</h5>
				</div>
        <p class="mb-4">Si quieres editar uno de los módulos, pulsa sobre él.</p>

        <!-- Content Row -->
        <div class="row">
          <!-- Panel de submódulos -->
          <ul class="list-group col-xl-3 col-md-12 mb-4">
            <?php
            $query = mysqli_query($mysqli, "SELECT * FROM submodulos WHERE id_modulo = '".$micurso['id']."' ORDER BY orden ASC");
            if (mysqli_num_rows($query) != 0) {
              if (mysqli_num_rows($query) == 1) {
                $submodulo = mysqli_fetch_array($query);
              ?>
              <li class="list-group-item d-flex justify-content-between align-items-center" style="padding: 0em;">
                <a href="editarsubmodulo.php?idm=<?php echo $micurso['id']; ?>&ids=<?php echo $submodulo['id']; ?>" class="list-group-item-action" style="padding: .75rem 1.25rem; border-top-right-radius: .35rem; border-bottom-right-radius: .35rem;"><?php echo $submodulo['orden'].". ".$submodulo['titulo']; ?></a>
                <?php if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM submodulos WHERE id_modulo = '".$submodulo['id_modulo']."' AND orden = '".($submodulo['orden'] - 1)."'")) != 0): ?>
                  <a href="server/ordenarriba.php?idm=<?php echo $submodulo['id_modulo']; ?>&ids=<?php echo $submodulo['id']; ?>&ref=editarmodulo" class="text-secondary" style="margin-right: .2rem; margin-left: .2rem;"><i class="far fa-arrow-alt-circle-up"></i></a>
                <?php endif; ?>
                <?php if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM submodulos WHERE id_modulo = '".$submodulo['id_modulo']."' AND orden = '".($submodulo['orden'] + 1)."'")) != 0): ?>
                  <a href="server/ordenabajo.php?idm=<?php echo $submodulo['id_modulo']; ?>&ids=<?php echo $submodulo['id']; ?>&ref=editarmodulo" class="text-secondary" style="margin-right: .2rem; margin-left: .2rem;"><i class="far fa-arrow-alt-circle-down"></i></a>
                <?php endif; ?>
              </li>
              <?php
              } else {
                while ($submodulo = mysqli_fetch_array($query)) {
                ?>
                <li class="list-group-item d-flex justify-content-between align-items-center" style="padding: 0em;">
                  <a href="editarsubmodulo.php?idm=<?php echo $micurso['id']; ?>&ids=<?php echo $submodulo['id']; ?>" class="list-group-item-action" style="padding: .75rem 1.25rem; border-top-right-radius: .35rem; border-bottom-right-radius: .35rem;"><?php echo $submodulo['orden'].". ".$submodulo['titulo']; ?></a>
                  <?php if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM submodulos WHERE id_modulo = '".$submodulo['id_modulo']."' AND orden = '".($submodulo['orden'] - 1)."'")) != 0): ?>
                    <a href="server/ordenarriba.php?idm=<?php echo $submodulo['id_modulo']; ?>&ids=<?php echo $submodulo['id']; ?>&ref=editarmodulo" class="text-secondary" style="margin-right: .2rem; margin-left: .2rem;"><i class="far fa-arrow-alt-circle-up"></i></a>
                  <?php endif; ?>
                  <?php if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM submodulos WHERE id_modulo = '".$submodulo['id_modulo']."' AND orden = '".($submodulo['orden'] + 1)."'")) != 0): ?>
                    <a href="server/ordenabajo.php?idm=<?php echo $submodulo['id_modulo']; ?>&ids=<?php echo $submodulo['id']; ?>&ref=editarmodulo" class="text-secondary" style="margin-right: .2rem; margin-left: .2rem;"><i class="far fa-arrow-alt-circle-down"></i></a>
                  <?php endif; ?>
                </li>
                <?php
                }
              }
            } else {
            ?>
            <p class="ml-3">Todavía no has creado ningún módulo en este curso. ¿A qué esperas para hacerlo?</p>
            <?php
            }
            ?>
            <br><a href="crearsubmodulo.php?id=<?php echo $micurso['id']; ?>" class="btn btn-primary">CREAR UN MÓDULO</a>
          </ul>
          <div class="card shadow h-100 py-2 col-xl-9 col-md-12">
            <div class="card-body">
              <form class="" action="server/editarmodulo.php" method="post">
                <input type="hidden" name="id_curso" value="<?php echo $micurso['id']; ?>">
                <div class="form-group">
                  <label for="titulo">Título del Curso</label>
                  <input type="text" class="form-control" name="titulo" id="titulo" value="<?php echo $micurso['titulo']; ?>">
                </div>
                <div class="form-group">
                  <label for="tema">Tema</label>
                  <input type="text" name="tema" class="form-control" id="tema" value="<?php echo $micurso['tema']; ?>">
                </div>
                <div class="form-group">
                  <label for="descripcion">Descripción</label>
                  <textarea class="form-control" id="summernote" name="descripcion" rows="3"><?php echo $micurso['descripcion']; ?></textarea>
                </div>
                <div class="form-group row">
                  <button type="submit" class="btn btn-primary col-xs-5 ml-3 mr-4">Editar Curso</button>
                  <div class="custom-control custom-switch col-xs-5 ml-4 mt-2" style="transform: scale(1.25);">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1" name="publicado" <?php if ($micurso['publicado'] == 1): ?>checked<?php endif; ?>>
                    <label class="custom-control-label" for="customSwitch1">Publicar curso</label>
                  </div>
                </div>
              </form>
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
