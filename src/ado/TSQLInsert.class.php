<?php

namespace App\ado;

/**
 * TSQLInsert.class [ SQLInstruction ]
 * Esta classe provê meios para manipulação de uma instrução de INSERT no banco de dados
 * @copyright (c) 2018, Carlos Junior
 */
final class TSQLInsert extends TSqlInstruction
{
    private $Dados; // Array com o Dados para Instrução

    private $Result; //Retorna o Id autoincremento

    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */
    /** <b>Metodo getInstruction</b>
     * Retorna a instrução de INSERT em forma de string
     * @return string Instrução SQL-INSERT
     * */
    protected function getInstruction()
    {
        $this->Sql = "INSERT INTO {$this->Entity} (";

        //monta uma string contendo os nomes de colunas
        $columns = implode(', ', array_keys($this->Dados));

        //monta uma string contendo os valores
        $values = ':' . implode(", :", array_keys($this->Dados));

        $this->Sql .= $columns . ')';
        $this->Sql .= " values ({$values})";
    }

    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */

    /** <b>Metodo __construct</b>
     *Instancia um novo objetio do tipo SQLInsert
     * @param String $Entity = 'Nome da tabela'
     * @param Array $Dados = Array associativo com os dados a serem inseridos [campo => valor]
     **/

    public function __construct($Entity, $Dados)
    {
        $this->Entity = (string)$Entity;
        $this->Dados = (array)$Dados;
    }

    /** <b>Metodo setCriterio</b>
     * Não existe no contexto desta classe, logo, irá lançar um erro ser for executado
     * */
    public function setCriterio(TCriterio $Criterio)
    {
        //lança o erro
        throw new Exception("Cannot call setCriterio from " . __CLASS__);
    }

    /** <b>Metodo Execute</b>
     * Executa uma instrução INSERT no banco de dados
     * Result = Retorna na propriedade [Result] o valor do ID autoincremento.
     **/
    public function Execute()
    {
        $this->getInstruction();

        parent::Connect();

        try {
            parent::$Statement->execute($this->Dados);
            $this->Result = parent::$Conn->lastInsertId();
        } catch (PDOException $e) {
            WSErro("<b>Erro ao executar o cadastro:</b> {$e->getMessage()}", $e->getCode());
            TTransaction::Log('**Rollback**');
            throw new Exception();
        }
    }

    /**
     * <b>Metodo getResult:</b> Retorna
     * Retorna o Id autoincrementado da instrução INSERT
     * @return int = ID autoincrementado
     */
    public function getResult()
    {
        return $this->Result;
    }
}
