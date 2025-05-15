<?php
$email = trim($_POST['email'] ?? '');
$equipo = trim($_POST['equipo'] ?? '');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($email) || empty($equipo)) {
        echo "<h2>❌ Debe completar todos los campos.</h2>";
        exit;
    }
    
    $archivoVotantes = 'votantes.txt';

    // Verificamos si ya votó
    if (file_exists($archivoVotantes)) {
        $votantes = file($archivoVotantes, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (in_array($email, $votantes)) {
            echo "<h2>⚠️ El e-mail <b>$email</b> ya ha votado.</h2>";
            exit;
        }
    }

    // Guarda el voto
    file_put_contents('resultados.txt', "Email: $email - Equipo: $equipo\n", FILE_APPEND);
    file_put_contents($archivoVotantes, "$email\n", FILE_APPEND);

    echo "<h2>✅ Gracias por votar, <b>$email</b>. Usted eligió: <b>$equipo</b></h2>";
} else {
    echo "<h2>❌ Acceso inválido</h2>";
}
?>