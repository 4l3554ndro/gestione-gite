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
    $gita = \Model\Gita::find($conn, $id);
    $iscritto = \Model\Gita::iscrittoAGita($conn, $id, $_SESSION['user_id']);
    $tours = \Model\Gita::findtour($conn, $id);

    // Recupera recensioni
    $stmt = $conn->prepare("SELECT r.*, u.nome, u.cognome FROM recensioni r JOIN users u ON r.user_id = u.id WHERE r.gita_id = ? ORDER BY r.data DESC");
    $stmt->execute([$id]);
    $recensioni = $stmt->fetchAll();

    // Recupera utenti iscritti e la loro recensione (se presente)
    $stmt = $conn->prepare("
        SELECT u.nome, u.cognome, u.email, r.testo AS recensione, r.voto
        FROM iscrizioni i
        JOIN users u ON i.user_id = u.id
        LEFT JOIN recensioni r ON r.gita_id = i.gita_id AND r.user_id = u.id
        WHERE i.gita_id = ?
    ");
    $stmt->execute([$id]);
    $utenti_iscritti = $stmt->fetchAll();

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

    $stmt = $conn->prepare("SELECT bloccato FROM users WHERE id=?");
    $stmt->execute([$user_id]);
    if ($stmt->fetchColumn()) {
        $errore = "Il tuo account è stato bloccato e non puoi effettuare questa operazione.";
        // mostra la view con il messaggio di errore
        // esempio per iscrizione gita:
        $gita = \Model\Gita::find($conn, $id);
        $iscritto = \Model\Gita::iscrittoAGita($conn, $id, $user_id);
        $tours = \Model\Gita::findtour($conn, $id);
        include 'views/gite/dettaglio.php';
        return;
    }

    $success = \Model\Gita::iscrivitiAGita($conn, $id, $user_id);
    if ($success === false) {
        // Limite raggiunto, mostra messaggio nella pagina dettaglio
        $gita = \Model\Gita::find($conn, $id);
        $iscritto = \Model\Gita::iscrittoAGita($conn, $id, $user_id);
        $tours = \Model\Gita::findtour($conn, $id);
        $errore = "Limite massimo di partecipanti raggiunto. Non puoi iscriverti a questa gita.";
        // Recupera recensioni se necessario
        $stmt = $conn->prepare("SELECT r.*, u.nome, u.cognome FROM recensioni r JOIN users u ON r.user_id = u.id WHERE r.gita_id = ? ORDER BY r.data DESC");
        $stmt->execute([$id]);
        $recensioni = $stmt->fetchAll();
        include 'views/gite/dettaglio.php';
    } else {
        header('Location: index.php?page=dettaglio_gita&id=' . $id);
    }
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
public function iscriviUtente() {
    $idGita = $_POST['id_gita'];
    $idUtente = $_SESSION['user_id'];
    $tourSelezionati = $_POST['tour'] ?? [];

    // Recupera costo base gita
    $stmt = $this->db->prepare("SELECT costo FROM gite WHERE id = ?");
    $stmt->execute([$idGita]);
    $costoBase = $stmt->fetchColumn();

    // Calcola costo totale tour selezionati
    $costoTour = 0;
    if (!empty($tourSelezionati)) {
        $in = str_repeat('?,', count($tourSelezionati) - 1) . '?';
        $stmt = $this->db->prepare("SELECT SUM(costo_aggiuntivo) FROM tour WHERE id IN ($in)");
        $stmt->execute($tourSelezionati);
        $costoTour = $stmt->fetchColumn();
    }

    $prezzoTotale = $costoBase + $costoTour;

    // Salva iscrizione e prezzo totale
    $stmt = $this->db->prepare("INSERT INTO iscrizioni (id_gita, id_utente, prezzo_totale) VALUES (?, ?, ?)");
    $stmt->execute([$idGita, $idUtente, $prezzoTotale]);

    // Salva tour scelti (tabella ponte iscrizione_tour)
    $idIscrizione = $this->db->lastInsertId();
    foreach ($tourSelezionati as $idTour) {
        $stmt = $this->db->prepare("INSERT INTO iscrizione_tour (id_iscrizione, id_tour) VALUES (?, ?)");
        $stmt->execute([$idIscrizione, $idTour]);
    }

    // Redirect o messaggio di successo
}
function modificaGita($conn) {
    $id = $_GET['id'] ?? 0;
    $gita = \Model\Gita::find($conn, $id);
    include 'views/gite/modifica.php';
}

function salvaModificaGita($conn) {
    $id = $_GET['id'] ?? 0;
    \Model\Gita::update($conn, $id, $_POST['nome'], $_POST['descrizione'], $_POST['data'], $_POST['costo'], $_POST['max']);
    header('Location: index.php?page=dettaglio_gita&id=' . $id);
}
function salvaRecensione($conn) {
    $gita_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    $testo = $_POST['testo'];
    $voto = $_POST['voto'];
    $stmt = $conn->prepare("INSERT INTO recensioni (gita_id, user_id, testo, voto) VALUES (?, ?, ?, ?)");
    $stmt->execute([$gita_id, $user_id, $testo, $voto]);
    header('Location: index.php?page=dettaglio_gita&id=' . $gita_id);
}
function pannelloAdmin($conn) {
    if (!isAdmin()) {
        header('Location: index.php');
        exit;
    }
    // Gite
    $gite = \Model\Gita::all($conn, $_SESSION['user_id']);
    // Utenti
    $stmt = $conn->query("SELECT * FROM users");
    $utenti = $stmt->fetchAll();
    include 'views/admin/pannello.php';
}
function eliminaGita($conn) {
    if (!isAdmin()) {
        header('Location: index.php');
        exit;
    }
    $id = $_GET['id'] ?? 0;
    $stmt = $conn->prepare("DELETE FROM gite WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: index.php?page=gite');
}
}
?>