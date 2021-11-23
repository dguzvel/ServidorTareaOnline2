<?php

    try{

        //Nos conectamos a la Base de Datos
        $base = new PDO('mysql:host=localhost; dbname=bdusuarios','root','');
        
        //Creamos una Tabla para los logs
        $sql = "CREATE TABLE IF NOT EXISTS logs(

                    id int(255) auto_increment not null,
                    fechaHora datetime(6),
                    operacion varchar(255),
                    CONSTRAINT pk_id PRIMARY KEY (id)

                );";
        $base->exec($sql);

        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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