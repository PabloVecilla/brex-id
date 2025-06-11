<?php
// Declaro variable para el título
$pageTitle = "Home | Brex-id";
// incluyo el menú
include("menu.html");
// conecto con la BD
require "conexion.php";
// Funciones de validación
require_once "validaciones.php";
?>
<main class="page_wrap">
    <h1>Resultados de búsqueda</h1>
    <div class="content_wrap row">
<?php
$keyword = string_seguro('bus'); // trim e higiene de datos
if(!$keyword){
    echo "<p>Introduzca un criterio de búsqueda.</p>"; 
    include("footer.html");
    exit; 
}
// Protejo el input de usuario
$searchParam = "%$keyword%"; 
$stmt = $conn->prepare("(SELECT 'evento' AS  tipo, titulo, ponentes, tematica, espacio, id_evento as id, foto
FROM eventos
WHERE titulo like ? OR ponentes LIKE ? OR contenido LIKE ? OR espacio like ?)
UNION 
(SELECT 'articulo' as tipo, titulo, resumen AS ponentes, tematica, '' AS espacio, id_art as id, foto
FROM articulos
WHERE titulo LIKE ? OR resumen LIKE ? OR tematica LIKE ?)");
$stmt->bind_param("sssssss", $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam ); 
$stmt->execute(); 
$result = $stmt->get_result(); 

//Combino los dos resultados en un solo array
$tarjetas = []; 
while ($row = $result->fetch_assoc()) $tarjetas[] = $row; 

// Muestro las tarjetas: 
if (count($tarjetas) === 0) {
    echo "<p>No se encontraron resultados para <strong>" . escape($keyword) . "</strong>.</p>"; 
} else {
    foreach ($tarjetas as $tarjeta) {
        // ruta dependiendo del tipo
        $ruta = ($tarjeta['tipo'] === 'evento') ? "evento.php?id=" : "articulo.php?id="; 
        ?>
        <div class="col-lg-4 col-md-6 col-sm-12 card_wrap">
    <!-- Página dinámica que cargue la info completa del evento desde BD -->
    <a href="<?php echo $ruta . escape($tarjeta['id']); ?>" class="link_card">   
        <input type="hidden" name="id_art" value="<?php echo $tarjeta['id']; ?>">
            <div class="card" style="width: 18rem;">
                <div class="img_wrap">
                    <img src="<?php echo escape($tarjeta['foto']); ?>" class="card-img-top" alt="Imagen de <?php echo escape($tarjeta['titulo']) ?: 'Imagen sin título' ; ?>">
                </div>
                <div class="card-body">
                <h5 class="card-title"><?php echo escape($tarjeta['titulo']); ?></h5>
                <p class="texto_discreto"><?php echo escape($tarjeta['tematica']); ?></p>
                </div>
                <div class="card-footer texto_discreto text-end">
                    <?php echo ucfirst($tarjeta['tipo']); ?>
                </div>
            </div>
        </a>
    </div>
    <?php
    }
}
    // Libero espacio en la RAM eliminando el resultset que ya he utilizado
    $result->free(); 
    //cierro el statement para la búsqueda: 
    $stmt->close();
    // Cierro la conexión
    $conn->close(); 
    ?>
</div>
</main>
<?php include ('footer.html'); ?>