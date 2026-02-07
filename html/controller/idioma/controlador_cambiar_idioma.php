<?php
require_once __DIR__ . '/../../model/modelo_idioma.php';

if (session_status() === PHP_SESSION_NONE) {
    if (!headers_sent()) {
        session_start();
    }
}

$idioma = isset($_POST['idioma']) ? htmlspecialchars($_POST['idioma'], ENT_QUOTES, 'UTF-8') : 'en';

// Usar el método del modelo para establecer el idioma
if (Modelo_Idioma::setLanguage($idioma)) {
    echo json_encode(['success' => true, 'idioma' => $idioma]);
} else {
    echo json_encode(['success' => false, 'message' => 'Idioma no válido']);
}

