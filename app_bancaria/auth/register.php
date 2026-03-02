<?php
require "../db/connessione.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO utenti (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        $message = "Registrazione completata!";
    } else {
        $message = "Username già esistente!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Registrazione</title>
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="auth-container">
  <h2>Registrazione</h2>

  <?php if ($message != "") echo "<p>$message</p>"; ?>

  <form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Registrati</button>
  </form>

  <a href="../index.html">Torna alla Home</a>
</div>

</body>
</html>