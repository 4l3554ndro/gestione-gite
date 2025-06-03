<?php $hidden=$_GET['id']; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi un Nuovo Tour</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow p-4" style="max-width: 500px; width: 100%;">
        <h2 class="text-center mb-4">Aggiungi un Nuovo Tour</h2>
        <form method="POST" action="index.php?page=salva_tour&id=<?php echo $hidden; ?>">
            <!-- Nome Tour -->
<?php //dd($hidden); <input type="text" id="gita_id" name="gita_id" value="<?php $hidden>"> ?>
            <div class="mb-3">
                <label for="nome_tour" class="form-label">Nome del Tour</label>
                <input type="text" class="form-control" id="nome_tour" name="nome_tour" required>
            </div>

            <!-- Descrizione -->
            <div class="mb-3">
                <label for="descrizione" class="form-label">Descrizione</label>
                <textarea class="form-control" id="descrizione" name="descrizione" rows="4" required></textarea>
            </div>

            <!-- Durata -->
            <div class="mb-3">
                <label for="durata" class="form-label">Durata (in ore)</label>
                <input type="number" class="form-control" id="durata" name="durata" required>
            </div>

            <!-- Costo Aggiuntivo -->
            <div class="mb-3">
                <label for="costo_aggiuntivo" class="form-label">Costo Aggiuntivo (€)</label>
                <input type="number" step="0.01" class="form-control" id="costo_aggiuntivo" name="costo_aggiuntivo" required>
            </div>
            
            <!-- Sconto -->
            <div class="mb-3">
                <label for="sconto" class="form-label">Sconto (%)</label>
                <input type="number" step="0.01" min="0" max="100" class="form-control" id="sconto" name="sconto" value="<?= isset($tour['sconto']) ? $tour['sconto'] : 0 ?>" required>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary w-100">Aggiungi Tour</button>
        </form>
        <div class="text-center mt-3">
            <a href="index.php?page=gite" class="text-decoration-none">Torna all'Elenco Gite</a>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const hiddenValue = document.getElementById("gita_id").value;
    console.log("Valore campo nascosto:", hiddenValue);
</script>
