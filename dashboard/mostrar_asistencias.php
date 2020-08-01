
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

				<h2 class="mt-4">Informacion de tu perfil</h2>
				<ol class="breadcrumb mb-4">
					<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
					<li class="breadcrumb-item active">Perfil</li>
				</ol>
				<div class="row">
          <div class="card mb-4">
              <div class="card-header"><i class="fas fa-table mr-1"></i>DataTable Example</div>
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                          <thead>
                              <tr>
                                  <th>Nombre</th>
                                  <th>Asignatura</th>
                                  <th>Grupo</th>
                              </tr>
                          </thead>
                          <tfoot>
                              <tr>
                                  <th>Nombre</th>
                                  <th>Asignatura</th>
                                  <th>Grupo</th>
                              </tr>
                          </tfoot>
                          <tbody>
                              <tr>
                                  <td>Tiger Nixon</td>
                                  <td>System Architect</td>
                                  <td>Edinburgh</td>
                              </tr>
                              <tr>
                                  <td>Garrett Winters</td>
                                  <td>Accountant</td>
                                  <td>Tokyo</td>
                              </tr>
                              <tr>
                                  <td>Ashton Cox</td>
                                  <td>Junior Technical Author</td>
                                  <td>San Francisco</td>
                              </tr>
                              <tr>
                                  <td>Cedric Kelly</td>
                                  <td>Senior Javascript Developer</td>
                                  <td>Edinburgh</td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
				</div>
			</div>

		<?php include_once 'includes/footer.php'; ?>
	</div>
</div>

<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<script src="javascript/scripts.js"></script>
<script src="javascript/bootstrap.min.js"></script>
</body>

</html>
