<?php

namespace App\ado;

/**
 * TFilter.class [ EXPRESSION ]
 * Classe responsável em gerar as expressões
 * @copyright (c) 2018, Carlos Junior
 */
class TFilter extends TExpression
{
    private $variable; //variavel
    private $operator; //operador
    private $value; //valor

    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */

    /** <b>Metodo transform</b>
     * Recebe um valor e faz as modificações necessárias
     * para ele ser interpretado pelo banco de dados
     * podendo ser um integer/string/boolean ou array
     * @param $value = Valor a ser transformado
     * @return string Retorna o valor transformado
     *  */
    private function transform($value)
    {
        //caso seja um aray
        if (is_array($value)):
            //percorre os valores
            foreach ($value as $x):
                //se for um inteiro
                if (is_integer($x)):
                    $foo[] = $x; elseif (is_string($x)):
                    //se for string, adiciona aspas
                    $foo[] = "'$x'";
        endif;
        endforeach;

        //converte o array em string separado por ','
        $result = '(' . implode(',', $foo) . ')';

        //caso seja uma string
        elseif (is_string($value)):
            //adiciona aspas
            $result = "'$value'";

        //caso seja um valor nullo
        elseif (is_null($value)):
            //armazena NULL
            $result = 'NULL';

        //caso seja booleano
        elseif (is_bool($value)):
            //armazena TRUE ou FALSE
            $result = $value ? 'TRUE' : 'FALSE'; else:
            $result = $value;
        endif;

        //retorna o valor
        return $result;
    }

    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */


    /** <b>Metodo __construct</b>
     * Instancia um novo filtro
     * @param String $variable = 'campo'
     * @param String $operator = operador (>, < ...)
     * @param String $value = valor a ser comparado
     *  */
    public function __construct($variable, $operator, $value)
    {
        //armazena as propriedades
        $this->variable = $variable;
        $this->operator = $operator;
        $this->value = $this->transform($value);
    }

    /** <b>Metodo dump</b>
     * Retorna o filtro em forma de expressão
     * @return string Retorna a expressão concatenada.
     *  */
    public function dump()
    {
        //concatena a expressão
        return "{$this->variable} {$this->operator} {$this->value}";
    }
}
