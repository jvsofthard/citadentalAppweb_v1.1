<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Paciente - Gestión de Citas Odontológicas</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Crear Paciente</h1>

    <div class="container">
    
               <?php
            // Procesamiento del formulario
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Incluir el archivo de conexión a la base de datos
                include_once "conexion.php";
                
                // Obtener los datos del formulario
                $nombre = $_POST["nombre"];
                $apellido = $_POST["apellido"];
                $edad = $_POST["edad"];
                $genero = $_POST["genero"];
                $seguro_medico = $_POST["seguro_medico"];
                $numero_afiliado = $_POST["numero_afiliado"];
                $telefono = $_POST["telefono"];
                $correo_electronico = $_POST["correo_electronico"];
                
                // Insertar los datos en la base de datos
                $sql = "INSERT INTO pacientes (nombre, apellido, edad, genero, seguro_medico, numero_afiliado, telefono, correo_electronico) 
                        VALUES ('$nombre', '$apellido', '$edad', '$genero', '$seguro_medico', '$numero_afiliado', '$telefono', '$correo_electronico')";
                
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Paciente creado exitosamente.');</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                
                // Cerrar la conexión
                $conn->close();
            }
            ?>

                <!-- Formulario para crear un nuevo paciente -->
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required><br>
                    
                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" required><br>
                    
                    <label for="edad">Edad:</label>
                    <input type="number" id="edad" name="edad" required><br>
                    
                    <label for="genero">Género:</label>
                    <select id="genero" name="genero" required>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select><br>
                    
                    <label for="seguro_medico">Seguro Médico:</label>
                    <input type="text" id="seguro_medico" name="seguro_medico"><br>
                    
                    <label for="numero_afiliado">Número de Afiliado:</label>
                    <input type="text" id="numero_afiliado" name="numero_afiliado"><br>
                    
                    <label for="telefono">Teléfono:</label>
                    <input type="tel" id="telefono" name="telefono" required><br>
                    
                    <label for="correo_electronico">Correo Electrónico:</label>
                    <input type="email" id="correo_electronico" name="correo_electronico"><br>
                    
                    <input type="submit" value="Crear Paciente">
                    <label class="home"><a href="index.php">Inicio</a></label>
                </form>

    </div>
</body>
</html>
    