<?php 
// Incluyo el menú de administración con valida_usuario y session_start(); 
include ("menu_admin.php");
// Declaro variable para el título
$pageTitle = "Home | Brex-id";

// Conecto con la base de datos. 
require_once "conexion.php"; 
?>
<h1>Calendario de eventos</h1>
<div class="content_wrap">

<?php // Mensaje de operación realizada con éxito
if (!empty($_GET['msg']) && $_GET['msg'] === 'ok') : ?>
    <div class="alert alert-success">Operación realizada con éxito.</div>
 <?php endif;
?>
<?php
    // Select de todos los campos de EVENTOS
    $sql="select * from eventos order by fecha desc";
    $result = mysqli_query($conn, $sql); 
    $index = 0; 
    while ($evento = mysqli_fetch_assoc($result)){
?>
<form action="crud.php" method="post" class="col-lg-4 col-md-6 col-sm-12">
    <!-- Input type hidden para guardar el id del evento a borrar -->
    <input type="hidden" name="accion" value="borr_event">
    <input type="hidden" name="id_event" value="<?php echo $evento['id_evento']; ?>">

        <div class="card" style="width: 18rem;">
            <div class="img_wrap"><img src="<?php echo $evento['foto']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($evento['titulo']); ?>"></div>
            <div class="card-body">
            <h5 class="card-title">
            <?php echo $evento['titulo']; ?>
            </h5>
            <p class="card-text texto_discreto"><?php echo $evento['fecha'] ?></p>
            <p class="card-text"><?php echo $evento['ponentes'] ?></p>
            </div>
            <div class="card-footer">
            <!-- Página dinámica que cargue la info completa del evento desde BD -->
            <a href="modi.php?id_eve=<?php echo $evento['id_evento'] ?>" class="btn btn-primary">Modificar</a>
            <!-- Genero un formulario para enviar data por post -->
                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro que quieres eliminar el evento <?php echo addslashes($evento["titulo"]); ?>?')">Eliminar</button>
            </div>
        </div>
    </form>
    <?php $index++; 
    }
     // Libero espacio en la RAM eliminando el resultset que ya he utilizado
     mysqli_free_result($result); 
     // Cierro la conexión
     $conn->close(); 
     ?>
</div>
<?php include ('footer.html'); ?>
