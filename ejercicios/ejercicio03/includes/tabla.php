<table class="table table-dark table-striped table-hover">
  <tr>
      <th>NOMBRE</th>
      <th>E-MAIL</th>
  </tr>

  <?php while($row = $query->fetch()){ { ?> 

    <tr>
    <td><?=$row["nombre"]." ".$row["apellidos"]?></td>
    <td><?=$row["email"]?></td>
    </tr>

  <?php } } ?>
  
</table>