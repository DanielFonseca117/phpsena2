<?php

include "modelos/anime.modelo.php";
class ControladorAnime{

    static public function ctrAnime(){

        if(isset($_POST["anim_nombre"])){

            $tabla = "anime";

            $datos = array(
                "anim_nombre" => $_POST["anim_nombre"],
                "anim_genero" => $_POST["anim_genero"],

            );

            $respuesta = ModeloAnime::mdlAnime($tabla, $datos);

            return $respuesta;

        }

    }

}