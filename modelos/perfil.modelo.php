<?php

require_once "conexion.php";

class ModeloPerfil {

    /*=============================================
    Registrar usuario
    =============================================*/
    static public function mdlPerfil($tabla, $datos){
        $sql = "INSERT INTO {$tabla} 
                    (perf_nombre) 
                VALUES 
                    (:perf_nombre)";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":perf_nombre",   $datos["perf_nombre"],   PDO::PARAM_STR);

        $ok = $stmt->execute();
        $stmt->closeCursor();
        return $ok ? "ok" : "error";
    }

}
