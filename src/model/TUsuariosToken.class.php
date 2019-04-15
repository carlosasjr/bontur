<?php
namespace App\model;

use App\ado\TRecord;
use App\ado\TCriterio;
use App\ado\TFilter;
use App\ado\TSQLSelect;

class TUsuariosToken extends TRecord
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */

    public function desativarToken($token)
    {
        //cria um critério de seleção
        $criterio = new TCriterio();
        //filtra por hass
        $criterio->add(new TFilter('hash', '=', $token));

        $sql = new TSQLSelect('usuariostoken', $criterio);
        $sql->Execute();



        if ($sql->getResult()) {


            $this->id = $sql->getResult()[0]['id'];
            $this->used = 1;

            $this->store();

            return true;
        }

        return false;
    }

}
