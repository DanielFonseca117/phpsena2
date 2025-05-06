<?php

require_once "conexion.php";

class ModeloAnime {

    /*=============================================
    Registrar producto
    =============================================*/
    static public function mdlAnime($tabla, $datos){
        $sql = "INSERT INTO {$tabla} 
                    (anim_nombre, anim_genero) 
                VALUES 
                    (:anim_nombre, :anim_genero)";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":anim_nombre",   $datos["anim_nombre"],   PDO::PARAM_STR);
        $stmt->bindParam(":anim_genero", $datos["anim_genero"], PDO::PARAM_STR);

        $ok = $stmt->execute();
        $stmt->closeCursor();
        return $ok ? "ok" : "error";
    }

}
