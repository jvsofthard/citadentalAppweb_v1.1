<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cita - Gestión de Citas Odontológicas</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Editar Cita</h1>

        <?php
        // Verificar si se proporcionó un ID de cita válido en la URL
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];
            
            // Incluir el archivo de conexión a la base de datos
            include_once "conexion.php";
            
            // Obtener los datos de la cita a editar
            $sql = "SELECT * FROM citas WHERE id = $id";
            $result = $conn->query($sql);
            
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
        ?>
                <!-- Formulario para editar la cita -->
                <form method="post" action="actualizar_cita.php">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    
                    <label for="paciente_id">Paciente:</label>
                    <select name="paciente_id" id="paciente_id" required>
                        <?php
                        // Obtener la lista de pacientes
                        $sql_pacientes = "SELECT * FROM pacientes";
                        $result_pacientes = $conn->query($sql_pacientes);

                        if ($result_pacientes->num_rows > 0) {
                            while ($paciente = $result_pacientes->fetch_assoc()) {
                                $selected = ($paciente['id'] == $row['paciente_id']) ? 'selected' : '';
                                echo "<option value='{$paciente['id']}' $selected>{$paciente['nombre']} {$paciente['apellido']}</option>";
                            }
                        }
                        ?>
                    </select><br>
                    
                    <label for="odontologo_id">Odontólogo:</label>
                    <select name="odontologo_id" id="odontologo_id" required>
                        <?php
                        // Obtener la lista de odontólogos
                        $sql_odontologos = "SELECT * FROM odontologos";
                        $result_odontologos = $conn->query($sql_odontologos);

                        if ($result_odontologos->num_rows > 0) {
                            while ($odontologo = $result_odontologos->fetch_assoc()) {
                                $selected = ($odontologo['id'] == $row['odontologo_id']) ? 'selected' : '';
                                echo "<option value='{$odontologo['id']}' $selected>{$odontologo['nombre']} {$odontologo['apellido']}</option>";
                            }
                        }
                        ?>
                    </select><br>
                    
                    <label for="edad">Edad:</label>
                    <input type="number" id="edad" name="edad" value="<?php echo $row['edad']; ?>"><br>
                    
                    <label for="seguro_medico">Seguro Médico:</label>
                    <input type="text" id="seguro_medico" name="seguro_medico" value="<?php echo $row['seguro_medico']; ?>"><br>

                    <label for="numero_afiliado">Número de Afiliado:
                    </label>
                    <input type="text" id="numero_afiliado" name="numero_afiliado" value="<?php echo $row['numero_afiliado']; ?>"><br>
                    
                    <label for="tipo_consulta">Tipo de Consulta:</label>
                    <input type="text" id="tipo_consulta" name="tipo_consulta" value="<?php echo $row['tipo_consulta']; ?>" required><br>
                    
                    <label for="comentario">Comentario:</label>
                    <textarea id="comentario" name="comentario" rows="4" cols="50"><?php echo $row['comentario']; ?></textarea><br>
                    
                    <input type="submit" value="Actualizar Cita">
                </form>
        <?php
            } else {
                echo "No se encontró la cita para editar.";
            }
            
            // Cerrar la conexión
            $conn->close();
        } else {
            echo "ID de cita no proporcionado o inválido.";
        }
        ?>
    </div>
</body>
</html>
