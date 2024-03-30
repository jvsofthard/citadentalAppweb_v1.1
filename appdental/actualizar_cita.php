<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Cita - Gestión de Citas Odontológicas</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Actualizar Cita</h1>

        <?php
        // Verificar si se envió el formulario con los datos actualizados
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verificar si se proporcionó un ID de cita válido
            if (isset($_POST['id']) && is_numeric($_POST['id'])) {
                // Obtener los datos del formulario
                $id = $_POST['id'];
                $paciente_id = $_POST["paciente_id"];
                $odontologo_id = $_POST["odontologo_id"];
                $edad = $_POST["edad"];
                $seguro_medico = $_POST["seguro_medico"];
                $numero_afiliado = $_POST["numero_afiliado"];
                $tipo_consulta = $_POST["tipo_consulta"];
                $comentario = $_POST["comentario"];
                
                // Incluir el archivo de conexión a la base de datos
                include_once "conexion.php";
                
                // Actualizar los datos de la cita en la base de datos
                $sql = "UPDATE citas SET 
                        paciente_id = $paciente_id,
                        odontologo_id = $odontologo_id,
                        edad = $edad,
                        seguro_medico = '$seguro_medico',
                        numero_afiliado = '$numero_afiliado',
                        tipo_consulta = '$tipo_consulta',
                        comentario = '$comentario'
                        WHERE id = $id";
                
                if ($conn->query($sql) === TRUE) {
                    echo "<script>
                            alert('Cita actualizada exitosamente.');
                            window.location.href = 'ver_citas.php';
                          </script>";
                } else {
                    echo "Error al actualizar la cita: " . $conn->error;
                }
                
                // Cerrar la conexión
                $conn->close();
            } else {
                echo "ID de cita no proporcionado o inválido.";
            }
        } else {
            echo "Acceso no permitido.";
        }
        ?>
    </div>     
</body>
</html>
