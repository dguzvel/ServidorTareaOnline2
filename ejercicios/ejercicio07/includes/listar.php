<main>
    <section class="container cuerpo text-center">

        <ul>
            <li><a href="./index.php">Listar</a></li>
            <li><a href="./añadir.php">Añadir</a></li>
        </ul>

        <h3 id="titulo">Listado de usuarios almacenados en la base de datos</h3>
        <?php

            try{

                //Nos conectamos a la Base de Datos
                $base = new PDO('mysql:host=localhost; dbname=bdusuarios','root','');
                $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                //Consultar datos de una base de datos
                $sql = "SELECT usuario_id, nombre, apellidos, email, imagen FROM Usuarios;";
                $query = $base->prepare($sql);
                $query->setFetchMode(PDO::FETCH_ASSOC); //Devuelve un array de datos por asociación con el nombre de cada columna
                $query->execute();  

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