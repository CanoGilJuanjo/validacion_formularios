<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php if(isset($_GET["libro"]) == false) header("location: index.php"); echo $_GET["libro"] ?> </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <style>
            body{
                background-color: darkslategrey;
                color: white;
                margin: 0px auto;
            }
        </style>
        <?php
            require "database_conection.php";
        ?>
    </head>
    <body>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["envio"] == "Volver"){
                header("location: index.php");
            }else if($_SERVER["REQUEST_METHOD"] == "GET"){
                $titulo = $_GET["libro"];
                $sql = $_conexion -> prepare("SELECT autor,paginas from libros where titulo = ?");
                $sql -> bind_param("s",$titulo);
                $sql -> execute();
                $resultado = $sql->get_result();
                $fila = $resultado->fetch_assoc();
            
            
        ?>
        <div class="container">
            <h1>Libro: <?php echo  $titulo ?></h1>
            <h3>Libro creado por: <?php echo $fila["autor"] ?></h3>
            <h3>El libro contiene: <?php echo $fila["paginas"] ?> paginas </h3>
        </div>
        <form action="edit_book.php" method="get">
            <input type="hidden" name="titulo" value="<?php echo $titulo ?>">
            <input type="hidden" name="tituloOriginal" value="<?php echo $titulo ?>">
            <input type="submit" class="btn btn-warning m-3" value ="Editar" name="envio">
        </form>
        <form action="" method="post">
            <input type="submit" value="Volver" class="btn btn-warning m-3" name="envio">
        </form>
        <?php 
            }

        ?>
        
    </body>
</html>