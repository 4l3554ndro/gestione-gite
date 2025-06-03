<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="d-flex justify-content-center align-items-center mt-5">
    <div class="card shadow p-4" style="max-width: 500px; width: 100%;">
        <h2 class="text-center mb-4">Modifica Tour</h2>
        <form action="index.php?page=salva_modifica_tour&id=<?= $tour['id'] ?>&gita_id=<?= $tour['gita_id'] ?>" method="POST">
            <div class="mb-3">
                <label for="nome_tour" class="form-label">Nome del Tour</label>
                <input type="text" class="form-control" id="nome_tour" name="nome_tour" value="<?= htmlspecialchars($tour['nome_tour']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="descrizione" class="form-label">Descrizione</label>
                <textarea class="form-control" id="descrizione" name="descrizione" rows="3" required><?= htmlspecialchars($tour['descrizione']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="durata" class="form-label">Durata (in ore)</label>
                <input type="number" class="form-control" id="durata" name="durata" value="<?= $tour['durata'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="costo_aggiuntivo" class="form-label">Costo aggiuntivo (€)</label>
                <input type="number" step="0.01" class="form-control" id="costo_aggiuntivo" name="costo_aggiuntivo" value="<?= $tour['costo_aggiuntivo'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="sconto" class="form-label">Sconto (%)</label>
                <input type="number" step="0.01" min="0" max="100" class="form-control" id="sconto" name="sconto" value="<?= isset($tour['sconto']) ? $tour['sconto'] : 0 ?>" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                <a href="index.php?page=dettaglio_gita&id=<?= $tour['gita_id'] ?>" class="btn btn-outline-secondary">Annulla</a>
            </div>
        </form>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
