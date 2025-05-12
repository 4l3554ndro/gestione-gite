<?php
require_once 'config/db.php';
require_once 'utils/session.php';
require_once 'models/User.php';
require_once 'models/Gita.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/GiteController.php';
use controllers\AuthController;
use controllers\GiteController;

$url = "";

if(isset($_GET['url']))
{
    $url = $_GET['url'];
}
else
{
    $url = '/';
}

$authcontroller = new AuthController($conn);
$gitecontroller = new GiteController($conn);

$page = $_GET['page'] ?? 'home';
switch ($page) {
    case 'login':
        if ($authcontroller->logged()) {
            header('Location: index.php');
            exit();
        }
        include 'views/auth/login.php';
        break;
    case 'register':       
        include 'views/auth/register.php';
        break;
    case 'logout':
        $authcontroller->logout();
        break;
    case 'registerok':
        $authcontroller->register($conn);
        break;
    case 'loginok':
        $authcontroller->login($conn);
        break;
    case 'gite':
        
        $gitecontroller->showGite($conn);
        break;
    case 'dettaglio_gita':
        $gitecontroller->dettaglioGita($conn);
        break;
    case 'aggiungi_gita':
        include 'controllers/GiteController.php';
        aggiungiGita($conn);
        break;
    case 'salva_gita':
        include 'controllers/GiteController.php';
        salvaGita($conn);
        break;
    case 'iscriviti_gita':
        $gitecontroller->iscrivitiGita($conn);
        break;
    case 'disiscriviti_gita':
        $gitecontroller->disiscrivitiGita($conn);
        break;
    default:
        include 'views/home.php';
}
function dd($var) {
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();
}
?>