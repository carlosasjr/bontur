<?php
require '../../../../vendor/autoload.php';

use App\model\TProdutosRecord;
use App\model\TCategoriasRecord;
use App\model\Check;

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);

$Action = $Post['action'];
$jSon = array();
unset($Post['action']);

switch ($Action) :
    case 'getCategorias':
        $categorias = new TCategoriasRecord();
        $dados = $categorias->getAll();
        $html = '';

        /* @var TCategoriasRecord $categoria */
        foreach ($dados as $categoria) :
            $selected = (isset($Post['option']) && ($Post['option'] == $categoria->id)) ? 'selected' : '';
            $html .= <<<TABELA
            <option value = {$categoria->id} {$selected}>$categoria->descricao</option>  
TABELA;
        endforeach;

        $jSon['resultado'] = $html;

        break;


    case 'read':
        $registro = new TProdutosRecord($Post['regID']);
        if ($registro) {
            $jSon['registro'] = $registro->toArray();
            $jSon['registro']['preco'] = Check::floatToReal($jSon['registro']['preco']);

        } else {
            $jSon['error'] = true;
        }
        break;

    case 'create':
        $registro = new TProdutosRecord();
        $Post['preco'] = Check::realTofloat($Post['preco']);

        $registro->fromArray($Post);
        $registro->store();

        $jSon['error'] = false;
        $jSon['success'] = "Cadastro com Sucesso!";

        $categoria = new TCategoriasRecord($registro->id_categoria);

        $html = <<<TABELA
            <tr id="{$registro->id}">
                <td>{$registro->id}</td>
                <td>$registro->descricao</td>                
                <td>$categoria->descricao</td>
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

        break;


    case 'update':
        $registro = new TProdutosRecord();
        $Post['preco'] = Check::realTofloat($Post['preco']);
        $registro->fromArray($Post);
        $registro->store();

        $jSon['error'] = false;
        $jSon['success'] = "Alterado com Sucesso!";

        //update não mando a tr, somente os td que serão atualizados.

        $categoria = new TCategoriasRecord($registro->id_categoria);
        $html = <<<TABELA
                <td>{$registro->id}</td>
                <td>$registro->descricao</td>
                <td>$categoria->descricao</td>                
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

        break;

    case 'delete':
        $registro = new TProdutosRecord($Post['regID']);


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
