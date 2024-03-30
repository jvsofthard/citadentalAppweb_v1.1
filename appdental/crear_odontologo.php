<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Odontólogo - Gestión de Citas Odontológicas</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Crear Odontólogo</h1>

        <?php
        // Procesamiento del formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Incluir el archivo de conexión a la base de datos
            include_once "conexion.php";

            // Obtener los datos del formulario
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $especialidad = $_POST["especialidad"];
            $telefono = $_POST["telefono"];
            $correo_electronico = $_POST["correo_electronico"];

            // Insertar los datos en la base de datos
            $sql = "INSERT INTO odontologos (nombre, apellido, especialidad, telefono, correo_electronico) 
                    VALUES ('$nombre', '$apellido', '$especialidad', '$telefono', '$correo_electronico')";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Odontólogo creado exitosamente.</p>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Cerrar la conexión
            $conn->close();
        }
        ?>

        <!-- Formulario para crear un nuevo odontólogo -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required><br>

            <label for="especialidad">Especialidad:</label>
            <input type="text" id="especialidad" name="especialidad" required><br>

            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" required><br>

            <label for="correo_electronico">Correo Electrónico:</label>
            <input type="email" id="correo_electronico" name="correo_electronico"><br>

            <input type="submit" value="Crear Odontólogo">
            <label class="home"><a href="index.php">Inicio</a></label>
        </form>


        <?php
        // Mostrar la tabla de odontólogos
        // Incluir el archivo de conexión a la base de datos
        include "conexion.php";

        // Consulta para obtener la lista de odontólogos
        $sql = "SELECT * FROM odontologos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar la lista de odontólogos en una tabla
            echo "<h2>Lista de Odontólogos</h2>";
            echo "<table border='1'>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Especialidad</th>
                        <th>Teléfono</th>
                        <th>Correo Electrónico</th>
                        <th>Acciones</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['nombre']}</td>
                        <td>{$row['apellido']}</td>
                        <td>{$row['especialidad']}</td>
                        <td>{$row['telefono']}</td>
                        <td>{$row['correo_electronico']}</td>
                        <td>
                            <a href='editar_odontologo.php?id={$row['id']}'><i class='fa-solid fa-pen-to-square'></i></a> | 
                            <a href='eliminar_odontologo.php?id={$row['id']}'><i class='fa-solid fa-trash'></i></a>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No se encontraron odontólogos.</p>";
        }

        // Cerrar la conexión
        $conn->close();
        ?>
    </div>
</body>
</html>
