<?php
namespace Controllers\Mnt;

use Controllers\PublicController;
use Exception;
use Views\Renderer;

class Carro extends PublicController{
    private $redirectTo = "index.php?page=Mnt-Carros";
    private $viewData = array(
        "mode" => "DSP",
        "modedsc" => "",
        "id" => 0,
        "bin"=> "",
        "placaCarro"=> "",
        "modeloCarro" =>"",
        "anoCarro" => "",
        "general_errors"=> array(),
        "has_errors" =>false,
        "show_action" => true,
        "readonly" => false,
        "xssToken" =>""
    );
    private $modes = array(
        "DSP" => "Detalle de %s (%s)",
        "INS" => "Nueva Carro",
        "UPD" => "Editar %s (%s)",
        "DEL" => "Borrar %s (%s)"
    );
    public function run() :void
    {
        try {
            $this->page_loaded();
            if($this->isPostBack()){
                $this->validatePostData();
                if(!$this->viewData["has_errors"]){
                    $this->executeAction();
                }
            }
            $this->render();
        } catch (Exception $error) {
            unset($_SESSION["xssToken_Mnt_Carro"]);
            error_log(sprintf("Controller/Mnt/Carro ERROR: %s", $error->getMessage()));
            \Utilities\Site::redirectToWithMsg(
                $this->redirectTo,
                "Algo Inesperado Sucedió. Intente de Nuevo."
            );
        }

    }
    private function page_loaded()
    {
        if(isset($_GET['mode'])){
            if(isset($this->modes[$_GET['mode']])){
                $this->viewData["mode"] = $_GET['mode'];
            } else {
                throw new Exception("Mode Not available");
            }
        } else {
            throw new Exception("Mode not defined on Query Params");
        }
        if($this->viewData["mode"] !== "INS") {
            if(isset($_GET['id'])){
                $this->viewData["id"] = intval($_GET["id"]);
            } else {
                throw new Exception("Id not found on Query Params");
            }
        }
    }
    private function validatePostData(){
        if(isset($_POST["xssToken"])){
            if(isset($_SESSION["xssToken_Mnt_Carro"])){
                if($_POST["xssToken"] !== $_SESSION["xssToken_Mnt_Carro"]){
                    throw new Exception("Invalid Xss Token no match");
                }
            } else {
                throw new Exception("Invalid Xss Token on Session");
            }
        } else {
            throw new Exception("Invalid Xss Token");
        }
        if(isset($_POST["bin"])){
            if(\Utilities\Validators::IsEmpty($_POST["bin"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_error"] = "El bin no puede estar vacio!";
            }
        } else {
            throw new Exception("bin not present in form");
        }

        if(isset($_POST["placaCarro"])){
            if(\Utilities\Validators::IsEmpty($_POST["placaCarro"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_error"] = "LA placa no puede estar vacia!";
            }
        } else {
            throw new Exception("placaCarro not present in form");
        }

        if(isset($_POST["modeloCarro"])){
            if(\Utilities\Validators::IsEmpty($_POST["modeloCarro"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_error"] = "Modelo de carro no puede estar vacio!";
            }
        } else {
            throw new Exception("modeloCarro not present in form");
        }

        if(isset($_POST["anoCarro"])){
            if(\Utilities\Validators::IsEmpty($_POST["añoCarro"])){
                $this->viewData["has_errors"] = true;
                $this->viewData["general_error"] = "El año de carro no puede estar vacio!";
            }
        } else {
            throw new Exception("anoCarro not present in form");
        }
        
        if(isset($_POST["id"])){
            if(($this->viewData["mode"] !== "INS" && intval($_POST["id"])<=0)){
                throw new Exception("id is not Valid");
            }
            if($this->viewData["id"]!== intval($_POST["id"])){
                throw new Exception("id value is different from query");
            }
        }else {
            throw new Exception("id not present in form");
        }
            $this->viewData["bin"] = $_POST["bin"];
            $this->viewData["placaCarro"] = $_POST["placaCarro"];
            $this->viewData["modeloCarro"] = $_POST["modeloCarro"];
		    $this->viewData["anoCarro"] = $_POST["anoCarro"];
    }
    private function executeAction(){
        switch($this->viewData["mode"]){
            case "INS":
                $inserted = \Dao\Mnt\Carros::insert(
                    $this->viewData["bin"],
                    $this->viewData["placaCarro"],
                    $this->viewData["modeloCarro"],
                    $this->viewData["anoCarro"],
                );
                if($inserted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Carro Creada Exitosamente"
                    );
                }
                break;
            case "UPD":
                $updated = \Dao\Mnt\Carros::update(
                    $this->viewData["bin"],
                    $this->viewData["placaCarro"],
                    $this->viewData["modeloCarro"],
                    $this->viewData["anoCarro"],
                    $this->viewData["id"]
                );
                if($updated > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Carro Actualizado Exitosamente"
                    );
                }
                break;
            case "DEL":
                $deleted = \Dao\Mnt\Carros::delete(
                    $this->viewData["id"]
                );
                if($deleted > 0){
                    \Utilities\Site::redirectToWithMsg(
                        $this->redirectTo,
                        "Carro Eliminado Exitosamente"
                    );
                }
                break;
        }
    }
    private function render(){
        $xssToken = md5("Carro" . rand(0,4000) * rand(5000, 9999));
        $this->viewData["xssToken"] = $xssToken;
        $_SESSION["xssToken_Mnt_Carro"] = $xssToken;

        if($this->viewData["mode"] === "INS") {
            $this->viewData["modedsc"] = $this->modes["INS"];
        } else {
            $tmpCarros = \Dao\Mnt\Carros::getById($this->viewData["id"]);
            if(!$tmpCarros){
                throw new Exception("Carro no existe en DB");
            }
            //$this->viewData["catnom"] = $tmpCategorias["catnom"];
            //$this->viewData["catest"] = $tmpCategorias["catest"];
            \Utilities\ArrUtils::mergeFullArrayTo($tmpCars, $this->viewData);
            $this->viewData["modedsc"] = sprintf(
            $this->modes[$this->viewData["mode"]],
            $this->viewData["placaCarro"],
            $this->viewData["id"]
            );
            if(in_array($this->viewData["mode"], array("DSP","DEL"))){
                $this->viewData["readonly"] = "readonly";
            }
            if($this->viewData["mode"] === "DSP") {
                $this->viewData["show_action"] = false;
            }
        }
        Renderer::render("mnt/Carro", $this->viewData);
    }
}

?>