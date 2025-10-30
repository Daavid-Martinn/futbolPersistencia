<?php
namespace App\Persistence;

use PDO;
use PDOException;

class Connection {
    private static $instance = null;
    private $conn;

    private function __construct() {
        // Ruta al archivo de credenciales
        $credentialsPath = __DIR__ . '/credentials.json';

        if (!file_exists($credentialsPath)) {
            die("Error: No se encuentra el archivo de credenciales (credentials.json).");
        }

        $config = json_decode(file_get_contents($credentialsPath), true);

        $dsn = "mysql:host={$config['host']};dbname={$config['name']};charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $this->conn = new PDO($dsn, $config['user'], $config['password'], $options);
        } catch (PDOException $e) {
            // En un entorno de producción, loguear el error y mostrar un mensaje genérico.
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}