<?php

namespace App\ado;



/**
 * TSqlInstruction.class [ ABSTRACT ]
 * Esta classe provê os métodos em comum entre todas as instruções
 * SQL (SELECT, INSERT, DELETE E UPDATE)
 * @copyright (c) 2018, Carlos Junior
 */
abstract class TSqlInstruction
{
    protected $Sql; //armazena a instrução SQL
    /** @var TCriterio */
    protected $Criterio; //armazena o objeto critério
    protected $Entity; //armazena a tabela

    /** @var PDOStatement */
    protected static $Statement;

    /** @var PDO */
    protected static $Conn;

    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */

    //Obtém o PDO e Prepara a query
    protected function Connect()
    {
        self::$Conn = TConn::getInstance();
        self::$Statement = self::$Conn->prepare($this->Sql);

        $logger = TTransaction::getLogger();

        if (!isset($logger)) :
            TTransaction::setLogger(new TLoggerHTML('logs/InstrucoesSQL.html'));
        endif;


        TTransaction::Log($this->Sql);
    }

    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */

    /** <b>Metodo setEntity</b>
     * Define o nome da entidade (tabela) manipulada pela instrução SQL
     * @param $Entity = tabela
     * */
    final public function setEntity($Entity)
    {
        $this->Entity = strtolower($Entity);
    }

    /** <b>Metodo getEntity</b>
     * Retorna o nome da entidade (tabela) manipulada pela instrução SQL
     * @return string = tabela
     * */
    final public function getEntity()
    {
        return $this->Entity;
    }

    /** <b>Metodo setCriterio</b>
     * Define um critério de seleção dos dados através da composição de um objeto
     * do tipo TCriterio, que oferece uma interface para definição de critérios
     * @param $Criterio = objeto do tipo TCriterio
     * */
    public function setCriterio(TCriterio $Criterio)
    {
        $this->Criterio = $Criterio;
    }

    /** <b>Metodo getInstruction</b>
     * Declarando-o como <abstract> obrigando sua declaração nas classes filhas,
     * uma vez que seu comportamento será distinto em cada uma delas. Usando o conceito de polimorfismo.
     * */
    abstract protected function getInstruction();

    /** <b>Metodo Execute</b>
     * Declarando-o como <abstract> obrigando sua declaração nas classes filhas,
     * uma vez que seu comportamento será distinto em cada uma delas. Usando o conceito de polimorfismo.
     * */
    abstract public function Execute();
}
