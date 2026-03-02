fetch('api/transazioni.php')
  .then(res => res.json())
  .then(data => {

      document.getElementById("saldo").innerHTML =
          "€ " + data.saldo.toFixed(2);

      let html = "<ul>";

      data.transazioni.forEach(t => {

    let classe = t.tipo === "entrata" ? "entrata" : "uscita";

    html += `<li>
        <span>${t.descrizione} (${t.data})</span>
        <span class="${classe}">
            ${t.tipo === "entrata" ? "+" : "-"} € ${t.importo}
        </span>
    </li>`;
});

      html += "</ul>";

      document.getElementById("transazioni").innerHTML = html;
  });