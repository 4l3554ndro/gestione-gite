    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuova Gita</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="d-flex justify-content-center align-items-center mt-5">

    <div class="card shadow p-4" style="max-width: 500px; width: 100%;">
        <h2 class="text-center mb-4">Nuova Gita</h2>
        <form action="index.php?page=salva_gita" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome meta</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Es. Firenze" required>
            </div>
            <div class="mb-3">
                <label for="descrizione" class="form-label">Descrizione</label>
                <textarea class="form-control" id="descrizione" name="descrizione" rows="3" placeholder="Descrivi la gita" required></textarea>
            </div>
            <div class="mb-3">
                <label for="data" class="form-label">Data</label>
                <input type="date" class="form-control" id="data" name="data" required>
            </div>
            <div class="mb-3">
                <label for="costo" class="form-label">Costo base (€)</label>
                <input type="number" class="form-control" id="costo" name="costo" step="0.01" placeholder="0.00" required>
            </div>
            <div class="mb-3">
                <label for="max" class="form-label">Numero massimo partecipanti</label>
                <input type="number" class="form-control" id="max" name="max" placeholder="Es. 30" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Salva Gita</button>
                <a href="index.php?page=gite" class="btn btn-outline-secondary">Annulla</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS (opzionale per funzionalità dinamiche) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</div>
