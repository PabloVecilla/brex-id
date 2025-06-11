<?php
// Incluyo el menu admin con validación de usuario e inicio de sesión
include("menu_admin.php");
// Declaro variable para el título
$pageTitle = "Modificar | Brex-id";
// Valida usuario   
require_once "validaciones.php"; 
//Funciones de conexión 
require_once "conexion.php"; 

$nombre = $_SESSION['nombre']; 
$id = isset($_GET["id_eve"]) ? escape($_GET["id_eve"]) :
       (isset($_GET["id_art"]) ? escape($_GET["id_art"]) : null); 
if(!$id){
    echo "ID no encontrado"; 
    exit; 
}

if (isset($_GET['id_eve'])) {
    $stmt = $conn->prepare("SELECT * FROM eventos WHERE id_evento = ?"); 
    $stmt->bind_param("i", $id); 
    $stmt->execute(); 
    $result = $stmt->get_result();
    $evento = $result->fetch_assoc(); 

    if (!$evento) {
        header("Location: admin.php?error=notfound"); 
        exit; 
    } 
?>
<div><h1 class="h1_home">Zona de administración de <?php echo $nombre ?></h1></div>
<div class="admin_wrap">
<div><form action="crud.php" method="post">
    <h2>Editar evento</h2>
    <input type="hidden" name="accion" value="mod_event">
    <input type="hidden" name="id_evento" value="<?php echo $evento['id_evento']; ?>">
    <p><label for="tit_event">Título: </label><input type="text" id="tit_event" name="tit_event" value="<?php echo htmlspecialchars($evento['titulo'])?>"></p>
    <p><label for="tem_event">Temática: </label><input type="text" id="tem_event" name="tem_event" value="<?php echo htmlspecialchars($evento['tematica'])?>"></p>
    <p><label for="pon_event">Ponentes: </label><input type="text" id="pon_event" name="pon_event" value="<?php echo htmlspecialchars($evento['ponentes'])?>"></p>
    <p><label for="fech_event">Fecha: </label><input type="text" id="fech_event" name="fech_event" value="<?php echo htmlspecialchars($evento['fecha'])?>"></p>
    <p><label for="con_event">Contenido: </label><input type="text" id="con_event" name="con_event" value="<?php echo htmlspecialchars($evento['contenido'])?>"></p>
    <p><label for="fot_event">Foto: </label><input type="text" id="fot_event" name="fot_event" value="<?php echo htmlspecialchars($evento['foto'])?>"></p>
    <p><label for="esp_event">Espacio: </label><input type="text" id="esp_event" name="esp_event" value="<?php echo htmlspecialchars($evento['espacio'])?>"></p>
    <button class="btn btn-primary" type="submit" name="accion" value="mod_event">Editar evento</button>
</form></div>

<?php  }

elseif (isset($_GET['id_art'])) {
    $stmt = $conn->prepare("SELECT * FROM articulos WHERE id_art = ?");
    $stmt->bind_param("i", $id); 
    $stmt->execute(); 
    $result = $stmt->get_result();  
    $articulo = $result->fetch_assoc(); 

    if (!$articulo) {
        header ("Location:admin.php?error=notfound"); 
        exit; 
    } 
?>
<div><h1 class="h1_home">Zona de administración de <?php echo $nombre ?></h1></div>
<div class="admin_wrap">
<div><form action="crud.php" method="post">
    <h2>Editar artículo</h2>
    <input type="hidden" name="accion" value="mod_art">
    <input type="hidden" name="id_art" value="<?php echo $articulo['id_art']; ?>">
    <p><label for="tit_art">Título: </label><input type="text" id="tit_art" name="tit_art" value="<?php echo htmlspecialchars($articulo ['titulo'])?>"></p>
    <p><label for="res_art">Resumen: </label><input type="text" id="res_art" name="res_art" value="<?php echo htmlspecialchars($articulo['resumen'])?>"></p>
    <p><label for="tem_art">Temática: </label><input type="text" id="tem_art" name="tem_art" value="<?php echo htmlspecialchars($articulo['tematica'])?>"></p>
    <p><label for="fech_art">Fecha: </label><input type="text" id="fech_art" name="fech_art" value="<?php echo htmlspecialchars($articulo['fecha'])?>"></p>
    <p><label for="con_art">Contenido: </label><textarea name="con_art" id="con_art"><?php echo htmlspecialchars($articulo['contenido'])?></textarea></p>
    <p><label for="fot_art">Imágen: </label><input type="text" id="fot_art" name="fot_art" value="<?php echo htmlspecialchars($articulo['foto'])?>"></p>

    <button class="btn btn-primary" type="submit" name="accion" value="mod_art">Editar artículo</button>
</form></div>

<?php  }
include ('footer.html'); ?>