<?php

include "modelos/producto.modelo.php";
class ControladorProducto{

    static public function ctrProducto(){

        if(isset($_POST["prod_nombre"])){

            $tabla = "productos";

            $datos = array(
                "prod_nombre" => $_POST["prod_nombre"],
                "prod_cantidad" => $_POST["prod_cantidad"],
                "prod_precio" => $_POST["prod_precio"],

            );

            $respuesta = ModeloProducto::mdlProducto($tabla, $datos);

            return $respuesta;

        }

    }

}