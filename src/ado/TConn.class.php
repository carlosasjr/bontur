<?php

namespace App\ado;

use PDO;
use PDOException;

/**
 * TConn.class [ CONEXÃO ]
 * Classe abstrata de conexão. Padrão SingleTon.
 * Retorna um objeto PDO pelo método estático getConn();
 * @copyright (c) 2018, Carlos Junior
 */
final class TConn
{
    private static $Host = HOST;
    private static $User = USER;
    private static $Pass = PASS;
    private static $Dbsa = DBSA;
    private static $Type = TYPE;

    private static $Instance;

    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */

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

    /**
     * Conecta com o banco de dados com o pattern singleton.
     * Retorna um objeto PDO!
     */
    public static function getInstance()
    {
        try {
            if (self::$Instance == null) :
                switch (self::$Type) {
                    case 'mysql':
                        $dsn = 'mysql:host=' . self::$Host . ';dbname=' . self::$Dbsa;
                        $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8mb4'];
                        self::$Instance = new PDO($dsn, self::$User, self::$Pass, $options);
                        break;

                    case 'sqlite':
                        $dsn = 'sqlite:' . self::$Dbsa;
                        self::$Instance = new PDO($dsn);

                    // no break
                    case 'ibase':
                        $dsn = 'firebird:dbname=' . self::$Dbsa;
                        self::$Instance = new PDO($dsn, self::$User, self::$Pass);
                        break;

                    default:
                        $dsn = 'mysql:host=' . self::$Host . ';dbname=' . self::$Dbsa;
                        $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
                        self::$Instance = new PDO($dsn, self::$User, self::$Pass, $options);
                        break;
                }


            endif;
        } catch (PDOException $e) {
            PHPErro($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
        }

        self::$Instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return self::$Instance;
    }
}
