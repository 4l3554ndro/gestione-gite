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
// gita
    public static function iscrittoAGita($conn,$id, $user_id) {
        $stmt = $conn->prepare("SELECT * FROM iscrizioni i WHERE i.gita_id=$id AND i.user_id=$user_id");
        $stmt->execute();
        return $stmt->fetch();
    }
    public static function iscrivitiAGita($conn, $id, $user_id) {
        $stmt = $conn->prepare("INSERT INTO iscrizioni(user_id, gita_id) VALUES ('$user_id','$id')");
        $stmt->execute();
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
