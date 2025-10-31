<?php
class Connection {
    private $conn;

    public function __construct() {
        $config = json_decode(file_get_contents(__DIR__ . '/credentials.json'), true);

        $host = $config['host'];
        $db   = $config['name'];  // Debe coincidir con la clave en JSON
        $user = $config['user'];
        $pass = $config['password'];
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        try {
            $this->conn = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
