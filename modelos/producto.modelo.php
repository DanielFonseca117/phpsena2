<?php

require_once "conexion.php";

class ModeloProducto {

    /*=============================================
    Registrar producto
    =============================================*/
    static public function mdlProducto($tabla, $datos){
        $sql = "INSERT INTO {$tabla} 
                    (prod_nombre, prod_cantidad, prod_precio) 
                VALUES 
                    (:prod_nombre, :prod_cantidad, :prod_precio)";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":prod_nombre",   $datos["prod_nombre"],   PDO::PARAM_STR);
        $stmt->bindParam(":prod_cantidad", $datos["prod_cantidad"], PDO::PARAM_STR);
        $stmt->bindParam(":prod_precio",   $datos["prod_precio"],   PDO::PARAM_STR);

        $ok = $stmt->execute();
        $stmt->closeCursor();
        return $ok ? "ok" : "error";
    }

}
