<?php
namespace Dao\Mnt;

use Dao\Table;

/*  CREATE TABLE `nw202301`.`Carros` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `bin` INT NULL,
    `placaCarro` VARCHAR(45) NULL,
    `modeloCarro` VARCHAR(45) NULL,
    `añoCarro` VARCHAR(45) NULL,
    PRIMARY KEY (`id`));
 */

class Carros extends Table{

    public static function getAll(){
        return self::obtenerRegistros("SELECT * from Carros:", array());
    }

    public static function getById(int $id){
            return self::obtenerUnRegistro(
                "SELECT * From Carros where id =:id", array("id=>$id")
            );
    }

    public static function insert(
        int    $bin,
        string $placaCarro,
        string $modeloCarro,
        string $añoCarro,
    ){
        $ins_sql = "INSERT INTO `Carros`
        (`binCarro`,
        `PlacaCarro`,
        `modelo`,
        `añoCarro`)
        
        VALUES
        (
        :binCarro,
        :PlacaCarro,
        :modelo,
        :añoCarro);";

            return self::executeNonQuery(
                $ins_sql,
                array(
                    "binCarro" => $bin,
                    "PlacaCarro" => $placaCarro ,
                    "modelo" => $modeloCarro ,
                    "añoCarro" => $añoCarro
                )
            );
    }

    public static function update(
        int    $bin,
        string $placaCarro,
        string $modeloCarro,
        string $añoCarro,
        int    $id

    ){
        $upd_sql = "UPDATE `Carros`
        SET
        `binCarro` = :binCarro,
        `PlacaCarro` = :PlacaCarro,
        `modelo` = :modelo,
        `añoCarro` = :añoCarro>
        WHERE `id` = :id}>;";

        return self::executeNonQuery(
            $upd_sql,
            array(
                "binCarro" => $bin,
                "PlacaCarro" => $placaCarro ,
                "modelo" => $modeloCarro ,
                "añoCarro" => $añoCarro,
                "id" => $id
            )
            );
    }

    public static function delete(
        string $id
    ){
        $del_sql = "SELECT from Carros where id=:id;";

        return self::executeNonQuery(
            $del_sql,
            array("id"=>$id)
        );
    }

}

?>