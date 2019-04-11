<?php

namespace App\ado;

/**
 * TSQLDelete.class [ SQLInstruction ]
 * Esta classe provê meios para manipulação de uma instrução de DELETE no banco de dados
 * @copyright (c) 2018, Carlos Junior
 */
class TSQLDelete extends TSqlInstruction
{
    private $Result;

    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */

    protected function getInstruction()
    {
        $this->Sql = "DELETE FROM {$this->Entity}";

        if ($this->Criterio) :
            $this->Sql .= " WHERE " . $this->Criterio->dump();
        endif;
    }

    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */

    public function __construct($Entity, TCriterio $Criterio)
    {
        $this->Entity = (string)$Entity;

        if (!$Criterio) :
            WSErro("<b>Critério do objeto TSQLDelete não foi informado:</b>", 999);
            die;
        endif;

        $this->setCriterio($Criterio);
    }

    public function Execute()
    {
        $this->getInstruction();

        parent::Connect();

        try {
            parent::$Statement->execute();
            $this->Result = true;
        } catch (PDOException $e) {
            WSErro("<b>Erro ao deletar o registro:</b> {$e->getMessage()}", $e->getCode());
        }
    }

    /**
     * <b>Metodo getResult:</b> Retorna a quantidade de registro afetados
     * @return int Result = registros alterados
     */
    public function getResult()
    {
        return $this->Result;
    }
}
