<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit book</title>
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
            if(!isset($_GET["titulo"])){header("location: index.php");}
            if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["envio"] == "Volver"){
                header("location: view_book.php?libro=".$_POST["titulo"]);
            }
            
            if($_SERVER["REQUEST_METHOD"] == "GET"){
                $sql = $_conexion->prepare("SELECT titulo, autor, paginas from libros where titulo = ?");
                $sql->bind_param("s",$_GET["titulo"]);
                $sql -> execute();
                $resultado = $sql->get_result();
                $fila = $resultado->fetch_assoc();

                $autor = $fila["autor"];
                $paginas = $fila["paginas"];
            }
            if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["envio"] == "Editar"){
                $_GET["titulo"] = $titulo = $_POST["titulo"];
                $paginas = $_POST["paginas"];
                $autor = $_POST["autor"];

                $sql = $_conexion->prepare("UPDATE libros set titulo = ?, paginas = ?, autor = ? where titulo = ?");
                $sql->bind_param("ssss",$titulo,$paginas,$autor,$_GET["tituloOriginal"]);
                $sql->execute();
            }
        ?>
        <div class="container">
            <h1>Editar libro: <?php echo $_GET["titulo"] ?></h1>
            <form action="" method="post">
                <label class="colFormLabelLg" for="titulo" >Titulo: </label>
                <input class="form-control" type="text" name="titulo" id="" value="<?php echo $_GET["titulo"] ?>">
                <label class="colFormLabelLg" for="autor">Autor: </label>
                <input class="form-control" type="text" name="autor" id="" value="<?php echo $autor ?>">
                <label class="colFormLabelLg" for="paginas">Paginas</label>
                <input class="form-control" type="text" name="paginas" value="<?php echo $paginas ?>">
                <input class="btn btn-warning m-2" type="submit" value="Editar" name="envio">
                <input type="submit" value="Volver" class="btn btn-warning" name="envio">
            </form>
        </div>
    </body>
</html>