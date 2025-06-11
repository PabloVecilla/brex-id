<?php
// Declaro variable para el título
$pageTitle = "Evento | Brex-id";
// Incluyo el menú
include("menu.html");
// Conecto con la base de datos. 
require_once "conexion.php";
// Importo funciones de validación. 
require_once "validaciones.php"; 

// TRAE EL ID DEL EVENTO de forma segura DE LA URL CON UN GET: 
$id = obtener_id_seguro("id"); 
if (!$id) {
    header("Location: eventos.php"); 
    exit; 
}

//TRAE EL ID anterior: 
$stmt_prev = $conn->prepare("select id_evento from eventos where id_evento < ? order by id_evento desc limit 1"); 
// Añado el $id a la select
$stmt_prev->bind_param("i", $id); 
// Hago la select
$stmt_prev->execute(); 
// Guardo el resultado: 
$result_prev = $stmt_prev->get_result(); 
// Extraigo la data como array asociativo: 
$prev_event = $result_prev->fetch_assoc(); 
// Saco el id: 
$prev_id = $prev_event["id_evento"] ?? null; 

// ID del evento siguiente:
$stmt_sig = $conn->prepare("select id_evento from eventos where id_evento > ? order by id_evento asc limit 1");
$stmt_sig->bind_param("i", $id); 
$stmt_sig->execute(); 
$result_sig = $stmt_sig->get_result(); 
$sig_event = $result_sig->fetch_assoc(); 
$sig_id = $sig_event['id_evento'] ?? null; 

// EVENTO actual: 
$stmt = $conn->prepare("SELECT * FROM eventos WHERE id_evento = ?"); 
$stmt->bind_param("i", $id); 
$stmt->execute(); 
$result = $stmt->get_result(); 

if ($evento = $result->fetch_assoc()) {
?> 
    <!-- HTML para display del evento -->
     <main class="page_wrap">
    <h1><?php echo escape($evento['titulo']); ?></h1>
    <div class="content_wrap">
        <img src="<?php echo escape($evento['foto']); ?>" class="evento_img" alt="imagen de <?php echo escape($evento['titulo']) ?>">
        <p><i>El día: </i><?php echo escape($evento['fecha']) ?> - en: <?php echo escape($evento['espacio']) ?> </p>
        <p> <?php echo nl2br(escape($evento['contenido'])) ?> </p>
    </div>
    <div class="button_wrap">
        <button class="btn btn-primary" onclick="location.href='<?php echo $prev_id ? "evento.php?id=$prev_id" : "eventos.php"; ?>'">ANTERIOR</button>
        <button class="btn btn-primary" onclick="location.href='<?php echo $sig_id ? "evento.php?id=$sig_id" : "eventos.php"; ?>'">SIGUIENTE</button>
    </div> 
    </main>        
<?php } else {
        echo "<p>Evento no encontrado</p>";
    }
// libero resultados
$result->free(); 
$result_prev->free(); 
$result_sig->free(); 
$stmt_prev->close(); 
$stmt_sig->close(); 
$stmt->close(); 
// cierro conexión con BD 
$conn->close();  
include ('footer.html'); ?>
    <!-- FIN PHP --> 

   