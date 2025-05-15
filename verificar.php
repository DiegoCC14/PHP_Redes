<?php
$email = trim($_POST['email'] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($email === '') {
        echo "❌ Debe ingresar un correo.";
        exit;
    }

    $archivo = 'correos_usados.txt';

    // Si el archivo no existe, lo crea
    if (!file_exists($archivo)) {
        $nuevo = fopen($archivo, "w");
        fclose($nuevo);
    }

    // Leer contenido actual
    $contenido = file($archivo, FILE_IGNORE_NEW_LINES);

    // Verificar si el correo ya existe
    if (in_array($email, $contenido)) {
        echo "⚠️ El correo $email ya votó.";
    } else {
        // Guardar el nuevo correo
        $file = fopen($archivo, "a");
        fwrite($file, $email . "\n");
        fclose($file);

        echo "✅ Voto registrado para $email.";
    }
} else {
    echo "❌ Acceso no permitido.";
}
?>
