<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tabla PDF</title>
    <style type="text/css">

      .encabezado{

        color:white;
        text-align: center;
        background-color: black;
        padding: 10px; 

      }
      
     .cuerpo{

        width: 100%;
        margin-top: 25px;
        margin-bottom: 25px;
        min-width: 100%;
        background-color: white;

      }

      table {

        width: 100%;
        border: 1px solid;
      
      }

      th {

        width: 25%;
        text-align: left;
        vertical-align: top;
        border: 1px solid;
        background-color: black;
        color: white;

      }

      td {

        width: 25%;
        text-align: left;
        vertical-align: top;
        border: 1px solid;
        background-color: lightgrey;
        color: black;

        }

      
      .pie{

        color:white;
        text-align: center;
        background-color: black;
        min-width: 100%;
        padding: 5px;

      }

    </style>
  </head>
  <body>
    <div class="encabezado text-center">
        <h1>
          DWES Tarea Online 2 - Ejercicio 09
        </h1>
    </div>
    
    <div>
      <div class="container cuerpo text-center">

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


          }catch (PDOException $e){

            die();

          }finally{

            $base = null;

          }  

        ?>
        <table>
          <tr>
              <th>NOMBRE</th>
              <th>E-MAIL</th>
              <th>IMAGEN</th>
              <th>OPERACIONES</th>
          </tr>

          <?php while($row = $query->fetch()){ { ?> 

            <tr>
              <td><?=$row["nombre"]." ".$row["apellidos"]?></td>
              <td><?=$row["email"]?></td>
              <td><?=$row["imagen"]?></td>
              <td><a href="./ejercicios/ejercicio09/editar.php?usuario_id=<?=$row["usuario_id"]?>">Editar</a>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="./ejercicios/ejercicio09/eliminar.php?usuario_id=<?=$row["usuario_id"]?>">Eliminar</a>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="./ejercicios/ejercicio09/detallar.php?usuario_id=<?=$row["usuario_id"]?>">Detallar</a>
              </td>
            </tr>

          <?php } } ?>
          
        </table>

      </div>
    </div>

    <div class="pie text-center">
        <p>Domingo Guzmán Vélez</p>
    </div>
  </body>
</html>