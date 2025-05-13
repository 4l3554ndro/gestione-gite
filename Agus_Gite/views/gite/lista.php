<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elenco Gite</title>
</head>
<body>
<h2>Elenco Gite</h2>
<ul>
<?php foreach ($gite as $gita): ?>
    <li>
        <a href="index.php?page=dettaglio_gita&id=<?= $gita['idgita'] ?>">
            <?= htmlspecialchars($gita['nome_meta']) ?> - <?= $gita['data'] ?> - €<?= $gita['costo_base'] ?>
        </a>
    </li>
<?php endforeach; //dd($gite); ?>
</ul>
<?php if (isAdmin()) : ?>
<a href="index.php?page=aggiungi_gita">Aggiungi Gita</a>
<?php endif; ?>
</body>
</html>