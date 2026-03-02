<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    echo json_encode(["errore" => "Non autorizzato"]);
    exit();
}

$username = $_SESSION['username'];

$file = "../data/transazioni.json";

$data = json_decode(file_get_contents($file), true);

$saldo = 0;
$transazioni_utente = [];

foreach ($data["transazioni"] as $t) {
    if ($t["username"] === $username) {

        $transazioni_utente[] = $t;

        if ($t["tipo"] === "entrata") {
            $saldo += $t["importo"];
        } else {
            $saldo -= $t["importo"];
        }
    }
}

echo json_encode([
    "saldo" => $saldo,
    "transazioni" => $transazioni_utente
]);
