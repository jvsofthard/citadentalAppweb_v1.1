<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cita - Gestión de Citas Odontológicas</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Crear Cita</h1>

        <?php
        // Incluir el archivo de conexión a la base de datos
        include_once "conexion.php";

        // Obtener la lista de pacientes
        $sql_pacientes = "SELECT * FROM pacientes";
        $result_pacientes = $conn->query($sql_pacientes);

        // Obtener la lista de odontólogos
        $sql_odontologos = "SELECT * FROM odontologos";
        $result_odontologos = $conn->query($sql_odontologos);

        // Procesamiento del formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los datos del formulario
            $paciente_id = $_POST["paciente_id"];
            $odontologo_id = $_POST["odontologo_id"];
            $edad = $_POST["edad"];
            $seguro_medico = $_POST["seguro_medico"];
            $numero_afiliado = $_POST["numero_afiliado"];
            $tipo_consulta = $_POST["tipo_consulta"];
            $comentario = $_POST["comentario"];

            // Insertar los datos en la base de datos
            $sql = "INSERT INTO citas (paciente_id, odontologo_id, edad, seguro_medico, numero_afiliado, tipo_consulta, comentario)
                    VALUES ($paciente_id, $odontologo_id, $edad, '$seguro_medico', '$numero_afiliado', '$tipo_consulta', '$comentario')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Cita creada exitosamente.');</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Cerrar la conexión
        $conn->close();
        ?>

        <!-- Formulario para crear una nueva cita -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="paciente_id">Paciente:</label>
            <select name="paciente_id" id="paciente_id" required>
                <option value="">Elije un paciente</option>
                <?php
                if ($result_pacientes->num_rows > 0) {
                    while ($row = $result_pacientes->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>{$row['nombre']} {$row['apellido']}</option>";
                    }
                } else {
                    echo "<option value='' disabled>No hay pacientes disponibles</option>";
                }
                ?>
            </select><br>

            <label for="odontologo_id">Odontólogo:</label>
            <select name="odontologo_id" id="odontologo_id" required>
                <option value="">Asigna un Odontologo</option>
                <?php
                if ($result_odontologos->num_rows > 0) {
                    while ($row = $result_odontologos->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>{$row['nombre']} {$row['apellido']} - {$row['especialidad']}</option>";
                    }
                } else {
                    echo "<option value='' disabled>No hay odontólogos disponibles</option>";
                }
                ?>
            </select><br><br>

            <label for="edad">Edad:</label>
            <input type="number" id="edad" name="edad"><br>

            <label for="seguro_medico">Seguro Médico:</label>
            <input type="text" id="seguro_medico" name="seguro_medico">

             <label for="numero_afiliado">Número de Afiliado:</label>
             <input type="text" id="numero_afiliado" name="numero_afiliado"><br>

            <label for="tipo_consulta">Tipo de Consulta:</label>
            <input type="text" id="tipo_consulta" name="tipo_consulta" required><br>

            <label for="comentario">Comentario:</label>
            <textarea id="comentario" name="comentario" rows="4" cols="50"></textarea><br><br>

            <input type="submit" value="Crear Cita">
            <label class="home"><a href="index.php">Inicio</a></label>
        </form>

        
    </div>
</body>
</html>
