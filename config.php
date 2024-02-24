<?php
// Evita que este script se ejecute a través de una solicitud HTTP directa.
if (php_sapi_name() !== 'cli' && !defined('STDIN')) {
    exit;
}

// Suponiendo que tu archivo env.php se encuentre en la misma carpeta que este script
$envFilePath = __DIR__ . '/env.php';

// Carga y parsea las variables de entorno si el archivo existe
if (file_exists($envFilePath)) {
    $vars = parse_ini_file($envFilePath);
} else {
    throw new Exception("No se pudo encontrar el archivo de variables de entorno.");
}

// Define las constantes para la conexión a la base de datos
defined('MYSQL_DATABASE_NAME') || define('MYSQL_DATABASE_NAME', $vars['MYSQL_DATABASE_NAME']);
defined('MYSQL_USER') || define('MYSQL_USER', $vars['MYSQL_USER']);
defined('MYSQL_PASSWORD') || define('MYSQL_PASSWORD', $vars['MYSQL_PASSWORD']);

// Ahora puedes usar estas constantes en tu aplicación
