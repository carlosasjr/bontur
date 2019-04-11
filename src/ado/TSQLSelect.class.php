<?php

namespace App\ado;

use Respect\Validation\Rules\Lowercase;

/**
 * TSQLSelect [ SQLInstruction ]
 * Esta classe provê meios para manipulação de uma instrução de SELECT no banco de dados
 * @copyright (c) 2018, Carlos Junior
 */


class TSQLSelect extends TSqlInstruction
{
    const FETCH_ALL = 'fetchAll';
    const FETCH_OBJECT = 'fetchObject';

    private $Result;
    private $Columns; //Array de colunas do Select

    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */

    private function getTermos()
    {
        if ($this->Criterio) :
            $this->Sql .= ' WHERE ' . $this->Criterio->dump();

            $order = $this->Criterio->getProperty('order');

            $limit = $this->Criterio->getProperty('limit');

            $offset = $this->Criterio->getProperty('offset');


            if ($order) :
                $this->Sql .= ' ORDER BY ' . $order;
            endif;

            if ($limit) :
                $this->Sql .= ' LIMIT ' . $limit;
            endif;

            if ($offset) :
                $this->Sql .= ' OFFSET ' . $offset;
            endif;

        endif;
    }

    private function getObjetos($object = null, $colletion = null)
    {
        if ($colletion) {
            $objetos = array();

            while ($row = parent::$Statement->fetchObject($object)) :
                $objetos[] = $row;
            endwhile;

            return $objetos;
        }

        return parent::$Statement->fetchObject(get_class($object));
    }

    /**
     * método getColumns
     * Retorna as colunas em formato de string, com implode
     * @return string
     */
    protected function getColumns()
    {
        //realiza o implode das colunas
        return implode(', ', $this->Columns);
    }

    /** <b>Metodo getInstruction</b>
     * Retorna a instrução de SELECT em forma de string
     * @return string Instrução SQL- SELECT
     * */
    protected function getInstruction()
    {
        $this->Sql = "SELECT ";

        $this->Sql .= $this->Columns ? $this->getColumns() : '*';

        $this->Sql .= " FROM {$this->Entity}";

        $this->getTermos();
    }



    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */

    /** <b>Metodo __construct</b>
     * Instancia um novo objetio do tipo SQLSelect
     * @param String $Entity = 'Nome da Tabela'
     * @param TCriterio $Criterio = Objeto do tipo TCriterio
     *  */
    public function __construct($Entity = null, TCriterio $Criterio = null)
    {
        $this->Entity = (string) $Entity;

        if (isset($Criterio)) :
            $this->setCriterio($Criterio);
        endif;
    }

    /** <b>Metodo addColumn</b>
     * Adiciona uma coluna no SELECT [$Coluna]
     * @param String $Coluna = 'Coluna'
     *  */
    public function addColumn($Coluna)
    {
        $this->Columns[] = $Coluna;
    }

    /**
     * <b>Metodo getResult:</b> Retorna um array ou um objeto com todos os resultados obtidos.
     * Envelope primário númérico. Para obter
     * um resultado chame o índice getResult()[0]! se for um fechtAll
     * @return ARRAY $this = Array ResultSet
     */
    public function getResult()
    {
        return $this->Result;
    }


    /** <b>Metodo Execute</b>
     * Executa a instrução SELECT no banco de Dados
     * @param string $fetch_style
     * @param null $object
     * @param null $colletion = Informar TRUE para percorrer os registro e retornar objetos
     * @return Saida da função
     */
    public function Execute($fetch_style = self::FETCH_ALL, $object = null, $colletion = null)
    {
        $this->getInstruction();

        parent::Connect();

        try {
            parent::$Statement->execute();

            if ($fetch_style != self::FETCH_ALL) :
                return $object ? $this->Result = $this->getObjetos(
                    $object,
                    $colletion
                ) : $this->Result = parent::$Statement->fetchObject();
            endif;

            $this->Result = parent::$Statement->fetchAll();

        } catch (PDOException $e) {
            WSErro("<b>Erro ao executar a consulta:</b> {$e->getMessage()}", $e->getCode());
        }
    }

    /** <b>Metodo FullSQL</b>
     * Executa a instrução SELECT no banco de Dados
     *  */
    public function FullSQL($Sql)
    {
        $this->Sql = $Sql;

        parent::Connect();

        try {
            parent::$Statement->execute();
            $this->Result = parent::$Statement->fetchAll();
        } catch (PDOException $e) {
            WSErro("<b>Erro ao executar a consulta:</b> {$e->getMessage()}", $e->getCode());
        }
    }
}
