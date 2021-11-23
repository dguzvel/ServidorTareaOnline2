<table class="table table-dark table-striped table-hover">
<tr>
    <th>NOMBRE</th>
    <th>E-MAIL</th>
    <th>IMAGEN</th>
    <th>OPERACIONES</th>
</tr>

<?php foreach($articulos as $articulo){ ?> 

    <tr>
    <td><?=$articulo["nombre"]." ".$articulo["apellidos"]?></td>
    <td><?=$articulo["email"]?></td>
    <td><img src="fotos/<?=$articulo["imagen"]?>" height="50" width="50"/><!--<?=$row["imagen"]?> --></td>
    <td><a href="./editar.php?usuario_id=<?=$articulo["usuario_id"]?>">Editar</a>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="./eliminar.php?usuario_id=<?=$articulo["usuario_id"]?>">Eliminar</a>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="./detallar.php?usuario_id=<?=$articulo["usuario_id"]?>">Detallar</a>
    </td>
    </tr>

<?php } ?>

</table>

<nav aria-label="Page navigation">
<ul class="pagination">

    <?php if($pagina == 1){ ?>

      <li class="page-item disabled">
      <a class="page-link" href="" aria-label="Previous">
          <span aria-hidden="true">«</span>
          <span class="sr-only">Anterior</span>
      </a>
      </li>
    <?php }else{ ?>

      <li class="page-item">
      <a class="page-link" href="?pagina=<?php echo $pagina - 1 ?>" aria-label="Previous">
          <span aria-hidden="true">«</span>
          <span class="sr-only">Anterior</span>
      </a>
      </li>
    <?php } ?>

    <?php
    
      for($i = 1; $i <= $numeroPagina; $i++){

        if($pagina == $i){

          echo "<li class='page-item active'>
                  <a class='page-link' href='?pagina=$i'>$i</a>
                </li>";

        }else{

          echo "<li class='page-item'>
                  <a class='page-link' href='?pagina=$i'>$i</a>
                </li>";

        }  

      }

    ?>
    
    <?php if($pagina == $numeroPagina){ ?>

    <li class="page-item disabled">
    <a class="page-link" href="" aria-label="Previous">
        <span aria-hidden="true">»</span>
        <span class="sr-only">Siguiente</span>
    </a>
    </li>

    <?php }else{ ?>

    <li class="page-item">
    <a class="page-link" href="?pagina=<?php echo $pagina + 1 ?>" aria-label="Previous">
        <span aria-hidden="true">»</span>
        <span class="sr-only">Siguiente</span>
    </a>
    </li>

    <?php } ?>

</ul>
</nav>