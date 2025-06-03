<?php
require_once 'config/db.php';
require_once 'utils/session.php';
require_once 'models/User.php';
require_once 'models/Gita.php';
require_once 'models/Tour.php';
require_once 'controllers/TourController.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/GiteController.php';
use controllers\AuthController;
use controllers\GiteController;
use controllers\TourController;
?>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand">Gestione Gite & Tour</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <?php if (!isLoggedIn()) { ?>
                    <?php } else { ?>
                    <a class="nav-link" href="index.php?page=gite">Elenco Gite</a>
                    <?php } ?>
                </li>
                <li class="nav-item">
                    <?php if (!isLoggedIn()) { ?>
                        <a class="nav-link" href="index.php?page=login">Login</a>
                    <?php } else { ?>
                        <a class="nav-link" href="index.php?page=logout">Logout</a>
                    <?php } ?>
                </li>
                <li class="nav-item">
                    <?php if (isAdmin()) { ?>
                        <a class="nav-link" href="index.php?page=admin">Admin</a>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php
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
$tourcontroller = new TourController($conn);

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
        $gitecontroller->aggiungiGita($conn);
        break;
    case 'salva_gita':
        $gitecontroller->salvaGita($conn);
        break;
    case 'aggiungi_tour':
        $tourcontroller->aggiungiTour($conn);
        break;
    case 'salva_tour':
        //dd($_POST);
        //dd($_GET);
        $tourcontroller->salvaTour($conn);
        break;
    case 'iscriviti_gita':
        $gitecontroller->iscrivitiGita($conn);
        break;
    case 'disiscriviti_gita':
        $gitecontroller->disiscrivitiGita($conn);
        break;
    case 'iscriviti_tour':  
        $gitecontroller->iscrivitiTour($conn);
        break;  
    case 'disiscriviti_tour':
        $gitecontroller->disiscrivitiTour($conn);
        break;
    case 'modifica_gita':
        $gitecontroller->modificaGita($conn);
        break;
    case 'salva_modifica_gita':
        $gitecontroller->salvaModificaGita($conn);
        break;
    case 'modifica_tour':
        $tourcontroller->modificaTour($conn);
        break;
    case 'salva_modifica_tour':
        $tourcontroller->salvaModificaTour($conn);
        break;
    case 'salva_recensione':
        $gitecontroller->salvaRecensione($conn);
        break;
    case 'admin':
        $gitecontroller->pannelloAdmin($conn);
        break;
    case 'elimina_gita':
        $gitecontroller->eliminaGita($conn);
        break;
    case 'elimina_tour':
        $tourcontroller->eliminaTour($conn);
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