<?php
function valida_usuario() {
    if (session_status() === PHP_SESSION_NONE){ 
        session_start();
    }
    if (!isset ($_SESSION["rol"]) || $_SESSION['rol']!=="admin") {
        header("Location: login.php");
        exit; 
    }
}
valida_usuario(); 

// Especificamos duración de la sesión: 
$timeout_duration = 1200; // tiempo en segundos; 
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset(); 
    session_destroy(); 
    echo "<script>alert('Sesión expirada, por favor inicia sesión de nuevo'); window.location.href='login.php'; </script>"; 
    exit; 
}

$_SESSION['LAST_ACTIVITY'] = time(); 
?>