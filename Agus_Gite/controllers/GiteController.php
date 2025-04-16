<?php
require_once 'models/Gita.php';

function showGite($conn) {
    $gite = Gita::all($conn);
    include 'views/gite/lista.php';
}

function dettaglioGita($conn) {
    $id = $_GET['id'] ?? 0;
    $gita = Gita::find($conn, $id);
    include 'views/gite/dettaglio.php';
}

function aggiungiGita($conn) {
    include 'views/gite/nuova.php';
}

function salvaGita($conn) {
    Gita::create($conn, $_POST['nome'], $_POST['descrizione'], $_POST['data'], $_POST['costo'], $_POST['max']);
    header('Location: index.php?page=gite');
}
?>