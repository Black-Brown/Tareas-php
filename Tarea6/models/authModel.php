<?php

require_once __DIR__ . "/../config/database.php";

class authModel {

    private $conn;

    public function __construct(){
        $db = new database();
        $this->conn = $db->getDB();
    }

    // Método para autenticar usuario
    public function login($usuario, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            // Autenticación exitosa
            return $user;
        }
        // Fallo de autenticación
        return false;
    }

    // Método para registrar un usuario nuevo
    public function registrar($usuario, $password, $nombre, $email) {
        // Verificar si el usuario ya existe
        $stmt = $this->conn->prepare("SELECT id FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            return false; // Usuario ya existe
        }
        $stmt->close();

        // Encriptar la contraseña
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Insertar el nuevo usuario
        $stmt = $this->conn->prepare("INSERT INTO usuarios (usuario, password, nombre, email) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $usuario, $passwordHash, $nombre, $email);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function __destruct(){
        $this->conn->close();
    }
}