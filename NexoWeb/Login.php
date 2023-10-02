<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- Enlaza el CSS de Bootstrap con el tema oscuro -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <?php
    session_start();
    include("User.php");

    // Inicializar la variable del ID del usuario
    $id_usuario = null;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nombre_usuario = $_POST["nombre_usuario"];
        $contrasena = $_POST["contrasena"];

        // Consulta para verificar las credenciales del usuario
        $stmt = $base->prepare("SELECT IdUsuario, Contrasena FROM usuario WHERE NombreUsuario = :nombre_usuario");
        $stmt->bindParam(':nombre_usuario', $nombre_usuario, PDO::PARAM_STR);
        $stmt->execute();

        // Obtener el resultado de la consulta
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado && verificarContrasena($contrasena, $resultado['Contrasena'])) {

            // Las credenciales son correctas, almacenar el ID del usuario
            $id_usuario = $resultado['IdUsuario'];
            echo $id_usuario;
            $_SESSION['id_usuario'] = $resultado['IdUsuario'];
            // Puedes redirigir a la página de inicio de sesión exitosa o realizar otras acciones aquí
            header('Location: index.php');
            exit();
        } else {

            // Las credenciales son incorrectas, mostrar un mensaje de error
            echo "<p class='text-center text-danger'>Credenciales incorrectas. Por favor, verifica tu nombre de usuario y contraseña.</p>";
        }
    }
    ?>
    <header class="bg-secondary py-4">
        <div class="container text-center">
            <h1 class="text-white">Iniciar Sesión</h1>
        </div>
    </header>

    <main class="py-5">
        <div class="container">
            <section class="bg-white p-5 rounded">
                <h2 class="text-center">Iniciar Sesión</h2>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="mb-3">
                        <label for="nombre_usuario" class="form-label text-end">Nombre de Usuario:</label>
                        <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="contrasena" class="form-label text-end">Contraseña:</label>
                        <input type="password" name="contrasena" id="contrasena" class="form-control" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                    </div>
                </form>
                <p class="mt-3 text-center">¿No tienes una cuenta? <a href="SignUp.php">Crea una cuenta aquí</a></p>
                <p class="text-center">¿Olvidaste tu contraseña? <a href="RecuperarContrasena.php">Recupérala aquí</a></p>
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
