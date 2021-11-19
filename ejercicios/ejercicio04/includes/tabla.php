<table class="table table-dark table-striped table-hover">
  <tr>
      <th>NOMBRE</th>
      <th>E-MAIL</th>
      <th>OPERACIONES</th>
  </tr>

  <?php while($row = $query->fetch()){ { ?> 

    <tr>
    <td><?=$row["nombre"]." ".$row["apellidos"]?></td>
    <td><?=$row["email"]?></td>
    <td><a href="./editar.php?usuario_id=<?=$row["usuario_id"]?>">Editar</a>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="./añadir.php">Añadir</a></td>
    </tr>

  <?php } } ?>
  
</table>