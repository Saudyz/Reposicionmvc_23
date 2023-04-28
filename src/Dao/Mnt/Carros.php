<?php
namespace Dao\Mnt;

use Dao\Table;

/*  CREATE TABLE `nw202301`.`Carros` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `bin` VARCHAR(45),
  `placaCarro` VARCHAR(45) NULL,
  `modeloCarro` VARCHAR(45) NULL,
  `anoCarro` int Default NULL,
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
        string   $bin,
        string   $placaCarro,
        string   $modeloCarro,
        string   $anoCarro,
    ){
        $ins_sql = "INSERT INTO `Carros`
        (`bin`,
        `PlacaCarro`,
        `modeloCarro`,
        `anoCarro`)
        
        VALUES
        (
        :bin,
        :PlacaCarro,
        :modeloCarro,
        :anoCarro);";

            return self::executeNonQuery(
                $ins_sql,
                array(
                    "bin" => $bin,
                    "PlacaCarro" => $placaCarro ,
                    "modeloCarro" => $modeloCarro ,
                    "añoCarro" => $anoCarro
                )
            );
    }

    public static function update(
        int    $bin,
        string $placaCarro,
        string $modeloCarro,
        string $anoCarro,
        int    $id

    ){
        $upd_sql = "UPDATE `Carros`
        SET
        `bin` = :bin,
        `PlacaCarro` = :PlacaCarro,
        `modeloCarro` = :modeloCarro,
        `anoCarro` = :anoCarro>
        WHERE `id` = :id}>;";

        return self::executeNonQuery(
            $upd_sql,
            array(
                "bin" => $bin,
                "PlacaCarro" => $placaCarro ,
                "modelo" => $modeloCarro ,
                "anoCarro" => $anoCarro,
                "id" => $id
            )
            );
    }

    public static function delete(
        string $id
    ){
        $del_sql = "DELETE from Carros where id=:id;";

        return self::executeNonQuery(
            $del_sql,
            array("id"=>$id)
        );
    }

}


?>