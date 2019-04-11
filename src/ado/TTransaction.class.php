<?php

namespace App\ado;

/**
 * TConn.class [ TRANSAÇÃO ]
 * Classe final de Transação.
 * Inicia uma transação no banco de dados
 * @copyright (c) 2018, Carlos Junior
 */
final class TTransaction
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */

    /** @var PDO */
    private static $Conn; //Conexão Ativa

    /** @var TLogger */
    private static $Logger; //Objeto de LOG

    /* Método __construct()
     * Está declarado como private para impedir que se crie instância de TTransaction
     */

    private function __construct()
    {

    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
    }

    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */

    /** <b>Metodo Open</b>
     * Inicializa uma transação no banco de dados
     * */
    public static function Open()
    {
        if (empty(self::$Conn)) :
            self::$Conn = TConn::getInstance();
            self::$Conn->beginTransaction();
            self::$Logger = null;
        endif;
    }

    /** <b>Metodo Rollback</b>
     * Interrompe uma transação no banco de dados
     * */
    public static function Rollback()
    {
        if (self::$Conn) :
            self::$Conn->rollBack();
            self::$Conn = null;
        endif;
    }


    /** <b>Metodo Close</b>
     * Fecha uma transação no banco de dados!
     * Executa o Commit
     * */
    public static function Close()
    {
        if (self::$Conn) :
            self::$Conn->commit();
            self::$Conn = null;
        endif;
    }

    /**
     * Método get
     * Retorna a conexão ativa da transação
     * @return PDO
     */
    public static function get()
    {
        if (empty(self::$Conn)) :
            self::$Conn = TConn::getInstance();
        endif;

        //retorna a conexão ativa
        return self::$Conn;
    }


    /** <b>Metodo setLogger</b>
     * Cria um objeto do tipo TLogger com o caminho do arquivo de log
     * @param TLooger $looger
     * */
    public static function setLogger(TLogger $logger)
    {
        self::$Logger = $logger;
    }

    /**
     * @return TLogger
     */
    public static function getLogger()
    {
        return self::$Logger;
    }


    /** <b>Metodo Log</b>
     * Cria uma mensagem no arquivo de Log
     * @param string $message = Mensagem
     * */
    public static function Log($message)
    {
        //verifica se existe um logger
        if (self::$Logger) :
            self::$Logger->write($message);
        endif;
    }
}
