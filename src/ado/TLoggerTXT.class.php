<?php

namespace App\ado;

/**
 * TLoggerTXT.class [ LOGGER ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class TLoggerTXT extends TLogger
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */

    public function write($message)
    {
        $time = date("Y-m-d H:i:s");

        //monta a string
        $text = "$time :: $message\n";

        //adiciona ao final do arquivo
        $handler = fopen($this->FileName, 'a');
        fwrite($handler, $text);
        fclose($handler);
    }
}
