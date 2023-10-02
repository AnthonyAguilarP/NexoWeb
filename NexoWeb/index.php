<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Blog de Diseños</title>
    <!-- Enlace a Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css">
    <style>
        /* Personaliza el estilo según tus preferencias */
        body {
            background-color: #f8f9fa;
        }
        .blog-header {
            background-color: #343a40;
            color: #fff;
            padding: 2rem 0;
            text-align: center; /* Centra el texto horizontalmente */
        }
        .blog-post {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <header class="blog-header">
            <h1 class="display-4">Blog de Diseños</h1>
            <p class="lead">Inspírate con los mejores diseños</p>
            <a href="Formulario.php" class="btn btn-primary">Subir archivo</a>
        </header>
        <div class="row">
            <?php
                $miconexion = mysqli_connect("localhost", "root", "", "nexoweb");
                if (!$miconexion) {
                    echo "La conexión falló";
                    exit();
                }
                $miconsulta = "SELECT * FROM diseno ORDER BY FechaPublicacion DESC";
                if ($resultado = mysqli_query($miconexion, $miconsulta)) {
                    while ($registro = mysqli_fetch_assoc($resultado)) {
            ?>
            <div class="col-md-6">
                <div class="blog-post">
                    <?php if ($registro['NombreImagen'] != "") { ?>
                    <img src="imagenes/<?php echo $registro['NombreImagen']; ?>" class="img-fluid mb-3 rounded" alt="Imagen" width=40%>
                    <?php } ?>
                    <h2><?php echo $registro['NombreDiseno']; ?></h2>
                    <p class="text-muted"><?php echo $registro['FechaPublicacion']; ?></p>
                    <p><?php echo $registro['DescripcionDiseno']; ?></p>
                </div>
            </div>
            <?php
                    }
                }
            ?>
        </div>
    </div>

    <!-- Enlace a Bootstrap 5 JS y Popper.js (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
