
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accedi</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="d-flex justify-content-center align-items-center mt-5">
    <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
        <h2 class="text-center mb-4">Accedi</h2>
        <form method="POST" action="index.php?page=loginok">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" name="action" value="login" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="text-center mt-3">
            <a href="index.php?page=register" class="text-decoration-none">Non hai un account? Registrati</a>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

