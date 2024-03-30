<?php
// Verificar si se proporcionó un ID de odontólogo válido en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    // Incluir el archivo de conexión a la base de datos
    include_once "conexion.php";

    // Consulta para eliminar el odontólogo
    $sql = "DELETE FROM odontologos WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Odontólogo eliminado exitosamente.'); window.location.href = 'crear_odontologo.php';</script>";
        exit;
    } else {
        echo "Error al eliminar el odontólogo: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo "ID de odontólogo no proporcionado o inválido.";
    exit;
}
?>
