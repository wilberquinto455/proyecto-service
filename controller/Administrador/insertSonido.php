<?php
session_start();
require_once("../../model/conexion.php");

class SonidoController {
    private $conexion;
    private $uploadDir = "../../view/client-side/uploads/audio/"; // Directorio para guardar los archivos
    private $allowedTypes = ['audio/mpeg', 'audio/wav', 'audio/ogg']; // Tipos MIME permitidos
    private $maxFileSize = 20971520; // 20MB en bytes

    public function __construct() {
        $modelo = new conexion();
        $this->conexion = $modelo->get_conexion();
    }

    public function insertSonido($nombreMusica, $tipoMusica, $duracion, $idUser, $audioFile) {
        try {
            // Validar el archivo
            $validacionArchivo = $this->validarArchivo($audioFile);
            if ($validacionArchivo !== true) {
                throw new Exception($validacionArchivo);
            }

            // Generar nombre único para el archivo
            $extension = pathinfo($audioFile['name'], PATHINFO_EXTENSION);
            $nombreArchivo = uniqid() . '_' . time() . '.' . $extension;
            $rutaCompleta = $this->uploadDir . $nombreArchivo;

            // Crear el directorio si no existe
            if (!is_dir($this->uploadDir)) {
                mkdir($this->uploadDir, 0777, true);
            }

            // Mover el archivo
            if (!move_uploaded_file($audioFile['tmp_name'], $rutaCompleta)) {
                throw new Exception("Error al subir el archivo.");
            }

            // Preparar la consulta SQL
            $sql = "INSERT INTO sonidos (Nombre, Ruta_Archivo, idtipo_sonido, Duracion, Fecha_Subida, ID_User) 
                    VALUES (:nombre, :ruta, :tipo, :duracion, NOW(), :idUser)";
            
            $stmt = $this->conexion->prepare($sql);
            
            // Vincular parámetros
            $stmt->bindParam(':nombre', $nombreMusica);
            $stmt->bindParam(':ruta', $rutaCompleta);
            $stmt->bindParam(':tipo', $tipoMusica);
            $stmt->bindParam(':duracion', $duracion);
            $stmt->bindParam(':idUser', $idUser);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                return [
                    'status' => 'success',
                    'message' => 'El sonido se ha registrado correctamente.'
                ];
            } else {
                // Si falla la inserción, eliminar el archivo subido
                unlink($rutaCompleta);
                throw new Exception("Error al insertar en la base de datos.");
            }

        } catch (Exception $e) {
            // Si algo falla, asegurarnos de eliminar el archivo si fue subido
            if (isset($rutaCompleta) && file_exists($rutaCompleta)) {
                unlink($rutaCompleta);
            }
            
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    private function validarArchivo($file) {
        // Verificar si se subió el archivo
        if (!isset($file['tmp_name']) || empty($file['tmp_name'])) {
            return "No se ha seleccionado ningún archivo.";
        }

        // Verificar el tamaño del archivo
        if ($file['size'] > $this->maxFileSize) {
            return "El archivo excede el tamaño máximo permitido (20MB).";
        }

        // Verificar el tipo de archivo
        if (!in_array($file['type'], $this->allowedTypes)) {
            return "Tipo de archivo no permitido. Solo se permiten archivos MP3, WAV y OGG.";
        }

        // Verificar si es realmente un archivo de audio
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mimeType, $this->allowedTypes)) {
            return "El archivo no es un archivo de audio válido.";
        }

        return true;
    }
}

// Manejo de la solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new SonidoController();
    
    if (!isset($_POST['nombreMusica'], $_POST['tipoMusica'], $_POST['duracion'], $_FILES['rutaArchivo'])) {
        $_SESSION['titulo'] = "Error!";
        $_SESSION['msj'] = "Faltan campos requeridos para completar el registro.";
        $_SESSION['icono'] = "error";
    } else {
        $idUser = $_SESSION['id'] ?? null;

        if (!$idUser) {
            $_SESSION['titulo'] = "Error!";
            $_SESSION['msj'] = "Usuario no autenticado.";
            $_SESSION['icono'] = "error";
        } else {
            $response = $controller->insertSonido(
                $_POST['nombreMusica'],
                $_POST['tipoMusica'],
                $_POST['duracion'],
                $idUser,
                $_FILES['rutaArchivo']
            );

            $_SESSION['titulo'] = $response['status'] === 'success' ? "Éxito!" : "Error!";
            $_SESSION['msj'] = $response['message'];
            $_SESSION['icono'] = $response['status'];
        }
    }

    header('Location: ../../view/administrador/agregarSonido.php');
    exit;
}
?>
