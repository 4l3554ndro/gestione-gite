<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Gestione Gite' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand">Gestione Gite & Tour</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <?php if (!isLoggedIn()) { ?>
                        <?php } else { ?>
                        <a class="nav-link" href="index.php?page=gite">Elenco Gite</a>
                        <?php } ?>
                    </li>
                    <li class="nav-item">
                        <?php if (!isLoggedIn()) { ?>
                            <a class="nav-link" href="index.php?page=login">Login</a>
                        <?php } else { ?>
                            <a class="nav-link" href="index.php?page=logout">Logout</a>
                        <?php } ?>
                    </li>
                    <li class="nav-item">
                        <?php if (isAdmin()) { ?>
                            <a class="nav-link" href="index.php?page=admin">Admin</a>
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Contenuto pagina -->
    <div>
        <?php include $view; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>