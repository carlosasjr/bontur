<?php
if (empty($_SESSION['login'])) {
    header('Location: ../../../login.php');
    exit;
}

use App\model\TCategoriasRecord;

?>


<div class="content mt-3">

    <button class="btn btn-primary" id="j_open" data-toggle="modal" data-target="#formModal">Nova Categoria</button>
    <br>
    <br>

    <div id="formModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Categoria</h5>
                    <button class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>

                <div class="modal-body">

                    <form method="post" id="formPost" name="formPost">
                        <input class="noclear" type="hidden" name="action" value="create">

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-12">
                                    <label for="descricao">Descrição</label>
                                    <input type="text" name="descricao" id="descricao" class="form-control" autofocus>
                                </div>
                            </div>
                        </div>

                    </form>

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
                        <strong class="card-title">Categorias de Produtos</strong>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tab_list">
                                <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Descrição</th>
                                    <th>Ação</th>
                                </tr>
                                </thead>

                                <?php
                                $categoria = new TCategoriasRecord();
                                $dados = $categoria->getAll();

                                if ($dados) : ?>
                                    <tbody class="j_list">
                                    <?php
                                    /* @var TCategoriasRecord $inscricao */
                                    foreach ($dados as $categoria) :
                                        ?>
                                        <tr id="<?= $categoria->id; ?>">
                                            <td><?= $categoria->id; ?></td>
                                            <td><?= $categoria->descricao; ?></td>
                                            <td>
                                                <button class="btn btn-dark j_edit" rel="<?= $categoria->id; ?>">
                                                    Editar
                                                </button>
                                                <button class="btn btn-danger j_delete" rel="<?= $categoria->id; ?>">
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

<script src="js/script.js"></script>





