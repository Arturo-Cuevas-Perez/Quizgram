
<?php include_once 'includes/navbar.php'; ?>


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
					<strong>¡Vaya!</strong> Parece que ha habido un error mientras guardábamos tus cambios. Inténtalo de nuevo.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php endif; ?>

				<?php if (isset($_GET['errorCoinciden'])): ?>
				<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
					<strong>¡Vaya!</strong> No coinciden las contraseñas intenta de nuevo.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php endif; ?>

				<?php if (isset($_GET['errorFormVacio'])): ?>
				<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
					<strong>¡Vaya!</strong> Dejaste vacio los campos del formulario.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php endif; ?>

				<h2 class="mt-4">Informacion de tu perfil</h2>
				<ol class="breadcrumb mb-4">
					<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
					<li class="breadcrumb-item active">Perfil</li>
				</ol>
				<div class="row">
					<div class="card mb-4 mx-auto" style="width: 300px;">
								<img src="assets\img\male-profile-blank.jpg" class="rounded mx-auto d-block img-fluid img-thumbnail" alt="image">
								<div class="card-body text-center">
									<h4 class="card-title">Cambiar Foto</h4>
									<label class="custom-file">
									 <input type="file" id="file" class="custom-file-input">
									 <span class="btn btn-outline-primary custom-file-control">Examinar Archivos</span>
								 </label>
								</div>
					</div>
					<div class="card col-lg-8 order-lg-2 mx-auto">
						<ul class="nav nav-pills nav-justified rounded-pill">
							<li class="nav-item">
								<a href="" data-target="#profile" data-toggle="tab" class="nav-link active rounded-pill">Perfil</a>
							</li>
							<li class="nav-item">
								<a href="" data-target="#messages" data-toggle="tab" class="nav-link rounded-pill">Mensajes</a>
							</li>
							<li class="nav-item">
								<a href="" data-target="#edit" data-toggle="tab" class="nav-link rounded-pill">Editar</a>
							</li>
						</ul>
						<div class="tab-content py-4">
							<div class="tab-pane active" id="profile">
								<h5 class="mb-3">Informacion Basica</h5>

									<div class="col-md-8">
										<ul class="list-unstyled list-justify">
											<li>Nombre: <span><?php echo ($row['user']); ?></span></li>
											<li>Apellido: <span><?php echo ($row['last_name']); ?></span></li>
											<li>Email: <span><?php echo ($row['email']); ?></span></li>
										</ul>
									</div>
									<div class="col-md-12">
										<h5 class="mt-2"><span class="fa fa-clock-o ion-clock float-right"></span>Actividad Reciente</h5>
										<table class="table table-sm table-hover table-striped">
											<tbody>
												<tr>
													<td>
														<!--<strong>Jorch</strong> se unio al proyecto <strong>`Colaboracion`</strong>-->
													</td>
												</tr>
											</tbody>
										</table>
									</div>
							</div>
							<div class="tab-pane" id="messages">
								<table class="table table-hover table-striped">
									<tbody>
										<tr>
											<td>
												<!--<span class="float-right font-weight-bold">Hace 3 hrs</span> Bienvenido.-->
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="tab-pane" id="edit">
								<form role="form" class="" action="server/editarperfilpersonales.php" method="post">
									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label">Nombre</label>
										<div class="col-lg-9">
											<input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo ($row['user']); ?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label">Apellidos</label>
										<div class="col-lg-9">
											<input class="form-control" type="text" name="apellido" id="apellido" value="<?php echo ($row['last_name']); ?>">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label">Email</label>
										<div class="col-lg-9">
											<input class="form-control" type="email" name="email" id="email" value="<?php echo ($row['email']); ?>" disabled>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label"></label>
										<div class="col-lg-9">
											<input type="reset" class="btn btn-secondary" value="Cancelar">
											<input type="submit" class="btn btn-primary" value="Guardar cambios">
										</div>
									</div>
									</form>
									<div class="divider">
										<br>
										<h2>Cambiar contraseña</h2>
										<br>
									</div>
									<form role="form" class="" action="server/editarpassword.php" method="post">
									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label">Contraseña nueva</label>
										<div class="col-lg-9">
											<input class="form-control" type="password" name="password" id="password">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label">Confirma tu contraseña</label>
										<div class="col-lg-9">
											<input class="form-control" type="password" name="r_password" id="r_password">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label"></label>
										<div class="col-lg-9">
											<input type="reset" class="btn btn-secondary" value="Cancelar">
											<input type="submit" class="btn btn-primary" value="Guardar cambios">
										</div>
									</div>
								</form>
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
