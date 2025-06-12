<?php
//Declaro variable para el título de la página
$pageTitle = "Admin | Brex-id"; 
// Incluyo el menú
include("menu_admin.php");
$nombre = $_SESSION['nombre']; 
?>
<div><h1 class="h1_home">Zona de administración de <?php echo $nombre ?></h1></div>
<div class="content_wrap">
<div class="admin_form_wrap"><form action="crud.php" method="post">
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