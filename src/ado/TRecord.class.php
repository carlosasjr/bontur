<?php

namespace App\ado;

/**
 * TRecord.class [ RECORD ]
 * Esta classe provê os métodos necessários para persistir e
 * recuperar objetos da base de dados (Active Record)
 * @copyright (c) 2018, Carlos Junior
 */
abstract class TRecord
{
    protected $data; //array contendo os dados do objeto

    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /**
     * Método getEntity
     * @return string = Retorna o nome da Clase subtraindo o prefixo Record
     */
    private function getEntity()
    {
        //obtém o nome da classe removendo o primeiro caracter T
        $function = new \ReflectionClass($this);
        $classe = substr(strtolower($function->getShortName()), 1);

        //retorna o nome da classe - 'Record'
        return substr($classe, 0, -6);
    }

    public function getLast()
    {
        //inicia transação
        if ($conn = TTransaction::get()) :
            //instância instrução de SELECT
            $sql = new TSQLSelect($this->getEntity());
            $sql->addColumn('max(id) as id');

            //executa instrução SQL
            $sql->Execute();

            return is_null($sql->getResult()[0]) ? 0 : $sql->getResult()[0][0];
        else :
            throw new Exception('Não há transação ativa!');
        endif;
    }


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */


    /**
     * TRecord constructor.
     * @param objetc $id
     * @throws Exception
     */
    public function __construct($id = null)
    {
        if ($id) : //se o ID for informado
            //carrega o objeto correspondente
            $object = $this->load($id);

            if ($object) :
                $this->fromArray($object->toArray());
            endif;
        endif;
    }

    /**
     * Método __set
     * @param $prop
     * @param $value
     */
    public function __set($prop, $value)
    {
        //verifica se existe método set<propriedade>
        if (method_exists($this, 'set' . $prop)) :
            //executa o método set<propriedade>
            call_user_func(array($this, 'set' . $prop), $value);
        else :
            //atribui o valor da propriedade ao array de data
            $this->data[$prop] = $value;
        endif;
    }

    /**
     * Método __get
     * Executado sempre que uma propriedade for requerida
     * @param $prop = Propriedade
     * @return mixed
     */
    public function __get($prop)
    {
        //verifica se existe método get<propriedade>
        if (method_exists($this, 'get' . $prop)) :
            //executa o método get<propriedade>
            return call_user_func(array($this, 'get' . $prop));
        else :
            //retorna o valor da propriedade
            return $this->data[$prop];
        endif;
    }

    /**
     * TRecord __clone
     * Executado quando o objeto for Clonado.
     * Limpa o ID para que seja gerado um novo Id para o Clone.
     */
    public function __clone()
    {
        unset($this->id);
    }

    /**
     * Método fromArray
     * Preenche os dados do objeto com um array
     * @param array $data
     */
    public function fromArray($data)
    {
        $this->data = $data;
    }

    /**
     * Método toArray
     * Retorno os dados do objeto como array
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }

    public function store()
    {
        //verifica se tem ID ou se existe na base de dados
        if (empty($this->data['id']) or (!$this->load($this->id))) :
            //incrementa o ID
            $this->id = $this->getLast() + 1;

            //cria uma instrução de insert
            $sql = new TSQLInsert($this->getEntity(), $this->data);
            $sql->Execute();
        else :
            //instancia instrução de update
            //cria um critério de seleção baseado no ID
            $criterio = new TCriterio();
            $criterio->add(new TFilter('id', '=', $this->id));

            $sql = new TSQLUpdate($this->getEntity(), $this->data, $criterio);

            //obtém transação ativa
            if ($conn = TTransaction::get()) :
                //executa o SQL
                $sql->Execute();
                return $sql->getResult(); //retorna True se efetuou
            endif;

            //se não tiver transação, retorna uma exceção
            throw new Exception('Não há transação ativa!');

        endif;
    }

    public function load($id)
    {
        //instancia instrução de SELECT
        $sql = new TSQLSelect($this->getEntity());


        $sql->addColumn('*');

        //cria critério de seleção baseado no ID
        $criterio = new TCriterio();
        $criterio->add(new TFilter('id', '=', $id));

        //define o critério de seleção de dados
        $sql->setCriterio($criterio);

        //obtém a transação ativa
        if ($conn = TTransaction::get()) :
            //executa a consulta;

            $sql->Execute(TSQLSelect::FETCH_OBJECT, $this);

            if ($sql->getResult()) :
                $objeto = $sql->getResult();
                return $objeto;
            endif;
        else :
            throw new Exception('Não há transação ativa!');
        endif;
    }

    public function delete($id = null)
    {
        //O Id é o parâmetro ou a propriedade ID
        $id = $id ? $id : $this->id;

        //cria critério de seleção de dados
        $criterio = new TCriterio();
        $criterio->add(new TFilter('id', '=', $id));

        //instância uma instrução de DELETE
        $sql = new TSQLDelete($this->getEntity(), $criterio);

        //obter a transação ativa
        if ($conn = TTransaction::get()) :
            //executa o SQL
            $sql->Execute();
            return $sql->getResult();
        else :
            throw new Exception('Não há transação ativa!');
        endif;
    }
}
