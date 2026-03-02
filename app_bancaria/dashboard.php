<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

//collegamento yaml

<!DOCTYPE html>
<html>
<head>
  <title><?php echo $app_nome; ?> - Dashboard</title>
  <link rel="stylesheet" href="./assets/style.css">
</head>
<body>

<div class="app-container">

    <header class="app-header">
        <div>
            <h1><?php echo $app_nome; ?></h1>
            <span class="welcome">Benvenuto, <?php echo htmlspecialchars($username); ?></span>
        </div>
        <a class="logout-btn" href="auth/logout.php">Logout</a>
    </header>

	<section class="saldo-section">
        <div class="saldo-card">
            <p class="saldo-label">Saldo disponibile</p>
            <p id="saldo" class="saldo-value">€ 0.00</p>
        </div>
        <?php if ($config["export"]["abilita_download_xml"] == "true") : ?>
		<div class="estratto-card">
    		<p>Scarica estratto conto completo</p>
    		<a href="api/download_estratto.php" target="_blank" class="download-btn">Scarica XML</a>
		</div>
		<?php endif; ?>
    </section>

    <section class="transazioni-section">
        <h3>Movimenti Recenti</h3>
        <div id="transazioni"></div>
    </section>

</div>

<script src="assets/script.js"></script>

</body>

</html>

