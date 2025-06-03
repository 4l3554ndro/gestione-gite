<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica Gita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="max-width: 500px; width: 100%;">
        <h2 class="text-center mb-4">Modifica Gita</h2>
        <form action="index.php?page=salva_modifica_gita&id=<?= $gita['id'] ?>" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome meta</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($gita['nome_meta']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="descrizione" class="form-label">Descrizione</label>
                <textarea class="form-control" id="descrizione" name="descrizione" rows="3" required><?= htmlspecialchars($gita['descrizione']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="data" class="form-label">Data</label>
                <input type="date" class="form-control" id="data" name="data" value="<?= $gita['data'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="costo" class="form-label">Costo base (€)</label>
                <input type="number" class="form-control" id="costo" name="costo" step="0.01" value="<?= $gita['costo_base'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="max" class="form-label">Numero massimo partecipanti</label>
                <input type="number" class="form-control" id="max" name="max" value="<?= $gita['max_partecipanti'] ?>" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                <a href="index.php?page=dettaglio_gita&id=<?= $gita['id'] ?>" class="btn btn-outline-secondary">Annulla</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>