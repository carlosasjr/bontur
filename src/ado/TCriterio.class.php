<?php

namespace App\ado;

/**
 * TCriterio.class [ EXPRESSION ]
 * Esta classe provê uma interface utilizada para definição de critérios
 * @copyright (c) 2018, Carlos Junior
 */
class TCriterio extends TExpression
{
    private $expressions; //armazena a lista de expressões
    private $operators; // armazena a lista de operadores
    private $properties; // propriedades do critério

    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */

    /*
     * Método Construtor
     */
    public function __construct()
    {
        $this->expressions = array();
        $this->operators = array();
    }


    /** <b>Metodo add</b>
     * Adiciona uma expressão ao critério
     * @param TExpression $expression = expressão (objeto TExpression)
     * @param TExpression $operador = Operador lógico de comparação (AND_OPERATOR / OR_OPERATOR)
     *  */
    public function add(TExpression $expression, $operator = self::AND_OPERATOR)
    {
        //Na primeira vez, não precisamos de operador lógico para concatenar
        if (empty($this->expressions)) :
            unset($operator);
        endif;


        //agrega o resultado da expressão à lista de expressões
        $this->operators[] = isset($operator) ? $operator : null;
        $this->expressions[] = $expression;
    }

    /** <b>Metodo dump</b>
     * Retorna a expressão final
     * @return string Retorna a expressão concatenada.
     *  */
    public function dump()
    {
        //concatena a lista de expressões
        $result = '';
        if (is_array($this->expressions)):
            foreach ($this->expressions as $i => $expression):
                $operator = $this->operators[$i];
        //concatena o o operador com a respectiva expressão
        $result .= $operator . $expression->dump() . ' ';
        endforeach;

        $result = trim($result);
        return "({$result})";
        endif;
    }

    /** <b>Metodo setProperty</b>
     * Define o valor de uma propriedade
     * @param string $property = order / limit / offset
     * @param string $value = valor
     *  */
    public function setProperty($property, $value)
    {
        $property = strtolower($property);

        if (isset($value)):
            $this->properties[$property] = $value; else:
            $this->properties[$property] = null;
        endif;
    }

    /** <b>Metodo getProperty</b>
     * Retorna o valor de uma propriedade
     * @param string $property = propriedade
     * @return string Retorna o valor de uma propriedade
     *  */
    public function getProperty($property)
    {
        if (isset($this->properties[$property])):
            return $this->properties[$property];
        endif;
    }
}
