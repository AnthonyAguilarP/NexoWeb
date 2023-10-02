<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <header class="bg-secondary py-4">
        <div class="container text-center">
            <h1 class="text-white">Recuperar Contraseña</h1>
        </div>
    </header>

    <main class="py-5">
        <div class="container">
            <section class="bg-white p-5 rounded">
                <h2>Respuesta de Recuperación</h2>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $correo = $_POST["correo"];
                    $nombre_usuario = $_POST["nombre_usuario"];
                    
                    // Incluye el archivo de conexión a la base de datos
                    include("User.php");

                    // Consulta la pregunta y respuesta de seguridad del usuario
                    $query = "SELECT pregunta.Nombre, usuario.Respuesta, usuario.Contrasena FROM usuario
                              INNER JOIN pregunta ON usuario.IdPregunta = pregunta.IdPregunta
                              WHERE usuario.Correo = :correo AND usuario.NombreUsuario = :nombre_usuario";
                    $statement = $base->prepare($query);
                    $statement->bindParam(':correo', $correo, PDO::PARAM_STR);
                    $statement->bindParam(':nombre_usuario', $nombre_usuario, PDO::PARAM_STR);
                    $statement->execute();

                    $registro = $statement->fetch(PDO::FETCH_ASSOC);

                    if ($registro) {
                        $pregunta = $registro['Nombre'];
                        $respuesta = $registro['Respuesta'];
                        $contrasena = $registro['Contrasena'];

                        echo "<p>Pregunta de seguridad: $pregunta</p>";

                        // Campo de entrada para la respuesta del usuario con clases de Bootstrap
                        echo '<div class="mb-3">';
                        echo '<label for="respuesta_usuario" class="form-label">Respuesta:</label>';
                        echo '<input type="text" name="respuesta_usuario" id="respuesta_usuario" class="form-control" placeholder="Escribe tu respuesta aquí">';
                        echo '</div>';

                        // Formulario que envía la contraseña al correo ingresado
                        echo '<form action="https://formsubmit.co/' . $correo . '" method="POST">';
                        echo '<input type="hidden" name="contrasena" value="' . $contrasena . '">';
                        echo '<input type="submit" value="Enviar contraseña por correo" class="btn btn-primary mt-2">';
                        echo '</form>';
                    } else {
                        echo "No se encontró ningún usuario con ese correo y nombre de usuario.";
                    }
                }
                ?>
            </section>
            
            <p class="mt-3 text-center">¿Recuerdas tu contraseña? <a href="login.php">Inicia sesión aquí</a></p>
        </div>
    </main>

    <footer class="bg-secondary py-3 text-white text-center">
        <div class="container">
            <p>&copy; 2023 NexoWeb</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
