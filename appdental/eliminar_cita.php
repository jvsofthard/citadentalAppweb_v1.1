<?php
// Verificar si se proporcionó un ID de cita válido en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    // Procesamiento de la eliminación
    // Incluir el archivo de conexión a la base de datos
    include_once "conexion.php";
    
    // Eliminar la cita de la base de datos
    $sql = "DELETE FROM citas WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Cita eliminada exitosamente.'); window.location.href = 'ver_citas.php';</script>";
        exit;
    } else {
        echo "Error al eliminar la cita: " . $conn->error;
    }
    
    // Cerrar la conexión
    $conn->close();
} else {
    echo "ID de cita no proporcionado.";
    exit;
}
?>
