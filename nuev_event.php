<?php
// funcion para validar el usuario como admin: 
require_once "valida_usuario.php";
// Me conecto a la BD
require_once "conexion.php"; 
// importo funciones de validación
require_once "validaciones.php"; 

// Cargo los datos del formulario EVENTOS
$titulo = string_seguro($_POST["tit_event"]); 
$ponentes = string_seguro($_POST["pon_event"]);
$fecha = string_seguro($_POST["fech_event"]);
$contenido = string_seguro($_POST["con_event"]);
$foto = string_seguro($_POST["fot_event"]); 
$espacio = string_seguro($_POST["esp_event"]); 

//Inserto los datos en la bd
$stmt=$conn->prepare("insert into eventos (titulo,ponentes,fecha,contenido,foto,espacio) 
            values (?, ?, ?, ?, ?, ?)"); 

$stmt->bind_param("ssssss", $titulo, $ponentes, $fecha, $contenido, $foto, $espacio); 



if ($stmt->execute()) {
    echo "<script>alert('Evento registrado correctamente');
        window.location='admin.php';</script>";
} else {
    
    die("Se ha producido un error ------- " . $stmt->error);
    /*echo "<script>alert('No se ha registrado correctamente:');
        window.history.back;</script>";*/
}
$stmt->close(); 
$conn->close();