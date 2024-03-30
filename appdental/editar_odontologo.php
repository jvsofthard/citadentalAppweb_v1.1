<?php
// Incluir el archivo de conexión a la base de datos
include_once "conexion.php";

// Verificar si se proporcionó un ID de odontólogo válido en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    // Consulta para obtener los datos del odontólogo
    $sql = "SELECT * FROM odontologos WHERE id = $id";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nombre = $row['nombre'];
        $apellido = $row['apellido'];
        $especialidad = $row['especialidad'];
        $telefono = $row['telefono'];
        $correo_electronico = $row['correo_electronico'];
    } else {
        echo "No se encontró el odontólogo.";
        exit;
    }
} else {
    echo "ID de odontólogo no proporcionado.";
    exit;
}

// Procesar el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $especialidad = $_POST["especialidad"];
    $telefono = $_POST["telefono"];
    $correo_electronico = $_POST["correo_electronico"];
    
    // Actualizar los datos del odontólogo en la base de datos
    $sql = "UPDATE odontologos SET 
            nombre = '$nombre',
            apellido = '$apellido',
            especialidad = '$especialidad',
            telefono = '$telefono',
            correo_electronico = '$correo_electronico'
            WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Odontólogo actualizado exitosamente.'); window.location.href = 'crear_odontologo.php';</script>";
        exit;
    } else {
        echo "Error al actualizar el odontólogo: " . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Odontólogo - Gestión de Citas Odontológicas</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">

        <h1>Editar Odontólogo</h1>
        
        <!-- Formulario para editar el odontólogo -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=$id");?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required><br>
            
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo $apellido; ?>" required><br>
            
            <label for="especialidad">Especialidad:</label>
            <input type="text" id="especialidad" name="especialidad" value="<?php echo $especialidad; ?>" required><br>
            
            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" value="<?php echo $telefono; ?>" required><br>
            
            <label for="correo_electronico">Correo Electrónico:</label>
            <input type="email" id="correo_electronico" name="correo_electronico" value="<?php echo $correo_electronico; ?>"><br>
            
            <input type="submit" value="Actualizar Odontólogo">
        </form>
    </div>
    
</body>
</html>
