<?php
    $_servidor = "localhost";
    $_usuario = "root";
    $_contrasena = "medac";
    $_baseDeDatos = "db_libros";

    $_conexion = new Mysqli($_servidor,$_usuario,$_contrasena,$_baseDeDatos) or die("Error, conexion fallida");
    
?>