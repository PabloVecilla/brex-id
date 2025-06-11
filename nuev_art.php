<?php
// valida usuario 
require_once "valida_usuario.php"; 
// Me conecto a la BD
require_once ("conexion.php");
// importo funciones de validación
require_once "validaciones.php"; 


// Cargo los datos del formulario ARTÍCULOS
$titulo = string_seguro($_POST["tit_art"]); 
$resumen = string_seguro($_POST["res_art"]); 
$tematica = string_seguro($_POST["tem_art"]); 
$fecha = string_seguro($_POST["fech_art"]); 
$contenido = string_seguro($_POST["con_art"]); 

//Inserto los datos en la bd
$stmt = $conn->prepare("insert into articulos (titulo,resumen,tematica,fecha, contenido) 
            VALUES (?,?,?,?,?)");
$stmt->bind_param("sssss",$titulo, $resumen, $tematica, $fecha, $contenido); 


if ($stmt->execute)// Si se ha insertado
{
    echo "<script>alert('Artículo registrado correctamente');
        window.location='admin.php';</script>";
} else {
    
    die("Se ha producido un error ------- " . $stmt->error);
    /*echo "<script>alert('No se ha registrado correctamente:');
        window.history.back;</script>";*/
}

$stmt->close(); 
$conn->close(); 
?>