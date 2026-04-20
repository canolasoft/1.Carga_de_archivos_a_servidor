<?php
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
        // obtener detalles del archivo subido
        $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
        $fileName = $_FILES['uploadedFile']['name'];
        $fileSize = $_FILES['uploadedFile']['size'];
        $fileType = $_FILES['uploadedFile']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // sanitiza el nombre del archivo
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

        // Comprueba si el archivo tiene alguna de las siguientes extensiones:
        $allowedfileExtensions = array('jpg', 'gif', 'png', 'zip', 'txt', 'xls', 'doc');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // directorio en el que se moverá el archivo subido
            $uploadFileDir = '../Vista/imagenes/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $message = 'El archivo se ha subido correctamente.';
            } else {
                $message = 'Hubo un error al mover el archivo al directorio de carga. Por favor, asegúrese de que el directorio de carga sea escribible por el servidor web.';
            }
        } else {
            $message = 'La carga del archivo falló. Tipos de archivo permitidos: ' . implode(',', $allowedfileExtensions);
        }
    } else {
        $message = 'Se ha producido un error al cargar el archivo. Por favor, revise el siguiente error.<br>';
        $message .= 'Error:' . $_FILES['uploadedFile']['error'];
    }
}
header("Location: ../Vista/form.php?msg=" . urlencode($message));