<?php
require '../../model/modelo_idioma.php';

session_start();

$idioma = isset($_POST['idioma']) ? htmlspecialchars($_POST['idioma'], ENT_QUOTES, 'UTF-8') : 'en';

$allowedLanguages = ['en', 'es', 'pt-BR'];

if (in_array($idioma, $allowedLanguages)) {
    $_SESSION['S_IDIOMA'] = $idioma;
    echo json_encode(['success' => true, 'idioma' => $idioma]);
} else {
    echo json_encode(['success' => false, 'message' => 'Idioma no válido']);
}

