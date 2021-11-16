<?php

    try{

        //Creamos la Base de Datos
        $base = new PDO('mysql:host=localhost','root','');
        $sql = "CREATE DATABASE IF NOT EXISTS bdusuarios";
        $base->exec($sql);

        //Nos conectamos a la Base de Datos
        $base = new PDO('mysql:host=localhost; dbname=bdusuarios','root','');
        
        //Creamos una Tabla
        $sql = "CREATE TABLE IF NOT EXISTS Usuarios(

                    usuario_id int(255) auto_increment not null,
                    nombre  varchar(50),
                    apellidos   varchar(255),
                    bio text,
                    email   varchar(255),
                    password    varchar(255),
                    imagen  varchar(255),
                    CONSTRAINT pk_usuario PRIMARY KEY (usuario_id)

                );";
        $base->exec($sql);

        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo '<div class="alert alert-success text-center">La conexión a la Base de Datos se ha realizado correctamente :)</div>';

    }catch (PDOException $e){

        /* die(
            '<div class="alert alert-danger text-center">
                No se ha podido conectar a la Base de Datos :( <br>'.$e->getMessage().'
            </div>'
        ); */

        echo '<div class="alert alert-danger text-center"> No se ha podido conectar a la Base de Datos :( <br>'.$e->getMessage().'</div>';

    }finally{

        $base = null;

    }

?>