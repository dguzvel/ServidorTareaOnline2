<nav class="navbar navbar-dark bg-dark">
<!-- Incluimos un nav con un botón toggler, tres líneas verticales, que podrá desplegarse y mostrar un menú -->
<div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
</div>
</nav>
<div class="collapse" id="navbarToggleExternalContent">
    <div class="bg-dark p-4">
            <button type="button" class="btn btn-light" onclick="location.href='./index.php'">Inicio</button>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <button type="button" class="btn btn-light" onclick="location.href='./añadir.php'">Añadir</button>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <button type="button" class="btn btn-light" onclick="location.href='../.././printPDF.php'">Generar PDF</button>
    </div>
</div>

<main>
    <section class="container cuerpo text-center">

        <h3 id="titulo">Listado de usuarios almacenados en la base de datos</h3>
        <?php

            try{

                //Nos conectamos a la Base de Datos
                $base = new PDO('mysql:host=localhost; dbname=bdusuarios','root','');
                $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                //$pagina tendrá el valor obtenido en $_GET que sea numérico, si no hay valores será 1
                $pagina = isset($_GET["pagina"]) ? (int)$_GET["pagina"] : 1;
                $filasPorPagina = 2;

                /*
                 *La fila inicial de la base de datos que se mostrará será la 0, que es la primera o
                 *el número máximo que correspondería en esa página menos el número de filas por página.
                 *Por ejemplo, página 3 y 5 filas por página son 15, menos esas 5, empezaría en la 10.
                 */
                $inicio = ($pagina > 1) ? ($pagina * $filasPorPagina - $filasPorPagina) : 0;

                //Consultar datos de una base de datos
                //Se calcula el número de filas en la base de datos comenzando desde la calculada como inicial y tantas como filas por pagina
                $sql = "SELECT SQL_CALC_FOUND_ROWS usuario_id, nombre, apellidos, email, imagen
                        FROM Usuarios LIMIT $inicio, $filasPorPagina;";
                $query = $base->prepare($sql);
                $query->setFetchMode(PDO::FETCH_ASSOC); //Devuelve un array de datos por asociación con el nombre de cada columna
                $query->execute();
                $articulos = $query->fetchAll();
                
                //Si no hay ningún artículo, un script lanzará un alert que advertirá que se debe añadir un usuario al menos y te dirige a dicha página
                if(!$articulos){

                    echo "<script>
                            alert('No hay ningún usuario registrado, añada al menos uno para continuar');
                            window.location= 'añadir.php'
                          </script>";

                }

                //Se calcula el total de artículos/filas en la base de datos
                $totalArticulos = $base->query("SELECT FOUND_ROWS() as total;");
                $totalArticulos = $totalArticulos->fetch()["total"];

                //Con ceil se redondea la división del total de filas entre las filas que habrá por página
                $numeroPagina = ceil($totalArticulos / $filasPorPagina);

                if($query){
                    echo '<div class="alert alert-success text-center">El listado de usuarios se ha realizado correctamente :)</div>';
                    include 'includes/tabla.php';
                }

            }catch (PDOException $e){

                die(
                    '<div class="alert alert-danger text-center">
                        No se ha podido mostrar el listado de usuarios registrados en la base de datos :( <br>'.$e->getMessage().'
                    </div>'
                );

            }finally{

                $base = null;

            } 

        ?>

    </section>
</main>