<main>
    <section class="container cuerpo text-center">

        <button type="button" class="btn btn-info" onclick="location.href='./index.php'">Inicio</button>

        <h3 id="titulo">Listado de usuarios almacenados en la base de datos</h3>
        <?php

            //Si mediante $_GET obtenemos un valor numérico  para usuario_id, se cumplirá la condición
            if(isset($_GET["usuario_id"])&&(is_numeric($_GET["usuario_id"]))){

                $usuario_id = $_GET["usuario_id"];

                try{

                    //Nos conectamos a la Base de Datos
                    $base = new PDO('mysql:host=localhost; dbname=bdusuarios','root','');
                    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    //Consultar datos de una base de datos, en concreto del usuario cuya id obtenemos desde el $_GET
                    $sql = "SELECT * FROM Usuarios WHERE usuario_id = :usuario_id;";
                    $query = $base->prepare($sql);
                    $query->setFetchMode(PDO::FETCH_ASSOC); //Devuelve un array de datos por asociación con el nombre de cada columna
                    $query->execute(['usuario_id' => $usuario_id]);  

                    if($query){
                        echo '<div class="alert alert-success text-center">Aquí tiene información más detallada del usuario :)</div>';
                        include 'includes/tablaCompleta.php';

                        $fechaHora = date('Y-m-d H:i:s');//Valores date para insertar en la tabla logs la fecha y hora
    
                        //Insertar valores en logs
                        $sql = "INSERT INTO logs VALUES(
    
                                    NULL,
                                    :fechaHora,
                                    :operacion
    
                                );";
                        $query = $base->prepare($sql);
                        $query->execute([
    
                                'fechaHora' => $fechaHora,
                                'operacion' => "Usuario visto en detalle"
    
                                ]);
                    }

                }catch (PDOException $e){

                    die(
                        '<div class="alert alert-danger text-center">
                            No se ha podido acceder al usuario del que desea obtener más información :( <br>'.$e->getMessage().'
                        </div>'
                    );

                }finally{

                    $base = null;//Cerramos la conexión a la base de datos

                }
            
            }

        ?>

    </section>
</main>