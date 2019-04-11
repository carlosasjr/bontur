<?php

namespace App\ado;

/**
 * TLoggerHTML.class [ LOGGER ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class TLoggerHTML extends TLogger
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
        $text = "<p>\n";
        $text .= "    <b>$time</b>\n";
        $text .= "    <i>$message</i>\n";
        $text .= "</p>\n";

        //adiciona ao final do arquivo
        $handler = fopen($this->FileName, 'a');
        fwrite($handler, $text);
        fclose($handler);
    }
}
