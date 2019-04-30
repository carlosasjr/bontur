<?php
if (empty($_SESSION['login'])) {
    header('Location: ../../../login.php');
    exit;
}

use App\model\TUsuariosRecord;

$usuario = new TUsuariosRecord($_SESSION['login']);

?>


<div class="content mt-3">
    <div class="form_load">
        <img src="public\images\load.gif" alt="[CARREGANDO...]" title="CARREGANDO..."/>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h4>Minha Conta</h4>
            </div>
        </div>
        <div class="card-body">
            <div id="formModal">
                <?php require 'formulario.php' ?>
            </div>
        </div>

        <div class="card-footer">
            <button class="btn btn-primary" id="btnSalvar">Salvar</button>
        </div>
    </div>
</div><!-- .content -->
