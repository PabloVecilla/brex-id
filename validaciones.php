<?php
// Validar ID como entero seguro 
function obtener_id_seguro($param) {
    $id = filter_input(INPUT_GET, $param, FILTER_VALIDATE_INT);
    return ($id !== false && $id > 0) ? $id : null; 
}

// Validar campo: 
function string_seguro($campo) {
    return htmlspecialchars(trim($_GET[$campo] ?? ''), ENT_QUOTES, 'UTF-8');
}

// Validar en BACKEND
function valida_campo($campo) {
    $campo = trim($campo); 
    $campo = strip_tags($campo); 
    $campo = htmlspecialchars($campo, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); 
    return $campo; 
    // ENT_QUOTES retira las comillas dobles y simples y las sustituye por caracteres seguros para evitar inyecciones de código
    // ENT_SUBSTITUTE sustituye los caracteres inválidos en entorno UTF-8 y los sustituye por símbolos seguros para que en lugar de romperse, la app se siga cargando con normalidad
}

// Escapar salida HTML:: Retira las capacidades de influir en el código de cualquier input externo, pasando código como etiquetas y scripts a texto plano inútil. 
function escape($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8'); 
}

// Función para validar la fecha en formato: 
function valida_fecha($fecha) {
    $d = DateTime::createFromFormat('Y-m-d', $fecha); 
    return $d && $d->format('Y-m-d') === $fecha; 
}
?>