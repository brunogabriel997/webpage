<?php

//incluir classes
include_once "../apirest/config/database.php";
include_once "login/login.php";

//base de dados
$database=new Database();
$db=$database->getConnection();
//instanciar objeto categorias
$cat=new iniciar($db);


// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Campo do utilizador vazio.</br></br>";
    } else{
        $username = trim($_POST["username"]);
    }
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Campo da password vazia.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err))
    {
        $st=$cat->procurar($username, $password);
        $num=$st->rowCount();
        if($num > 0)
        {
            if($row = $st->fetch())
            {
                $username2 = $row["username"];
                $password2 = $row["passwords"];

                if($password == $password2 && $username == $username2)
                {
                    header("Location: ../webstore");
                }
                else
                {
                    $username_err = "O username ou a password </br>";
                    $password_err = "    estão incorretas";
                }
            }
        }
        else
        {
            $username_err = "O username ou a password </br>";
            $password_err = "    estão incorretas";
        }


    }

}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- Third party plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="index.html">Atelier da Branca</a><button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.html"><i class="fa fa-undo"></i> Voltar</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10">
                        <h1 class="text-uppercase text-white font-weight-bold">Acesso Administrativo</h1>
                        <hr class="divider my-4" />
                        <div class="d-flex justify-content-center form_container">
                            <div class="wrapper">
                                <h2 style="color: white;"><strong>Login</strong></h2>
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <!-- Campos vazios -->
                                    <div>
                                        <h3>
                                            <span class="badge badge-danger">
                                                <?php echo $username_err; 
                                                echo $password_err;?>
                                            </span>
                                        </h3>

                                    </div>


                                    <!-- Introduzir dados -->
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">User</span>
                                        </div>
                                        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Pass</span>
                                        </div>
                                            <input type="password" name="password" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Login">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>