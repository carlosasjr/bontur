<?php

/**
 * .class [ TIPO ]
 *
 * @copyright (c) 2018, Carlos Junior
 */

namespace App\model;

class Check
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */


    /**
     * <b>realTofloat:</b> Ao executar este HELPER, ele automaticamente formata o valor para ser aceito no banco
     * @return double = valor formatado para mysql!
     */
    public static function realTofloat($get_valor)
    {
        $source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto
        return $valor; //retorna o valor formatado para gravar no banco
    }

    /**
     * <b>floatToReal:</b> Ao executar este HELPER, ele automaticamente formata o valor para um valor em Real
     * @return double = valor formatado para Real!
     */
    public static function floatToReal($get_valor)
    {
        return number_format($get_valor, 2,',', '.');
    }
}