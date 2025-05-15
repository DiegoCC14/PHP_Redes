<?php
// Verificamos si el usuario ya votó con una cookie
if (isset($_COOKIE['voto_realizado'])) {
    echo "<h2>✅ Ya ha realizado su voto.</h2>";
    exit;
}

// Verificamos que se haya enviado por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST["email"]);
    $equipo = htmlspecialchars($_POST["equipo"]);

    // Podés guardar los datos en un archivo de texto si querés hacer un registro simple
    $registro = fopen("resultados.txt", "a");
    fwrite($registro, "Email: $email - Equipo: $equipo\n");
    fclose($registro);

    // Creamos una cookie para evitar múltiples votos (por navegador)
    setcookie("voto_realizado", "1", time() + (60 * 60 * 24)); // 1 día

    echo "<h2>✅ Gracias por votar, $email. Usted eligió: $equipo</h2>";
} else {
    echo "<h2>❌ Acceso inválido</h2>";
}
?>
