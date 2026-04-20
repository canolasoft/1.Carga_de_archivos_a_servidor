<?php
    $message = $_GET["msg"] ?? '';
?>
<!DOCTYPE html>
<html>

<head>
    <title>PHP File Upload</title>
</head>

<body>
    <?php echo $message; ?>
    <form method="POST" action="../Controlador/upload.php" enctype="multipart/form-data">
        <h3>Carga de imagen a servidor</h3>
        <div>
            <span>Selecciona un archivo:</span>
            <input type="file" name="uploadedFile" />
        </div>

        <input type="submit" value="Cargar" />
    </form>
</body>

</html>