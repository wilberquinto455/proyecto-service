<?php
    class Conexion{
        public function get_conexion(){
            $user = "root";
            $pass = "12345";
            $host = "127.0.0.1";
            $db = "bd_sistemas_timeout";

            try {
                $conexion = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
                // Establecer la zona horaria en la conexión
                $conexion->exec("SET time_zone = '-05:00'"); // Ajusta esto a tu zona horaria
                $conexion->exec("SET SESSION sql_mode = ''");
                return $conexion;
            } catch(PDOException $e) {
                echo "Error de conexión: " . $e->getMessage();
                return null;
            }
        }
    }
?>