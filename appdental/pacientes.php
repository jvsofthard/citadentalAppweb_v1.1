<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pacientes - Gestión de Citas Odontológicas</title>
    <link rel="stylesheet" href="css/styles.css">

</head>
<body>
    <div class="container">

        <h1>Lista de Pacientes</h1>

        <!-- Formulario de búsqueda de pacientes -->
        <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="buscar">Buscar Paciente:</label>
            <input type="text" id="buscar" name="buscar">
            <button type="submit">Buscar</button>
            <label class="home"><a href="index.php">Inicio</a></label>
        </form>   
         
    <hr>

        <?php
        // Incluir el archivo de conexión a la base de datos
        include_once "conexion.php";

        // Procesamiento de la búsqueda de pacientes
        $sql = "SELECT * FROM pacientes";
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['buscar']) && !empty($_GET['buscar'])) {
            $buscar = $_GET['buscar'];
            $sql .= " WHERE nombre LIKE '%$buscar%' OR apellido LIKE '%$buscar%'";
        }
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar la lista de pacientes en una tabla
            echo "<table border='1'>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Edad</th>
                        <th>Género</th>
                        <th>Seguro Médico</th>
                        <th>Número de Afiliado</th>
                        <th>Teléfono</th>
                        <th>Correo Electrónico</th>
                        <th>Fecha de Creación</th>
                        <th>Acciones</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['nombre']}</td>
                        <td>{$row['apellido']}</td>
                        <td>{$row['edad']}</td>
                        <td>{$row['genero']}</td>
                        <td>{$row['seguro_medico']}</td>
                        <td>{$row['numero_afiliado']}</td>
                        <td>{$row['telefono']}</td>
                        <td>{$row['correo_electronico']}</td>
                        <td>{$row['fecha_creacion']}</td>
                        <td>
                            <a href='editar_paciente.php?id={$row['id']}'><i class='fa-solid fa-pen-to-square'></i></a> | 
                            <a href='eliminar_paciente.php?id={$row['id']}'><i class='fa-solid fa-trash'></i></a>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "No se encontraron pacientes.";
        }
        
        // Cerrar la conexión
        $conn->close();

        ?>        
    </div>
</body>
</html>
