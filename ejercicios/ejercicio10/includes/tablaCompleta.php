<table class="table table-dark table-striped table-hover">
<!-- Tabla que muestra todos los valores de un usuario determinado -->
  <tr>
      <th>NOMBRE</th>
      <th>APELLIDOS</th>
      <th>BIOGRAFÍA</th>
      <th>E-MAIL</th>
      <th>CONTRASEÑA</th>
      <th>IMAGEN</th>
  </tr>

  <!-- Mediante un bucle crearemos arrays $row mientras haya contenidos a los que hacer fetch en la query. 1 fila en este caso -->
  <?php while($row = $query->fetch()){ { ?> 

    <tr>
        <td><?=$row["nombre"]?></td>
        <td><?=$row["apellidos"]?></td>
        <td><?=$row["bio"]?></td>
        <td><?=$row["email"]?></td>
        <td><?=$row["password"]?></td>
        <td><?=$row["imagen"]?></td>
    </tr>

  <?php } } ?>
  
</table>