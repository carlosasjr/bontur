<?php

namespace App\ado;

use Exception;

/**
 * TRepository.class [ REPOSITORY ]
 * Esta classe provê os métodos necessários para manipular coleções de objetos
 * @copyright (c) 2018, Carlos Junior
 */
final class TRepository
{
    private $class; //nome da classe manipulada pelo repositório

    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */

    /*
     * Método __construct()
     * Instancia um repositório de objetos
     * @param $class = Classe dos Objetos
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * Método load
     * Recuperar um conjunto de objetos (collection) da base de dados
     * através de um critério de seleção, e instancià-los em memória
     * @param TCriterio $criterio = Objeto do tipo TCriterio
     * @return array
     * @throws Exception
     */
    public function load(TCriterio $criterio)
    {
        //instancia a instrução de SELECT
        $sql = new TSQLSelect();
        $sql->addColumn('*');
        $sql->setEntity($this->class);

        //atribui o critério passado como parâmetro
        $sql->setCriterio($criterio);

        //obtém a transação ativa
        if ($conn = TTransaction::get()) :
            //Executa a consulta no banco de dados

            $objeto = 'App\model\T' . ucwords($this->class) . 'Record';

            $sql->Execute(TSQLSelect::FETCH_OBJECT, $objeto, true);

            //retorna o array de objetos
            return $sql->getResult();
        else :
            //se não existir transação, retorna uma exceção
            throw new Exception('Não há transação ativa!');
        endif;
    }

    /**
     * Método Delete
     * Excluir um conjunto de objetos (collection) da base de dados
     * através de um critério de seleção
     * @param TCriterio $criterio = objeto do tipo TCriterio
     * @return int
     * @throws Exception
     */
    public function delete(TCriterio $criterio)
    {
        //instancia instrução de DELETE
        $sql = new TSQLDelete($this->class, $criterio);

        if ($conn = TTransaction::get()) :
            //executa a instrução de DELETE
            $sql->Execute();
            return $sql->getResult();
        else :
            //se não existir transação, retorna uma exceção
            throw new Exception('Não há transação ativa!');
        endif;
    }

    public function count(TCriterio $criterio)
    {
        //instancia instrução de SELECT
        $sql = new TSQLSelect();
        $sql->addColumn('count(*)');
        $sql->setEntity($this->class);
        //atribui o critério passado como parâmetro
        $sql->setCriterio($criterio);

        if ($conn = TTransaction::get()) :
            //executa a instrução de SELECT
            $sql->Execute();
            if ($sql->getResult()) :
                return $sql->getResult()[0][0];
            endif;
        endif;

        //se não existir transação, retorna uma exceção
        throw new Exception('Não há transação ativa!');
    }
}
