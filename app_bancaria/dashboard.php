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
	
//collegamento saldo e xml

//collegamento transazioni json e script

</body>
</html>