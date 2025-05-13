<?php
namespace Controllers;
require_once 'models/Gita.php';
use Model\Gita;

class GiteController
{

   
public function __construct($pdo)
    {
        $this->Gita = new Gita($pdo);
    }

function showGite($conn) {
    $gite = Gita::all($conn, $_SESSION['user_id']);
    include 'views/gite/lista.php';
}

function dettaglioGita($conn) {
    $id = $_GET['id'] ?? 0;
    $gita = Gita::find($conn, $id);
    $iscritto = Gita::iscrittoAGita($conn, $id, $_SESSION['user_id']);
    //$iscrittoTour = Gita::iscrittoATour($conn, $id, $_SESSION['user_id']);
    $tours = Gita::findtour($conn, $id);
    
    include 'views/gite/dettaglio.php';
}

/*function iscrittoAGita($conn) {
    $id = $_GET['id'] ?? 0;
    $user_id = $_SESSION['user_id'];
    $iscritto = Gita::iscrittoAGita($conn, $user_id);
    return $iscritto;
    
}*/
function iscrivitiGita($conn) {
    $id = $_GET['id'] ?? 0;
    $user_id = $_SESSION['user_id'];
    Gita::iscrivitiAGita($conn, $id, $user_id);
    header('Location: index.php?page=dettaglio_gita&id=' . $id);
}
function disiscrivitiGita($conn) {
    $id = $_GET['id'] ?? 0;
    $user_id = $_SESSION['user_id'];
    Gita::disiscrivitiAGita($conn, $id, $user_id);
    header('Location: index.php?page=gite');
}
function iscrivitiTour($conn) {
    $id = $_GET['id'] ?? 0;
    $iscrizione_id = $_GET['iscrizione_id'];
    $gita_id = $_GET['gita_id'];
    Gita::iscrivitiATour($conn, $id, $iscrizione_id);
    header('Location: index.php?page=dettaglio_gita&id=' . $gita_id);
}
function disiscrivitiTour($conn) {
    $id = $_GET['id'] ?? 0;
    $iscrizione_id = $_GET['iscrizione_id'];
    $gita_id = $_GET['gita_id'];
    Gita::disiscrivitiATour($conn, $id, $iscrizione_id);
    header('Location: index.php?page=dettaglio_gita&id=' . $gita_id);
}
function aggiungiGita($conn) {
    include 'views/gite/nuova.php';
}

function salvaGita($conn) {
    Gita::create($conn, $_POST['nome'], $_POST['descrizione'], $_POST['data'], $_POST['costo'], $_POST['max']);
    header('Location: index.php?page=gite');
}
}
?>