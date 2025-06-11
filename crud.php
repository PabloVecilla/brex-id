<?php 
// Habría que llamar a la función
// valida_usuario() en todas las página
// para que al backend sólo entre el
// usuario con rol admin, antes incluso
// de que empiece el HTML
require_once ("valida_usuario.php");
valida_usuario(); 
// conecto con la BD
require_once "conexion.php";
// funciones de validación : 
require_once "validaciones.php";
// variable para recoger la data enviada por post desde las tarjetas de ver_even y ver_art
$accion = $_POST["accion"] ?? null; 

if(!$accion) {
    echo "<script>alert('Acción no válida.'); window.location='admin.php'; </script>"; 
    exit; 
}

try {
    switch($accion) {
        // EN el caso de borrar evento: 
        case "borr_event":
            $id = (int)$_POST["id_event"]; 
            if($id<=0){
                throw new Exception ("ID inválido");
            }
            $stmt = $conn->prepare("DELETE from eventos where 
                id_evento = ?");
            $stmt->bind_param("i", $id); 
            break; 
        // EN el caso de modificar evento: 
        case "mod_event":
            $fecha = $_POST['fech_event']; 
            if(!valida_fecha($fecha)){
                throw new Exception("Fecha en formato inválido (YYYY-mm-dd)."); 
            }
            $id = (int)$_POST["id_event"]; 
            if($id<=0){
                throw new Exception ("ID inválido");
            }
            $stmt = $conn->prepare("update eventos set 
                titulo=?,
                tematica=?,
                ponentes=?,
                fecha=?,
                contenido=?,
                foto=?,
                espacio=?
                where id_evento=?");
            $stmt->bind_param("sssssssi", valida_campo($_POST['tit_event']),
                                        valida_campo($_POST['tem_event']),
                                        valida_campo($_POST['pon_event']),
                                        $fecha,
                                        valida_campo($_POST['con_event']),
                                        valida_campo($_POST['fot_event']), 
                                        valida_campo($_POST['esp_event']),
                                        $id ); 
            break;
        // EN el caso de insertar nuevo evento: 
        case "nuev_event": 
            $fecha = $_POST['fech_event']; 
            if(!valida_fecha($fecha)){
                throw new Exception("Fecha en formato inválido (YYYY-mm-dd)."); 
            }
            $stmt = $conn->prepare("insert into eventos (titulo,tematica,ponentes,fecha,contenido,foto,espacio) 
                values (?,?,?,?,?,?,?);"); 
            $stmt->bind_param("sssssss", valida_campo($_POST['tit_event']),
                                        valida_campo($_POST['tem_event']),
                                        valida_campo($_POST['pon_event']),
                                        $fecha,
                                        valida_campo($_POST['con_event']),
                                        valida_campo($_POST['fot_event']), 
                                        valida_campo($_POST['esp_event'])
                                        ); 
            break; 
        // EN el caso de borrar un artículo: 
        case "borr_art":
            $id = (int)$_POST["id_art"]; 
            if($id<=0){
                throw new Exception ("ID inválido");
            }
            $stmt=$conn->prepare("delete from articulos where 
                    id_art=?;"); 
            $stmt->bind_param("i", $id);
            break;
        // En el caso de modificar artículo: 
        case "mod_art":
            $fecha = $_POST['fech_art']; 
            if(!valida_fecha($fecha)){
                throw new Exception("Fecha en formato inválido (YYYY-mm-dd)."); 
            }
            $id = (int)$_POST["id_art"]; 
            if($id<=0){
                throw new Exception ("ID inválido");
            }
            $stmt = $conn->prepare("update articulos set 
                    titulo=?,
                    resumen=?,
                    tematica=?,
                    fecha=?,
                    contenido=?,
                    foto=?
    
                where id_art=?");
            $stmt->bind_param("ssssssi", valida_campo($_POST["tit_art"]),
                                        valida_campo($_POST["res_art"]), 
                                        valida_campo($_POST["tem_art"]),
                                        $fecha,
                                        valida_campo($_POST["con_art"]),
                                        valida_campo($_POST["fot_art"]),
                                        $id);
                break;
        // En caso de nuevo artículo: 
        case "nuev_art": 
            $fecha = $_POST['fech_art']; 
            if(!valida_fecha($fecha)){
                throw new Exception("Fecha en formato inválido (YYYY-mm-dd)."); 
            }
            $stmt = $conn->prepare("insert into articulos (titulo,resumen,tematica,fecha,contenido,foto) 
                values (?,?,?,?,?,?)"); 
            $stmt ->bind_param("ssssss", valida_campo($_POST["tit_art"]),
                                        valida_campo($_POST["res_art"]),
                                        valida_campo($_POST["tem_art"]),
                                        $fecha,
                                        valida_campo($_POST["con_art"]),
                                        valida_campo($_POST["fot_art"])); 
            break; 

        default:
            throw new Exception("Accion no reconocida.");
        } 

if($stmt->execute()) {
    $redirect = (str_starts_with($accion, 'nuev_art') || str_starts_with($accion, 'mod_art') || str_starts_with($accion, 'borr_art'))
    ? 'ver_art.php' : 'ver_even.php';

header("Location: $redirect?msg=ok");
exit;
} else {
    throw new Exception("Error al ejecutar la operación: " . $stmt->error); 
}
$stmt->close(); 
$conn->close(); 
} catch (Exception $e) {
    echo "<script>alert('" . addslashes($e->getMessage()) . "'); window.location='admin.php'; </script>"; 
}
?>