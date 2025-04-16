<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuova Gita</title>
</head>
<body>
<h2>Nuova Gita</h2>
<form action="index.php?page=salva_gita" method="POST">
    <input type="text" name="nome" placeholder="Nome meta" required><br>
    <textarea name="descrizione" placeholder="Descrizione" required></textarea><br>
    <input type="date" name="data" required><br>
    <input type="number" name="costo" step="0.01" placeholder="Costo base" required><br>
    <input type="number" name="max" placeholder="Numero massimo partecipanti" required><br>
    <button type="submit">Salva Gita</button>
</form>
<a href="index.php?page=gite">Annulla</a>
</body>
</html>