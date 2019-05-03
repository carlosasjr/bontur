<?php
if (empty($_SESSION['login'])) {
    header('Location: ../../../login.php');
    exit;
}

use App\model\TUsuariosRecord;

?>


<div class="content mt-3">
    <button class="btn btn-primary" id="j_open" data-toggle="modal" data-target="#formModal">Novo Usuário</button>
    <br>
    <br>

    <div id="formModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Usuários</h5>
                    <button class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>

                <div class="modal-body">
                    <?php require 'formulario.php' ?>
                </div> <!-- MODAL BODY -->


                <div class="modal-footer">
                    <button class="btn btn-primary" id="btnSalvar">Salvar</button>
                    <button class="btn btn-danger" data-dismiss="modal">Fechar</button>

                    <div class="form_load">
                        <img src="public\images\load.gif" alt="[CARREGANDO...]" title="CARREGANDO..."/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form_load">
        <img src="public\images\load.gif" alt="[CARREGANDO...]" title="CARREGANDO..."/>
    </div>

    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Usuários</strong>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tab_list">
                                <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Ação</th>
                                </tr>
                                </thead>

                                <?php
                                $usuarios = new TUsuariosRecord();
                                $dados = $usuarios->getAll();

                                if ($dados) : ?>
                                    <tbody class="j_list">
                                    <?php
                                    /* @var TUsuariosRecord $inscricao */
                                    foreach ($dados as $usuario) :
                                        ?>
                                        <tr id="<?= $usuario->id; ?>">
                                            <td><?= $usuario->id; ?></td>
                                            <td><?= $usuario->nome; ?></td>
                                            <td><?= $usuario->email; ?></td>
                                            <td>
                                                <button class="btn btn-dark j_edit" rel="<?= $usuario->id; ?>">
                                                    Editar
                                                </button>
                                                <button class="btn btn-danger j_delete" rel="<?= $usuario->id; ?>">
                                                    Excluir
                                                </button>
                                            </td>
                                        </tr>


                                    <?php endforeach; ?>

                                    </tbody>

                                <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->







