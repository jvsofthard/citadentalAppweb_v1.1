<?php
$servername = "localhost"; 
$username = "Nombre_Usuario"; 
$password = "Contraseña";
$database = "Nombre_Base_de_Dato"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
