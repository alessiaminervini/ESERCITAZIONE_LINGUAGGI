<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

$config = [];
$config_raw = file("config/app.yaml");

$current_section = null;

foreach ($config_raw as $line) {
    $line = trim($line);

    if (strpos($line, ":") !== false) {
        if (substr($line, -1) == ":") {
            $current_section = rtrim($line, ":");
            $config[$current_section] = [];
        } else {
            list($key, $value) = explode(":", $line, 2);
            $key = trim($key);
            $value = trim($value);

            if ($current_section) {
                $config[$current_section][$key] = $value;
            } else {
                $config[$key] = $value;
            }
        }
    }
}

$app_nome = $config["app"]["nome"];
$app_versione = $config["app"]["versione"];
$app_ambiente = $config["app"]["ambiente"];

$username = $_SESSION['username'];
?>
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


