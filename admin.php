<?php
//Declaro variable para el título de la página
$pageTitle = "Admin | Brex-id"; 
// Incluyo el menú
include("menu_admin.php");
$nombre = $_SESSION['nombre'];
    
?>
<div><h1 class="h1_home">Zona de administración de <?php echo $nombre ?></h1></div>
<div class="admin_wrap">
<div><form action="crud.php" method="post">
    <h2>Nuevo evento</h2>
    <p><label for="tit_event">Título: </label><input type="text" id="tit_event" name="tit_event"></p>
    <p><label for="tem_event">Temática: </label><input type="text" id="tem_event" name="tem_event"></p>
    <p><label for="pon_event">Ponentes: </label><input type="text" id="pon_event" name="pon_event"></p>
    <p><label for="fech_event">Fecha: </label><input type="text" id="fech_event" name="fech_event"></p>
    <p><label for="con_event">Contenido: </label><textarea name="con_event" id="con_event"></textarea></p>
    <p><label for="fot_event">Imágen: </label><input type="text" id="fot_event" name="fot_event" placeholder="url de la imágen del evento"></p>
    <p><label for="esp_event">Espacio: </label><input type="text" id="esp_event" name="esp_event"></p>
    <p><button class="btn btn-primary" type="submit" name="accion" value="nuev_event">Añadir a eventos</button></p>
</form></div>
<div><form action="crud.php" method="post">
    <h2>Nuevo artículo</h2>
    <p><label for="tit_art">Título: </label><input type="text" id="tit_art" name="tit_art"></p>
    <p><label for="res_art">Resumen: </label><input type="text" id="res_art" name="res_art"></p>
    <p><label for="tem_art">Temática: </label><input type="text" id="tem_art" name="tem_art"></p>
    <p><label for="fech_art">Fecha: </label><input type="text" id="fech_art" name="fech_art" placeholder="formato año-mes-día"></p>
    <p><label for="aut_art">Contenido: </label><textarea name="con_art" id="con_art"></textarea></p>
    <p><label for="fot_art">Imagen: </label> <input type="text" id="fot_art" name="fot_art"></p>

    <p><button class="btn btn-primary" type="submit" name="accion" value="nuev_art">Añadir artículo</button></p>
</form></div>
</div>
<!-- FOOTER -->
<?php include ('footer.html'); ?>