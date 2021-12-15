<?php 
    session_start();
  
    if(!$_SESSION['id']){
        header('location:login.php');
    }
 
?>

<?php 

$txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre = (isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtImagen = (isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$accion = (isset($_POST['accion']))?$_POST['accion']:"";

include("config.php");

switch ($accion) {
    case "Agregar":
        $sentenciaSQL=$pdo->prepare("INSERT INTO libros (nombre,imagen) VALUES(:nombre,:imagen);"); 
        $sentenciaSQL->bindParam(':nombre',$txtNombre);

        // para cargar la imagen en el formulario y que en caso de que un usuario suba una imagen con el mismo nombre de otra imagen se pondra el nombre establecido por una fecha y el nombre de la imagen
        $fecha = new DateTime();
        $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
        // va a ver una imagen temporal que se pondra en el servidor
        $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

        //validar si la imagen temporal tiene algo y si es diferente a vacio se movera hacia la carpeta img con el nombre del archivo
        if($tmpImagen!=""){
            move_uploaded_file($tmpImagen, "./img/".$nombreArchivo);
        }

        $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
        $sentenciaSQL->execute();

        header("Location:crudlibro.php");
        break;
    
    case "Modificar":
            $sentenciaSQL=$pdo->prepare("UPDATE libros SET nombre=:nombre WHERE id=:id");
            $sentenciaSQL->bindParam(':nombre',$txtNombre);
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();

            // si esta vacio el campo de imagen se modificará
            if($txtImagen!=""){


                $fecha = new DateTime();
            $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
                $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

            move_uploaded_file($tmpImagen, "./img/".$nombreArchivo);

            // con el archivo antiguo de la imagen se procese a eliminar ya     que es reemplazado por el archivo modificado
                $sentenciaSQL=$pdo->prepare("SELECT imagen FROM libros WHERE id=:id");
                    $sentenciaSQL->bindParam(':id',$txtID);
                    $sentenciaSQL->execute();
                    $libro=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

                    // validar si la imagen existe dentro de la carpeta img
                    if(isset($libro["imagen"]) &&($libro["imagen"]!="imagen.jpg")){
                        if(file_exists("./img/".$libro["imagen"])){
                            unlink("./img/".$libro["imagen"]);
                        }
                    }
       

                $sentenciaSQL=$pdo->prepare("UPDATE libros SET imagen=:imagen WHERE id=:id");
                $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
                $sentenciaSQL->bindParam(':id',$txtID);
                $sentenciaSQL->execute();
            }

            header("Location:crudlibro.php");
        break;
    
    case "Cancelar":
            header("Location:crudlibro.php");
        break;

    case "Seleccionar":
            $sentenciaSQL=$pdo->prepare("SELECT * FROM libros WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            $libro=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            $txtNombre=$libro['nombre'];
            $txtImagen=$libro['imagen'];
        break;

    case "Borrar":

                //para borrar la imagen en el servidor
                    $sentenciaSQL=$pdo->prepare("SELECT imagen FROM libros WHERE id=:id");
                    $sentenciaSQL->bindParam(':id',$txtID);
                    $sentenciaSQL->execute();
                    $libro=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

                    // validar si la imagen existe dentro de la carpeta img
                    if(isset($libro["imagen"]) &&($libro["imagen"]!="imagen.jpg")){
                        if(file_exists("./img/".$libro["imagen"])){
                            unlink("./img/".$libro["imagen"]);
                        }
                    }

            $sentenciaSQL=$pdo->prepare("DELETE FROM libros WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();

            header("Location:crudlibro.php");
        break;
    
}

$sentenciaSQL=$pdo->prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
$listarLibros=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Sitio Web de Libros</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="inicio.php">Sitio Web de Libros</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i> <?php echo ucfirst($_SESSION['nombre']); ?></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <!--<li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>-->
                        <li> <a class="dropdown-item" href="logout.php?logout=true"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="inicio.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                Inicio
                            </a>
                            

                            <div class="sb-sidenav-menu-heading">Información de Libros</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Libros
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="crudlibro.php">Registro de Libros</a>
                                </nav>
                            </div>


                            <div class="sb-sidenav-menu-heading">Usuarios</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUsers" aria-expanded="false" aria-controls="collapseUsers">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Registro
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseUsers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="register.php">Registro de Usuarios</a>
                                </nav>
                            </div>
                            
                          
                          
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Desarrollador por:</div>
                            Rixler Corp
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>

 
                   <div class="container mt-5">
                       <div class="row">
                   
                   <div class="col-md-4">

                        <div class="card">
                            <div class="card-header">
                                Datos de los Libros
                            </div>

                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data">
                              <div class="form-group">
                                   <input  name="txtID" id="txtID" class="form-control" value="<?php echo $txtID;?>" type="hidden" placeholder="ID">
                               </div>

                                 <div class="form-group mb-3">
                                   <label class="mb-2"  for="txtNombre">Nombre: </label>
                                
                                       <input  name="txtNombre" required id="txtNombre" class="form-control" value="<?php echo $txtNombre;?>" type="text" placeholder="Nombre del Libro">
                                  
                                 </div>

                                <div class="form-group">
                                   <label class="mb-2"  for="txtImagen">Imagen: </label>
                                   
                                   <!--si existe la imagen se mostarra la misma-->
                                   <?php if($txtImagen!=""){ ?>

                                        <img class="img-thumbnail rounded" src="./img/<?php echo $txtImagen;?>" width="150">
                                        <br><br>
                                     <?php } ?>
                                     
                                 
                                    <input  name="txtImagen" id="txtImagen" class="form-control" type="file">
                                
                                 </div>
                                
                                 <br>
                                <!--desactivar los botones cuando sea requerido-->
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success">Agregar</button>
                                    <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
                                    <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
                                </div>
                                </form>
                            </div>
                        </div>
                </div>


                    <div class="col-md-7">
                        
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Imagen</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($listarLibros as $libro) { ?>
                                    <tr>
                                    <td><?php echo $libro['id']; ?></td>
                                    <td><?php echo $libro['nombre']; ?></td>
                                    <td>

                                        <img class="img-thumbnail rounded" src="./img/<?php echo $libro['imagen']; ?>" width="50">
                                        
                                    </td>
                                    <td>
                                        <form method="POST">
                                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $libro['id']; ?>">
                                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary">
                                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger">
                                        </form>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                         





                       </div>
                   </div>
                   
                </main>
            
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
