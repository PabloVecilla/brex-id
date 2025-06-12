<?php
require_once "validaciones.php";// Importa las funciones para validar campos 
// Conecto a la base de datos: 
require_once "conexion.php"; 

// COOKIES de sesión: 
session_set_cookie_params([
    'lifetime' => 0, 
    'path' => '/', 
    'secure' => true,
    'httponly' => true, 
    'samesite' => 'Strict'
]); 
//Crea una nueva sesión 
session_start();  
if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Cargo los datos del formulario
        $usu= trim($_POST["usu"] ?? '');
        $pass=trim($_POST["pas"] ?? '');


        if ($usu === '' || $pass === ''){
            echo "<script>alert('Por favor, completa todos los campos.'); window.location.href='login.php';</script>"; 
            exit; 
        }

        $usu = valida_campo($usu); 
        // Preparamos los inputs para evitar inyecciones sql
        $stmt = $conn->prepare("SELECT * FROM perfiles WHERE alias = ?"); 
        $stmt->bind_param("s", $usu);
        $stmt->execute(); 
        $result = $stmt->get_result(); 

        if($user = $result->fetch_assoc()) {
            // usar password_verify para contraseñas: 
                
                if (password_verify($pass, $user['pass'])) {
                    // Regenero el id de sesión: 
                    session_regenerate_id(true); 

                    //Genero variables de sesión para los datos del usuario: 
                    $_SESSION["nombre"] = $user["nombre"]; 
                    $_SESSION["apellidos"] = $user["apellidos"]; 
                    $_SESSION["rol"] = $user["rol"]; 

                    require_once "valida_usuario.php";//validación de usuario con rol admin 


                    $stmt->close(); 
                    $conn->close(); 

                    header("location: admin.php"); 
                    exit; 
                } else {
                    // Contraseña incorrecta
                    $stmt->close(); 
                    $conn->close(); 
                    echo "<script>alert('Contraseña incorrecto'); window.location.href='login.php';</script>";
                    exit; 
                } 
        } else {
            //usuario incorrecto
            $stmt->close();
            $conn->close(); 
            echo "<script>alert('Usuario no encontrado'); window.location.href='login.php'; </script>";
        }
    } else {
        echo "<script> alert('Acceso no permitido'); window.location.href='login.php';</script>";
        exit; 
    }
?>