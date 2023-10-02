<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!-- Enlaza el CSS de Bootstrap con el tema oscuro -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <?php
    include("User.php");
    $registro = $base->query("SELECT * FROM pregunta")->fetchAll(PDO::FETCH_OBJ);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_pregunta = $_POST["pregunta_secreta"];
        $correo = $_POST["correo"];
        $contrasena = cifrarContrasena($_POST["contrasena"]);
        $primer_nombre = $_POST["primer_nombre"];
        $segundo_nombre = $_POST["segundo_nombre"];
        $primer_apellido = $_POST["primer_apellido"];
        $segundo_apellido = $_POST["segundo_apellido"];
        $pregunta_secreta = $_POST["pregunta_secreta"];
        $respuesta_secreta = $_POST["respuesta_secreta"];
        $nombre_usuario = $_POST["nombre_usuario"];

        // Verificar si el nombre de usuario ya existe
        if (nombreUsuarioExiste($nombre_usuario)) {

            echo "<p>El nombre de usuario ya está en uso. Por favor, elige otro.</p>";
        } else {

            // Realizar la validación de longitud aquí antes de insertar en la base de datos
            if (

                strlen($contrasena) >= 4 && strlen($contrasena) <= 150 &&
                strlen($primer_nombre) >= 3 && strlen($primer_nombre) <= 20 &&
                strlen($segundo_nombre) >= 3 && strlen($segundo_nombre) <= 20 &&
                strlen($primer_apellido) >= 3 && strlen($primer_apellido) <= 20 &&
                strlen($segundo_apellido) >= 3 && strlen($segundo_apellido) <= 20 &&
                strlen($respuesta_secreta) >= 2 && strlen($respuesta_secreta) <= 70 &&
                strlen($correo) >= 12 && strlen($correo) <= 255 &&
                strlen($nombre_usuario) >= 4 && strlen($nombre_usuario) <= 70

            ) {

                // Insertar los datos en la base de datos
                $stmt = $base->prepare("INSERT INTO usuario (IdPregunta, Respuesta, PrimerNombre, SegundoNombre, PrimerApellido, SegundoApellido, NombreUsuario, Correo, Contrasena) VALUES (:pregunta_secreta, :respuesta_secreta, :primer_nombre, :segundo_nombre, :primer_apellido, :segundo_apellido, :nombre_usuario, :correo, :contrasena)");
                $stmt->bindParam(':pregunta_secreta', $pregunta_secreta);
                $stmt->bindParam(':respuesta_secreta', $respuesta_secreta);
                $stmt->bindParam(':primer_nombre', $primer_nombre);
                $stmt->bindParam(':segundo_nombre', $segundo_nombre);
                $stmt->bindParam(':primer_apellido', $primer_apellido);
                $stmt->bindParam(':segundo_apellido', $segundo_apellido);
                $stmt->bindParam(':nombre_usuario', $nombre_usuario);
                $stmt->bindParam(':correo', $correo);
                $stmt->bindParam(':contrasena', $contrasena);
                $stmt->execute();

                echo "<p>Registro exitoso.</p>";
            } else {

                // Mostrar un mensaje de error si no se cumplen las restricciones de longitud
                echo "<p>Por favor, verifica las restricciones de longitud en los campos.</p>";
            }
        }
    }
    ?>
    <header class="bg-secondary py-4">
        <div class="container text-center">
            <h1 class="text-white">Registro</h1>
        </div>
    </header>

    <main class="py-5">
        <div class="container">
            <section class="bg-white p-5 rounded">
                <h2 class="text-center">Crear una cuenta</h2>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="mb-3">
                        <label for="correo" class="form-label text-end">Correo Electrónico:</label>
                        <input type="email" name="correo" id="correo" class="form-control" required minlength="12"
                            maxlength="255">
                    </div>
                    <div class="mb-3">
                        <label for="contrasena" class="form-label text-end">Contraseña:</label>
                        <input type="password" name="contrasena" id="contrasena" class="form-control" required
                            minlength="4" maxlength="150">
                    </div>
                    <div class="mb-3">
                        <label for="primer_nombre" class="form-label text-end">Primer Nombre:</label>
                        <input type="text" name="primer_nombre" id="primer_nombre" class="form-control" required
                            minlength="3" maxlength="20">
                    </div>
                    <div class="mb-3">
                        <label for="segundo_nombre" class="form-label text-end">Segundo Nombre:</label>
                        <input type="text" name="segundo_nombre" id="segundo_nombre" class="form-control"
                            minlength="3" maxlength="20">
                    </div>
                    <div class="mb-3">
                        <label for="primer_apellido" class="form-label text-end">Primer Apellido:</label>
                        <input type="text" name="primer_apellido" id="primer_apellido" class="form-control" required
                            minlength="3" maxlength="20">
                    </div>
                    <div class="mb-3">
                        <label for="segundo_apellido" class="form-label text-end">Segundo Apellido:</label>
                        <input type="text" name="segundo_apellido" id="segundo_apellido" class="form-control"
                            minlength="3" maxlength="20">
                    </div>
                    <div class="mb-3">
                        <label for="pregunta_secreta" class="form-label text-end">Selecciona una pregunta secreta:</label>
                        <select name="pregunta_secreta" id="pregunta_secreta" class="form-select" required>
                            <?php foreach ($registro as $pregunta): ?>
                            <option value="<?php echo $pregunta->IdPregunta; ?>"><?php echo $pregunta->Nombre; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="respuesta_secreta" class="form-label text-end">Respuesta a la pregunta secreta:</label>
                        <input type="text" name="respuesta_secreta" id="respuesta_secreta" class="form-control"
                            required minlength="2" maxlength="70">
                    </div>
                    <div class="mb-3">
                        <label for="nombre_usuario" class="form-label text-end">Nombre de Usuario:</label>
                        <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" required
                            minlength="4" maxlength="70">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Registrarse</button>
                    </div>
                </form>
                <p class="mt-3 text-center">¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
            </section>
        </div>
    </main>

    <footer class="bg-secondary py-3 text-white text-center">
        <div class="container">
            <p>&copy; 2023 NexoWeb</p>
        </div>
    </footer>

    <!-- Enlaza el JavaScript de Bootstrap al final de tu página -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
