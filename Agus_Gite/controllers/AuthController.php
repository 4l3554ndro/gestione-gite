<?php
namespace Controllers;
require_once 'models/User.php';
use Model\User;

class AuthController
{
   

    public function __construct($pdo)
    {
        $this->User = new User($pdo);
    }

function login($conn) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = User::findByEmail($conn, $email);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['ruolo'] = $user['ruolo'];
        header('Location: index.php');
    } else {
        echo "<p>Credenziali errate</p>";
    }
}

function register($conn) {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    if(isset($_POST['admin'])) {
        $ruolo = 'admin';
    } else {
        $ruolo = 'utente';
    }
    User::create($conn, $nome, $cognome, $email, $password, $ruolo);
    header('Location: index.php?page=login');
}

function logout() {
    session_destroy();
    header('Location: index.php');
}

function logged() {
    if (isset($_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }
}

function bloccaUtente($conn) {
    if (!isAdmin()) exit;
    $id = $_GET['id'] ?? 0;
    $stmt = $conn->prepare("UPDATE users SET bloccato=1 WHERE id=?");
    $stmt->execute([$id]);
    header('Location: index.php?page=admin');
}

function sbloccaUtente($conn) {
    if (!isAdmin()) exit;
    $id = $_GET['id'] ?? 0;
    $stmt = $conn->prepare("UPDATE users SET bloccato=0 WHERE id=?");
    $stmt->execute([$id]);
    header('Location: index.php?page=admin');
}

}
?>
