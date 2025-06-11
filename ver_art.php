<?php 
// Incluyo menu admin
include ("menu_admin.php");
// Declaro variable para el título
$pageTitle = "Artículos | Brex-id";
// Conecto con la base de datos. 
require_once "conexion.php";
?>
<h1>Biblioteca de artículos</h1>
<div class="content_wrap">
<?php // Mensaje de operación realizada con éxito
if (!empty($_GET['msg']) && $_GET['msg'] === 'ok') : ?>
    <div class="alert alert-success">Operación realizada con éxito.</div>
 <?php endif;
?>
<?php
    // Select de todos los campos de ARTICULOS
    $sql="select * from articulos order by fecha desc";
    $result = mysqli_query($conn, $sql); 
    $index = 0; 
    while ($articulo = mysqli_fetch_assoc($result)){
?>
<form action="crud.php" method="post" class="col-lg-4 col-md-6 col-sm-12">
    <input type="hidden" name="accion" value="borr_art">
    <input type="hidden" name="id_art" value="<?php echo $articulo['id_art']; ?>">
        <div class="card" style="width: 18rem;">
            <div class="img_wrap"><img src="<?php echo $articulo['foto']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($articulo['titulo']); ?>"></div>
            <div class="card-body">
            <h5 class="card-title">
            <?php echo $articulo['titulo']; ?>
            </h5>
            <p class="card-text texto_discreto"><?php echo $articulo['fecha'] ?></p>
            <p class="card-text resumen"><?php echo $articulo['resumen'] ?></p>
            </div>
            <div class="card-footer">
            <!-- Página dinámica que cargue la info completa del artículo desde BD -->
            <a href="modi.php?id_art=<?php echo $articulo['id_art'] ?>" class="btn btn-primary">Modificar</a>
            <!-- button para enviar data por post a borrar -->
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro que quieres eliminar el artículo <?php echo addslashes($articulo["titulo"]); ?>?')">Eliminar</button>
            </div>
        </div>
    </form>
    <?php $index++; 
    }
     // Libero espacio en la RAM eliminando el resultset que ya he utilizado
     mysqli_free_result($result); 
     // Cierro la conexión
     mysqli_close($conn); 
     ?>

</div>
<?php include ('footer.html'); ?>
