<?php
if (empty($_SESSION['login'])) {
    header('Location: ../../../login.php');
    exit;
}

use App\model\TProdutosRecord;
use App\model\TCategoriasRecord;

?>


<div class="content mt-3">

    <button class="btn btn-primary" id="j_open" data-toggle="modal" data-target="#formModal">Novo Produto</button>
    <br>
    <br>

    <div id="formModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Produtos</h5>
                    <button class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>

                <div class="modal-body">

                    <form method="post" id="formPost" name="formPost">
                        <input class="noclear" type="hidden" name="action" value="create">


                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-12">
                                    <label for="id_categoria">Categoria</label>
                                    <select name="id_categoria" id="id_categoria" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-12">
                                    <label for="descricao">Descrição</label>
                                    <input type="text" name="descricao" id="descricao" class="form-control" autofocus>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-12 col-sm-6">
                                    <label for="preco">Preço</label>
                                    <input type="text" name="preco" id="preco" class="form-control">
                                </div>

                                <div class="col-12 col-sm-6">
                                    <label for="preco">Pontos</label>
                                    <input type="number" name="pontos" id="pontos" class="form-control">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-12">
                                    <label for="observacoes">Observações:</label>
                                    <textarea class="form-control" rows="3" id="detalhes"
                                              name="detalhes"></textarea>
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
                        <strong class="card-title">Produtos</strong>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tab_list">
                                <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Descrição</th>
                                    <th>Categoria</th>
                                    <th>Ação</th>
                                </tr>
                                </thead>

                                <?php
                                $produtos = new TProdutosRecord();
                                $dados = $produtos->getAll();

                                if ($dados) : ?>
                                    <tbody class="j_list">
                                    <?php
                                    /* @var TProdutosRecord $inscricao */
                                    foreach ($dados as $produtos) :

                                        $categoria = new TCategoriasRecord($produtos->id_categoria);
                                        ?>
                                        <tr id="<?= $produtos->id; ?>">
                                            <td><?= $produtos->id; ?></td>
                                            <td><?= $produtos->descricao; ?></td>

                                            <td><?= $categoria->descricao; ?></td>
                                            <td>
                                                <button class="btn btn-dark j_edit" rel="<?= $produtos->id; ?>">
                                                    Editar
                                                </button>
                                                <button class="btn btn-danger j_delete" rel="<?= $produtos->id; ?>">
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





