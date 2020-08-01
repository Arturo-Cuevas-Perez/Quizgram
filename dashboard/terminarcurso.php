

<?php include_once 'includes/navbar.php'; ?>

<?php

  include('secretInfo/conexion_BD.php');
  $id_modulo = $_GET['idm'];

  $id_submodulo = mysqli_fetch_array(mysqli_query($mysqli, "SELECT id FROM submodulos WHERE id_modulo = '".$id_modulo."' ORDER BY orden DESC"));
  mysqli_query($mysqli, "INSERT INTO progresocursos SET id_usuario = '".$row['id']."', id_modulo = '".$id_modulo."', id_submodulo = '".$id_submodulo['id']."'");

  if ($consulta = mysqli_query($mysqli, "SELECT id FROM tareas WHERE id_modulo = '".$id_modulo."' AND id_para LIKE '%,".$row['id']."%'"))
  {
    while ($tareas = mysqli_fetch_array($consulta))
    {
      mysqli_query($mysqli, "INSERT INTO respuestas SET id_tarea = '".$tareas['id']."', id_alumno = '".$row['id']."', puntuacion = 100");
    }
  }
?>

  <script src="https://unpkg.com/feather-icons"></script>

<div id="layoutSidenav">

	<?php include_once 'includes/sidebar.php'; ?>

	<div id="layoutSidenav_content">

			<div class="container-fluid">

        <style>
        .confetti {
          width: 0.8rem;
          height: 0.8rem;
          display: inline-block;
          position: absolute;
          top: -1rem;
          left: 0;
          z-index: 150;
        }
        @media (min-width: 420px)
        {
          .confetti
          {
           left: 0;
          }
        }
        .confetti .rotate {
          animation: driftyRotate 1s infinite both ease-in-out;
          perspective: 1000;
        }
        .confetti .askew {
          background: currentColor;
          transform: skewY(10deg);
          width: 1rem;
          height: 1rem;
          animation: drifty 1s infinite alternate both ease-in-out;
          perspective:1000;
        }

        .confetti:nth-of-type(5n) {
          color: #F56620;
        }
        .confetti:nth-of-type(5n+1) {
          color: #00EAFF;
        }
        .confetti:nth-of-type(5n+2) {
          color: #EA8EE0;
        }
        .confetti:nth-of-type(5n+3) {
          color: #EBFF38;
        }
        .confetti:nth-of-type(5n+4) {
          color: #0582FF;
        }

        .confetti:nth-of-type(7n) .askew {
          animation-delay: -.6s;
          animation-duration: 2.25s;
        }
        .confetti:nth-of-type(7n + 1) .askew {
          animation-delay: -.879s;
          animation-duration: 3.5s;
        }
        .confetti:nth-of-type(7n + 2) .askew {
          animation-delay: -.11s;
          animation-duration: 1.95s;
        }
        .confetti:nth-of-type(7n + 3) .askew {
          animation-delay: -.246s;
          animation-duration: .85s;
        }
        .confetti:nth-of-type(7n + 4) .askew {
          animation-delay: -.43s;
          animation-duration: 2.5s;
        }
        .confetti:nth-of-type(7n + 5) .askew {
          animation-delay: -.56s;
          animation-duration: 1.75s;
        }
        .confetti:nth-of-type(7n + 6) .askew {
          animation-delay: -.76s;
          animation-duration: 1.5s;
        }

        .confetti:nth-of-type(9n) .rotate {
          animation-duration: 2s;
        }
        .confetti:nth-of-type(9n + 1) .rotate {
          animation-duration: 2.3s;
        }
        .confetti:nth-of-type(9n + 2) .rotate {
          animation-duration: 1.1s;
        }
        .confetti:nth-of-type(9n + 3) .rotate {
          animation-duration: .75s;
        }
        .confetti:nth-of-type(9n + 4) .rotate {
          animation-duration: 4.3s;
        }
        .confetti:nth-of-type(9n + 5) .rotate {
          animation-duration: 3.05s;
        }
        .confetti:nth-of-type(9n + 6) .rotate {
          animation-duration: 2.76s;
        }
        .confetti:nth-of-type(9n + 7) .rotate {
          animation-duration: 7.6s;
        }
        .confetti:nth-of-type(9n + 8) .rotate {
          animation-duration: 1.78s;
        }

        @keyframes drifty {
          0% {
            transform: skewY(10deg) translate3d(-250%, 0, 0);
          }
          100% {
            transform: skewY(-12deg) translate3d(250%, 0, 0);
          }
        }
        @keyframes driftyRotate {
          0% {
            transform: rotateX(0);
          }
          100% {
            transform: rotateX(359deg);
          }
        }
        </style>
        <div class="confetti-land">
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
          <div class="confetti"></div>
        </div>

        <?php
        $modulo = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM modulos WHERE id = '".$id_modulo."'"));
        ?>
        <div class="text-center">
          <h1 class="mx-auto text-success display-1 mt-4" style="transform: translateX(-0.2em);">¡Felicidades <?php echo $row['user']; ?>!</h1>
          <p class="display-4 text-info mb-5">Acabas de terminar el curso <?php echo $modulo['titulo']; ?></p>
          <a href="curso.php?idm=<?php echo $modulo['id']; ?>&ids=1" class="btn btn-lg btn-secondary mb-4">Accede al temario</a>
          <p class="text-gray-500 mb-0">¿Por qué no te animas con otro?</p>
          <a href="index.php">&larr; Volver al inicio</a>
        </div>



			</div>

		<?php include_once 'includes/footer.php'; ?>
	</div>
</div>

<script src="javascript/scripts.js"></script>
<script src="javascript/bootstrap.min.js"></script>
<script src="javascript/summernote-es-ES.js"></script>

<script>
  feather.replace();

  var confettiPlayers = [];

  function makeItConfetti() {
    var confetti = document.querySelectorAll('.confetti');

    if (!confetti[0].animate) {
      return false;
    }

    for (var i = 0, len = confetti.length; i < len; ++i) {
      var snowball = confetti[i];
      snowball.innerHTML = '<div class="rotate"><div class="askew"></div></div>';
      var scale = Math.random() * .8 + .8;
      var player = snowball.animate([
        { transform: 'translate3d(' + (i/len*100) + 'vw,0,0) scale(' + scale + ')', opacity: scale },
        { transform: 'translate3d(' + (i/len*100 + 10) + 'vw,100vh,0) scale(' + scale + ')', opacity: 1 }
      ], {
        duration: Math.random() * 3000 + 3000,
        iterations: Infinity,
        delay: -(Math.random() * 5000)
      });


      confettiPlayers.push(player);
    }
  }

  makeItConfetti();
</script>

</body>

</html>
