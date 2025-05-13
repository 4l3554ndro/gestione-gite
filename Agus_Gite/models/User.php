<?php
namespace Model;
class User {
    public static function create($conn, $nome, $cognome, $email, $password, $ruolo) {

        $stmt = $conn->prepare("INSERT INTO users (nome, cognome, email, password,ruolo) VALUES ('$nome', '$cognome', '$email', '$password', '$ruolo')");
        $stmt->execute();
    }
    public static function findByEmail($conn, $email) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = '$email'");
        $stmt->execute();
        return $stmt->fetch();
    }
}
?>