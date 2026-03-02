<?php
session_start();
require "../db/connessione.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, password FROM utenti WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION["username"] = $username;
            $_SESSION["user_id"] = $id;
            header("Location: ../dashboard.php");
            exit();
        } else {
            $error = "Password errata!";
        }
    } else {
        $error = "Utente non trovato!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="auth-container">
  <h2>Login</h2>

  <?php if ($error != "") echo "<p style='color:red;'>$error</p>"; ?>

  <form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Accedi</button>
  </form>

  <a href="../index.html">Torna alla Home</a>
</div>

</body>
</html>