<?php

/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */

namespace App\model;

use App\ado\TRecord;
use App\ado\TCriterio;
use App\ado\TFilter;
use App\ado\TSQLSelect;

class TUsuariosRecord extends TRecord
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */

    public function login($email, $senha)
    {
        //cria um critério de seleção
        $criterio = new TCriterio();
        //filtra por código do aluno
        $criterio->add(new TFilter('email', '=', $email));
        $criterio->add(new TFilter('senha', '=', $senha));

        $sql = new TSQLSelect('Usuarios', $criterio);
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
}
