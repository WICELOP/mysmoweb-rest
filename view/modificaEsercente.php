<?php
function visualizzaPagina($dbc){

    ob_start();
    require ('../model/backEnd_json/ottieni_esercente_da_id.php');
    $output = ob_get_clean();
    $esercente = json_decode($output, true);

    $nomesito = "Modifica " . $esercente['nome'];

    require ('parcials/header.php');
    ?>

    <!--Inizio modificaEsercente-->

    <style>

    .mdl-button {
        color: white;
        font-size: 18px;
        text-align: center;
        line-height: 36px;
    }

    #nomees {
        padding: 20px 0 0 0;
    }

    #labnome.mdl-textfield__label{
        font-size: 24px;
    }

    #nomees.mdl-textfield--floating-label.is-focused .mdl-textfield__label, #nomees.mdl-textfield--floating-label.is-dirty .mdl-textfield__label, #nomees.mdl-textfield--floating-label.has-placeholder .mdl-textfield__label {
        font-size: 14px;
    }

    #nome {
        font-size: 24px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
    }

    #labnome {
        color: white;
    }

    #labnome::after {
        bottom: 0;
        background-color: white;
    }

</style>

<script type="text/javascript" src="js/eserScript.js"></script>

<script type="text/javascript">

    var esercenteNonModificato = <?php echo $output ?>;

    function modificaEsercente()
    {
      
        //modifico l'email se è stata modificata
        if (esercenteNonModificato.email != getEmail()) {
            esercenteNonModificato.email = getEmail();
        }
        
        //modifico il nome se è stato modificato
        if (esercenteNonModificato.nome != getNome()) {
            esercenteNonModificato.nome = getNome();
        }

        //modifico il percorso dell'immagine se è stato modificato
        if (getFileName() != "C:/images/uploads/"){
            esercenteNonModificato.percorso_logo = getFileName();
        }
        
        //aggiorno comunque gli esercizi (per comodità)
        esercenteNonModificato.esercizi = getPuntiVendita();

        //converto in stringa il JSON
        var esercenteModificato = JSON.stringify(esercenteNonModificato);

        $.ajax({
            //imposto il tipo di invio dati (GET O POST)
            type: "POST",
            //Dove devo inviare i dati recuperati dal form?
            url: "modificaEsercente",
            //Quali dati devo inviare?
            data: "id_amministratore=<?php echo $_GET['id']?>" + "&esercente=" + esercenteModificato ,
            dataType: "html",
            success: function (msg) {
                if (msg != "errore") {
                    messaggio("Modifiche salvate");
                        setTimeout(function () {
                            window.location.href = "listaEsercenti?evd=" + getNome();
                        }, 2500);
                } else {
                    messaggio("Errore, le modifiche non possono essere salvate" + msg);
                }

                // messaggio di avvenuta aggiunta valori al db (preso dal file risultato_aggiunta.php) potete impostare anche un alert("Aggiunto, grazie!");

                }, 
            error: function () {
                messaggio("Errore, impossibile interrogare la pagina"); //sempre meglio impostare una callback in caso di fallimento
            }
        });

        }

        $(document).ready(function(){
            if(ottieniImmagine("<?php echo $esercente['percorso_logo'] ?>") != "proxyImage?pic="){
                document.getElementById("topcard").className += " topcard";
                var percorso = "<?php echo $esercente['percorso_logo'] ?>";
                document.getElementById("topcard").style.backgroundImage = "url('"+ottieniImmagine(percorso)+"')";
                componentHandler.upgradeDom();
            }
        });

    </script>

    <div class="demo-card-wide mdl-card mdl-shadow--2dp">

        <div id="topcard" class="mdl-card__title" style="height: 200px">
            <h2 class="mdl-card__title-text" style="width: 100%;">
                <div id="nomees" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <?php echo '<input id="nome" class="mdl-textfield__input" value="' . $esercente['nome'] . '"> '; ?>
                    <label id="labnome" class="mdl-textfield__label" for="nome">Nome Azienda</label>
                </div>
            </h2>
        </div>

        <div class="mdl-card__supporting-text">

            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <?php echo '<input id="email" class="mdl-textfield__input" type="email" value="' . $esercente['email'] . '"> '; ?>
                <label class="mdl-textfield__label" for="email">Email</label>
            </div>

            <input type="file" id="file" onchange="uploadImg()" accept=".jpg, .jpeg, .png, .gif" style="display: none;">
            <label for="file" id="uploadfile"
            class="pr mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
                <i class="material-icons">file_upload</i>
                <div class="mdl-spinner spinner-color-upload mdl-spinner--single-color mdl-js-spinner is-active"
                id="spinner-upload" style="display:none;"></div>
            </label>

            <div class="mdl-tooltip" for="uploadfile">
                Seleziona un'immagine da assegnare
            </div>

    </div>

    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">Punti vendita</h2>
    </div>

    <div class="mdl-card__supporting-text">
        <ul id="unli" class="demo-list-control mdl-list ftm">
            <?php
            $indice = 0;
            foreach ($esercente['esercizi'] as $puntoVendita) {
                ?>
                <li class="mdl-list__item ftm">
                    <span class="mdl-list__item-primary-content spc">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="puntovendita<?php echo $indice ?>" value="<?php echo $puntoVendita ?>">
                            <label class="mdl-textfield__label" for="puntovendita<?php echo $indice ?>">Nuovo punto vendita</label>
                        </div>
                    </span>
                    <a class="mdl-list__item-secondary-action mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect" onclick="cancellaOpzione(this)">
                        <i class="material-icons gr">delete</i>
                    </a>
                </li>
                <?php
                $indice++;
            }
            ?>
        </ul>

        <button id="addopt" class="pr mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored"
        onclick="aggiungiOpzione(this)">
            <i class="material-icons">add</i>
        </button>

        <div class="mdl-tooltip" for="addopt">
            Aggiungi punto vendita
        </div>

    </div>

    <!--bottone salva modifiche-->

    <div class="mdl-card__title">
        <button id="demo-show-toast" class="mdl-button mdl-js-button mdl-js-ripple-effect" style="margin: auto;"
            onclick="modificaEsercente()">
            Salva Modifiche
        </button>
    </div>

</div>

<div id="demo-snackbar-example" class="mdl-js-snackbar mdl-snackbar">
    <div class="mdl-snackbar__text"></div>
    <button class="mdl-snackbar__action" type="button"></button>
</div>

<!--Fine modificaEsercente-->

<?php
require ('parcials/footer.php');
}
?>