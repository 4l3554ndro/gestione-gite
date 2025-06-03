<?php
namespace Model;
class Gita {
    public static function all($conn, $user_id) {
        $stmt = $conn->query("SELECT g.id AS idgita, g.nome_meta, g.descrizione, g.data, g.costo_base, g.max_partecipanti, i.id AS idiscrizione, i.user_id, i.prezzo_totale FROM gite g LEFT JOIN iscrizioni i ON g.id=i.gita_id AND i.user_id=2;");
        return $stmt->fetchAll();
    }
    public static function find($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM gite WHERE id = $id");
        $stmt->execute();
        return $stmt->fetch();
    }
    public static function findtour($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM tour t LEFT JOIN iscrizione_tour i ON t.id=i.tour_id WHERE t.gita_id = $id");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public static function create($conn, $nome, $descrizione, $data, $costo, $max) {
        $stmt = $conn->prepare("INSERT INTO gite (nome_meta, descrizione, data, costo_base, max_partecipanti) VALUES ('$nome', '$descrizione', '$data', '$costo', '$max')");
        $stmt->execute();
    }
    public static function update($conn, $id, $nome, $descrizione, $data, $costo, $max) {
        $stmt = $conn->prepare("UPDATE gite SET nome_meta=?, descrizione=?, data=?, costo_base=?, max_partecipanti=? WHERE id=?");
        $stmt->execute([$nome, $descrizione, $data, $costo, $max, $id]);
    }
// gita
    public static function iscrittoAGita($conn, $id, $user_id) {
        // Recupera iscrizione
        $stmt = $conn->prepare("SELECT * FROM iscrizioni WHERE gita_id=$id AND user_id=$user_id");
        $stmt->execute();
        $iscrizione = $stmt->fetch();

        if ($iscrizione) {
            // Calcola costo base gita
            $stmt = $conn->prepare("SELECT costo_base FROM gite WHERE id = $id");
            $stmt->execute();
            $costo_base = $stmt->fetchColumn();

            // Calcola costo totale dei tour a cui l'utente è iscritto
            $stmt = $conn->prepare("SELECT SUM(t.costo_aggiuntivo) FROM iscrizione_tour it JOIN tour t ON it.tour_id = t.id WHERE it.iscrizione_id = ?");
            $stmt->execute([$iscrizione['id']]);
            $costo_tour = $stmt->fetchColumn();
            if (!$costo_tour) $costo_tour = 0;

            $iscrizione['prezzo_totale'] = $costo_base + $costo_tour;
        }

        return $iscrizione;
    }
    public static function iscrivitiAGita($conn, $id, $user_id) {
        // Recupera il numero massimo di partecipanti per la gita
        $stmt = $conn->prepare("SELECT max_partecipanti FROM gite WHERE id = $id");
        $stmt->execute();
        $max = $stmt->fetchColumn();

        // Conta gli iscritti attuali
        $stmt = $conn->prepare("SELECT COUNT(*) FROM iscrizioni WHERE gita_id = $id");
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count >= $max) {
            return false; // Limite raggiunto
        }

        // Procedi con l'iscrizione
        $stmt = $conn->prepare("INSERT INTO iscrizioni (gita_id,user_id) VALUES ($id, $user_id)");
        return $stmt->execute();
    }
    public static function disiscrivitiAGita($conn, $id, $user_id) {
        $stmt = $conn->prepare("DELETE FROM iscrizioni WHERE user_id=$user_id AND gita_id=$id");
        $stmt->execute();
    }
// tour
    /*public static function iscrittoATour($conn, $tour_id, $iscrizione_id) {
        $stmt = $conn->prepare("SELECT * FROM iscrizioni_tour i WHERE i.tour_id=$tour_id AND i.iscrizione_id=$iscrizione_id");
        $stmt->execute();
        return $stmt->fetch();
    }*/
    public static function iscrivitiATour($conn, $tour_id, $iscrizione_id) {
        //dd($iscrizione_id." ".$tour_id);
        $stmt = $conn->prepare("INSERT INTO iscrizione_tour(iscrizione_id, tour_id) VALUES ('$iscrizione_id','$tour_id')");
        
        $stmt->execute();
    }
    public static function disiscrivitiATour($conn, $tour_id, $iscrizione_id) {
        $stmt = $conn->prepare("DELETE FROM iscrizione_tour WHERE iscrizione_id=$iscrizione_id AND tour_id=$tour_id");
        $stmt->execute();
    }
}
?>
