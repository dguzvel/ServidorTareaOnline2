<main>
    <section class="container cuerpo text-center">
        
        <button type="button" class="btn btn-info" onclick="location.href='./index.php'">Inicio</button>

        <h3 id="titulo">Eliminar Usuario</h3>
        <?php 

            if(isset($_GET["usuario_id"])&&(is_numeric($_GET["usuario_id"]))){

                $usuario_id = $_GET["usuario_id"];//Damos el valor del $_GET a la variable $usuario_id

                try{

                    //Nos conectamos a la Base de Datos
                    $base = new PDO('mysql:host=localhost; dbname=bdusuarios','root','');
                    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    //Consultar datos de una base de datos y borrar la imagen asociada al usuario eliminado
                    $sql = "SELECT imagen FROM Usuarios WHERE usuario_id = :usuario_id;";
                    $query = $base->prepare($sql);
                    $query->setFetchMode(PDO::FETCH_ASSOC);
                    $query->execute(['usuario_id' => $usuario_id]);
                    $row = $query->fetch();
                    unlink("fotos/".$row["imagen"]);//Eliminamos con unlink la imagen, mediante su name, en la ruta establecida
                    //Se elimina al usuario
                    $sql = "DELETE FROM Usuarios WHERE usuario_id = :usuario_id;";
                    $query = $base->prepare($sql);
                    $query->execute(['usuario_id' => $usuario_id]);
                    
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
                            'operacion' => "Usuario eliminado"

                            ]);

                    if($query){
                        //echo '<div class="alert alert-success text-center">El usuario se ha eliminado correctamente :)</div>';
                        header("Location:index.php");
                    }
    
                }catch (PDOException $e){
    
                    die(
                        '<div class="alert alert-danger text-center">
                            No se ha podido acceder al usuario que desea eliminar :( <br>'.$e->getMessage().'
                        </div>'
                    );
    
                }finally{
    
                    $base = null;//Cerramos la conexión a la base de datos
    
                }  

            } 

        ?>

    </section>
</main>