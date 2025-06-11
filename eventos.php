<?php
// Declaro variable para el título
$pageTitle = "Eventos | Brex-id";
// Incluyo el menú
include("menu.html");
// Conecto con la base de datos. 
require_once "conexion.php";
// Importo funciones de validación
require_once "validaciones.php";
?>
<main class="page_wrap">
<h1>Calendario de eventos</h1>
<div class="content_wrap row">
<?php
    // Select de todos los EVENTOS ordenados por fecha desc
    $stmt = $conn->prepare("select * from eventos order by fecha desc");
    $stmt->execute();
    $result = $stmt->get_result();  
    // Verificamos si hy resultados: 
        if ($result && $result->num_rows > 0){
            while ($evento = $result->fetch_assoc()){
                ?>
                <div class="card_wrap col-lg-4 col-md-6 col-sm-12">
                <a href="evento.php?id=<?php echo escape($evento['id_evento']) ?>">
                    <div class="card" style="width: 18rem;">
                        <div class="img_wrap">
                            <img src="<?php echo escape($evento['foto']); ?>" class="card-img-top" alt=".Imagen de <?php echo escape($evento['titulo']); ?>">
                        </div>
                        <div class="card-body">
                        <h5 class="card-title"><?php echo escape($evento['titulo']); ?></h5>
                        <p class="card-text texto_discreto"><?php echo escape($evento['fecha']) ?></p>
                        <p class="card-text"><?php echo escape($evento['ponentes']) ?></p>
                        </div>
                    </div>
                </a>
                </div>
                <?php
            }
                       
        } else{
            echo "<p>No hay eventos para mostrar.</p>"; 
        }

// Libero espacio en la RAM eliminando el resultset que ya he utilizado
$result->free(); 
$stmt->close(); 
 // Cierro la conexión
$conn->close(); 
 ?>
</div>
</main>
<?php include ('footer.html'); ?>
