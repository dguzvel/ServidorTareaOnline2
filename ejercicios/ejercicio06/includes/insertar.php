<main>
    <section class="container cuerpo text-center">
        
        <button type="button" class="btn btn-info" onclick="location.href='./index.php'">Inicio</button>

        <h3 id="titulo">Añadir Usuario</h3>
        <?php 

            if(isset($_POST["submit"]) && count($errores) == 0){

                global $nombre;
                global $apellidos;
                global $bio;
                global $email;
                global $password;
                $imagen = $_FILES["imagen"]["tmp_name"];

                try{

                    //Nos conectamos a la Base de Datos
                    $base = new PDO('mysql:host=localhost; dbname=bdusuarios','root','');
                    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    //Insertar valores en una tabla de la Base de Datos
                    $sql = "INSERT INTO Usuarios VALUES(

                                NULL,
                                :nombre,
                                :apellidos,
                                :bio,
                                :email,
                                :password,
                                :imagen

                            );";
                    $query = $base->prepare($sql);
                    $query->execute([

                            'nombre' => $nombre,
                            'apellidos' => $apellidos,
                            'bio' => $bio,
                            'email' => $email,
                            'password' => $password,
                            'imagen' => $imagen

                            ]);


                    if($query){
                        echo '<div class="alert alert-success text-center">El usuario se ha registrado correctamente :)</div>';
                    }

                }catch (PDOException $e){

                    die(
                        '<div class="alert alert-danger text-center">
                            No se ha podido registrar al usuario en la Base de Datos :( <br>'.$e->getMessage().'
                        </div>'
                    );

                }finally{

                    $base = null;

                }

            }   

        ?>
        <br>
        <!-- Formulario HTML que realizará la acción de la ruta establecida, recoger.php -->
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

            <label for="bio">
                Biografia:
                <textarea name="bio" class="form-control">
                    <?php
                        if(isset($_POST["bio"])){
                            echo $_POST["bio"];
                        }
                    ?>
                </textarea>
                <?php echo mostrarError($errores, "bio"); ?>
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

            <label for="password">
                Contraseña:
                <input type="password" name="password" class="form-control"
                    <?php
                        if(isset($_POST["password"])){
                            echo "value='{$_POST["password"]}'";
                        }
                    ?>
                />
                <?php echo mostrarError($errores, "password"); ?>
            </label>
            <br><br>

            <label for="imagen">
                Imagen:
                <input type="file" name="imagen" class="form-control" />
                <?php echo mostrarError($errores, "imagen"); ?>
            </label>
            <br><br>

            <input type="submit" value="Enviar" name="submit" class="btn btn-success" />

        </form>

    </section>
</main>