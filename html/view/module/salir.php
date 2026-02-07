<?php
require_once __DIR__ . '/../model/modelo_idioma.php';
$t = function ($key) {
    return Modelo_Idioma::t($key);
};


session_destroy();

echo '<script>

window.location = "/";

</script>';
