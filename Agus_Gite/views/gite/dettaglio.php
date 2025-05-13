<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettaglio Gita</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">
    <h2 class="mb-4 text-center">Dettagli Gita: <?= htmlspecialchars($gita['nome_meta']) ?></h2>

    <div class="mb-4 text-center">
        <?php if (isset($iscritto['user_id'])): ?>
            <a href="index.php?page=disiscriviti_gita&id=<?= $gita['id'] ?>" class="btn btn-danger">Disiscriviti</a>
        <?php else: ?>
            <a href="?page=iscriviti_gita&id=<?= $gita['id'] ?>" class="btn btn-success">Iscriviti</a>
        <?php endif; ?>
    </div>

    <div class="mb-4">
        <p><strong>Descrizione:</strong> <?= htmlspecialchars($gita['descrizione']) ?></p>
        <p><strong>Data:</strong> <?= $gita['data'] ?></p>
        <p><strong>Costo:</strong> €<?= number_format($gita['costo_base'], 2, ',', '.') ?></p>
        <p><strong>Posti disponibili:</strong> <?= $gita['max_partecipanti'] ?></p>
    </div>

    <h4 class="mt-5">Tour Disponibili</h4>
    <div class="table-responsive">
        <table class="table table-striped align-middle mt-3">
            <thead class="table-primary">
                <tr>
                    <th>Nome</th>
                    <th>Descrizione</th>
                    <th>Durata</th>
                    <th>Costo</th>
                    <th>Iscrizione</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tours as $tour): ?>
                    <tr>
                        <td><?= htmlspecialchars($tour['nome_tour']) ?></td>
                        <td><?= htmlspecialchars($tour['descrizione']) ?></td>
                        <td><?= htmlspecialchars($tour['durata']) ?></td>
                        <td>€<?= number_format($tour['costo_aggiuntivo'], 2, ',', '.') ?></td>
                        <td>
                            <?php if (isset($iscritto['user_id'])): ?>
                                <?php if (isset($tour['tour_id'])): ?>
                                    <a href="?page=disiscriviti_tour&id=<?= $tour['id'] ?>&iscrizione_id=<?= $tour['iscrizione_id'] ?>&gita_id=<?= $tour['gita_id'] ?>" class="btn btn-outline-danger btn-sm">Disiscriviti</a>
                                <?php else: ?>
                                    <a href="?page=iscriviti_tour&id=<?= $tour['id'] ?>&iscrizione_id=<?= $iscritto['id'] ?>&gita_id=<?= $tour['gita_id'] ?>" class="btn btn-outline-success btn-sm">Iscriviti</a>
                                <?php endif; ?>
                            <?php else: ?>
                                <span class="text-muted">Iscriviti prima alla gita</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="text-center mt-4">
        <a href="?page=gite" class="btn btn-secondary">Torna indietro</a>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
