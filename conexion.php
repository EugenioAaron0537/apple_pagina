<?php
$host = "localhost";
$user = "root";     // Usuario por defecto en XAMPP
$pass = "";         // En XAMPP la contraseña por defecto va vacía
$db   = "apple_pagina";

// Crear conexión usando mysqli
$conexion = new mysqli($host, $user, $pass, $db);

// Verificar si hubo error en la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}
?>