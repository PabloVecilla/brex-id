<?php
session_start(); // abro sesión
// Declaro variable para el título
$pageTitle = "Login | Brex-id";
// Incluyo el menú
require ("menu.html"); 
?>
<main class="page_wrap">
<h1>Formulario de Entrada</h1>
<div class="content_wrap">
    <div class="admin_form_wrap"><form action="login_verifica.php" class="formulario" method="POST">
        <h2 class="titulo">ENTRAR EN SISTEMA</h2>
            <p><label for="usu">Usuario:</label><input type="text" id="usu" name="usu" placeholder="Usuario" class="i100" required></p>
            <p><label for="pas">Contraseña: </label><input type="password" id="pas" name="pas" placeholder="Contraseña" class="i100" required></p>
            <p><button class="btn btn-primary" type="submit" id="enviar" class="enviar">Enviar</button></p>

    </form></div>
</div>
</main>
<?php include ('footer.html'); ?>