<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Books <?php echo $_POST["busqueda"] ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <style>
            body{
                background-color: darkslategrey;
                color: white;
                margin: 0px auto;
            }
            .table{
                width: 100%;
            }
        </style>
        <?php 
            require "database_conection.php";
        ?>
    </head>
    <body>
        <div class="container">
            <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $busqueda = "%".$_POST["busqueda"]."%";
                    $sql = $_conexion->prepare("SELECT * from libros where titulo like ?;");
                    $sql -> bind_param("s",$busqueda);
                    $sql->execute();
                    $resultado = $sql->get_result();
                    ?>
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Titulo</th>
                                <th>Paginas</th>
                                <th>Autor/a</th>
                            </tr>
                        </thead>
                    <?php
                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                            while($libro = $resultado->fetch_assoc()){
                                echo "<tr>";
                                echo "<td>".$libro["titulo"]."</td>";
                                echo "<td>".$libro["paginas"]."</td>";
                                echo "<td>".$libro["autor"]."</td>";
                                echo "</tr>";
                            }
                        }
                }
                ?>
                </table>
            <a href="index.php"><button class="btn btn-warning">Volver</button></a>
        </div>
    </body>
</html>