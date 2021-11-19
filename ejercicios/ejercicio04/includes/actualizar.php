<main>
    <section class="container cuerpo text-center">
        
        <button type="button" class="btn btn-info" onclick="location.href='./index.php'">Inicio</button>

        <h3 id="titulo">Datos de Usuario</h3>
        <?php 

            if(isset($_GET["usuario_id"])&&(is_numeric($_GET["usuario_id"]))){

                $usuario_id = $_GET["usuario_id"];

                try{

                    //Nos conectamos a la Base de Datos
                    $base = new PDO('mysql:host=localhost; dbname=bdusuarios','root','');
                    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    //Consultar datos de una base de datos
                    $sql = "SELECT * FROM usuarios WHERE usuario_id = :usuario_id;";
                    $query = $base->prepare($sql);
                    $query->setFetchMode(PDO::FETCH_ASSOC); //Devuelve un array de datos por asociación con el nombre de cada columna
                    $query->execute(['usuario_id' => $usuario_id]);
                    
                    { ?>

                        <table class="table table-dark table-striped table-hover">
                        <tr>
                            <th>NOMBRE</th>
                            <th>E-MAIL</th>
                        </tr>

                        <?php while($row = $query->fetch()){ { ?> 

                            <tr>
                            <td><?=$row["nombre"]." ".$row["apellidos"]?></td>
                            <td><?=$row["email"]?></td>

                        <?php } } ?>
                        
                        </table> 

                    <?php }
                    if($query){
                        echo '<div class="alert alert-success text-center">Aquí está el usuario que desea editar :)</div>';
                    }
    
                }catch (PDOException $e){
    
                    die(
                        '<div class="alert alert-danger text-center">
                            No se ha podido acceder al usuario que desea editar :( <br>'.$e->getMessage().'
                        </div>'
                    );
    
                }finally{
    
                    $base = null;
    
                }  

            }

            if(isset($_POST["submit"]) && count($errores) == 0){

                $usuario_id = $_POST["usuario_id"];
                $nombre = $_POST["nombre"];
                $apellidos = $_POST["apellidos"];
                $email = $_POST["email"];

                try{

                    //Nos conectamos a la Base de Datos
                    $base = new PDO('mysql:host=localhost; dbname=bdusuarios','root','');
                    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    //Insertar valores en una tabla de la Base de Datos
                    $sql = "UPDATE Usuarios SET nombre = :nombre, apellidos = :apellidos, email = :email WHERE usuario_id = :usuario_id;";
                    $query = $base->prepare($sql);
                    $query->execute([

                            'usuario_id' => $usuario_id,
                            'nombre' => $nombre,
                            'apellidos' => $apellidos,
                            'email' => $email,

                            ]);


                    if($query){
                        echo '<div class="alert alert-success text-center">El usuario se ha actualizado correctamente :)</div>';
                    }

                }catch (PDOException $e){

                    die(
                        '<div class="alert alert-danger text-center">
                            No se han podido actualizar los datos del usuario en la Base de Datos :( <br>'.$e->getMessage().'
                        </div>'
                    );

                }finally{

                    $base = null;

                }

            }   

        ?>
        <br>
        <!-- Formulario HTML -->
        <form action="" method="POST" enctype="multipart/form-data">

            <label for="nombre">
                Nombre:
                <input type="text" name="nombre" class="form-control" 
                    <?php
                        if(isset($_POST["nombre"])){
                            echo "value='{$_POST["nombre"]}'";
                        }
                    ?>
                />
                <?php echo mostrarError($errores, "nombre"); ?>
            </label>
            <br><br>

            <label for="apellidos">
                Apellidos:
                <input type="text" name="apellidos" class="form-control"
                    <?php
                        if(isset($_POST["apellidos"])){
                            echo "value='{$_POST["apellidos"]}'";
                        }
                    ?>
                />
                <?php echo mostrarError($errores, "apellidos"); ?>
            </label>
            <br><br>

            <label for="email">
                E-mail:
                <input type="email" name="email" class="form-control"
                    <?php
                        if(isset($_POST["email"])){
                            echo "value='{$_POST["email"]}'";
                        }
                    ?>
                />
                <?php echo mostrarError($errores, "email"); ?>
            </label>
            <br><br>

            <input type="hidden" name="usuario_id" class="form-control" value="<?php echo $usuario_id; ?>" />
            
            <input type="submit" value="Actualizar" name="submit" class="btn btn-success" />

        </form>

    </section>
</main>