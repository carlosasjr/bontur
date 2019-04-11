<!DOCTYPE html>
<?php
session_start();

if (empty($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

require 'vendor/autoload.php';

?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>Title</title>
</head>
<body>
<h1>Area Restrita</h1>
<?php


?>

</body>
</html>

