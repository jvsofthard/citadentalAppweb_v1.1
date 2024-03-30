<?php
// Incluir el archivo de conexión a la base de datos
include_once "conexion.php";

// Verificar si se proporcionó un ID de paciente válido en la URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    // Consulta para obtener los datos del paciente
    $sql = "SELECT * FROM pacientes WHERE id = $id";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nombre = $row['nombre'];
        $apellido = $row['apellido'];
        $edad = $row['edad'];
        $genero = $row['genero'];
        $seguro_medico = $row['seguro_medico'];
        $numero_afiliado = $row['numero_afiliado'];
        $telefono = $row['telefono'];
        $correo_electronico = $row['correo_electronico'];
    } else {
        echo "No se encontró el paciente.";
        exit;
    }
} else {
    echo "ID de paciente no proporcionado.";
    exit;
}

// Procesar el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $edad = $_POST["edad"];
    $genero = $_POST["genero"];
    $seguro_medico = $_POST["seguro_medico"];
    $numero_afiliado = $_POST["numero_afiliado"];
    $telefono = $_POST["telefono"];
    $correo_electronico = $_POST["correo_electronico"];
    
    // Actualizar los datos del paciente en la base de datos
    $sql = "UPDATE pacientes SET 
            nombre = '$nombre',
            apellido = '$apellido',
            edad = '$edad',
            genero = '$genero',
            seguro_medico = '$seguro_medico',
            numero_afiliado = '$numero_afiliado',
            telefono = '$telefono',
            correo_electronico = '$correo_electronico'
            WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Paciente actualizado exitosamente.'); window.location.href = 'pacientes.php';</script>";
        exit;
    } else {
        echo "Error al actualizar el paciente: " . $conn->error;
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
    <title>Editar Paciente - Gestión de Citas Odontológicas</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Editar Paciente</h1>
        
        <!-- Formulario para editar el paciente -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=$id";?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required><br>
            
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value="<?php echo $apellido; ?>" required><br>
            
            <label for="edad">Edad:</label>
            <input type="number" id="edad" name="edad" value="<?php echo $edad; ?>" required><br>
            
            <label for="genero">Género:</label>
            <select id="genero" name="genero" required>
                <option value="Masculino" <?php if ($genero == "Masculino") echo "selected"; ?>>Masculino</option>
                <option value="Femenino" <?php if ($genero == "Femenino") echo "selected"; ?>>Femenino</option>
            </select><br>
            
            <label for="seguro_medico">Seguro Médico:</label>
            <input type="text" id="seguro_medico" name="seguro_medico" value="<?php echo $seguro_medico; ?>"><br>
            
            <label for="numero_afiliado">Número de Afiliado:</label>
            <input type="text" id="numero_afiliado" name="numero_afiliado" value="<?php echo $numero_afiliado; ?>"><br>
            
            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" value="<?php echo $telefono; ?>" required><br>
            
            <label for="correo_electronico">Correo Electrónico:</label>
            <input type="email" id="correo_electronico" name="correo_electronico" value="<?php echo $correo_electronico; ?>"><br>
            
            <input type="submit" value="Actualizar Paciente">
        </form>
    </div>
</body>
</html>
