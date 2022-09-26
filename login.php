<?php
session_start();
require_once('config.php');
 
if(isset($_POST['submit']))
{
	if(isset($_POST['email'],$_POST['password']) && !empty($_POST['email']) && !empty($_POST['password']))
	{
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
 
		if(filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$sql = "select * from users where email = :email ";
			$handle = $pdo->prepare($sql);
			$params = ['email'=>$email];
			$handle->execute($params);
			if($handle->rowCount() > 0)
			{
				$getRow = $handle->fetch(PDO::FETCH_ASSOC);
				if(password_verify($password, $getRow['password']))
				{
					unset($getRow['password']);
					$_SESSION = $getRow;
					header('location:inicio.php');
					exit();
				}
				else
				{
					$errors[] = "Error en  Email o Password";
				}
			}
			else
			{
				$errors[] = "Error Email o Password";
			}
			
		}
		else
		{
			$errors[] = "Email no valido";	
		}
 
	}
	else
	{
		$errors[] = "Email y Password son requeridos";	
	}
 
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login</title>

        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="portada">


    <div class="container">
            <nav class="navegar">
                <a href="index.php" class="navegar__items navegar__items--cta">Sistema Web de Libros</a>
            </nav>

            <section class="hero__container">
            <div id="layoutAuthentication">
             <div id="layoutAuthenticatio n_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                    <?php
                                         if (isset($errors) && count($errors) > 0) {
                                             foreach ($errors as $error_msg) {
                                                 echo '<div class="alert alert-danger">' . $error_msg . '</div>';
                                            }
                                        }
                                    ?>
                                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="email" id="inputEmail" type="email" placeholder="name@example.com" />
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="password" id="inputPassword" type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
            
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a></a>
                                                <button type="submit" name="submit" class="btn btn-primary">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!--<div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.php">Registrese!</a></div>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
            </section>
    </div>



       
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
