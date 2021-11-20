<table class="table table-dark table-striped table-hover">
  <tr>
      <th>NOMBRE</th>
      <th>E-MAIL</th>
      <th>OPERACIONES</th>
      <th>IMAGEN</th>
  </tr>

  <?php while($row = $query->fetch()){ { ?> 

    <tr>
      <td><?=$row["nombre"]." ".$row["apellidos"]?></td>
      <td><?=$row["email"]?></td>
      <td><img src="fotos/<?=$row["imagen"]?>" height="50" width="50"/><!--<?=$row["imagen"]?> --></td>
      <td><a href="./editar.php?usuario_id=<?=$row["usuario_id"]?>">Editar</a>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <a href="./eliminar.php?usuario_id=<?=$row["usuario_id"]?>">Eliminar</a>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <a href="./detallar.php?usuario_id=<?=$row["usuario_id"]?>">Detallar</a>
      </td>
    </tr>

  <?php } } ?>
  
</table>