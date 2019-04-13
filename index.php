<!DOCTYPE html>
<?php
ob_start();
session_start();

use App\model\TUsuariosRecord;

if (empty($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

require 'vendor/autoload.php';

$id = $_SESSION['login'];
$usuario = new TUsuariosRecord($id);
$nome = $usuario->nome;

?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>Title</title>
</head>
<body>
<h1>Area Restrita</h1>

<h2>Olá <?= $nome; ?></h2>

<a class="btn btn-primary" href="sair.php">Sair</a>
<?php


?>

</body>
</html>

<?php
ob_end_flush();

