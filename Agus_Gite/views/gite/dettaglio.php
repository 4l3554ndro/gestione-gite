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
    <?php if (!empty($errore)): ?>
        <div class="alert alert-danger text-center">
            <?= htmlspecialchars($errore) ?>
        </div>
    <?php endif; ?>

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
        <?php if (isset($iscritto['user_id'])): ?>
            <p><strong>Prezzo totale (gita + tour):</strong> €<?= number_format($iscritto['prezzo_totale'], 2, ',', '.') ?></p>
        <?php endif; ?>
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
                    <?php if (isAdmin()): ?>
                        <th>Azioni</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tours as $tour): ?>
                    <tr>
                        <td><?= htmlspecialchars($tour['nome_tour']) ?></td>
                        <td><?= htmlspecialchars($tour['descrizione']) ?></td>
                        <td><?= htmlspecialchars($tour['durata']) ?></td>
                        <td>
                            <?php
                                $prezzo = $tour['costo_aggiuntivo'];
                                $sconto = isset($tour['sconto']) ? $tour['sconto'] : 0;
                                if ($sconto > 0) {
                                    $prezzo_scontato = $prezzo - ($prezzo * $sconto / 100);
                                    echo "<span class='text-decoration-line-through text-danger'>€" . number_format($prezzo, 2, ',', '.') . "</span> ";
                                    echo "<span class='fw-bold text-success'>€" . number_format($prezzo_scontato, 2, ',', '.') . "</span>";
                                    echo " <span class='badge bg-success'>-" . $sconto . "%</span>";
                                } else {
                                    echo "€" . number_format($prezzo, 2, ',', '.');
                                }
                            ?>
                        </td>
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
                        <?php if (isAdmin()): ?>
                            <td>
                                <a href="index.php?page=modifica_tour&id=<?= $tour['id'] ?>" class="btn btn-warning btn-sm">Modifica</a>
                                <a href="index.php?page=elimina_tour&id=<?= $tour['id'] ?>&gita_id=<?= $gita['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questo tour?');">Elimina</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Aggiungi pulsante per aggiungere un nuovo tour -->
    <?php if (isAdmin()): ?>
        <div class="text-center mt-4">
            <a href="index.php?page=aggiungi_tour&id=<?= $gita['id'] ?>" class="btn btn-primary">Aggiungi Nuovo Tour</a>
            <a href="index.php?page=modifica_gita&id=<?= $gita['id'] ?>" class="btn btn-warning ms-2">Modifica Gita</a>
        </div>
    <?php endif; ?>

    <?php if (isset($iscritto['user_id'])): ?>
        <div class="mb-4">
            <h5>Lascia una recensione</h5>
            <form action="index.php?page=salva_recensione&id=<?= $gita['id'] ?>" method="POST">
                <div class="mb-2">
                    <label for="voto" class="form-label">Voto:</label>
                    <select name="voto" id="voto" class="form-select" required>
                        <option value="">Seleziona</option>
                        <?php for ($i=1; $i<=5; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="testo" class="form-label">Recensione:</label>
                    <textarea name="testo" id="testo" class="form-control" rows="2" required></textarea>
                </div>
                <button type="submit" class="btn btn-success btn-sm">Invia Recensione</button>
            </form>
        </div>
    <?php endif; ?>

    <h4 class="mt-5">Recensioni</h4>
    <?php if (!empty($recensioni)): ?>
        <?php foreach ($recensioni as $rec): ?>
            <div class="border rounded p-2 mb-2">
                <strong><?= htmlspecialchars($rec['nome']) ?> <?= htmlspecialchars($rec['cognome']) ?></strong>
                <span class="badge bg-warning text-dark"><?= $rec['voto'] ?>/5</span>
                <p class="mb-1"><?= nl2br(htmlspecialchars($rec['testo'])) ?></p>
                <small class="text-muted"><?= $rec['data'] ?></small>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nessuna recensione ancora.</p>
    <?php endif; ?>
    <div class="text-center mt-4">
        <a href="?page=gite" class="btn btn-secondary">Torna indietro</a>
    </div>

    <?php if (isAdmin()): ?>
        <h4 class="mt-5">Utenti iscritti a questa gita</h4>
        <div class="table-responsive mb-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Cognome</th>
                        <th>Email</th>
                        <th>Recensione</th>
                        <th>Voto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($utenti_iscritti as $utente): ?>
                        <tr>
                            <td><?= htmlspecialchars($utente['nome']) ?></td>
                            <td><?= htmlspecialchars($utente['cognome']) ?></td>
                            <td><?= htmlspecialchars($utente['email']) ?></td>
                            <td><?= $utente['recensione'] ? nl2br(htmlspecialchars($utente['recensione'])) : '<span class="text-muted">Nessuna</span>' ?></td>
                            <td><?= $utente['voto'] ? $utente['voto'].'/5' : '-' ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
