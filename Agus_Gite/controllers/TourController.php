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

function modificaTour($conn) {
    $id = $_GET['id'] ?? 0;
    $stmt = $conn->prepare("SELECT * FROM tour WHERE id = ?");
    $stmt->execute([$id]);
    $tour = $stmt->fetch();
    include 'views/tour/modifica.php';
}

function salvaModificaTour($conn) {
    $id = $_GET['id'] ?? 0;
    $gita_id = $_GET['gita_id'] ?? 0;
    $stmt = $conn->prepare("UPDATE tour SET nome_tour=?, descrizione=?, durata=?, costo_aggiuntivo=? WHERE id=?");
    $stmt->execute([
        $_POST['nome_tour'],
        $_POST['descrizione'],
        $_POST['durata'],
        $_POST['costo_aggiuntivo'],
        $id
    ]);
    header('Location: index.php?page=dettaglio_gita&id=' . $gita_id);
}

function eliminaTour($conn) {
    if (!isAdmin()) {
        header('Location: index.php');
        exit;
    }
    $id = $_GET['id'] ?? 0;
    $gita_id = $_GET['gita_id'] ?? 0;
    $stmt = $conn->prepare("DELETE FROM tour WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: index.php?page=dettaglio_gita&id=' . $gita_id);
}
}
?>