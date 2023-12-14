<?php
    function sqlExiteLibro($tituloLibro) {
        require "database_conection.php";
        $sql = "SELECT titulo from libros;";
        $resultado = $_conexion ->query($sql);
        while($row = $resultado -> fetch_assoc()) {
            if($resultado->num_rows == 0){
                return false;
            }else if($row["titulo"] == $tituloLibro){
                return true;
            }
        }
        return false;
    }
?>