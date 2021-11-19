<table class="table table-dark table-striped table-hover">
  <tr>
      <th>NOMBRE</th>
      <th>APELLIDOS</th>
      <th>BIOGRAFÍA</th>
      <th>E-MAIL</th>
      <th>CONTRASEÑA</th>
      <th>IMAGEN</th>
  </tr>

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