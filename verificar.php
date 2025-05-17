<?php
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        # Datps Formulario --------------------->>>>>
        $email = trim($_POST['email'] ?? '');
        $voto = trim($_POST['equipo'] ?? '');
        # -------------------------------------->>>>>

        $archivo = 'correo_votos.json';

        // Lectura archivo de votos.json
        $correos = json_decode( file_get_contents($archivo), true);
        
        // Verificar votacion
        if (array_key_exists( $email, $correos )) {
            echo "Usted ya voyo: $email";
        } else {
            // Guardar nuevo voto
            $correos[$email] = $voto;
            file_put_contents( $archivo, json_encode($correos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            echo "Voto registrado: $email => $voto";
        }

    } else {
        echo "Acceso no permitido.";
    }
?>
