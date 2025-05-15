<?php
$archivo_votantes = 'correos_usados.txt';
$archivo_log = 'registro.txt';

$email = trim($_POST['email'] ?? '');
$ip = $_SERVER['REMOTE_ADDR'] ?? 'Desconocida';
$puerto = $_SERVER['REMOTE_PORT'] ?? 'Desconocido';
$fecha = date('Y-m-d H:i:s');

// Validación de envío
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($email)) {
        echo "<h2>❌ Correo vacío</h2>";
        $file = fopen($archivo_log, "a");
        fwrite($file, "[$fecha] IP: $ip Port: $puerto — Email vacío\n");
        fclose($file);
        exit;
    }

    $email = strtolower($email);

    // Leer correos existentes
    $votantes = file_exists($archivo_votantes)
        ? file($archivo_votantes, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)
        : [];

    $file = fopen($archivo_log, "a");
    
    echo "<h2>⚠️ El correo <b>$votantes</b> ya ha votado.</h2>";

    if (in_array($email, $votantes)) {
        echo "<h2>⚠️ El correo <b>$email</b> ya ha votado.</h2>";
        fwrite($file, "[$fecha] User: $email, IP: $ip Port: $puerto — Intento repetido\n");
    } else {
        file_put_contents($archivo_votantes, "$email\n", FILE_APPEND);
        echo "<h2>✅ Gracias por votar, <b>$email</b>.</h2>";
        fwrite($file, "[$fecha] User: $email, IP: $ip Port: $puerto — Voto registrado\n");
    }

    fclose($file);
} else {
    echo "<h2>❌ Método no permitido</h2>";
}
?>
