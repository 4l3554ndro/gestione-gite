<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pannello di Amministrazione</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-5">
    <h2 class="mb-4 text-center">Pannello di Amministrazione</h2>

    <h4>Gestione Gite</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Data</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($gite as $gita): ?>
                <tr>
                    <td><?= htmlspecialchars($gita['nome_meta']) ?></td>
                    <td><?= $gita['data'] ?></td>
                    <td>
                        <a href="index.php?page=dettaglio_gita&id=<?= $gita['idgita'] ?>" class="btn btn-info btn-sm">Dettaglio</a>
                        <a href="index.php?page=modifica_gita&id=<?= $gita['idgita'] ?>" class="btn btn-warning btn-sm">Modifica</a>
                        <a href="index.php?page=elimina_gita&id=<?= $gita['idgita'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Sei sicuro di voler eliminare questa gita?');">Elimina</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h4 class="mt-5">Gestione Utenti</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Email</th>
                <th>Ruolo</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($utenti as $utente): ?>
                <tr>
                    <td><?= htmlspecialchars($utente['nome']) ?></td>
                    <td><?= htmlspecialchars($utente['cognome']) ?></td>
                    <td><?= htmlspecialchars($utente['email']) ?></td>
                    <td><?= htmlspecialchars($utente['ruolo']) ?></td>
                    <td>
                        <?php if ($utente['bloccato']): ?>
                            <a href="index.php?page=sblocca_utente&id=<?= $utente['id'] ?>" class="btn btn-success btn-sm">Sblocca</a>
                        <?php else: ?>
                            <a href="index.php?page=blocca_utente&id=<?= $utente['id'] ?>" class="btn btn-danger btn-sm">Blocca</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>