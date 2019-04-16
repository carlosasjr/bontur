<?php
ob_start();
session_start();


if (empty($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

require 'vendor/autoload.php';

use App\model\TUsuariosRecord;

$id = $_SESSION['login'];
$usuario = new TUsuariosRecord($id);
$nome = $usuario->nome;

$logoff = filter_input(INPUT_GET, 'logoff', FILTER_VALIDATE_BOOLEAN);
$getexe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);

?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <title>Title</title>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,800' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/reset.css"/>
        <link rel="stylesheet" href="css/admin.css"/>
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-dark rounded-bottom" style="background-color: #069;">

                    <?php
                    //ATIVA MENU
                    if (isset($getexe)) :
                        $linkto = explode('/', $getexe);
                    else :
                        $linkto = array();
                    endif;
                    ?>

                    <a class="navbar-brand" href="#">Dasboard</a>

                    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="navbar-collapse collapse" id="navbarMenu">
                        <div class="navbar-nav">
                            <a href="index_old.php?exe=categorias/create" class="nav-item nav-link <?php if (in_array('categorias', $linkto)) {
                                echo ' active';
                            } ?>" >Categorias</a>
                            <a href="index_old.php?exe=produtos/create" class="nav-item nav-link <?php if (in_array('produtos', $linkto)) {
                                echo ' active';
                            } ?>">Produtos</a>
                            <a href="index_old.php?exe=comprar/create" class="nav-item nav-link <?php if (in_array('comprar', $linkto)) {
                                echo ' active';
                            } ?>">Comprar</a>
                            <a href="index_old.php?exe=pontuacao/create" class="nav-item nav-link <?php if (in_array('pontuacao', $linkto)) {
                                echo ' active';
                            } ?>">Pontuação</a>
                        </div>
                    </div>

                    <div class="navbar-nav">
                        <div id="nomeBar" class="text-white d-flex align-items-center" style="font-family: Open Sans">
                            Olá <?= $nome ?> </div>
                        <a href="index_old.php?exe=users/profile" class="nav-item nav-link" data-toggle="tooltip" data-placement="right" title="Clique aqui para editar o Perfil."><img src="icons/profile.png"></a>
                        <a href="index_old.php?exe=users/users" class="nav-item nav-link" data-toggle="tooltip" data-placement="right" title="Clique aqui para editar o Usuário"><img src="icons/users.png"></a>
                        <a href="sair.php" class="nav-item nav-link" data-toggle="tooltip" data-placement="right" title="Clique aqui para sair do sistema."><img src="icons/logout.png"></a>
                    </div>
                </nav>
            </div>
        </div>

        <div id="painel">
            <?php
            //QUERY STRING
            if (!empty($getexe)) :
                $includepatch = __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . strip_tags(trim($getexe) . '.php');
            else :
                $includepatch = __DIR__ . DIRECTORY_SEPARATOR;
            endif;


            if (file_exists($includepatch)) :
                require_once($includepatch);
            else :
                echo "<div class=\"content notfound\">";
                WSErro("<b>Erro ao incluir tela:</b> Erro ao incluir o controller /{$getexe}.php!", WS_ERROR);
                echo "</div>";
            endif;
            ?>
        </div> <!-- painel -->

        <footer class="main_footer">
            <a href="http://www.carlosasjr.com.br/bontur" target="_blank" title="Bontur ">&copy; Carlosasjr - Todos os
                Direitos
                Reservados</a>
        </footer>
    </div>

    </body>

    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/additional-methods.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/jquery.mask.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.js"></script>
    <script src="js/localization/messages_pt_BR.min.js" type="text/javascript"></script>
    <script src="js/script.js" type="text/javascript"></script>
    </html>
<?php
ob_end_flush();
