
<?php include_once 'includes/navbar.php'; ?>


<div id="layoutSidenav">

	<?php include_once 'includes/sidebar.php'; ?>

	<div id="layoutSidenav_content">

			<div class="container-fluid">

				<h2 class="mt-4">Configuración de la cuenta</h2>
				<ol class="breadcrumb mb-4">
					<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
          <li class="breadcrumb-item active">Configuración</li>
				</ol>
				<div class="row">
					<div class="card col-lg-8 order-lg-2 " style="width: 600px;">
            <div class="list-group">
              <form class="" action="#" method="post">
                <div class="form-group">
                  <select class="form-control" name="tema">
                    <option disabled selected>Selecciona el tema del Dashboard:</option>
                    <option value="Dark">Oscuro</option>
                    <option value="Normal">Normal</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Cambiar tema</button>
              </form>
              <br>
              <br>
              <a href="#" class="list-group-item list-group-item-action list-group-item-light text-danger text-center" data-toggle="modal" data-target="#borrarCuentaModal" style="top: 300px; width: 170px;">Borrar cuenta</a>
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
