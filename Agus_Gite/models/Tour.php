<?php
namespace Model;
class Tour {
    public static function create($conn, $gita_id, $nome, $descrizione, $durata, $costo, $sconto) {
        $stmt = $conn->prepare("INSERT INTO tour (gita_id, nome_tour, descrizione, durata, costo_aggiuntivo, sconto) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$gita_id, $nome, $descrizione, $durata, $costo, $sconto]);
    }
}
?>