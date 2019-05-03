<?php
require '../../../../vendor/autoload.php';

use App\model\TCategoriasRecord;

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);

$Action = $Post['action'];
$jSon = array();
unset($Post['action']);


switch ($Action) :
    case 'read':
        $registro = new TCategoriasRecord($Post['regID']);
        if ($registro) {
            $jSon['registro'] = $registro->toArray();
        } else {
            $jSon['error'] = true;
        }
        break;

    case 'create':
        if (in_array('', $Post)) {
            $jSon['error'] = true;
            $jSon['mensagem'] = "<b>Opss:</b> Para cadastrar uma categoria. Preencha todos os campos!";
        } else {
            $registro = new TCategoriasRecord();
            $registro->fromArray($Post);
            $registro->store();

            $jSon['error'] = false;
            $jSon['success'] = "Cadastro com Sucesso!";

            $html = <<<TABELA
            <tr id="{$registro->id}">
                <td>{$registro->id}</td>
                <td>$registro->descricao</td>
                <td>
                   <button class="btn btn-dark j_edit" rel="{$registro->id}">
                      Editar
                   </button>
                   <button class="btn btn-danger j_delete" rel="{$registro->id}">
                      Excluir
                   </button>
                </td>
            </tr>     
TABELA;

            $jSon['result'] = $html;
        }

        break;


    case 'update':
        if (in_array('', $Post)) {
            $jSon['error'] = true;
            $jSon['mensagem'] = "<b>Opss:</b> Para cadastrar uma categoria. Preencha todos os campos!";
        } else {
            $registro = new TCategoriasRecord();
            $registro->fromArray($Post);
            $registro->store();

            $jSon['error'] = false;
            $jSon['success'] = "Alterado com Sucesso!";

            //update não mando a tr, somente os td que serão atualizados.
            $html = <<<TABELA
                <td>{$registro->id}</td>
                <td>$registro->descricao</td>
                <td>
                   <button class="btn btn-dark j_edit" rel="{$registro->id}">
                      Editar
                   </button>
                   <button class="btn btn-danger j_delete" rel="{$registro->id}">
                      Excluir
                   </button>
                </td>
TABELA;

            $jSon['result'] = $html;
        }

        break;

    case 'delete':
        $registro = new TCategoriasRecord($Post['regID']);

        try {
            if (!$registro->delete()) {
                $jSon['error'] = true;
            }
        } catch (PDOException $e) {
            $jSon['error'] = true;
            $jSon['mensagem'] = 'Não foi possível excluir o registro. <br> Registro vinculado a outra tabela. <br>' . $e->getMessage();
        }
        break;

    default:
        $jSon['error'] = "Erro ao Selecionar Ação!";
        break;
endswitch;

echo json_encode($jSon);
