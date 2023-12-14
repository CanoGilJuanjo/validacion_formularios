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
        </style>
        <?php 
            require "database_conection.php";
        ?>
    </head>
    <body>
        <div class="container">
            <div class="m-3">
                <form action="page_book.php" method="post">
                    <label for="busqueda">Buscar</label>
                    <input type="text" name="busqueda" id="">
                    <input type="submit" value="buscar">
                </form>
            </div>
            <div class="m-3">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Titulo</th>
                            <th>Paginas</th>
                            <th>Autor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql = $_conexion->prepare("SELECT titulo, paginas, autor from libros");
                            $sql->execute();
                            $libros = $sql->get_result();
                            while($libro = $libros -> fetch_assoc()){
                                echo "<tr>";
                                echo "<td>".$libro["titulo"]."</td>";
                                echo "<td>".$libro["paginas"]."</td>";
                                echo "<td>".$libro["autor"]."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>