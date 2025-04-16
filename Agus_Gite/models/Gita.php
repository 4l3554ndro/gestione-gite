<?php
class Gita {
    public static function all($conn) {
        $stmt = $conn->query("SELECT * FROM gite");
        return $stmt->fetchAll();
    }
    public static function find($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM gite WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public static function create($conn, $nome, $descrizione, $data, $costo, $max) {
        $stmt = $conn->prepare("INSERT INTO gite (nome_meta, descrizione, data, costo_base, max_partecipanti) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nome, $descrizione, $data, $costo, $max]);
    }
}
?>
