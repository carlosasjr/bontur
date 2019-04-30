<?php
require '../../../../vendor/autoload.php';

use App\model\TPerfilRecord;
use App\model\TUsuariosRecord;

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);

$Action = $Post['action'];
$jSon = array();
unset($Post['action']);


switch ($Action) :
    case 'getPerfis':
        $perfis = new TPerfilRecord();
        $dados = $perfis->getAllPerfil();
        $html = '';

        /* @var TPerfilRecord $inscricao */
        foreach ($dados as $perfil) :
            $selected = (isset($Post['option']) && ($Post['option'] == $perfil->id)) ? 'selected' : '';
            $html .= <<<TABELA
            <option value = {$perfil->id} {$selected}>$perfil->descricao</option>  
TABELA;
        endforeach;

        $jSon['resultado'] = $html;

        break;


    case 'read':
        $registro = new TUsuariosRecord($Post['regID']);
        if ($registro) {
            $jSon['registro'] = $registro->toArray();
        } else {
            $jSon['error'] = true;
        }
        break;

    case 'create':
        $registro = new TUsuariosRecord();

        if ($registro->existeEmail($Post['email'])) {
            $jSon['error'] = true;
            $jSon['mensagem'] = '<b>Opps....</b> E-mail já cadastrado!';
        } else {
            $Post['ip'] = $_SERVER['REMOTE_ADDR'];
            $Post['status'] = (isset($Post['status'])) ? 0 : 1;


            $registro->fromArray($Post);
            $registro->store();

            $jSon['error'] = false;
            $jSon['success'] = "Cadastro com Sucesso!";

            $html = <<<TABELA
            <tr id="{$registro->id}">
                <td>{$registro->id}</td>
                <td>$registro->nome</td>
                <td>$registro->email</td>
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
        $registro = new TUsuariosRecord();
        $Post['senha'] = md5($Post['senha']);
        $registro->fromArray($Post);
        $registro->store();

        $jSon['error'] = false;
        $jSon['success'] = "Alterado com Sucesso!";

        //update não mando a tr, somente os td que serão atualizados.
        $html = <<<TABELA
                <td>{$registro->id}</td>
                <td>$registro->nome</td>
                <td>$registro->email</td>
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
        $registro = new TUsuariosRecord($Post['regID']);

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
