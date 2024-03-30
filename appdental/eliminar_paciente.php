<?php
// Incluir el archivo de conexión a la base de datos
include_once "conexion.php";

// Verificar si se proporcionó un ID de paciente válido en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    // Consulta para eliminar el paciente de la base de datos
    $sql = "DELETE FROM pacientes WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Paciente eliminado exitosamente.'); window.location.href = 'pacientes.php';</script>";
    } else {
        echo "Error al eliminar el paciente: " . $conn->error;
    }
} else {
    echo "ID de paciente no proporcionado.";
}

// Cerrar la conexión
$conn->close();
?>
