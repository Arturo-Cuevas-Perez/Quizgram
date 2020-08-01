<!DOCTYPE html>
<html class="no-js" lang="es">
<head>
    <meta charset="UTF-8">
    <title>Quizgram | Plataforma Educativa</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="dashboard/css/all.css">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- script
    ================================================== -->
    <script src="js/modernizr.js"></script>
    <script src="js/pace.min.js"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="assets/img/quizgram.svg" type="image/x-icon">
    <link rel="icon" href="assets/img/quizgram.svg" type="image/x-icon">

    <style>
    .home-content h1::before {
      background-color: #117bed;
    }
    </style>
</head>

<body id="top">

    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader" class="dots-jump">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>


    <!-- header
    ================================================== -->
    <header class="s-header">

        <div class="row">
            <div class="header-logo">
                <a class="site-logo" href="index.php">
                    <img src="assets/img/quizgram.svg" alt="Logo Quizgram" style="width:auto;height:55px;margin-bottom:6px;">
                </a>
            </div>

            <nav class="header-nav-wrap">
                <ul class="header-main-nav">
                    <li class="current"><a class="smoothscroll" href="#inicio" title="inicio">Inicio</a></li>
                    <li><a class="smoothscroll" href="#queesquizgram" title="Que es Quizgram">Qué es Quizgram</a></li>
                    <li><a class="smoothscroll" href="#comofunciona" title="Como funciona">Cómo funciona</a></li>
                    <li><a class="smoothscroll" href="#contacto" title="Download">Contacto</a></li>
                </ul>

                <div class="header-cta">
                    <a href="dashboard/auth/login.php" class="btn btn--warning header-cta__btn">INICIAR SESIÓN</a>
                </div>
            </nav>

            <a class="header-menu-toggle" href="#"><span>Menu</span></a>
        </div>

    </header>


    <!-- home

    ================================================== -->
    <section id="inicio" class="s-home target-section" data-parallax="scroll" data-image-src="https://source.unsplash.com/500x400/?study&sig=<?php echo rand(1,999); ?>" data-natural-width=3000 data-natural-height=2000 data-position-y=center>
        <div class="shadow-overlay"></div>

        <div class="home-content">

            <div class="row home-content__main">

                <div class="home-content__left">
                    <h1>
                    Nunca dejes de aprender algo nuevo
                    </h1>

                    <h3>
                    Las nuevas tecnologías se fusionan y fortalecen el aprendizaje, por ello es posible la enseñanza virtual e-Learning.
                    </h3>

                    <div class="home-content__btn-wrap">
                        <a href="dashboard/auth/registro.php" class="btn btn--warning home-content__btn">
                            Registrate
                        </a>
                    </div>
                </div> <!-- end home-content__left-->

                <!--<div class="home-content__right">
                    <img src="" srcset="images/hero-app-screens-800.png 1x, images/hero-app-screens-1600.png 2x">
                </div>-->
               <!-- end home-content__right -->

            </div>

            <ul class="home-content__social">
                <li><a href="">Facebook</a></li>
                <li><a href="">twitter</a></li>
                <li><a href="">Instagram</a></li>
            </ul>

        </div>

        <a href="#footer" class="home-scroll smoothscroll">
            <span class="home-scroll__text">Scroll</span>
            <span class="home-scroll__icon"></span>
        </a>

    </section>


    <!-- about
    ================================================== -->
    <section id="queesquizgram" class="s-about target-section">

        <div class="row section-header has-bottom-sep" data-aos="fade-up">
            <div class="col-full">
                <h1 class="display-1">
                    Simplemente, la mejor forma de enseñar
                </h1>
                <p class="lead">
                    En la actualidad estamos conectados todo el día desde que nos levantamos hasta que nos acostamos, Quizgram nos permite aprender a través de él en cualquier momento.
                </p>
            </div>
        </div>

        <div class="row wide about-desc" data-aos="fade-up">

            <div class="col-full slick-slider about-desc__slider">

                <div class="about-desc__slide">
                    <h3 class="item-title">Intuitivo</h3>

                    <p>
                    Nuestra plataforma es muy sencilla de utilizar, tanto para profesores como para alumnos.
                    </p>
                </div>

                <div class="about-desc__slide">
                    <h3 class="item-title">Único</h3>

                    <p>
                    El aprendizaje es individualizado y lleva el ritmo de cada alumno.
                    </p>
                </div>

                <div class="about-desc__slide">
                    <h3 class="item-title">Seguimiento</h3>

                    <p>
                    Como profesor/a podrás realizar un seguimiento de la evolución del alumnado de una forma muy sencilla.
                    </p>
                </div>

                <div class="about-desc__slide">
                    <h3 class="item-title">Compartido</h3>

                    <p>
                    Los contenidos que ya están en la plataforma son accesibles para todos, pero puedes crear los tuyos y compartirlos con el resto de la comunidad.
                    </p>
                </div>

            </div>

        </div>

    </section>


    <!-- about-how
    ================================================== -->
    <section id="comofunciona" class="s-about-how target-section">

        <div class="row process-wrap">

            <h2 class="display-2 text-center" data-aos="fade-up">¿Cómo funciona?</h2>

            <div class="process" data-aos="fade-up">
                <div class="process__steps block-1-2 block-tab-full group">

                    <div class="col-block step">
                        <h3 class="item-title">Regístrate</h3>
                        <p>Este es un proceso muy sencillo, tanto para ti como para tus alumnos.
                        </p>
                    </div>

                    <div class="col-block step">
                        <h3 class="item-title">Crea tu clase</h3>
                        <p>Crea tu primera clase y anima a tus alumnos a unirse con el código generado.
                        </p>
                    </div>

                    <div class="col-block step">
                        <h3 class="item-title">Asigna un curso</h3>
                        <p>Puedes crear un curso en la plataforma y redactar temas de interés para tus alumnos.
                        </p>
                    </div>

                    <div class="col-block step">
                        <h3 class="item-title">Evalúa</h3>
                        <p>Puedes crear y asignar enunciados personalizados para evaluar el aprendizaje del alumnado.
                        </p>
                    </div>

                </div>
           </div>
        </div>

    </section>

    <!-- download
    ================================================== -->
    <section id="contacto" class="s-download target-section">

        <div class="row section-header align-center" data-aos="fade-up">
            <div class="col-full">
                <h1 class="display-1">
                    ¿Qué esperas para hacer el cambio?
                </h1>
                <p class="lead">
                  Únete a Quizgram ahora mismo y se un motor de cambio.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-full text-center">
              <a href="/dashboard/auth/login.php" title="" class="btn btn--warning header-cta__btn">Iniciar Sesión</a>
            </div>
        </div>

        <!--<div class="row download-bottom-image" data-aos="fade-up">
            <img src="assets/img/app-screen-1400.png"
                alt="App Screenshots">
        </div>-->

    </section>


    <!-- footer
    ================================================== -->
    <footer class="s-footer footer" id="footer">

        <div class="row section-header align-center">
            <div class="col-full">
                <h1 class="display-1" style="color: #ffffff;">
                    Desafia tus limites
                </h1>
                <p class="lead">
                No olvides compartir Quizgram en tu red de contactos.
                </p>
            </div>
        </div>


        <div class="row footer__bottom">

            <div class="footer__about col-five tab-full left">
              <h4>Contacto</h4>
              <p>Puedes ponerte en contacto con nosotros en el correo: <a href="mailto:project.quizgram@gmail.com">project.quizgram@gmail.com</a></p>
            </div>

            <div class="footer__about col-five tab-full right">
                <h4>Acerca del proyecto</h4>
                <p>
                Quizgram es un proyecto modular del Centro Universitario UTEG.
                </p>
                <img src="assets/img/logopagina.png" alt="LogoUTEG">
            </div>

            <div class="col-full ss-copyright">
                <ul class="footer__social">
                  <li><span>&copy; Copyright Quizgram 2020</span></li>
                  <br>
                  <li><a href=""><i class="fab fa-facebook"></i></a></li>
                  <li><a href=""><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                </ul>
            </div>

        </div>

        <div class="go-top">
            <a class="smoothscroll" title="Back to Top" href="#top"></a>
        </div>

    </footer>


    <!-- Java Script
    ================================================== -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

</body>
