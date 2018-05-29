<?php
function visualizzaPagina($dbc){

    $_COOKIE['id_amministratore'] = $_GET['id'];
    ob_start();
    require ('../model/backEnd_json/ottieni_esercente_da_id.php');
    $output = ob_get_clean();
    $esercente = json_decode($output, true);
    $id = $_GET['id'];

    /*assegna il titolo alla pagina*/
    $nomesito = "Visualizza " . $esercente['nome'];

    require ('parcials/header.php');
    ?>

    <!--Inizio visualizzaEsercente-->

<!-- <script type="text/javascript" src="../js/html2canvas.min.js"></script> -->

    <style>

    .demo-card-wide.mdl-card {
        width: 670px;
        margin: 10% auto;
    }

    .bottone {
        background-color: #5C6BC0;
    }

    .bottone:hover {
        background-color: #2196F3;
    }
    .bottone_non_pubblicato {
        background-color: #F44336;
    }

    .bottone_non_pubblicato:hover {
        background-color: #4CAF50;
    }
    .bottone_pubblicato {
        background-color: #4CAF50;
    }
    .material-icons.md1::before{
        content:"add";
    }

    .croce:hover::before .material-icons{
        content:"clear";
        background-color: #F44336;
    }
    .croce:hover::after .material-icons{
        content:"done";
        background-color:#4CAF50;
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

    .mdl-data-table {
        margin: auto;
        width: 100%;
        position: relative;
        border: 1px solid rgba(0, 0, 0, .12);
        border-collapse: collapse;
        white-space: nowrap;
        font-size: 13px;
        background-color: #fff;
    }

    .demo-list-icon {
        width: auto;
        margin-top: 0px;
        margin-bottom: 0px;
    }

    #percorso_logo {
        border-radius: 50%;
        width: 200px;
    }

    .demo-list-icon {
        width: 500px;
    }

    #casellaricerca {
        width: auto;
        padding: 20px 0 0 0;
    }

    .mdl-card__title {
        justify-content: space-between;
    }

    #casellaricerca {
        padding: 20px 0 0 0;
    }

    #cerca {
        font-size: 18px;
        border-bottom: 1px solid rgba(255, 255, 255, .7);
    }

    #labcerca {
        color: white;
    }

    #labcerca::after {
        bottom: 0;
        background-color: white;
    }

    #noes {
        font-size: 16px;
        line-height: 24px;
    }
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
    }

</style>

