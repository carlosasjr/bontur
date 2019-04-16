<?php
if (empty($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

use App\model\TPerfilRecord;

?>


<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-primary">Novo Perfil</button>
                <br>
                <br>

                <?php

                $delCat = filter_input(INPUT_GET, 'delete', FILTER_VALIDATE_INT);

                if ($delCat) :
                    $deletar = new TPerfilRecord($delCat);

                    if (!is_null($deletar->id)) {
                        try {
                            $deletar->delete($delCat);
                            WSErro('Perfil deletado. ', WS_ACCEPT, 'Sucesso');
                        } catch (Exception $e) {
                            //exibe a mensagem gerada pela exceção
                            WSErro($e->getMessage(), WS_ERROR, 'Oppsss');
                        }
                    } else {
                        WSErro('Perfil não encontrado', WS_ERROR, 'Oppsss');
                    }


                endif;
                ?>


                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Perfil do usuário</strong>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tabPerfil">
                                <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Descrição</th>
                                    <th>Ação</th>
                                </tr>
                                </thead>

                                <?php
                                $perfis = new TPerfilRecord();
                                $dados = $perfis->getAllPerfil();

                                if ($dados) : ?>
                                    <tbody>
                                    <?php
                                    /* @var TPerfilRecord $inscricao */
                                    foreach ($dados as $perfil) :
                                        ?>
                                        <tr>
                                            <td><?= $perfil->id; ?></td>
                                            <td><?= $perfil->descricao; ?></td>
                                            <td><a href="index.php?exe=perfil/index&verid=<?= $perfil->id; ?>"
                                                ><img src="icons/act_edit.png">
                                                </a>
                                                <a
                                                        href="index.php?exe=perfil/index&delete=<?= $perfil->id; ?>"
                                                ><img src="icons/act_delete.png"></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                    </tbody>

                                <?php endif; ?>

                        </div>
                    </div>
                </div>


            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
</div>
