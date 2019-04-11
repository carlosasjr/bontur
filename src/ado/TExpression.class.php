<?php

namespace App\ado;

/**
 * TExpression.class [ ABSTRATA ]
 * Classe base para gerar as expressões WHERE
 * @copyright (c) 2018, Carlos Junior
 */
abstract class TExpression
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */

    //operadores lógicos
    const AND_OPERATOR = 'AND ';
    const OR_OPERATOR = 'OR ';

    //marca método dump como obrigatório
    abstract public function dump();

    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */
}
