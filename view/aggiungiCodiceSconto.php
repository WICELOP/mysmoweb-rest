<?php
function visualizzaPagina(){

    $nomesito = "Aggiungi buoni sconto";

    require ('parcials/header.php');
    ?>

    <!--Inizio aggiungiCodiceSconto-->

    <style>

    .center {
        position: relative;
        text-align: center;
        font-size: 16px;
    }

    .mdl-button.mdl-button--colored {
        color: white;
        margin: 4px auto;
    }

    .mdl-button {
        color: white;
        font-family: "Roboto", "Helvetica", "Arial", sans-serif;
        font-size: 18px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0;
        cursor: pointer;
        text-align: center;
        line-height: 36px;
    }

    .mdl-chip {
    display: flex;
    margin: 20px auto 0 auto;
    justify-content: center;
    padding: 6px;
}

</style>

    <script>
        var lista = new Array();

        function aggiungiCodiceSconto() {
            if (document.getElementById("cod_sconto").value == "" || document.getElementById("cod_sconto").value == "undefined" || document.getElementById("cod_valore").value == "" || document.getElementById("cod_valore").value == "undefined" || document.getElementById("cod_punti").value == "" ||
                document.getElementById("cod_punti").value == "undefined" || isNaN(document.getElementById("cod_punti").value) || isNaN(document.getElementById("cod_valore").value)) {
                messaggio("Errore! Compila correttamente i campi");
            } else {
                lista.push(new Sconto(document.getElementById("cod_sconto").value, document.getElementById("cod_valore").value, document.getElementById("cod_punti").value));
                $("#cod_sconto").val('');
                $("#cod_valore").val('');
                $("#cod_punti").val('');
                cambiaNumeroCodici();
            }
        }

        function readBlob(opt_startByte, opt_stopByte) {
            var files = $("#file").get(0).files;
            if (!files.length) {
                messaggio('Seleziona un file!');
                return;
            }
            var file = files[0];
            var start = parseInt(opt_startByte) || 0;
            var stop = parseInt(opt_stopByte) || file.size - 1;
            var reader = new FileReader();
            reader.onloadend = function (evt) {
                if (evt.target.readyState == FileReader.DONE) {
                    // DONE == 2
                    inserisci(evt.target.result);
                    //alert(['Read bytes: ', start + 1, ' - ', stop + 1,' of ', file.size, ' byte file'].join(''));
                    }
                };
                var blob = file.slice(start, stop + 1);
                reader.readAsBinaryString(blob);
        }

        function inserisci(str) {

            try {
                var arr = str.split(";");
                var s = 0;
                var ind = 0;
                var cod = "";
                var punti = "";
                var val = "";
                for (; s < arr.length; s++) {
                    if (ind == 0) //leggiamo il codice
                    {
                        cod = arr[s];
                        ind++;
                    }
                    else if (ind == 1) //leggiamo il valore
                    {
                        valore = arr[s];
                        (parseInt(valore));
                        ind++;
                    }
                    else if (ind == 2) //leggiamo i punti
                    {
                        punti = arr[s];
                        (parseInt(punti));
                        lista.push(new Sconto(cod, valore, punti));
                        ind = 0;
                    }
                }
                cambiaNumeroCodici();
            } catch (e) {
                messaggio("Errore nel file, cancellati tutti i codici inseriti");
                lista = new Array();
            }
        }

        function cambiaNumeroCodici() {
            $("h5").text((lista.length) + " buoni da aggiungere");
        }

        function messaggio(testo) {
            var handler = function (event) {
            }
            'use strict';
            var data = {
                message: testo,
                timeout: 3500,
                actionHandler: handler,
                actionText: 'Ok'
            };
            document.querySelector('#demo-snackbar-example').MaterialSnackbar.showSnackbar(data);
        }

        function mandaViaAjax() {
            var json = JSON.stringify(lista);
            $.ajax({
                //imposto il tipo di invio dati (GET O POST)
                type: "POST",
                //Dove devo inviare i dati recuperati dal form?
                url: "../backEnd_json/inserisci_codice.php",
                //Quali dati devo inviare?
                data: "sconto=" + json,
                dataType: "html",
                success: function (msg) {
                    if (msg) {
                        messaggio("Buonni sconto aggiunti correttamente");
                    }
                    else {
                        messaggio("Buoni sconto non aggiunti!");
                    }
                },
                error: function () {
                    messaggio("Impossibile contattare la pagina"); //sempre meglio impostare una callback in caso di fallimento
                }
            });

        }

        jQuery(document).ready(function () {
            setTimeout(function () {
                $("#file").get(0).addEventListener('change', function (evt) {
                    var startByte = evt.target.getAttribute('data-startbyte');
                    var endByte = evt.target.getAttribute('data-endbyte');
                    readBlob(startByte, endByte);
                }, false);
            }, 2000);
        });

    </script>

    <div class="demo-card-wide mdl-card mdl-shadow--2dp">

        <div id="topcard" class="mdl-card__title" style="height: 150px;">
            <h2 class="mdl-card__title-text"><?php echo $nomesito ?></h2>
        </div>

        <div class="mdl-card__supporting-text">
            <ul id="unli" class="demo-list-control mdl-list ftm">
                <li class="mdl-list__item ftm">
                    <span class="mdl-list__item-primary-content spc">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="cod_sconto">
                            <label class="mdl-textfield__label" for="cod_sconto">Codice sconto</label>
                        </div>
                    </span>
                    <span class="mdl-list__item-primary-content spc">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="cod_valore">
                            <label class="mdl-textfield__label" for="cod_valore">Valore (€)</label>
                            <span class="mdl-textfield__error">Inserisci un numero</span>
                        </div>
                    </span>
                    <span class="mdl-list__item-primary-content spc">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" pattern="?[0-9]*(\.[0-9]+)?" id="cod_punti">
                            <label class="mdl-textfield__label" for="cod_punti">Punti</label>
                            <span class="mdl-textfield__error">Inserisci un numero</span>
                        </div>
                    </span>
                    <a class="mdl-list__item-secondary-action mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect"
                    onclick="aggiungiCodiceSconto()">
                        <i class="material-icons gr">add</i>
                    </a>
                </li>
            </ul>

        <input type="file" id="file" accept=".text/csv" style="display: none;">
        <label for="file" id="addopt" class="pr mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">note_add</i>
        </label>

        <div class="mdl-tooltip" for="addopt">
            Importa buoni da file
        </div>

        <span class="mdl-chip">
            <span class="mdl-chip__text center">Non ci sono buoni da aggiungere!</span>
        </span>

    </div>

<div class="mdl-card__title">
    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" onclick="mandaViaAjax()">
        Carica buoni
    </a>
</div>

</div>
<div id="demo-snackbar-example" class="mdl-js-snackbar mdl-snackbar" >
    <div class="mdl-snackbar__text"></div>
    <button class="mdl-snackbar__action" type="button" style="display: none;"></button>
</div>

<!--Fine aggiungiCodiceSconto-->

<?php
require ('parcials/footer.php');
}
?>