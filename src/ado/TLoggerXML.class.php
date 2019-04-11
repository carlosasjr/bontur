<?php

namespace App\ado;

/**
 * TLoggerXML.class [ LOGGER ]
 *
 * @copyright (c) 2018, Carlos Junior
 */
class TLoggerXML extends TLogger
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
        $xml = "<log>\n";
        $xml .= "   <time>$time</time>\n";
        $xml .= "   <message>$time</message>\n";
        $xml .= "</log>\n";


        //adiciona ao final do arquivo
        $handler = fopen($this->FileName, 'a');
        fwrite($handler, $xml);
        fclose($handler);
    }
}
