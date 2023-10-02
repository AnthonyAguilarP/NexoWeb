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
                <h2>¿Olvidaste tu contraseña?</h2>
                <p>Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.</p>
                <form action="Respuesta.php" method="post">
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo Electrónico:</label>
                        <input type="email" name="correo" id="correo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="nombre_usuario" class="form-label">Nombre de Usuario:</label>
                        <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" required>
                    </div>
                    <div class="text-center">
                        <input type="submit" value="Enviar enlace de recuperación" class="btn btn-primary">
                    </div>
                </form>
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
