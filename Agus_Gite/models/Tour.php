<?php
namespace Model;
class Tour {
    public static function create($conn, $gita_id, $nome, $descrizione, $durata, $costo) {
        $stmt = $conn->prepare("INSERT INTO tour (gita_id, nome_tour, descrizione, durata, costo_aggiuntivo) VALUES ('$gita_id','$nome', '$descrizione', '$durata', '$costo')");
        $stmt->execute();
    }
}
?>