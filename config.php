<?php
$envFilePath = __DIR__ . '/env.php';
if (file_exists($envFilePath)) {
    $vars = parse_ini_file($envFilePath);
} else {
    throw new Exception("No se pudo encontrar el archivo de variables de entorno.");
}

defined('MYSQL_DATABASE_NAME') || define('MYSQL_DATABASE_NAME', $vars['MYSQL_DATABASE_NAME']);
defined('MYSQL_USER') || define('MYSQL_USER', $vars['MYSQL_USER']);
defined('MYSQL_PASSWORD') || define('MYSQL_PASSWORD', $vars['MYSQL_PASSWORD']);