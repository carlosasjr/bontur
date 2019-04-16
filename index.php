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
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Bontur Bondinhos Aéreos</title>
        <meta name="description" content="Bontur Bondinhos Aéreos">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <link rel="stylesheet" href="public/vendors/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="public/vendors/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="public/vendors/themify-icons/css/themify-icons.css">
        <link rel="stylesheet" href="public/vendors/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" href="public/vendors/selectFX/css/cs-skin-elastic.css">
        <link rel="stylesheet" href="public/vendors/jqvmap/dist/jqvmap.min.css">

        <link rel="stylesheet" href="public/assets/css/style.css" type="text/css">
        <link rel="stylesheet" href="css/admin.css" type="text/css">

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    </head>

    <body>
    <?php require_once 'public/menu.php' ?>

    <div id="right-panel" class="right-panel">
        <?php require_once 'public/header.php' ?>

        <!-- Right Panel -->
        <div id="painel">
            <?php
            //QUERY STRING
            if (!empty($getexe)) :
                $includepatch = __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'system' .
                    DIRECTORY_SEPARATOR . strip_tags(trim($getexe) . '.php');
            else :
                $includepatch = __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'dashboard.php';
            endif;


            if (file_exists($includepatch)) :
                require_once($includepatch);
            else :
                echo "<div class=\"content notfound\">";
                WSErro("Erro ao incluir o controller /{$getexe}.php!", WS_ERROR, 'Erro ao incluir tela');
                echo "</div>";
            endif;
            ?>
        </div> <!-- painel -->
    </div><!-- /#right-panel -->


    <script src="public/vendors/jquery/dist/jquery.min.js"></script>
    <script src="public/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="public/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="public/assets/js/main.js"></script>


    <script src="public/vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="public/assets/js/dashboard.js"></script>
    <script src="public/assets/js/widgets.js"></script>
    <script src="public/vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="public/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="public/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>

    <script src="public/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="public/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="public/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="public/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="public/vendors/jszip/dist/jszip.min.js"></script>
    <script src="public/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="public/vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="public/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="public/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="public/vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="public/assets/js/init-scripts/data-table/datatables-init.js"></script>
    <script type="text/javascript">
        (function ($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>





    </body>

    </html>
<?php
ob_end_flush();
