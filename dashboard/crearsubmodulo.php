

<?php include_once 'includes/navbar.php'; ?>

<?php

	include('secretInfo/conexion_BD.php');

  if ($row['id_tipo'] != "1") {
    header('Location: index.php');
  }
	$misubmodulo = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM submodulos WHERE id = '".$_GET['id']."'"));
  $sql = mysqli_query($mysqli, "SELECT * FROM modulos WHERE id = '".$_GET['id']."'");
  if ($result = mysqli_fetch_array($sql)) {
    $id_curso = $result['id'];
    $titulo_curso = $result['titulo'];
  }

?>


<div id="layoutSidenav">

	<?php include_once 'includes/sidebar.php'; ?>

	<div id="layoutSidenav_content">

			<div class="container-fluid">
				<?php if (isset($_GET['cambios_ok'])): ?>
				<div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
					<strong>¡Genial!</strong> Hemos guardado los cambios sin ningún problema. Ya puedes seguir disfrutando de QuizGram.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php endif; ?>

				<?php if (isset($_GET['error'])): ?>
				<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
					<strong>¡Vaya!</strong> No te podemos inscribir porque ya estás inscrito.
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
					<h1 class="h3 mb-0 text-gray-800"><?php echo $titulo_curso; ?></h1>
				</div>
				<div class="d-sm-flex align-items-center justify-content-between mb-4">
					<h5 class="h5 mb-0 text-gray-800">Módulos ya creados</h5>
				</div>

				<!-- Content Row -->
				<div class="row">
					<!-- Panel de submódulos -->
					<ul class="list-group col-xl-3 col-md-12 mb-4">
						<?php
						$query = mysqli_query($mysqli, "SELECT * FROM submodulos WHERE id_modulo = '".$id_curso."' ORDER BY orden ASC");
						if (mysqli_num_rows($query) != 0) {
							if (mysqli_num_rows($query) == 1) {
								$submodulo = mysqli_fetch_array($query);
							?>
							<li class="list-group-item d-flex justify-content-between align-items-center" style="padding: 0em;">
                <a href="editarsubmodulo.php?idm=<?php echo $submodulo['id_modulo']; ?>&ids=<?php echo $submodulo['id']; ?>" class="list-group-item-action" style="padding: .75rem 1.25rem; border-top-right-radius: .35rem; border-bottom-right-radius: .35rem;"><?php echo $submodulo['orden'].". ".$submodulo['titulo']; ?></a>
                <?php if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM submodulos WHERE id_modulo = '".$submodulo['id_modulo']."' AND orden = '".($submodulo['orden'] - 1)."'")) != 0): ?>
                  <a href="server/ordenarriba.php?idm=<?php echo $submodulo['id_modulo']; ?>&ids=<?php echo $submodulo['id']; ?>&ref=editar&isub=<?php echo $misubmodulo['id']; ?>" class="text-secondary" style="margin-right: .2rem; margin-left: .2rem;"><i class="far fa-arrow-alt-circle-up"></i></a>
                <?php endif; ?>
                <?php if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM submodulos WHERE id_modulo = '".$submodulo['id_modulo']."' AND orden = '".($submodulo['orden'] + 1)."'")) != 0): ?>
                  <a href="server/ordenabajo.php?idm=<?php echo $submodulo['id_modulo']; ?>&ids=<?php echo $submodulo['id']; ?>&ref=editar&isub=<?php echo $misubmodulo['id']; ?>" class="text-secondary" style="margin-right: .2rem; margin-left: .2rem;"><i class="far fa-arrow-alt-circle-down"></i></a>
                <?php endif; ?>
              </li>
							<?php
							} else {
								while ($submodulo = mysqli_fetch_array($query)) {
								?>
								<li class="list-group-item d-flex justify-content-between align-items-center" style="padding: 0em;">
                  <a href="editarsubmodulo.php?idm=<?php echo $id_curso; ?>&ids=<?php echo $submodulo['id']; ?>" class="list-group-item-action" style="padding: .75rem 1.25rem; border-top-right-radius: .35rem; border-bottom-right-radius: .35rem;"><?php echo $submodulo['orden'].". ".$submodulo['titulo']; ?></a>
                  <?php if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM submodulos WHERE id_modulo = '".$submodulo['id_modulo']."' AND orden = '".($submodulo['orden'] - 1)."'")) != 0): ?>
                    <a href="server/ordenarriba.php?idm=<?php echo $submodulo['id_modulo']; ?>&ids=<?php echo $submodulo['id']; ?>&ref=editar&isub=<?php echo $misubmodulo['id']; ?>" class="text-secondary" style="margin-right: .2rem; margin-left: .2rem;"><i class="far fa-arrow-alt-circle-up"></i></a>
                  <?php endif; ?>
                  <?php if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM submodulos WHERE id_modulo = '".$submodulo['id_modulo']."' AND orden = '".($submodulo['orden'] + 1)."'")) != 0): ?>
                    <a href="server/ordenabajo.php?idm=<?php echo $submodulo['id_modulo']; ?>&ids=<?php echo $submodulo['id']; ?>&ref=editar&isub=<?php echo $misubmodulo['id']; ?>" class="text-secondary" style="margin-right: .2rem; margin-left: .2rem;"><i class="far fa-arrow-alt-circle-down"></i></a>
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
					</ul>
					<div class="col-xl-9 col-md-12 card shadow mb-4">
						<div class="card-body">
							<form class="" action="server/crearnuevosubmodulo.php" method="post">
								<h3>Creación de un Módulo</h3>
								<div class="form-group">
									<label for="titulo">Título del Módulo</label>
									<input type="text" class="form-control" name="titulo" id="titulo" placeholder="Este aparecera en el índice">
								</div>
								<nav>
									<div class="nav nav-tabs" id="nav-tab" role="tablist">
										<a class="nav-item nav-link active" id="nav-editor-tab" data-toggle="tab" href="#nav-editor" role="tab" aria-controls="nav-editor" aria-selected="true"><i data-feather="edit-2" style="transform: scale(0.8);"></i> Editor</a>
										<!-- <a class="nav-item nav-link" id="nav-previous-tab" data-toggle="tab" href="#nav-previous" role="tab" aria-controls="nav-previous" aria-selected="false"><i data-feather="eye" style="transform: scale(0.8);"></i> Vista Previa</a> -->
									</div>
								</nav>
								<div class="tab-content py-4" id="nav-tabContent">
									<div class="tab-pane fade show active" id="nav-editor" role="tabpanel" aria-labelledby="nav-editor-tab">
										<div class="form-group">
											<label for="contenido">Contenido</label>
											<textarea id="summernote" class="form-control shadow m-0" style="padding:150px;padding-left:30px;border-color:#e3e6f0; padding-bottom:55px; overflow: hidden; overflow-wrap: break-word; resize: none;" id="contenido" name="contenido" rows="2" placeholder=""></textarea>
										</div>
									</div>
									<div class="tab-pane fade" id="nav-previous" role="tabpanel" aria-labelledby="nav-previous-tab"></div>
								</div>
								<div class="form-group">
									<input type="hidden" name="id_modulo" value="<?php echo $_GET['id']; ?>">
									<button type="submit" class="btn btn-primary">Crear Módulo</button>
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
