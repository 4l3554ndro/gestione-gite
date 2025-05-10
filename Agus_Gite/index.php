<?php
require_once 'config/db.php';
require_once 'utils/session.php';
require_once 'models/User.php';
require_once 'models/Gita.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/GiteController.php';
use controllers\AuthController;

$url = "";

if(isset($_GET['url']))
{
    $url = $_GET['url'];
}
else
{
    $url = '/';
}

$controller = new AuthController($conn);

$page = $_GET['page'] ?? 'home';
switch ($page) {
    case 'login':
        include 'views/auth/login.php';
        break;
    case 'register':       
        include 'views/auth/register.php';
        break;
    case 'logout':
        include 'controllers/AuthController.php';
        logout();
        break;
    case 'registerok':
      
        $controller->register($conn);
        break;
    case 'gite':
        include 'controllers/GiteController.php';
        showGite($conn);
        break;
    case 'dettaglio_gita':
        include 'controllers/GiteController.php';
        dettaglioGita($conn);
        break;
    case 'aggiungi_gita':
        include 'controllers/GiteController.php';
        aggiungiGita($conn);
        break;
    case 'salva_gita':
        include 'controllers/GiteController.php';
        salvaGita($conn);
        break;
    default:
        include 'views/home.php';
}
?>