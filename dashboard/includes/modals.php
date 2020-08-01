
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quieres salir?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
      <br><br><span class="text-danger">NOTA: El progreso que no hayas guardado se perderá.</span></div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-danger" href="auth/logout.php">Cerrar sesión</a>
      </div>
    </div>
  </div>
</div>

<!-- Crear Curso Modal-->
<div class="modal fade" id="crearCursoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crea tu propio curso</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form class="" action="server/crearnuevomodulo.php" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col col-sm-12 py-2 card-body">
              <div class="form-group">
                <label for="titulo">Título del Curso</label>
                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Elige un título llamativo.">
              </div>
              <div class="form-group">
                <label for="lenguaje">Tema</label>
                <input type="text" name="tema" class="form-control" id="tema" placeholder="Sobre que tema trata el curso.">
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="discripcion" name="descripcion" placeholder="Describe brevemente tu curso. Esto ayudará a que tu curso sea más popular" rows="3"></textarea>
              </div>
              <div class="form-group text-danger">
                <small><p><b>NOTA: </b>El curso no estará disponible hasta que no indiques su publicación. Para ello deberás acceder al menú de edición de cursos en el menu lateral.</p></small>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Crear Curso</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Editar Curso Modal-->
<div class="modal fade" id="editarCursoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Qué curso quieres editar?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form class="" action="editarmodulo.php" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col col-sm-12 py-2 card-body" style="padding: 0.5rem !important;">
              <div class="form-group">
                <select class="form-control" id="exampleFormControlSelect1" name="id_modulo">
                  <option disabled selected>Selecciona el curso que quieres editar</option>
                  <?php
                  $consulta = mysqli_query($mysqli, "SELECT * FROM modulos WHERE id_autor = '".$row['id']."'");
                  while ($micurso = mysqli_fetch_array($consulta)) {
                  ?>
                  <option value="<?php echo $micurso['id']; ?>"><?php echo $micurso['titulo']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Editar Curso</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Crear Clase Modal-->
<div class="modal fade" id="crearClaseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crea una clase</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form class="" action="server/crearclase.php" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col col-sm-12 py-2 card-body">
              <div class="form-group">
                <label for="nombre">Nombre de la Clase</label>
                <input type="text" name="nombreClase" class="form-control"  id="nombreClase" placeholder="¿Como se llamara la clase?">
              </div>
              <div class="form-group">
                <label for="asignatura">Asignatura</label>
                <input type="text" name="asignatura" class="form-control" id="asignatura" placeholder="¿De qué asignatura es?">
              </div>
              <div class="form-group">
                <label for="curso">Curso</label>
                <input type="text" name="curso" class="form-control" id="curso" placeholder="¿El curso de qué trata?">
              </div>
              <div class="form-group">
                <label for="grupo">Grupo</label>
                <input type="text" name="grupo" class="form-control" id="grupo" placeholder="¿De qué grupo trata?">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Crear Clase</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Editar Clase Modal-->
<div class="modal fade" id="editarClaseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar la clase</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form class="" action="server/editarclase.php" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col col-sm-12 py-2 card-body">
              <div class="form-group">
                <label for="nombre">Nombre de la Clase</label>
                <input type="text" name="nombreClase" class="form-control"  id="nombreClase" placeholder="Elige un nombre para la clase" value="<?php echo $clase['nombreClase']; ?>">
              </div>
              <div class="form-group">
                <label for="asignatura">Asignatura</label>
                <input type="text" name="asignatura" class="form-control" id="asignatura" placeholder="¿De qué asignatura se trata?" value="<?php echo $clase['asignatura']; ?>">
              </div>
              <div class="form-group">
                <label for="curso">Curso</label>
                <input type="text" name="curso" class="form-control" id="curso" placeholder="¿De qué curso se trata?" value="<?php echo $clase['curso']; ?>">
              </div>
              <div class="form-group">
                <label for="grupo">Grupo</label>
                <input type="text" name="grupo" class="form-control" id="grupo" placeholder="¿De qué grupo se trata?" value="<?php echo $clase['grupo']; ?>">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <div>
            <button type="submit" class="btn btn-primary">Editar Clase</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          </div>
          <input type="hidden" name="btn_editar" value="<?php echo $clase['id']; ?>">
          <button class="btn btn-danger" type="submit" data-toggle="modal" data-target="#borrarCuModal" data-dismiss="modal">Borrar Clase</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Borrar Curso Modal-->
<div class="modal fade" id="borrarCuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quieres borrar esta clase?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form class="" action="server/borrarclase.php" method="post">
      <div class="modal-body">
      <br><br><span class="text-danger">NOTA: Una vez borrado no es posible recuperlo, tendras que crear uno nuevo.</span></div>
      <div class="modal-footer">
        <input type="hidden" name="btn_borrar" value="<?php echo $clase['id']; ?>">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-danger">Borrar</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Unirse a una Clase Modal-->
<div class="modal fade" id="unirClaseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Unirse a una clase</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form class="" action="server/uniraclase.php" method="post">
        <div class="modal-body">
          <div class="row">
            <div class="col col-sm-12 py-2 card-body">
              <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" class="form-control form-control-lg" name="codigo" id="codigo" placeholder="Introduce el código de la clase">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Unirse a la Clase</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Preguntas frecuentes login Modal -->
<div class="modal fade" id="faqloginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Preguntas Frecuentes</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="accordion" class="ayuda-accord">
          <div class="card">
            <div class="card-header">
              <a class="nav-link collapsed faq" data-toggle="collapse" href="#collapseFour">
                ¿Al proporcionar mis datos puedo confiar que estaran seguros?
              </a>
            </div>
            <div id="collapseFour" class="collapse" data-parent="#accordion">
              <div class="card-body">
                Claro que si, la seguridad de nuestros usuarios es lo mas importante. Hemos tomado medidas como la encriptacion de las contraseñas en la base de datos
                lo cual ningun usuario podra verla ni siquiera los administradores.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <a class="nav-link collapsed faq" data-toggle="collapse" href="#collapseOne">
                ¿Que hago si no me llega el correo de activacion?
              </a>
            </div>
            <div id="collapseOne" class="collapse" data-parent="#accordion">
              <div class="card-body">
                <sapn>Ponte en contacto con nosotros y en breve activaremos tu cuenta: <a href="mailto:project.quizgram@gmail.com">project.quizgram@gmail.com</a></sapn>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <a class="nav-link collapsed faq" data-toggle="collapse" href="#collapseTwo">
                ¿En cuanto tiempo aparece el correo de activacion en mi email?
              </a>
            </div>
            <div id="collapseTwo" class="collapse" data-parent="#accordion">
              <div class="card-body">
                Por lo regular de 1 a 2 minutos dependera del servidor web.
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <a class="nav-link collapsed faq" data-toggle="collapse" href="#collapseThree">
                ¿En que carpetas de mi email deberia encontrar el correo de activacion?
              </a>
            </div>
            <div id="collapseThree" class="collapse" data-parent="#accordion">
              <div class="card-body">
                Por lo general en la bandeja principal, pero hay casos que lo marca como spam y lo manda a correo no deseado.
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <a class="nav-link collapsed faq" data-toggle="collapse" href="#collapseFive">
                ¿Puedo iniciar la misma session en dispositivos diferentes?
              </a>
            </div>
            <div id="collapseFive" class="collapse" data-parent="#accordion">
              <div class="card-body">
                Claro, tienes la libertad de utilizar la app en donde sea, en la computadora o dispositivo movil.
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="button" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="borrarCuentaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $row['user']; ?> Lamentamos que decidad irte.</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <span>¿Estas seguro de que quieres borrar tu cuenta?</span>
      <br><br>
      <span class="text-danger">NOTA: Perderas toda informacion como tus clases, cursos, asignaciones, registro de asistencias y calificaciones de tus alumnos.
      Una vez hecho el proceso no podras recuperar la cuenta.
      </span>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-danger" href="#">Borra cuenta</a>
      </div>
    </div>
  </div>
</div>
