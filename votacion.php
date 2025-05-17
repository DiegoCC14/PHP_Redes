<?php
    
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        
        $archivo = 'correo_votos.json';
        readfile($archivo); // Envia el contenido tal cual

    } else {
        echo "Acceso no permitido.";
    }
?>
