<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elenco Gite</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
    <h2 class="text-center mb-4">Elenco Gite</h2>

    <div class="list-group">
        <?php foreach ($gite as $gita): ?>
            <a href="index.php?page=dettaglio_gita&id=<?= $gita['idgita'] ?>" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1"><?= htmlspecialchars($gita['nome_meta']) ?></h5>
                    <small><?= $gita['data'] ?></small>
                </div>
                <p class="mb-1">Costo base: €<?= number_format($gita['costo_base'], 2, ',', '.') ?></p>
            </a>
        <?php endforeach; ?>
    </div>

    <?php if (isAdmin()) : ?>
        <div class="text-center mt-4">
            <a href="index.php?page=aggiungi_gita" class="btn btn-primary">Aggiungi Gita</a>
        </div>
    <?php endif; ?>
</div>

<!-- Bootstrap JS (opzionale) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
