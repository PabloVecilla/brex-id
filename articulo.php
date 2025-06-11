<?php
// Declaro variable para el título de la página
$pageTitle = "Artículo | Brex-id"; 
//Incluyo el menú: 
include("menu.html");
//Conecto con la base de datos y muestro error si falla
require_once "conexion.php"; 
// Validación de datos
require_once "validaciones.php"; 

//Trae el id del evento de la url vía get: 
$id = obtener_id_seguro('id'); // si está especificado, toma el valor de id como un entero (despreciando letras o símbolos y pasando cadenas a 0), si no existe se asigna el valor null. 
if (!$id) {
    header("Location: articulos.php"); 
    exit; 
}

// Preparo la select con valor ? a definir.
$stmt_prev = $conn->prepare(
"select id_art from articulos where id_art < ? order by id_art desc limit 1" 
);
// Meto el id con bind_param, el primer parámetro es el tipo de dato ("i" para integer) y el segundo el valor, en este caso la variable $id
$stmt_prev -> bind_param('i', $id); 
// Ejecuto la select con parámetros
$stmt_prev->execute(); 
// Variable para almacenar el resultado de la select
$result_prev = $stmt_prev->get_result(); 
// Variable para el id del artículo anterior
$prev_art = $result_prev->fetch_assoc(); 
//Variable que recoje el id del artículo anterior
$prev_id = $prev_art['id_art'] ?? null; 

// DATA para el botón SIGUIENTE: 
$stmt_sig = $conn->prepare("select id_art from articulos where id_art > ? order by id_art asc limit 1"); //preparo la select
$stmt_sig->bind_param("i", $id); //añado el id seguro como int
$stmt_sig->execute(); //ejecuto select
$result_sig = $stmt_sig->get_result(); 
$sig_art = $result_sig->fetch_assoc(); 
$sig_id = $sig_art['id_art'] ?? null; 

// Artículo actual: 
$stmt = $conn->prepare("SELECT * FROM articulos WHERE id_art = ?"); 
$stmt->bind_param("i", $id); 
$stmt->execute(); 
$result = $stmt->get_result(); 

//Si hay id; 
if ($articulo = $result->fetch_assoc()) {
    ?>
        <!-- HTML para el display del artículo -->
        <main class="page_wrap">
        <h1><?php echo escape($articulo['titulo']); ?></h1>
                <div class="content_wrap">
                    <img src="<?php echo escape($articulo['foto']); ?>" class="evento_img" alt="imagen de <?php echo escape($articulo['titulo']); ?>">
                    <p><i>Publicado: </i><?php echo escape($articulo['fecha']) ?></p>
                    <p> <?php echo nl2br(escape($articulo['contenido'])) ?> </p>
                </div>
                <div class="button_wrap">
                    <button class="btn btn-primary" onclick="location.href='<?php echo $prev_id ? "articulo.php?id=$prev_id" : "articulos.php"; ?>'">ANTERIOR</button>
                    <button class="btn btn-primary" onclick="location.href='<?php echo $sig_id ? "articulo.php?id=$sig_id" : "articulos.php"; ?>'">SIGUIENTE</button>
                </div>
                </main>
    <?php }
    $result->free();
    $stmt->close();
    $result_prev->free();
    $stmt_prev->close();
    $result_sig->free();
    $stmt_sig->close();
    $conn->close();
 include ('footer.html'); ?>