<script>
    window.onclick = function(event) {
        if (event.target == document.getElementById("myDialog")) {
            document.getElementById("myDialog").style.display = "none";
        }
    }
    $(document).ready(function () {
        ricerca();
    });

    function screen() {
        html2canvas(document.body).then(function (canvas) {
            document.body.appendChild(canvas);
        });
    }

    function ricerca() {
        var testo = $("#cerca").val();
        if (testo == undefined || testo == null || testo == "") {
            testo = "%";
        }
        $.ajax({
            type: "POST",
            url: "../backEnd_json/lista_questionari_per_esercente.php",
            <?php
            if (isset($_GET['id'])) {
                echo 'data: "id_esercente=' . $_GET['id'] . '&nome="+testo';
            } else {
                header('Location: dashboardApertamente.php');
                exit();
            }
            ?>,
            dataType
            :
            "html",
            success
            :

            function (msg) {

            var esercente = JSON.parse(msg);
            $("#questionari").empty();
            var i = 0;
            var str = "<table class=\"mdl-data-table mdl-js-data-table mdl-data-table mdl-shadow--2dp\">";
                str = str + "<th class=\"mdl-data-table__cell--non-numeric\">Titolo</th>";
                str = str + "<th>Id</th>";
                //str = str + "<th>Tempo minimo</th>";
                //str = str + "<th>Tempo massimo</th>";
                str = str + "<th class=\"mdl-data-table__cell--non-numeric\">Metodo di invio</th>";
                str = str + "<th>Pubblicato</th>";
                str = str + "<th class=\"mdl-data-table__cell--non-numeric\">Struttura</th>";
                str = str + "<th class=\"mdl-data-table__cell--non-numeric\">Grafico</th>";
                str = str + "<th class=\"mdl-data-table__cell--non-numeric\">PDF</thead>";
                    for (; i < esercente.length; i++) {
                    str = str + "<tr>";
                        str = str + "<td class=\"mdl-data-table__cell--non-numeric\">" + esercente[i].nome + "</td>";
                        str = str + "<td>" + esercente[i].id_questionario + "</td>";
                        //str = str + "<td>" + esercente[i].tempo_min + "</td>";
                        //str = str + "<td>" + esercente[i].tempo_max + "</td>";
                        str = str + "<td class=\"mdl-data-table__cell--non-numeric\">" + esercente[i].metodo_invio + "</td>";

                        if(esercente[i].pubblicato)
                        {
                          str = str + "<td class=\"mdl-data-table__cell--non-numeric\">" +
                              "<a onclick='messaggio(\"Questionario giò pubblicato\")' class=\"bottone_pubblicato mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab\">\n" +
                                  "  <i class=\"material-icons\">send</i>\n" +
                              "</a></td>";
                          }
                          else
                          {
                              str = str + "<td class=\"mdl-data-table__cell--non-numeric\">" +
                                  "<a onclick='pubblicaQuestionario(" + esercente[i].id_questionario + ")' class=\"bottone_non_pubblicato mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab\">\n" +
                                      "  <i class=\"material-icons\">send</i>\n" +
                                  "</a></td>";
                              }
                              str = str + "<td class=\"mdl-data-table__cell--non-numeric\">" +
                                "<a href='visualizzaQuestionario.php?id=" + esercente[i].id_questionario + "' class=\"bottone mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab\">\n" +
                                    "  <i class=\"material-icons\">remove_red_eye</i>\n" +
                                "</a></td>";
                                str = str + "<td class=\"mdl-data-table__cell--non-numeric\">" +
                                    "<a href='grafici.php?id=" + esercente[i].id_questionario + "' class=\"bottone mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab\">\n" +
                                        "  <i class=\"material-icons\">timeline</i>\n" +
                                    "</a></td>";
                                    str = str + "<td class=\"mdl-data-table__cell--non-numeric\">" +
                                        /*"<a onclick='screen()' class=\"bottone mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab\">\n" +
                                            "  <i class=\"material-icons\">picture_as_pdf</i>\n" +
                                        "</a></td>";*/

                                        "<a href='pdf/pdf.php?id_questionario=" + esercente[i].id_questionario + "' class=\"bottone mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab\">\n" +
                                            "  <i class=\"material-icons\">picture_as_pdf</i>\n" +
                                        "</a></td>";

                                    str = str + "</tr>";
                                }
                            str = str + "</table>";
                            $("#questionari").append($.parseHTML(str));
                        }

                        ,
                        error: function () {
                        messaggio("Impossibile contattare la pagina di aggiunta questionario"); //sempre meglio impostare una callback in caso di fallimento
                    }
                })
                ;
            }
            function ricerca2(indice) {
            var testo = $("#cerca2").val();
            if (testo == undefined || testo == null || testo == "") {
            testo = "%";
        }
        $.ajax({
        type: "POST",
        url: "../backEnd_json/lista_questionari_per_esercente.php",
        <?php
        if (isset($_GET['id'])) {
            echo 'data: "id_esercente=' . $_GET['id'] . '&nome="+testo';
        } else {
            header('Location: dashboardApertamente.php');
            exit();
        }
        ?>,
        dataType
        :
        "html",
        success
        :

        function (msg) {

        var esercente = JSON.parse(msg);
        $("#questionari2").empty();
        var i = 0;
        var str = "<table class=\"mdl-data-table mdl-js-data-table mdl-data-table mdl-shadow--2dp\">";
            str = str + "<th class=\"mdl-data-table__cell--non-numeric\">SELEZIONA</th>";
            str = str + "<th class=\"mdl-data-table__cell--non-numeric\">Titolo</th>";
            str = str + "<th>Id</th>";
            str = str + "<th>Punti</th>";
            str = str + "<th class=\"mdl-data-table__cell--non-numeric\">Struttura</th>";
            str = str + "<th class=\"mdl-data-table__cell--non-numeric\">Grafico</th>";
            str = str + "<th class=\"mdl-data-table__cell--non-numeric\">PDF</thead>";
                for (; i < esercente.length; i++) {
                str = str + "<tr>";
                    if(esercente[i].id_questionario==indice)
                    {
                        str = str + "<td class=\"mdl-data-table__cell--non-numeric\">" +
                            "<a class=\"mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab\">\n" +
                                "  <i class=\"material-icons\">done</i>\n" +
                            "</a></td>";
                        }
                        else
                        {
                            str = str + "<td class=\"mdl-data-table__cell--non-numeric\">" +
                                "<a class=\"mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab croce\">\n" +
                                    "  <i class=\"material-icons\"></i>\n" +
                                "</a></td>";
                            }
                            str = str + "<td class=\"mdl-data-table__cell--non-numeric\">" + esercente[i].nome + "</td>";
                            str = str + "<td>" + esercente[i].id_questionario + "</td>";
                            str = str + "<td>" + esercente[i].punti + "</td>";
                            str = str + "<td class=\"mdl-data-table__cell--non-numeric\">" +
                                "<a href='visualizzaQuestionario.php?id=" + esercente[i].id_questionario + "' class=\"bottone mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab\">\n" +
                                    "  <i class=\"material-icons\">remove_red_eye</i>\n" +
                                "</a></td>";
                                str = str + "<td class=\"mdl-data-table__cell--non-numeric\">" +
                                    "<a href='grafici.php?id=" + esercente[i].id_questionario + "' class=\"bottone mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab\">\n" +
                                        "  <i class=\"material-icons\">timeline</i>\n" +
                                    "</a></td>";
                                    str = str + "<td class=\"mdl-data-table__cell--non-numeric\">" +
                                        /*"<a onclick='screen()' class=\"bottone mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab\">\n" +
                                            "  <i class=\"material-icons\">picture_as_pdf</i>\n" +
                                        "</a></td>";*/

                                        "<a href='pdf/pdf.php?id_questionario=" + esercente[i].id_questionario + "' class=\"bottone mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab\">\n" +
                                            "  <i class=\"material-icons\">picture_as_pdf</i>\n" +
                                        "</a></td>";

                                    str = str + "</tr>";
                                }
                            str = str + "</table>";
                            $("#questionari2").append($.parseHTML(str));
                        }

                        ,
                        error: function () {
                        messaggio("Impossibile contattare la pagina di aggiunta questionario"); //sempre meglio impostare una callback in caso di fallimento
                    }
                })
                ;
            }
            function dialog()
            {
                document.getElementById("myModal").style.display = "block";
            }
            function redirect(str)
            {
                window.location.href = str;
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
function pubblicaQuestionario(id) {
$.ajax({
//imposto il tipo di invio dati (GET O POST)
type: "POST",
//Dove devo inviare i dati recuperati dal form?
url: "../backEnd_json/pubblica_questionario_da_id.php",
//Quali dati devo inviare?
data: "id_questionario=" + id,
dataType: "html",
success: function (msg) {
if (msg == "bravo") {
messaggio("Questionario pubblicato");
setTimeout(function() {location.reload(); }, 1500);
}
else {
messaggio("Errore, impossibile aggiungere il questionario !");
}

},
error: function () {
messaggio("Impossibile contattare la pagina di aggiunta questionario"); //sempre meglio impostare una callback in caso di fallimento
}
});
}
</script>
<?php
function ottieniImmagine($percorso)
{
    $array = explode("/", $percorso);
    return "proxyImage.php?pic=" . $array[3];
}

?>
<br>
<div class="demo-card-wide mdl-card mdl-shadow--2dp">
    <div id="topcard" class="mdl-card__title" style="height: 65px;">
        <h2 class="mdl-card__title-text"><?php echo $esercente['nome']; ?></h2>
        <button id="edit" class="mdl-button mdl-js-button mdl-button--icon"
        onclick="redirect('modificaEsercente.php?id=<?php echo $_GET['id'] ?>')">
        <i class="material-icons">edit</i>
    </button>
</div>
<div class="mdl-card__supporting-text">
    <ul class="demo-list-icon mdl-list">
        <li class="mdl-list__item">
          <span class="mdl-list__item-primary-content">
              <i class="material-icons mdl-list__item-icon">email</i>
              <?php echo $esercente['email']; ?>
          </span>
      </li>
  </ul>
</div>
<div class="mdl-card__title">
    <h2 class="mdl-card__title-text">Punti vendita</h2>
</div>
<div class="mdl-card__supporting-text">
    <?php
    if ($esercente['esercizi'] == null) {
        echo '<div id="noes">Non ci sono punti vendita!</div>';
    } else {
        foreach ($esercente['esercizi'] as $esercizio) {
            echo '<span class="mdl-chip">
            <span class="mdl-chip__text">' . $esercizio . '</span>
            </span><br>';
        }
    }
    ?>
</div>
<div class="mdl-card__title">
    <a class="mdl-button mdl-js-button mdl-js-ripple-effect" style="margin: auto;color:white;"
    href="<?php echo "creaQuestionario_safe.php?id=" . $id . "&mail=" . $esercente['email']; ?>">
    Crea Questionario
</a>
</div>
</div>

<div class="mdl-tooltip" data-mdl-for="edit">
    Modifica esercente
</div>
<div id="demo-snackbar-example" class="mdl-js-snackbar mdl-snackbar">
    <div class="mdl-snackbar__text"></div>
    <button class="mdl-snackbar__action" type="button"></button>
</div>
<div class="demo-card-wide mdl-card mdl-shadow--2dp">
    <div class="mdl-card__title">
        <h2 class="mdl-card__title-text">Lista di questionari</h2>
        <div id="casellaricerca" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input id="cerca" class="mdl-textfield__input" type="text" onkeyup="ricerca()">
            <label id="labcerca" class="mdl-textfield__label" for="cerca">Cerca per titolo</label>
        </div>
    </div>
    <div class="mdl-card__supporting-text">
        <div id="questionari">
        </div>
    </div>
</div>
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
      <div class="demo-card-wide mdl-card mdl-shadow--2dp">
          <div class="mdl-card__title">
              <h2 class="mdl-card__title-text">Lista di questionari</h2>
              <div id="casellaricerca" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input id="cerca2" class="mdl-textfield__input" type="text" onkeyup="ricerca2()">
                  <label id="labcerca2" class="mdl-textfield__label" for="cerca2">Cerca per titolo</label>
              </div>
          </div>
          <div class="mdl-card__supporting-text">
              <div id="questionari2">
              </div>
          </div>
      </div>
  </div>
</div>

<!--Fine visualizzaEsercente-->

<?php
require ('parcials/footer.php');
}
?>
