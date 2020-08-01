
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
					<strong>¡Vaya!</strong> No te podemos inscribir porque ya estás inscrito.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php endif; ?>

				<h2 class="mt-4">Gestiona tus clases</h2>
				<ol class="breadcrumb mb-4">
					<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
					<li class="breadcrumb-item active">Mis clases</li>
				</ol>
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
<script src="javascript/scripts.js"></script>
<script src="javascript/bootstrap.min.js"></script>
</body>

</html>
