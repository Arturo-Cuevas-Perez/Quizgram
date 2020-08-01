
<?php include_once 'includes/navbar.php'; ?>

<?php

  include('secretInfo/conexion_BD.php');

  $clase = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM clases WHERE id = '".$_GET['id']."'"));

  $alumnos = explode(";", $clase['id_alumnos']);
  $alumno_de_clase = false;

  foreach ($alumnos as $alumno)
  {
    if ($alumno == $row['id'])
    {
      $alumno_de_clase = true;
    }
  }

  if ($alumno_de_clase == false)
  {
    header('Location: index.php');
  }

?>

<div id="layoutSidenav">

	<?php include_once 'includes/sidebar.php'; ?>

	<div id="layoutSidenav_content">

    <div class="container-fluid">

      <br>
      <div class="d-flex d-sm-flex align-items-center justify-content-between mb-0">
        <img src="https://source.unsplash.com/collection/4932946/1900x600" <?php echo rand(1,999); ?> class="img-fluid" style="transform: scale(1); margin-bottom: -35px; filter: brightness(0.65); border-radius: 12px;">
      </div>
      <div class="d-flex d-sm-flex align-items-center justify-content-between mb-3" style="z-index:200;">
        <h1 class="h1 mb-0 text-white fluid-text" style="z-index: 20; margin-top:-110px; margin-left: 25px; line-height: 0.8em;">
        <?php echo $clase['nombreClase']; ?> <span class="badge badge-info d-none d-sm-inline" style="z-index:200; font-size: 0.4em;"><?php echo $clase['curso']." ".$clase['grupo']; ?></span>
        <?php if ($row['id_tipo'] == "1" && $clase['id_tutor'] == $row['id']): ?>
        <br><small class="h6" style="#ffffff">Código de clase: <b><?php echo $clase['id']; ?></b></small></h1>
        <a href="#" data-toggle="modal" data-target="#editarClaseModal" class="text-white" style="z-index:20;"><span class="float-right" style="z-index: 20; margin-top: -20px; margin-bottom: 20px; margin-right: 15px;"><i class="lnr lnr-cog" style="font-size:25px;"></i></span></a>
        <?php else: ?>
        </h1>
      <?php endif; ?>
      </div>


      <style>
      .nav-item .nav-link.active {
        color: white!important;
      }
      #pills-tab {z-index:20; padding: 5px; width: 340px;}
      @media (max-width: 523px) {
        #pills-tab {
          transform: scale(0.85) translateX(-0.95em);
        }
      }
      @media only screen and (max-width: 475px) {

    			.img-fluid {
    				height: 150px;
    			}
    		}
      </style>

      <!-- Content Row -->
      <div class="row">

        <!-- Content -->
        <div class="mx-auto col-sm-12" style="z-index:20; padding-top: 30px;">
          <ul class="nav nav-pills mb-5 nav-justified rounded-pill bg-white shadow mx-auto" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active rounded-pill" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Comentarios</a>
            </li>
            <li class="nav-item">
              <a class="nav-link rounded-pill" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Tareas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link rounded-pill" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Alumnos</a>
            </li>
          </ul>
          <div class="tab-content col-xl-9 col-md-11 col-sm-12 mx-auto" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

              <div class="mb-4">
                <form method="post" action="server/publicar.php">
                  <input type="hidden" name="id_clase" value="<?php echo $clase['id']; ?>">
                  <textarea class="summernote form-control shadow m-0" style="padding:150px;padding-left:30px;border-color:#e3e6f0; padding-bottom:55px; overflow: hidden; overflow-wrap: break-word; resize: none;" id="post" name="descripcion" rows="2" placeholder="Comparte algo con la clase..."></textarea>
                  <button type="submit" class="btn btn-primary float-right rounded-pill shadow" style="margin-top: -50px; margin-right: 5px; margin-bottom: 30px; z-index:20; position:relative;">Publicar</button>
                </form>
              </div>

              <?php
              $publicaciones = mysqli_query($mysqli, "SELECT * FROM publicaciones WHERE id_clase = '".$clase['id']."' ORDER BY llave DESC");
              while ($publicacion = mysqli_fetch_array($publicaciones))
              {
                $usuario_publicacion = mysqli_fetch_array(mysqli_query($mysqli, "SELECT user, last_name FROM usuarios WHERE id = '".$publicacion['id_autor']."'"));
                ?>
                <div class="col-sm-12 card shadow mb-4">
                  <div class="card-body" style="padding: 1.25rem 0.25rem 1.25rem 0.25rem">
                    <?php if ($publicacion['id_autor'] == $row['id']): ?>
                    <div class="float-right" style="list-style-type:none;">
                      <a class="nav-link " href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#000000;"><i class="fas fa-ellipsis-h"></i></a>
                      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown" style="min-width: 8rem;" >
                        <a class="dropdown-item" href="server/borrarcomentario.php?llave=<?php echo $publicacion['llave'] ?>&id=<?php echo $clase['id']; ?>&autor=<?php echo $publicacion['id_autor']; ?>"><i class="fas fa-trash text-danger"></i>Eliminar</a>
                      </div>
                    </div>
                  <?php else: ?>
                <?php endif; ?>
                    <h6 class="m-0 mb-3"><span class="font-weight-bold text-primary"><?php echo $usuario_publicacion['user']." ".$usuario_publicacion['last_name']; ?></span> ha publicado un comentario:</h6>
                    <span class="timeago" style="margin-bottom: 0rem !important; font-size: 12px;"><?php echo time_ago($publicacion["fecha"]); ?></span>
                    <p id="comentario"><?php echo $publicacion['descripcion']; ?></p>
                  </div>
                </div>
                <?php
              }
              ?>


            </div>
            <div class="tab-pane mx-auto fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
              <?php if ($row['id'] == $clase['id_tutor']): ?>
                <a class="btn btn-info btn-lg shadow rounded-pill mb-3 col-sm-4" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-plus"></i> Crear nueva tarea</a>
                <div class="collapse" id="collapseExample">
                  <div class="col-sm-12 card shadow mb-4">
                    <div class="card-body">
                      <p>Antes de crear una tarea selecciona su tipo:</p>
                      <nav>
                        <div class="nav nav-pills" id="nav-tab" role="tablist">
                          <a class="nav-item nav-link active" id="nav-editor-tab" data-toggle="tab" href="#nav-editor" role="tab" aria-controls="nav-editor" aria-selected="true">Curso</a>
                          <a class="nav-item nav-link" id="nav-previous-tab" data-toggle="tab" href="#nav-previous" role="tab" aria-controls="nav-previous" aria-selected="false">Ejercicio</a>
                        </div>
                      </nav>
                      <div class="tab-content py-4" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-editor" role="tabpanel" aria-labelledby="nav-editor-tab">

                          <form method="post" action="server/creartarea.php">
                            <div class="form-group">
                              <label for="exampleFormControlSelect1">Curso:</label>
                              <select class="form-control" id="exampleFormControlSelect1" name="id_modulo" required>
                                <option disabled value="" selected>Elige uno de la lista</option>

                            <?php

                            $consulta = mysqli_query($mysqli, "SELECT DISTINCT id_modulo FROM progresocursos WHERE id_usuario = '".$row['id']."' ORDER BY id DESC");
                            while ($curs_hist = mysqli_fetch_array($consulta))
                            {
                              $curso = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM modulos WHERE id = '".$curs_hist['id_modulo']."'"));
                              $historico_id_submodulo = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM progresocursos WHERE id_modulo = '".$curso['id']."' ORDER BY id DESC LIMIT 1"));
                              $id_submodulo_orden = mysqli_fetch_array(mysqli_query($mysqli, "SELECT orden FROM submodulos WHERE id = '".$historico_id_submodulo['id_submodulo']."'"));
                              $num_submodulos = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM submodulos WHERE id_modulo = '".$curso['id']."'"));

                              $cursos_pendientes = 0;
                              $porcentaje_progreso = ($id_submodulo_orden['orden'] * 100) / $num_submodulos;

                              if ($porcentaje_progreso == 100)
                              {
                                ?>

                                <option value="<?php echo $curso['id']; ?>"><?php echo $curso['titulo']; ?></option>

                                <?php
                              }

                            }

                            ?>

                              </select>
                              <small>Para asignar un curso debes haberlo completado previamente</small>
                            </div>
                            <div class="form-group">
                              <p>¿Quién deberá completar la tarea?</p>
                              <div class="custom-control custom-checkbox" style="margin-bottom: 0.9em;">
                                <input type="checkbox" class="custom-control-input" id="customCheck1" onClick="selectAll(this)">
                                <label class="custom-control-label" for="customCheck1">Asignar a toda la clase</label>
                              </div>
                              <?php if ($alumnos = explode(";", $clase['id_alumnos'])):
                                $num_alumnos = 0;
                                ?>
                                <?php foreach ($alumnos as $id_alumno):
                                  if ($id_alumno != "" && $id_alumno != $row['id'])
                                  {
                                    $num_alumnos++;
                                    $datos_alumno = mysqli_fetch_array(mysqli_query($mysqli, "SELECT id, user, last_name FROM usuarios WHERE id = '".$id_alumno."'"));
                                    ?>
                                    <div class="custom-control custom-checkbox">
                                      <input type="checkbox" class="custom-control-input checkalumno" id="customCheck1Alumno<?php echo $num_alumnos; ?>" name="alumno[<?php echo $num_alumnos; ?>]" value="<?php echo $datos_alumno['id']; ?>">
                                      <label class="custom-control-label" for="customCheck1Alumno<?php echo $num_alumnos; ?>"><?php echo $datos_alumno['user']." ".$datos_alumno['last_name']; ?></label>
                                    </div>
                                  <?php
                                }
                                ?>
                                <?php endforeach; ?>
                              <?php endif; ?>
                            </div>
                            <div class="form-group">
                              <input type="hidden" name="id_clase" value="<?php echo $clase['id']; ?>">
                              <input type="hidden" name="tipo" value="curso">
                              <input type="submit" value="Asignar Curso" class="btn btn-primary">
                            </div>

                          </form>

                        </div>
                        <div class="tab-pane fade" id="nav-previous" role="tabpanel" aria-labelledby="nav-previous-tab">
                          <form id="formtarea" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                              <label for="exampleFormControlSelect1">Enunciado de la tarea:</label>
                              <textarea name="enunciado" class="summernote form-control" rows="4"></textarea>
                              <p>Tamaño maximo del archivo permitido 32 MB.</p>
                              <input id="file" type="file" name="file">
                            </div>
                            <div class="form-group">
                              <p>¿Quién deberá completar la tarea?</p>
                              <div class="custom-control custom-checkbox" style="margin-bottom: 0.9em;">
                                <input type="checkbox" class="custom-control-input" id="customCheck2" onClick="selectAll(this)">
                                <label class="custom-control-label" for="customCheck2">Asignar a toda la clase</label>
                              </div>
                              <?php if ($alumnos = explode(";", $clase['id_alumnos'])):
                                $num_alumnos = 0;
                                ?>
                                <?php foreach ($alumnos as $id_alumno):
                                  if ($id_alumno != "" && $id_alumno != $row['id'])
                                  {
                                    $num_alumnos++;
                                    $datos_alumno = mysqli_fetch_array(mysqli_query($mysqli, "SELECT id, user, last_name FROM usuarios WHERE id = '".$id_alumno."'"));
                                    ?>
                                    <div class="custom-control custom-checkbox">
                                      <input type="checkbox" class="custom-control-input checkalumno" id="customCheck2Alumno<?php echo $num_alumnos; ?>" name="alumno[<?php echo $num_alumnos; ?>]" value="<?php echo $datos_alumno['id']; ?>">
                                      <label class="custom-control-label" for="customCheck2Alumno<?php echo $num_alumnos; ?>"><?php echo $datos_alumno['user']." ".$datos_alumno['last_name']; ?></label>
                                    </div>
                                  <?php
                                }
                                ?>
                                <?php endforeach; ?>
                              <?php endif; ?>
                            </div>
                            <div class="form-group">
                              <input type="hidden" name="id_clase" value="<?php echo $clase['id']; ?>">
                              <input type="hidden" name="tipo" value="ejercicio">
                              <input type="submit" name="save" id="save" value="Crear Ejercicio" class="btn btn-primary">
                            </div>

                          </form>

                          <div class="form-group" id="process" style="display:none">
                            <div class="progress">
                              <div class="progress-bar bg-success progress-bar-striped active progress-bar-animated" role="progressbar" style="width: 20%" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>

                        </div>
                      </div>

                    </div>
                  </div>
                </div>

              <?php endif; ?>

              <?php
              if ($row['id_tipo'] == "1" && $clase['id_tutor'] == $row['id'])
              {
                $tareas_pendientes = mysqli_query($mysqli, "SELECT * FROM tareas WHERE id_clase = '".$clase['id']."' ORDER BY id DESC");
              }
              else
              {
                $tareas_pendientes = mysqli_query($mysqli, "SELECT * FROM tareas WHERE id_para LIKE 'c: ".$clase['id']."; %,".$row['id']."%' ORDER BY id DESC");
              }
              $num_tarea = 0;
              while ($tarea = mysqli_fetch_array($tareas_pendientes))
              {
                $num_tarea++;
              ?>
              <div class="col-sm-12 card shadow mb-4">
                <div class="card-body">

                    <?php if ($tarea['id_autor'] == $row['id']): ?>
                  <div class="float-right" style="list-style-type:none;">
                    <a class="nav-link " href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#000000;"><i class="fas fa-ellipsis-h"></i></a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown" style="min-width: 8rem;" >
                      <a class="dropdown-item" href="server/borrartarea.php?id=<?php echo $tarea['id'] ?>&id_clase=<?php echo $tarea['id_clase']; ?>&autor=<?php echo $tarea['id_autor']; ?>"><i class="fas fa-trash text-danger"></i>Eliminar</a>
                    </div>
                  </div>
                <?php else: ?>
              <?php endif; ?>

                  <?php if ($tarea['tipo'] == "ejercicio"): ?>

                  <h6 style="margin-bottom: 0rem !important;">Enunciado: </h6>
                  <span class="timeago" style="margin-bottom: 0rem !important; font-size: 12px;"><?php echo time_ago($tarea["fecha_tarea"]); ?></span>
                  <h5 class="mb-4" style="margin-top: 2rem !important;"><?php echo $tarea['descripcion']; ?></h5>
                  <?php if ($tarea['archivo'] != NULL): ?>
                  <span>Descargar: <a href="server/download.php?filename=<?php echo $tarea['archivo'];?>"><?php echo $tarea['archivo']; ?></a> <br> </span>
                  <?php else: ?>
                <?php endif; ?>
                    <?php if ($tarea['id_autor'] == $row['id']): ?>

                      <a class="btn btn-primary mt-3 mb-3" data-toggle="collapse" href="#respuestas<?php echo $tarea['id']; ?>" role="button" aria-expanded="false" aria-controls="respuestas<?php echo $tarea['id']; ?>">Ver respuestas</a>

                      <div class="collapse" id="respuestas<?php echo $tarea['id']; ?>">
                        <div class="">
                          <?php
                          $explode1 = explode("; ,", $tarea['id_para']);
                          if ($alumnos = explode(",", $explode1[1])): ?>
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">Alumno/a</th>
                                  <th scope="col"><span class="float-right"></span></th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($alumnos as $id_alumno):
                                  $datos_alumno = mysqli_fetch_array(mysqli_query($mysqli, "SELECT user, last_name FROM usuarios WHERE id = '".$id_alumno."'"));
                                  ?>

                                  <tr>
                                    <td><?php echo $datos_alumno['user']." ".$datos_alumno['last_name']; ?></td>

                                    <?php

                                    if ($respuesta_enviada = mysqli_fetch_array(mysqli_query($mysqli, "SELECT id, respuesta, puntuacion FROM respuestas WHERE id_alumno = '".$id_alumno."' AND id_tarea = '".$tarea['id']."'")))
                                    {
                                      if ($respuesta_enviada['puntuacion'] != NULL)
                                      {
                                        if ($respuesta_enviada['puntuacion'] < 50)
                                        {
                                          ?>
                                          <td><span class="float-right"><a href="respuesta.php?id=<?php echo $respuesta_enviada['id']; ?>">Ver respuesta</a> (Puntuación: <b><?php echo $respuesta_enviada['puntuacion']; ?></b>/100) <i class="far fa-square" class="text-danger" style="transform: scale(0.8); margin-top: -0.2em;"></i></span></td>
                                          <?php
                                        }
                                        else
                                        {
                                          ?>
                                          <td><span class="float-right"><a href="respuesta.php?id=<?php echo $respuesta_enviada['id']; ?>">Ver respuesta</a> (Puntuación: <b><?php echo $respuesta_enviada['puntuacion']; ?></b>/100) <i class="far fa-check-square" class="text-success" style="transform: scale(0.8); margin-top: -0.2em;"></i></span></td>
                                          <?php
                                        }
                                      }
                                      else
                                      {
                                        ?>
                                        <td><span class="float-right"><a href="respuesta.php?id=<?php echo $respuesta_enviada['id']; ?>">Ver respuesta</a> (Pendiente de evaluar) <i class="far fa-square" style="transform: scale(0.8); margin-top: -0.2em;"></i></span></td>
                                        <?php
                                      }
                                    }
                                    else
                                    {
                                      ?>
                                      <td><span class="float-right">Sin enviar <i class="far fa-square" style="transform: scale(0.8); margin-top: -0.2em;"></i></span></td>
                                      <?php
                                    }
                                    ?>
                                  </tr>
                                <?php endforeach; ?>
                              </tbody>
                            </table>
                          <?php endif; ?>
                        </div>
                      </div>


                    <?php else: ?>
                      <?php if ($respuesta = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM respuestas WHERE id_tarea = '".$tarea['id']."' AND id_alumno = '".$row['id']."'"))): ?>
                        <?php if ($respuesta['puntuacion'] != ""): ?>
                          <h6 class="float-left"><span style="font-size: 1em;">Puntuación:</span> <b><?php echo $respuesta['puntuacion']; ?></b><span style="font-size: 0.9em;" class="text-secondary">/100</span></h6>
                          <h6 class="float-right" style="margin-top: 0.3em;">Ya has completado esta tarea&nbsp;&nbsp;&nbsp;&nbsp;<i class=" far fa-check-square text-success float-right" style="transform: scale(1.4); margin-top: -1em;"></i></h6>
                        <?php else: ?>
                          <h6 class="float-left"><span style="font-size: 1.2em;">Pendiente de evaluar</span></h6>
                          <h6 class="float-right" style="margin-top: 0.3em;">Ya has completado esta tarea&nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-check-square text-success float-right" style="transform: scale(1.4); margin-top: -1em;"></i></h6>
                        <?php endif; ?>
                      <?php else: ?>
                        <a class="btn btn-secondary mb-4" data-toggle="collapse" href="#collapseExample<?php echo $num_tarea; ?>" role="button" aria-expanded="false" aria-controls="collapseExample<?php echo $num_tarea; ?>">Responder</a>
                        <div class="collapse" id="collapseExample<?php echo $num_tarea; ?>">
                          <form id="formrespuesta" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                              <label for="respuesta">Solución:</label>
                              <textarea id="summernote3" name="respuesta" rows="4" class="form-control" placeholder="Escribe aquí tu respuesta"></textarea>
                              <p>Tamaño maximo del archivo permitido 32 MB.</p>
                              <input id="file" type="file" name="file">
                            </div>
                            <div class="form-group">
                              <input type="hidden" name="id_tarea" value="<?php echo $tarea['id']; ?>">
                              <input type="hidden" name="id_clase" value="<?php echo $clase['id']; ?>">
                              <input type="submit" name="enviar" id="enviar" class="btn btn-primary" value="Enviar Respuesta">
                            </div>
                          </form>

                          <div class="form-group" id="process" style="display:none">
                            <div class="progress">
                              <div class="progress-bar bg-success progress-bar-striped active progress-bar-animated" role="progressbar" style="width: 20%" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>

                        </div>
                        <h6 class="float-right" style="margin-top: 3em;"><span>Todavía no has completado esta tarea</span>&nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-square text-secondary float-right" style="transform: scale(1.4); margin-top: -1em;"></i></h6>
                      <?php endif; ?>
                    <?php endif; ?>
                    <?php else: ?>

                      <?php
                      $respuesta = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM respuestas WHERE id_tarea = '".$tarea['id']."' AND id_alumno = '".$row['id']."'"));
                      $curso = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM modulos WHERE id = '".$tarea['id_modulo']."' ORDER BY id DESC"));
                      ?>
                      <h5>Te han asignado un curso: <i><b><?php echo $curso['titulo']; ?></b></i>. Empiézalo pulsando en este <a href="curso.php?idm=<?php echo $curso['id']; ?>&ids=1" style="text-decoration: none">enlace.</a></h5>
                      <?php if ($tarea['id_autor'] == $row['id']): ?>

                        <a class="btn btn-primary mt-3 mb-3" data-toggle="collapse" href="#progreso<?php echo $tarea['id']; ?>" role="button" aria-expanded="false" aria-controls="progreso<?php echo $tarea['id']; ?>">Ver progreso</a>

                        <div class="collapse" id="progreso<?php echo $tarea['id']; ?>">
                          <div class="">
                            <?php $explode1 = explode("; ,", $tarea['id_para']);
                              if ($alumnos = explode(",", $explode1[1])): ?>
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">Alumno/a</th>
                                    <th scope="col"><span class="float-right">Progreso</span></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($alumnos as $id_alumno):
                                    $datos_alumno = mysqli_fetch_array(mysqli_query($mysqli, "SELECT user, last_name FROM usuarios WHERE id = '".$id_alumno."'"));
                                    ?>

                                    <tr>
                                      <td><?php echo $datos_alumno['user']." ".$datos_alumno['last_name']; ?></td>

                                      <?php

                                      if ($id_submodulo_completado = mysqli_fetch_array(mysqli_query($mysqli, "SELECT id_submodulo FROM progresocursos WHERE id_usuario = '".$id_alumno."' AND id_modulo = '".$curso['id']."' ORDER BY id DESC LIMIT 1")))
                                      {
                                        $num_submodulos = mysqli_num_rows(mysqli_query($mysqli, "SELECT id FROM submodulos WHERE id_modulo = '".$curso['id']."'"));
                                        $orden = mysqli_fetch_array(mysqli_query($mysqli, "SELECT orden FROM submodulos WHERE id = '".$id_submodulo_completado['id_submodulo']."'"));
                                        if ($orden['orden'] == $num_submodulos)
                                        {
                                          ?>
                                          <td><span class="float-right">Completado <i class="far fa-check-square text-success" style="transform: scale(0.8); margin-top: -0.2em;"></i></span></td>
                                          <?php
                                        }
                                        else
                                        {
                                          ?>
                                          <td><span class="float-right"><?php echo $orden['orden']; ?> de <?php echo $num_submodulos; ?> completados <i class="far fa-square" style="transform: scale(0.8); margin-top: -0.2em;"></i></span></td>
                                          <?php
                                        }
                                      }
                                      else
                                      {
                                        ?>
                                        <td><span class="float-right">Sin comenzar <i class="far fa-square" style="transform: scale(0.8); margin-top: -0.2em;"></i></span></td>
                                        <?php
                                      }
                                      ?>
                                    </tr>
                                  <?php endforeach; ?>
                                </tbody>
                              </table>
                            <?php endif; ?>
                          </div>
                        </div>

                      <?php else: ?>

                        <?php if ($respuesta['puntuacion'] == 100): ?>
                          <h6 class="float-right" style="margin-top: 1em;">Ya has completado esta tarea&nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-check-square text-success float-right" style="transform: scale(1.4); margin-top: -1em;"></i></h6>
                        <?php else: ?>
                          <h6 class="float-right" style="margin-top: 1em;"><span>Todavía no has completado esta tarea</span>&nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-square text-secondary float-right" style="transform: scale(1.4); margin-top: -1em;"></i></h6>
                        <?php endif; ?>


                      <?php endif; ?>

                  <?php endif; ?>

                </div>
              </div>
              <?php
              }
              ?>

            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

              <div class="card shadow mb-4">
                <div class="card-body">
                  <?php if ($alumnos = explode(";", $clase['id_alumnos'])): ?>
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Usuarios</th>
                          <?php if ($row['id_tipo'] == "1" && $clase['id_tutor'] == $row['id']): ?>
                            <th scope="col"></th>
                          <?php endif; ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($alumnos as $id_alumno):
                          if ($id_alumno != "") {
                            $datos_alumno = mysqli_fetch_array(mysqli_query($mysqli, "SELECT user, last_name FROM usuarios WHERE id = '".$id_alumno."'"));
                            ?>

                            <tr>
                              <td><?php echo $datos_alumno['user']." ".$datos_alumno['last_name']; ?></td>
                              <?php if ($row['id_tipo'] == "1" && $clase['id_tutor'] == $row['id']): ?>
                              <td><span class="float-right">
                                <?php if ($id_alumno != $clase['id_tutor']): ?>
                                  <!--<a href="progreso.php?id=<?php //echo $id_alumno; ?>">Ver progreso</a>-->
                                    &nbsp;&nbsp;&nbsp;<a href="server/sacardeclase.php?id=<?php echo $id_alumno; ?>&idc=<?php echo $clase['id']; ?>" class="text-danger">Eliminar</a>
                                <?php else: ?>
                                  <span><b>Tutor/a</b></span>
                                <?php endif; ?>
                              </span></td>
                              <?php endif; ?>
                            </tr>

                          <?php
                          }
                          ?>

                        <?php endforeach; ?>
                      </tbody>
                    </table>

                  <?php else: ?>
                    <p>Todavía no hay alumnos/as en la clase.</p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
    <!-- /.container-fluid -->


		<?php include_once 'includes/footer.php'; ?>

	</div>
</div>


<script src="javascript/scripts.js"></script>
<script src="javascript/bootstrap.min.js"></script>
<script src="javascript/summernote-es-ES.js"></script>
<script src="javascript/ajaxupload.js"></script>


<script>
  // Lista alumnos checkbox
  function selectAll(source) {
    checkboxes = document.getElementsByClassName('checkalumno');
    for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = source.checked;
    }
  }
  // Summernote
  $(document).ready(function() {
  $('.summernote').summernote({
    placeholder: 'Escribe aquí...',
    lang: 'es-ES'
  });
  $('#summernote3').summernote({
    placeholder: 'Responder tarea...',
    lang: 'es-ES'
  });
});
</script>

<script type="text/javascript">


$(document).ready(function(){

  $('#formrespuesta').on('submit', function(event){
   event.preventDefault();

    $.ajax({
     url:"server/respondertarea.php",
     type:"POST",
     data: new FormData(this),
     contentType: false,
     cache: false,
     processData:false,
     beforeSend:function()
     {
      $('#enviar').attr('disabled', 'disabled');
      $('#process').css('display', 'block');
     },
     success:function(data)
     {
      var percentage = 0;

      var timer = setInterval(function(){
       percentage = percentage + 20;
       progress_bar_process(percentage, timer);
      }, 1000);
     }
    })

  });

  function progress_bar_process(percentage, timer)
  {
   $('.progress-bar').css('width', percentage + '%');
   if(percentage > 100)
   {
    clearInterval(timer);
    $('#formrespuesta')[0].reset();
    $('#process').css('display', 'none');
    $('.progress-bar').css('width', '0%');
    $('#enviar').attr('disabled', false);
   }
  }

 });


</script>

</body>

</html>
