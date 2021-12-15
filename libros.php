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
    <link rel="stylesheet" type="text/css" href="css/estilos.css">

</head>
<body>

	 <header class="hero_libros">
        <div class="container">
            <nav class="nav">
                 <a href="index.php" class="nav__items nav__items--cta">Sistema Web de Libros</a>
                <a href="libros.php" class="nav__items">Sección de Libros</a>
                <a href="login.php" class="nav__items">Login</a>
            </nav>

            
               <div class="container_libros mt-5">
                       <div class="row">
                       <?php foreach($listarLibros as $lb){?>
                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="./img/<?php echo $lb['imagen']?>" alt="">
                            <div class="card-body">
                                <div class="card-title"><?php echo $lb['nombre'];?></div>
                            </div>

                        </div>
                    </div>
                    <?php } ?>
                       </div>
                   </div>
          
        </div>
     
    </header>

    <main>
        
    </main>

   

</body>
</html>