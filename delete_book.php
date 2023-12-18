<?php
    require "database_conection.php";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $sql = $_conexion->prepare("DELETE from libros where titulo = ?");
        $sql->bind_param("s",$_POST["libro"]);
        $sql->execute();
        header("location: index.php");
    }

?>