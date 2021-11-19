<?php

    try{

        //Nos conectamos a la Base de Datos
        $base = new PDO('mysql:host=localhost; dbname=bdusuarios','root','');
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        //Consultar datos de una base de datos
        $sql = "SELECT nombre, apellidos, email FROM usuarios;";
        $query = $base->prepare($sql);
        $query->setFetchMode(PDO::FETCH_ASSOC); //Devuelve un array de datos por asociación con el nombre de cada columna
        $query->execute();

        include 'includes/tabla.php';  

        if($query){
            echo '<div class="alert alert-success text-center">El listado de usuarios se ha realizado correctamente :)</div>';
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