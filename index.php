<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Books availables</title>
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
            input[name="busqueda"]{
                width: 60%;
            }
            #top{
                margin-top: -6px;
            }
        </style>
        <?php 
            require "database_conection.php";
        ?>
    </head>
    <body>
        <div class="container">
            <div class="m-3">
                <form action="" method="post">
                    <input type="text" name="busqueda" id="busqueda" placeholder="Titulo a buscar"> 
                    <label for="categoria">Ordenar: </label>
                    <select name="categoria" id="categoria" class="form-select-sm m-1">
                        <option value="paginas">Paginas</option>
                        <option value="autor">Autor</option>
                        <option value="titulo" selected>Titulo</option>
                    </select>
                    <select name="orden" id="orden" class="form-select-sm m-1">
                        <option value="ASC" >Ascendente</option>
                        <option value="DESC" selected>Descendente</option>
                    </select>
                    <input type="submit" value="Buscar" class="btn btn-warning" id="top" name="envio">
                </form>
            </div>
            <?php 
                $busqueda = "%%";
                $categoria = "titulo";
                $orden = "DESC";
                if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["envio"] == "Buscar"){
                    $busqueda = "%".$_POST["busqueda"]."%";
                    $categoria = $_POST["categoria"];
                    $orden = $_POST["orden"];
                }else if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["envio"] == "crear libro"){
                    header("location: create_block.php");
                }else if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["envio"] == "🗑"){
                    
                }
            ?>
            <div class="m-3">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Titulo</th>
                            <th>Paginas</th>
                            <th>Autor/a</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql = $_conexion->prepare("SELECT * from libros where titulo like ? ORDER BY $categoria $orden");
                            $sql->bind_param("s",$busqueda);
                            $sql->execute();
                            $libros = $sql->get_result();
                            while($libro = $libros -> fetch_assoc()){
                                echo "<tr>";
                                    echo "<td>".$libro["titulo"]."</td>";
                                    echo "<td>".$libro["paginas"]."</td>";
                                    echo "<td>".$libro["autor"]."</td>";
                                    echo
                                    "<td>"
                                    ?>
                                    <form action="view_book.php" method = "get">
                                        <input type="hidden" name = "libro" value="<?php echo $libro["titulo"] ?>">
                                        <input type="submit" class="btn btn-warning" value="👁">
                                    </form>
                                    <?php
                                    echo "</td>";
                                    echo "<td>"?>
                                        <form action="delete_book.php" method="post">
                                            <input type="hidden" name = "libro" value="<?php echo $libro["titulo"] ?>">
                                            <input type="submit" value="🗑" class="btn btn-danger" name="envio">
                                        </form>
                                    <?php "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <form action="" method="post">
                <input class="btn btn-warning m-3 mt-0" id="margin-left" type="submit" name="envio" value="crear libro">
            </form>
        </div>
    </body>
</html>