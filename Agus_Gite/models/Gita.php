<?php
namespace Model;
class Gita {
    public static function all($conn, $user_id) {
        $stmt = $conn->query("SELECT * FROM gite g LEFT JOIN iscrizioni i ON g.id=i.gita_id AND i.user_id=$user_id");
        return $stmt->fetchAll();
    }
    public static function find($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM gite WHERE id = $id");
        $stmt->execute();
        return $stmt->fetch();
    }
    public static function findtour($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM tour WHERE gita_id = $id");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public static function create($conn, $nome, $descrizione, $data, $costo, $max) {
        $stmt = $conn->prepare("INSERT INTO gite (nome_meta, descrizione, data, costo_base, max_partecipanti) VALUES ('$nome', '$descrizione', '$data', '$costo', '$max')");
        $stmt->execute();
    }

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
}
?>
