<?php
namespace Controllers;
require_once 'models/Tour.php';
use Model\Tour;

class TourController
{

   
public function __construct($pdo)
    {
        $this->Tour = new Tour($pdo);
    }

function aggiungiTour($conn) {
    include 'views/tour/nuovo.php';// . $gita_id;
}

function salvaTour($conn) {

    //dd($_POST);
    Tour::create($conn, $_GET['id'], $_POST['nome_tour'], $_POST['descrizione'], $_POST['durata'], $_POST['costo_aggiuntivo']);
    header('Location: index.php?page=dettaglio_gita&id=' . $_GET['id']);
}
}
?>