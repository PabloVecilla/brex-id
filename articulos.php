<?php
// Declaro variable para el título
$pageTitle = "Producción | Brex-id";
// incluyo el menu
include("menu.html"); 
//Conecto con la base de datos
require_once "conexion.php"; 
// Importo las funciones de validación 
require_once "validaciones.php";
?>
<main class="page_wrap">
<h1>Biblioteca de Artículos</h1>
<div class="content_wrap row">
<?php
// SELECT de todos los campos de ARTICULOS
$stmt=$conn->prepare("select * from articulos order by fecha desc"); 
$stmt->execute(); 
$result = $stmt->get_result(); 
if ($result && $result->num_rows > 0){
    while ($articulo = $result->fetch_assoc()) {
        ?>
            <div class="card_wrap col-lg-4 col-md-6 col-sm-12">
            <a href="articulo.php?id=<?php echo escape($articulo['id_art']) ?>">
                <div class="card" style="width: 18rem;">
                    <div class="img_wrap"><img src="<?php echo escape($articulo['foto']); ?>" class="card-img-top" alt="Imagen de <?php echo escape($articulo['titulo']); ?>"></div>
                    <div class="card-body">
                    <h5 class="card-title">
                    <?php echo escape($articulo['titulo']); ?>
                    </h5>
                    <p class="card-text texto_discreto"><?php echo escape($articulo['fecha']) ?></p>
                    <p class="card-text"><?php echo escape($articulo['tematica']) ?></p>
                    </div>
                </div>
            </a>
            </div>
        <?php
            }
} else {
    echo "<p>No hay artículos para mostrar</p>";
}
$result->free(); 
$stmt->close(); 
mysqli_close($conn); 
?>
</div>
</main>
<?php include ('footer.html'); ?>