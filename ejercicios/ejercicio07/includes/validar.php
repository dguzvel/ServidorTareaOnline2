<?php

    $errores = [];

    function mostrarError($errores, $campo){

        $alerta = "";

        if(isset($errores[$campo]) && !empty($campo)){

            $alerta = '<div class="alert alert-danger">'.$errores[$campo].'</div>';

        }

        return $alerta;

    }

    function filtrado($datos){

        $datos = trim($datos);
        $datos = stripslashes($datos);
        $datos = htmlspecialchars($datos);

        return $datos;

    }
     
    if(isset($_POST["submit"])){
        
        if(!empty($_POST["nombre"]) && strlen($_POST["nombre"]) <= 20 && !preg_match("/[\d]/", $_POST["nombre"])){

            $nombre = filtrado($_POST["nombre"]);
            $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);

        }else{

            $errores["nombre"] = "Un nombre no puede estar vacío, tener más de 20 caracteres ni contener números";

        }
        
        if(!empty($_POST["apellidos"]) && !preg_match("/[\d]/", $_POST["apellidos"])){

            $apellidos = filtrado($_POST["apellidos"]);
            $apellidos = filter_var($apellidos, FILTER_SANITIZE_STRING);

        }else{

            $errores["apellidos"] = "Un apellido no puede estar vacío ni contener números";

        }
        
        if(strlen(trim($_POST["bio"]))){

            $bio = filtrado($_POST["bio"]);

        }else{

            $errores["bio"] = "La biografía no puede estar vacía";

        }
        
        if(!empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){

            //preg_match("/[a-z]{7}[\d]{3}@g.educaand.es/", $_POST["email"])

            $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

        }else{

            $errores["email"] = "El e-mail no es válido";

        }
        
        if(!empty($_POST["password"]) && preg_match("/(?=.+[a-z])(?=.+[A-Z])(?=.+\d)(?=.+\W)[a-zA-Z\d\W]{6,}/", $_POST["password"])){

            $password = sha1($_POST["password"]);

        }else{

            $errores["password"] = "La contraseña debe contener al menos 6 caracteres";

        }
        
        if(isset($_FILES["imagen"]) || !empty($_FILES["imagen"]["tmp_name"])){

            if(!is_dir("fotos")){

                $directorio = mkdir("fotos", 0777, true);

            }else{

                $directorio = true;
                
                }


            if($directorio){

                $nombreImagen = time()."-".$_FILES["imagen"]["name"];

                $mueveImagen = move_uploaded_file($_FILES["imagen"]["tmp_name"],"fotos/".$nombreImagen);

                $imagen = $nombreImagen;

                if($mueveImagen){
                    $imagenCargada = true;
                }else{
                    $imagenCargada = false;
                    $errores["imagen"]="Error: La imagen no se cargó correctamente :(";
                }
                
            }

        }

    }

?>