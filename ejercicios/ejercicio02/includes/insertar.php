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