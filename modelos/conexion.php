<?php

    class Conexion{

        static public function conectar(){

            $link = new PDO("mysql:hosts=localhost:3306;dbname=phpsena_bd","root","");
            return $link;

        }

    }