<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Nueva Imagen</title>

    <!-- Incluye la biblioteca de Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <header class="bg-secondary py-4">
        <div class="container text-center">
            <h1 class="text-white">Subir Nueva Imagen</h1>
        </div>
    </header>

    <main class="py-5">
        <div class="container">
            <section class="bg-white p-5 rounded">
                <h2 class="text-center">Formulario de Subida de Imagen y Archivo</h2>
                <form action="Insertar Contenido.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="campo_titulo" class="form-label">Título de la Imagen:</label>
                        <input type="text" name="campo_titulo" id="campo_titulo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="area_comentarios" class="form-label">Descripción de la Imagen:</label>
                        <textarea name="area_comentarios" id="area_comentarios" rows="5" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Selecciona una Imagen (menos de 2 MB):</label>
                        <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label for="archivo" class="form-label">Selecciona un Archivo (menos de 25 MB):</label>
                        <input type="file" name="archivo" id="archivo" class="form-control" accept="application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="btn_enviar" id="btn_enviar" class="btn btn-primary">Subir Archivos</button>
                    </div>
                </form>
            </section>
        </div>
    </main>

    <footer class="bg-secondary py-3 text-white text-center">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> Tu Blog de Diseños</p>
        </div>
    </footer>

    <!-- Incluye la biblioteca de Bootstrap 5 JS al final del cuerpo del documento -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
