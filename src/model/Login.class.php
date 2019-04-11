<?php

/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */

namespace App\model;

use App\ado\TCriterio;
use App\ado\TFilter;
use App\ado\TRepository;

class Login
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

        $usuarios = new TRepository('Usuarios');
        $usuarios = $usuarios->load($criterio);

        if ($usuarios) {
            foreach ($usuarios as $usuario) {
                $_SESSION['login'] = $usuario->id;
                return true;
            }
        }


        return false;


    }
}
