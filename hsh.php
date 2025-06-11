<?php
// Funciones de conexion 
require_once "conexion.php"; 
// Extracción de datos de perfiles
$sql = "SELECT id_perfil, pass from perfiles"; 
$result = $conn->query($sql); 

while ($row = $result->fetch_assoc()) { 
    $id = $row['id_perfil']; 
    $plainPassword = $row['pass']; 


// Opcional pero más seguro: 
if (password_get_info($plainPassword)['algo']) {
    echo "Usuario $id ya seguro. Saltando... <br>"; 
    continue; 
}

// hashear contraseña
$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT); 

// Actualizar en base de datos 
$stmt = $conn->prepare("UPDATE perfiles SET pass = ? where id_perfil = ?"); 
$stmt->bind_param("si", $hashedPassword, $id);
$stmt->execute(); 

Echo "ID de usuario: $id. Contraseña actualizada.<br>"; 
}
$conn->close(); 
?>