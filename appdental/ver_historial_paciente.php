<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Historial de Citas - Gestión de Citas Odontológicas</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Ver Historial de Citas</h1>

        <!-- Formulario para buscar el historial de citas por nombre y apellido -->
        <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>
            <button type="submit">Buscar Historial</button>
            <label class="home"><a href="index.php">Inicio</a></label>
            
        </form>

        <?php
        // Incluir el archivo de conexión a la base de datos
        include_once "conexion.php";

        // Procesamiento del formulario
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['nombre']) && !empty($_GET['nombre']) && isset($_GET['apellido']) && !empty($_GET['apellido'])) {
            $nombre = $_GET['nombre'];
            $apellido = $_GET['apellido'];

            // Obtener el ID del paciente usando el nombre y apellido
            $sql_id_paciente = "SELECT id FROM pacientes WHERE nombre = '$nombre' AND apellido = '$apellido'";
            $result_id_paciente = $conn->query($sql_id_paciente);

            if ($result_id_paciente->num_rows > 0) {
                $row_id_paciente = $result_id_paciente->fetch_assoc();
                $paciente_id = $row_id_paciente['id'];

                // Obtener el nombre del paciente
                $nombre_paciente = "$nombre $apellido";

                // Obtener el historial de citas del paciente
                $sql_historial_citas = "SELECT citas.id, odontologos.nombre AS nombre_odontologo, citas.edad, citas.seguro_medico, citas.tipo_consulta, citas.comentario, citas.fecha_creacion 
                                        FROM citas 
                                        INNER JOIN odontologos ON citas.odontologo_id = odontologos.id 
                                        WHERE paciente_id = $paciente_id";
                $result_historial_citas = $conn->query($sql_historial_citas);

                if ($result_historial_citas->num_rows > 0) {
                    // Mostrar el historial de citas en una tabla
                    echo "<h2>Historial de Citas para $nombre_paciente</h2>";
                    echo "<table border='1'>
                            <tr>
                                <th>ID</th>
                                <th>Odontólogo</th>
                                <th>Edad</th>
                                <th>Seguro Médico</th>
                                <th>Tipo de Consulta</th>
                                <th>Comentario</th>
                                <th>Fecha de Creación</th>
                            </tr>";
                    while ($row = $result_historial_citas->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['nombre_odontologo']}</td>
                                <td>{$row['edad']}</td>
                                <td>{$row['seguro_medico']}</td>
                                <td>{$row['tipo_consulta']}</td>
                                <td>{$row['comentario']}</td>
                                <td>{$row['fecha_creacion']}</td>
                            </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No hay citas para $nombre_paciente</p>";
                }
            } else {
                echo "<p>No se encontró ningún paciente con el nombre $nombre y apellido $apellido</p>";
            }
        }

        // Cerrar la conexión
        $conn->close();
        ?>
    
    </div>    
</body>
</html>
