<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettaglio</title>
</head>
<body>
<h2>Dettagli Gita: <?= htmlspecialchars($gita['nome_meta']) ?></h2>
<p><?= htmlspecialchars($gita['descrizione']) ?></p>
<p>Data: <?= $gita['data'] ?></p>
<p>Costo: €<?= $gita['costo_base'] ?></p>
<p>Posti disponibili: <?= $gita['max_partecipanti'] ?></p>
<a href="index.php">Torna indietro</a>
</body>
</html>