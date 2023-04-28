<?php

namespace Dao\Clase;

use Dao\Table;

class Demo extends Table{

    public static function getAResponse(){
        return self::obtenerUnRegistro('select 1 as Response;',array());
    }
}

?>