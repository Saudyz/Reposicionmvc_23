<?php

namespace Controllers\NW202301;

use Controllers\PublicController;
use Views\Renderer;
use Dao\Clase\Demo;


class me extends PublicController{
    public function run() :void
    {
        $viewData = array();
        $responseDao = Demo::getAResponse()[0][""];
        $viewData["response"] = $responseDao;
        Renderer::render('NW202301?/me', $viewData);
    }
}

?>