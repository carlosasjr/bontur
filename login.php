<!DOCTYPE html>
<?php
session_start();

require 'vendor/autoload.php';

use App\model\Login;


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($dados) && $dados['formLogin']) {
    $email = $dados['email'];
    $senha = md5($dados['senha']);

    $usuario = new Login();

    if ($usuario->login($email, $senha)) {
        header("Location: index.php");
        exit;
    } else {
        $erroLogin = "<br><br><small class='error'>E-mail e/ou Senha inválidos!</small>";
    }
}


?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>Sistema de Login - Bontur Bondinhos Aéreos</title>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="css/styleLogin.css">
    <link type="text/css" rel="stylesheet" href="css/alertify.bootstrap.css">
    <link type="text/css" rel="stylesheet" href="css/alertify.default.css"/>
</head>
<body>
<section class="login-block">
    <div class="container">
        <div class="row">
            <div class="col-md-4 login-sec">
                <h2 class="text-center">Login</h2>
                <form class="login-form" id="formLogin" method="post">
                    <div class="form-group">
                        <label for="email" class="text-uppercase">E-mail</label>
                        <input type="email" class="form-control" placeholder="" autofocus id="email" name="email">

                    </div>
                    <div class="form-group">
                        <label for="senha" class="text-uppercase">Senha</label>
                        <input type="password" class="form-control" placeholder="" id="senha" name="senha">
                        <a href="esqueci.php">
                            <small>Esqueci a senha</small>
                        </a>
                    </div>


                    <div class="form-check">
                        <a href="registrar.php" class="btn btn-primary float-right">Registrar-se</a>
                        <input type="submit" class="btn btn-login float-right" name="formLogin" value="Entrar">
                    </div>
                </form>


                <div class="copy-text">Criado por by <a href="http://www.carlosasjr.com.br">carlosasjr.com.br</a>
                </div>

                <?php
                if (!empty($erroLogin)) {
                    echo $erroLogin;
                }
                ?>
            </div>
            <div class="col-md-8 banner-sec">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="d-block img-fluid"
                                 src="src/views/imagens/Bontur-Bondinhos-Aereos-Aparecida-SP-1121.jpg"
                                 alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <div class="banner-text">
                                    <h2>This is Heaven</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid"
                                 src="src/views/imagens/Bontur-Bondinhos-Aereos-Aparecida-SP-59.jpg"
                                 alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <div class="banner-text">
                                    <h2>This is Heaven</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid"
                                 src="src/views/imagens/Bontur-Bondinhos-Aereos-Aparecida-SP-168.jpg"
                                 alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <div class="banner-text">
                                    <h2>This is Heaven</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</section>


<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/additional-methods.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/jquery.mask.min.js"></script>
<script type="text/javascript" src="js/bootstrap.bundle.js"></script>
<script type="text/javascript" src="js/alertify.min.js"></script>
<script src="js/localization/messages_pt_BR.min.js" type="text/javascript"></script>
<script type="text/javascript" rel="script" src="js/scriptLogin.js"></script>
</body>
</html>


}