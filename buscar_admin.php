<?php
// Incluyo el menú admin.
include("menu_admin.php");
// Declaro variable para el título
$pageTitle = "Home | Brex-id";
// conecto con la BD
include "conxion.php"; 

$keyword = trim($_GET['bus'] ?? ''); 
$keyword = mysqli_real_escape_string($con, $keyword); 
if (!$keyword){
    echo "Introduzca un criterio de búsqueda";
    exit; 
}
// Preparar keyword: 
$searchParam = "%$keyword%"; 
// EVENTOS: 
$stmt1 = $conn->prepare("SELECT 'evento' as tipo, titulo,ponentes,contenido,espacio, null as tematica, id_evento as id, foto
FROM eventos
WHERE titulo LIKE ? OR ponentes LIKE ? OR contenido LIKE ? OR espacio LIKE ?
");  
$stmt1->bind_param("ssss", $searchParam, $searchParam, $searchParam, $searchParam);
$stmt1->execute(); 
$result1 = $stmt1->get_result(); 

// ARTÍCULOS
$stmt2 = $conn->prepare("SELECT 'articulo' as tipo, titulo, resumen as ponentes, contenido, ' ' as espacio, tematica, id_art as id, foto
FROM articulos
WHERE titulo LIKE ? OR resumen LIKE ? OR tematica LIKE ? 
"); 
$stmt2->bind_param("sss", $searchParam, $searchParam, $searchParam); 
$stmt2->execute(); 
$result2 = $stmt2->get_result(); 

// Combina resultados
$cards = []; 
while($row = $result1->fetch_assoc()) $cards[] = $row; 
while($row = $result2->fetch_assoc()) $cards[] = $row; 

// Genera tarjetas
foreach ($cards as $card){
    ?>
    <div class="content_wrap">
    <form action="crud.php" method="post" class="col-lg-4 col-md-6 col-sm-12">
        <input type="hidden" name="accion" value="borr_art">
        <input type="hidden" name="id_art" value="<?php echo $card['id']; ?>">
            <div class="card" style="width: 18rem;">
                <img src="<?php echo $card['foto']; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title"><?php echo $card['titulo']; ?></h5>
                <p class="card-text"><?php echo $card['contenido'] ?></p>
                <!-- Página dinámica que cargue la info completa del evento desde BD -->
                <a href="modi.php?id_art=<?php echo $card['id']?>" class="btn btn-primary">Modificar</a>
                <!-- button para enviar data por post a borrar -->
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Seguro que quieres eliminar el artículo <?php echo addslashes($card["titulo"]); ?>?')">Eliminar</button>
                </div>
            </div>
        </form>
    </div>

        <?php 
    }
    // Libero espacio en la RAM eliminando los resultset
    $result1->free(); 
    $result2->free();
    $stmt1->close();  
    $stmt2->close();
    // Cierro la conexión
    $conn->close(); 
    include ('footer.html'); ?>