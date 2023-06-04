<?php

include("config.php");
$sentenciaSQL=$pdo->prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
$listarLibros=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sitio Web de Libros</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>

	 <header class="hero">
        <div class="container">
            <nav class="nav">
                <a href="#ultimo" class="nav__items nav__items--cta">Contactanos</a>
                <a href="#primero" class="nav__items">Libros</a>
                <a href="#segundo" class="nav__items">Nuestros Clientes</a>
                <a href="#cuarto" class="nav__items">Creador</a>
                <a href="libros.php" class="nav__items">Sección de Libros</a>
                <a href="login.php" class="nav__items">Login</a>
            </nav>

            <section class="hero__container">
                <div class="hero__text">
                    <h1 class="hero__title">Sitio Web de Libros</h1>
                    <h2 class="hero__subtitle">Un acceso al mundo de la lectura</h2>
                </div>
            </section>
        </div>
        <div class="hero__wave" style="overflow: hidden;"><svg viewBox="0 0 500 150" preserveAspectRatio="none"
                style="height: 100%; width: 100%;">
                <path d="M0.00,49.99 C150.00,150.00 349.20,-49.99 500.00,49.99 L500.00,150.00 L0.00,150.00 Z"
                    style="stroke: none; fill: #fff;"></path>
            </svg></div>
    </header>

    <main>
         <a name="primero"></a>
        <section class="presentation container">
            <img src="img/imagen.jpg" alt="portafolios" class="presentation__picture">
            <h2 class="subtitle">Sitio Web de Libros</h2>
            <p class="presentation__copy">
                Esta sitio esta diseñado para que todo tipo de personas verifiquen todos los libros con los 
                cuales disponemos para su disposición y puedan leer en nuestras salas de lectura online.
            </p>
           <a href="libros.php" class="presentation__cta">Ver Libros</a>
        </section>
        <section class="about container">
            <div class="about__texts">
                <h2 class="subtitle"> Información </h2>
                <p class="about__paragraph">
                    Usted en este lugar prodra conocer sobre los libros más actualues existentes que le 
                    ayudaran en su área de estudios.
                </p>
                <p class="about__paragraph">
                    Especialmente tendra acceso ilimitado a un gran catálogo de libros. 
                </p>
            </div>
            <figure class="about__img">
                <img src="img/informacion.jpeg" alt="nuevo" class="about__picture">
            </figure>
            <figure class="about__img about__img--left">
                <img src="img/investigacion.jpg" alt="nuevo" class="about__picture">
            </figure>
            <div class="about__texts">
                <h2 class="subtitle"> ¿Cómo Funcionamos? </h2>
                <p class="about__paragraph">
                    Nuestros encargados se encuentran en constante investigación y por ende buscan 
                    los libros actuales y necesarios para toda clase de usuario. 
                </p>
                <p class="about__paragraph">
                    Los libros nuevos se iran publicando cada dos semanas o cuando sea necesario para que 
                    nuestros usuarios esten satisfechos con los servicios que prestamos.
                </p>
            </div>
        </section>

        <section class="projects">
            <a name="segundo"></a>
            <div class="container">
                <h2 class="subtitle">Nuestros Clientes</h2>
                <div class="projects__grid">
                    <article class="projects__items">
                        <img src="img/img8.jpg" alt="imagen2" class="projects__img">
                        <div class="projects__hover">
                            <h2 class="projects__title">Clientes</h2>
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </div>
                    </article>
                    <article class="projects__items">
                        <img src="img/img9.jpg" alt="imagen2" class="projects__img">
                        <div class="projects__hover">
                            <h2 class="projects__title">Clientes</h2>
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </div>
                    </article>
                    <article class="projects__items">
                        <img src="img/img10.jpg" alt="imagen2" class="projects__img">
                        <div class="projects__hover">
                            <h2 class="projects__title">Clientes</h2>
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </div>
                    </article>
                    <article class="projects__items">
                        <img src="img/img11.jpg" alt="imagen2" class="projects__img">
                        <div class="projects__hover">
                            <h2 class="projects__title">Clientes</h2>
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </div>
                    </article>
                     <article class="projects__items">
                        <img src="img/img13.jpg" alt="imagen2" class="projects__img">
                        <div class="projects__hover">
                            <h2 class="projects__title">Clientes</h2>
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </div>
                    </article>
                </div>
            </div>
        </section>
        <section class="testimony container">
            <a name="cuarto"></a>
            <h2 class="subtitle">Creador de Portafolios</h2>

            <div class="testimony__grid">
                <article class="testimony__item">
                    <div class="testimony__person">
                        <img src="img/img12.jpg" alt="usuarios" class="testimony__img">
                        <div class="testimony__texts">
                            <h3 class="testimony__name">Bryan Cachimuel</h3>
                            <p class="testimony__verification">Creador de Aplicación</p>
                        </div>
                    </div>
                    <p class="testimony__review">
                        Me complace entregar a los usuarios este sistema ya que con el podran verificar los libros más
                        actualizados para sus investigaciones. 
                    </p>
                </article>
            </div>
        </section>
    </main>

    <footer class="footer">
        <a name="ultimo"></a>
        <div class="container footer__grid">
            <nav class="nav nav--footer">
                <a class="nav__items nav__items--footer" href="#">Inicio</a>
                <a class="nav__items nav__items--footer" href="#">Sobre mi</a>
                <a class="nav__items nav__items--footer" href="#">Mis skills</a>
                <a class="nav__items nav__items--footer" href="#">Proyectos</a>
            </nav>

            <section class="footer__contact">
                <h3 class="footer__title">Contactame</h3>
                <div class="footer__icons">
                    <span class="footer__container-icons">
                        <a class="fab fa-facebook-square footer__icon" aria-hidden="true" href="#"></a>
                    </span>
                    <span class="footer__container-icons">
                        <a class="fab fa-twitter-square footer__icon" aria-hidden="true" href="#"></a>
                    </span>
                    <span class="footer__container-icons">
                        <a class="fab fa-whatsapp-square footer__icon" aria-hidden="true" href="#"></a>
                    </span>
                    <span class="footer__container-icons">
                        <a class="fab fa-instagram-square footer__icon" aria-hidden="true" href="#"></a>
                    </span>
                </div>
            </section>
        </div>
               <div class="line">
                       <h2 class="titulo-final">&copy; RixlerCorp | Bryan Cachimuel</h2>
               </div>
         
    
    </footer>


</body>
</html>