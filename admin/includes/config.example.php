<?php
// Šablona konfiguračního souboru. Zkopírujte na server jako "config.php"
// (mimo Git) a vložte skutečný hash hesla.
//
// Vygenerování hashe:
//   php -r "echo password_hash('VaseNoveHeslo', PASSWORD_DEFAULT);"

define('ADMIN_PASSWORD_HASH', 'sem-vlozte-vygenerovany-hash');
