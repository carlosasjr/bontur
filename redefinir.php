<?php
ob_start();
session_start();

require 'vendor/autoload.php';

use App\model\TUsuariosRecord;
use App\model\TUsuariosToken;
use App\ado\TTransaction;

?>

<!DOCTYPE html>
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
            <div class="col-md-5 login-sec" id="redefinir">
                <h2 class="text-center">Redefinir Senha</h2>
                <form class="login-form" id="formLogin" name="formLogin" method="post">
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" placeholder="Senha" id="senha" name="senha">
                    </div>


                    <div class="form-check">
                        <input type="submit" class="btn btn-login float-right" name="formRedefinir" value="Redefinir">
                    </div>
                </form>

                <?php
                $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                $token = filter_input(INPUT_GET, 'token', FILTER_DEFAULT);

                if (!empty($token)) {
                    try {
                        $usuario = new TUsuariosRecord();
                        if (!$usuario->tokenAtivo($token)) {
                            WSErro('<b>Erro:</b> Token inválido ou já utilizado!', WS_ERROR);
                            return false;
                        }

                        if (!empty($dados) && isset($dados['formRedefinir'])) {
                            if (in_array('', $dados)) {
                                WSErro('<b>Oppsss:</b> Senha não informada!', WS_ALERT);
                                return false;
                            }


                            //inicia uma transação com o banco
                            TTransaction::Open();

                            $senha = $dados['senha'];

                            $usuario->senha = md5($senha);
                            $usuario->store();

                            $usuarioToken = new TUsuariosToken();
                            if (!$usuarioToken->desativarToken($token)) {
                                WSErro('<b>Erro:</b> Token inválido ou já utilizado!', WS_ERROR);
                                //inicia uma transação com o banco
                                TTransaction::Close();
                            }

                            //finaliza a transação
                            TTransaction::Close();

                            header("Location: login.php?exe=redefiniu");
                            exit;
                        }
                    } catch (Exception $e) {
                        //exibe mensagem gerada pela exceção
                        echo '<b>Erro</b>' . $e->getMessage();

                        //desfaz todas as alterações no banco de dados
                        TTransaction::Rollback();
                    }
                }
                ?>

            </div>


            <div class="col-md-7 banner-sec">
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
<?php
ob_end_flush();
