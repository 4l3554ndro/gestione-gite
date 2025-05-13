<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettaglio</title>
</head>
<body>
<h2>Dettagli Gita: <?= htmlspecialchars($gita['nome_meta'])?></h2>
<?php
if (isset($iscritto['user_id'])) {
        echo "<button><a href=\"index.php?page=disiscriviti_gita&id=" . $gita['id']."\">Disiscriviti</a></button>";
    } else {
        echo "<button><a href=\"?page=iscriviti_gita&id=" . $gita['id'] . "\">Iscriviti</a></button>";
    }
?>
<p><?= htmlspecialchars($gita['descrizione']) ?></p>
<p>Data: <?= $gita['data'] ?></p>
<p>Costo: €<?= $gita['costo_base'] ?></p>
<p>Posti disponibili: <?= $gita['max_partecipanti'] ?></p>

<?php /*echo($_SESSION['user_id']." ".$iscritto['user_id']);*/?>

<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>descrizione</th>
            <th>durata</th>
            <th>costo</th>
            <th>iscriviti</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($tours as $tour): ?>
            <tr>
                <td><?= htmlspecialchars($tour['nome_tour']) ?></td>
                <td><?= htmlspecialchars($tour['descrizione']) ?></td>
                <td><?= htmlspecialchars($tour['durata']) ?></td>
                <td><?= htmlspecialchars($tour['costo_aggiuntivo']) ?></td>
<td>
    <?php
    if (isset($iscritto['user_id'])) {
        if (isset($isctour['id'])) {
            $tour_id = $tour['id'];
            //$iscrittoTour = Gita::iscrittoATour($conn, $tour_id, $iscritto['id']);
        } else {
            $iscrittoTour = false;
        }
        echo "<button><a href=\"?page=iscriviti_tour&id=" . $tour['id'] . "\">Iscriviti</a></button>";
    } else {
        echo "Iscriviti prima alla gita";
    }
    ?>
</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="?page=gite">Torna indietro</a>
</body>
</html>