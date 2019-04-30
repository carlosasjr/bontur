<?php

namespace App\model;

use App\ado\TRecord;
use App\ado\TCriterio;
use App\ado\TFilter;
use App\ado\TSQLSelect;
use App\ado\TRepository;

class TUsuariosRecord extends TRecord
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */

    private function emailRedefinir($email, $link)
    {
        $mensagem = "Acesse seu e-mail e clique no link para redefinir sua senha: \r\n" . $link;


        $assunto = 'Redefinição de senha';

        $headers = 'From: contato@carlosasjr.com.br' . '\r\n' .
            'XMailer: PHP/' . phpversion();

        mail($email, $assunto, $mensagem, $headers);
    }

    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */

    public function login($email, $senha)
    {
        //cria um critério de seleção
        $criterio = new TCriterio();
        //filtra por email e senha
        $criterio->add(new TFilter('email', '=', $email));
        $criterio->add(new TFilter('senha', '=', $senha));

        $sql = new TSQLSelect('usuarios', $criterio);
        $sql->Execute();

        if ($sql->getResult()) {
            $this->id = $sql->getResult()[0]['id'];

            $_SESSION['login'] = $this->id;

            $this->ip = $_SERVER['REMOTE_ADDR'];

            $this->store();

            return true;
        }


        return false;
    }

    public function existeEmail($email)
    {
        //cria um critério de seleção
        $criterio = new TCriterio();
        //filtra por email
        $criterio->add(new TFilter('email', '=', $email));

        $sql = new TSQLSelect('usuarios', $criterio);
        $sql->Execute();

        if ($sql->getResult()) {
            $this->id = $sql->getResult()[0]['id'];
            return true;
        }

        return false;
    }

    public function gerarToken($email)
    {
        $token = md5(time() . rand(0, 99999) . rand(0, 99999));

        $usuarioToken = new TUsuariosToken();
        $usuarioToken->id_usuario = $this->id;
        $usuarioToken->hash = $token;
        $usuarioToken->expirado_em = date('Y-m-d H:i', strtotime('+1 months'));

        $usuarioToken->store();

        $link = HOME . "/redefinir.php?token=" . $token;

        $this->emailRedefinir($email, $link);
    }

    public function tokenAtivo($token)
    {
        //cria um critério de seleção
        $criterio = new TCriterio();
        //filtra por hass
        $criterio->add(new TFilter('hash', '=', $token));
        $criterio->add(new TFilter('used', '=', '0'));
        $criterio->add(new TFilter('expirado_em', '>', date('Y-m-d')));

        $sql = new TSQLSelect('usuariostoken', $criterio);
        $sql->Execute();

        if ($sql->getResult()) {
            $this->id = $sql->getResult()[0]['id_usuario'];
            return true;
        }

        return false;
    }

    public function getAllUsuarios()
    {
        try {
            //instancia um criterio de seleção
            $criterio = new TCriterio();
            $criterio->add(new TFilter('id', '>', 0));
            $criterio->setProperty('ORDER', 'id');

            //instancia um repositório para Inscrição
            $repository = new TRepository('usuarios');
            //retorna todos objetos que satisfazerem o critério
            return $repository->load($criterio);

        } catch (Exception $e) {
            //exibe a mensagem gerada pela exceção
            WSErro($e->getMessage(), WS_ERROR, 'Oppsss');
        }
    }
}
