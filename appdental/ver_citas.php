<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Citas - Gestión de Citas Odontológicas</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Citas</h1>

        <!-- Formulario de búsqueda de citas -->
        <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="buscar">Buscar Cita:</label>
            <input type="text" id="buscar" name="buscar">
            <button type="submit">Buscar</button>
            <label class="home"><a href="index.php">Inicio</a></label>
        </form>

        <?php
        // Incluir el archivo de conexión a la base de datos
        include_once "conexion.php";

        // Procesamiento de la búsqueda de citas
        $sql = "SELECT citas.id, pacientes.nombre AS paciente_nombre, pacientes.apellido AS paciente_apellido, odontologos.nombre AS odontologo_nombre, odontologos.apellido AS odontologo_apellido, citas.edad, citas.seguro_medico, citas.numero_afiliado, citas.tipo_consulta, citas.comentario, citas.fecha_creacion 
                FROM citas 
                INNER JOIN pacientes ON citas.paciente_id = pacientes.id 
                INNER JOIN odontologos ON citas.odontologo_id = odontologos.id";
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['buscar']) && !empty($_GET['buscar'])) {
            $buscar = $_GET['buscar'];
            $sql .= " WHERE pacientes.nombre LIKE '%$buscar%' OR pacientes.apellido LIKE '%$buscar%' OR odontologos.nombre LIKE '%$buscar%' OR odontologos.apellido LIKE '%$buscar%' OR citas.numero_afiliado LIKE '%$buscar%' OR
                citas.tipo_consulta LIKE '%$buscar%' OR
                 citas.comentario LIKE '%$buscar%'";
        }
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar la lista de citas en una tabla
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Paciente</th>
                        <th>Odontólogo</th>
                        <th>Edad</th>
                        <th>Seguro Médico</th>
                        <th>Numero Afiliado</th>
                        <th>Tipo de Consulta</th>
                        <th>Comentario</th>
                        <th>Fecha de Creación</th>
                        <th>Acciones</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['paciente_nombre']} {$row['paciente_apellido']}</td>
                        <td>{$row['odontologo_nombre']} {$row['odontologo_apellido']}</td>
                        <td>{$row['edad']}</td>
                        <td>{$row['seguro_medico']}</td>
                        <td>{$row['numero_afiliado']}</td>
                        <td>{$row['tipo_consulta']}</td>
                        <td>{$row['comentario']}</td>
                        <td>{$row['fecha_creacion']}</td>
                        <td>
                            <a href='editar_cita.php?id={$row['id']}'><i class='fa-solid fa-pen-to-square'></i></a> |
                            <a href='eliminar_cita.php?id={$row['id']}' onclick='return confirm(\"¿Estás seguro de que deseas eliminar esta cita?\")'><i class='fa-solid fa-trash'></i></a>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron citas.";
        }
        
        // Cerrar la conexión
        $conn->close();
        ?>
        
    </div>    
</body>
</html>
