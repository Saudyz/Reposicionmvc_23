<?php
namespace Dao\Mnt;

use Dao\Table;

/* 
    warehouse_id INT AUTO_INCREMENT PRIMARY KEY,
    warehouse_name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(255) NOT NULL,
    state VARCHAR(255) NOT NULL,
    country VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
*/ 

class warehouse extends Table{
    public static function getAll(){
        return self::obtenerRegistros("SELECT * from warehouse;", array());
    }
    public static function getById(int $warehouse_id){
        return self::obtenerUnRegistro(
            "SELECT *  from warehouse where warehouse_id =:warehouse_id;",array("warehouse_id"=>$warehouse_id)
        );

    }

    public static function insert(
        string $warehouse_name,
        string $addres,
        string $city,
        string $stat,
        string $country,
        string $create_at
    ){
$ins_sql = "INSERT INTO `warehouse`
(`warehouse_name`,
`addres`,
`city`,
`stat`,
`country`,
`created_at`)

VALUES

(
:warehouse_name,
:addres,
:city,
:stat,
:country,
now());";
                
    return self::executeNonQuery(
        $ins_sql,
            array(
                "warehouse_name" => $warehouse_name,
                "addres " => $addres,
                "city " =>$city ,
                "stat " =>$stat, 
                "country" =>$country
        )
    );                          
}
    public static function update(
        string $warehouse_name,
        string $addres,
        string $city,
        string $stat,
        string $country,
        string $create_at,
        int $warehouse_id
    ){

        

    }
    public static function delete(
        string $warehouse_id
    ){

    }


}


?>