<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create a new block</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <?php 
            require "database_conection.php"; 
            require "functions.php";    
        ?>
        <style>
            body{
                background-color: darkslategray;
                color: white;
            }
        </style>
    </head>
    <body>

        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $titulo = $_POST["titulo"];
                $paginas = (int) $_POST["paginas"];
                $autor = $_POST["autor"];
                
                if(sqlExiteLibro($titulo)){
                    $mensajeError = "Error el libro ya ha sido añadido";
                }else{
                    $sql = $_conexion -> prepare("INSERT into libros values (?,?,?);");
                    $sql -> bind_param("sis",$titulo,$paginas,$autor);
                    $sql -> execute();
                }
                
            }
        ?>

        <div class="container">
            <h1>Crear libro</h1>

            <form action="" method="post">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Titulo</label>
                    <input type="text" name="titulo" id="" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="paginas" class="form-label">Paginas</label>
                    <input type="number" name="paginas" id="" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="autor" class="form-label">Autor</label>
                    <input type="text" name="autor" id="" class="form-control">
                </div>

                <div class="mb-3">
                    <input type="submit" class="btn btn-warning" value="crear">
                </div>
            </form>

            <?php
                if(isset($mensajeError)){
                    ?>
                        <div class="mb-3">
                            <p class="bg-info"> <?php echo $mensajeError ?> </p>
                        </div>
                    <?php
                }
            ?>

        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>