<?php

require_once "conexion.php";

class ModeloRegistro {

    /*=============================================
    Registrar usuario
    =============================================*/
    static public function mdlRegistro($tabla, $datos){
        $sql = "INSERT INTO {$tabla} 
                    (pers_nombre, pers_telefono, pers_correo_electronico, pers_clave) 
                VALUES 
                    (:nombre, :telefono, :correo, :clave)";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":nombre",   $datos["nombre"],   PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":correo",   $datos["correo"],   PDO::PARAM_STR);
        $stmt->bindParam(":clave",    $datos["clave"],    PDO::PARAM_STR);

        $ok = $stmt->execute();
        $stmt->closeCursor();
        return $ok ? "ok" : "error";
    }

        /*=============================================
    Seleccionar Registros
    =============================================*/
    static public function mdlSeleccionarRegistro($tabla, $item, $valor){

        if ($item === null && $valor === null) {

            // Trae todos los registros, aliasando la PK a 'id'
            $sql = "
                SELECT 
                    pk_id_personas AS id,
                    pers_nombre,
                    pers_telefono,
                    pers_correo_electronico,
                    pers_clave,
                    DATE_FORMAT(fecha_registro, '%d/%m/%Y') AS fecha 
                FROM {$tabla} 
                ORDER BY pk_id_personas DESC
            ";

            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->execute();
            $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();

            return $datos;

        } else {

            // Trae un solo registro filtrado
            $sql = "
                SELECT 
                    pk_id_personas AS id,
                    pers_nombre,
                    pers_telefono,
                    pers_correo_electronico,
                    pers_clave,
                    DATE_FORMAT(fecha_registro, '%d/%m/%Y') AS fecha 
                FROM {$tabla} 
                WHERE {$item} = :valor 
                ORDER BY pk_id_personas DESC
            ";

            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindValue(":valor", $valor, PDO::PARAM_STR);
            $stmt->execute();
            $dato = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt->closeCursor();

            return $dato;
        }

    }

    public static function mdlActualizarRegistro($tabla, $datos) {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET pers_nombre = :nombre, pers_telefono = :telefono,pers_ correo_electronico = :correo,pers_clave = :clave WHERE id_registro = :id");

        $stmt->bindParam(":pers_nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":pers_telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":pers_correo_electronico", $datos["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":pers_clave", $datos["clave"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt = null;
    }


}
