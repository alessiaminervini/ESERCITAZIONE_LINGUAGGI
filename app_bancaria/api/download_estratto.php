<?php
session_start();

if (!isset($_SESSION['username'])) {
    exit("Non autorizzato");
}

$username = $_SESSION['username'];

$template = simplexml_load_file("../data/estratto_conto.xml");
$data = json_decode(file_get_contents("../data/transazioni.json"), true);

$template->Utente = $username;
$template->DataGenerazione = date("Y-m-d");

$saldo = 0;

foreach ($data["transazioni"] as $t) {
    if ($t["username"] === $username) {

        if ($t["tipo"] === "entrata") {
            $saldo += $t["importo"];
        } else {
            $saldo -= $t["importo"];
        }

        $trans = $template->Transazioni->addChild("Transazione");
        $trans->addChild("Tipo", $t["tipo"]);
        $trans->addChild("Descrizione", $t["descrizione"]);
        $trans->addChild("Importo", $t["importo"]);
        $trans->addChild("Data", $t["data"]);
    }
}

$template->SaldoFinale = $saldo;

header("Content-Type: application/xml");
header("Content-Disposition: attachment; filename=estratto_conto_$username.xml");

echo $template->asXML();