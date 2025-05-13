<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benvenuto | Gite Organizzate</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex flex-column justify-content-center align-items-center min-vh-100 text-center">
    <div class="card shadow p-5 bg-white rounded" style="max-width: 600px; width: 100%;">
        <h1 class="mb-4">Benvenuto su Gite Organizzate</h1>
        <p class="lead">Esplora, iscriviti e partecipa a gite indimenticabili. Organizzate con cura per offrirti esperienze uniche e ben strutturate.</p>
        
        <div class="d-grid gap-3 mt-4">
            <?php if (!isLoggedIn()) { ?>
                <a href="index.php?page=login" class="btn btn-primary btn-lg">Accedi al tuo account</a>
            <?php } else { ?>
                <a href="index.php?page=gite" class="btn btn-primary btn-lg">Visualizza Gite Disponibili</a>
            <?php } ?>
            
            
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
