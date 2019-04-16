<?php

namespace App\model;

use App\ado\TRecord;
use App\ado\TRepository;
use App\ado\TTransaction;
use App\ado\TCriterio;
use App\ado\TFilter;

class TPerfilRecord extends TRecord
{
    /*     * ************************************************ */
    /*     * ************* METODOS PRIVADOS ***************** */
    /*     * ************************************************ */


    /*     * ************************************************ */
    /*     * ************* METODOS PUBLICOS ***************** */
    /*     * ************************************************ */

    public function getAllPerfil()
    {
        try {
            //instancia um criterio de seleção
            $criterio = new TCriterio();
            $criterio->add(new TFilter('id', '>', 0));
            $criterio->setProperty('ORDER', 'id');

            //instancia um repositório para Inscrição
            $repository = new TRepository('perfil');
            //retorna todos objetos que satisfazerem o critério
            return $repository->load($criterio);

        } catch (Exception $e) {
            //exibe a mensagem gerada pela exceção
            WSErro($e->getMessage(), WS_ERROR, 'Oppsss');
        }
    }
}
