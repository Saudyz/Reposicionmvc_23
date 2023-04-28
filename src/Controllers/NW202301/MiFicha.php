<?php
namespace Controllers\NW202301;

use Controllers\PublicController;
use Views\Renderer;

class MiFicha extends PublicController{

    public function run() : void
    {
        $viewData = array(
            "nombre" => "Saudy Zavala",
            "email" => "saudyzavala@gmail.com",
            "title" => "Software Engenier"
        );

        Renderer::render("nw202301/mificha", $viewData);

    }
}

?>





