<?php

namespace App\ado;

/**
 * TLogger.class [ REGISTRO DE LOGS ]
 * Classe abstrata de Logs
 * @copyright (c) 2018, Carlos Junior
 */
abstract class TLogger
{
    protected $FileName;

    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */

    /** <b>Metodo __construct</b>
     * Instancia um logger
     * @param string $FileName = Local do arquivo de Log
     * */
    public function __construct($FileName)
    {
        $this->FileName = $FileName;

        //reseta o conteudo do arquivo
        //file_put_contents($FileName, '');
    }

    abstract public function write($message);
}
