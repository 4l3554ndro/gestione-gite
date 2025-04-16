<h1>Benvenuto nel portale Gite Scolastiche</h1>
<a href="index.php?page=gite">Visualizza Gite</a>
<?php if (!isLoggedIn()) { ?>
<a href="index.php?page=login">Login</a>
<?php } else { ?>
<a href="index.php?page=logout">Logout</a>
<?php } ?>