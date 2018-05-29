<?php
/**
 * Created by IntelliJ IDEA.
 * User: valemochuz
 * Date: 17/05/18
 * Time: 20.58
 */

function visualizzaPagina(){

    $nomesito = "Segnala problema";

    require ('parcials/header.php');
?>

<!--Inizio segnalaBug-->

<style>

    .demo-card-wide.mdl-card {
        width: 650px;
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

    .text-form {
        margin: 12px 0;
        font-size: 20px;
    }

    .mdl-textfield__label {
        color: rgba(0, 0, 0, .54);
        font-size: 18px;
    }

    .mdl-textfield__input {
        font-size: 18px;
    }

</style>

<script>
    $(document).ready(function () {
        $("#submitreport").click(function () {
            /*var txtFile = "var/www/html/mysmoweb/docs/BugReport.txt";
            var file = new File(txtFile);
            file.open("w"); // open file with write access
            var day = new Date();
            day.toDateString();
            file.writeln("Email: ");
            file.writeln("Data: " + day);
            file.writeln("Pagina: " + $("#octane").val());
            file.writeln("Report: " + $("#report").val());
            file.close();*/
            alert("Segnalazione inviata!")
        });
    });
</script>

<div class="demo-card-wide mdl-card mdl-shadow--2dp">
    <div class="mdl-card__title" style="height: 150px;">
        <h2 class="mdl-card__title-text">Segnala bug</h2>
    </div>

    <div class="mdl-card__supporting-text">
        <div class="text-form">Compila il seguente modulo per la segnalazione dei problemi:</div>
        <div style="display: flex;">
            <div class="text-form" style="font-size: 18px; width: 50%; margin: auto;">In che pagina hai riscontrato il
                bug?
            </div>
            <div class="mdl-textfield mdl-js-textfield" style="width: 50%;">
                <select class="mdl-textfield__input" id="octane" name="pagine">
                    <option>login</option>
                    <option>dashboardApertamente</option>
                    <option>aggiungiEsercente</option>
                    <option>modificaEsercente</option>
                    <option>creaQuestionario</option>
                    <option>graficiQuestionario</option>
                    <option>visualizzaQuestionario</option>
                    <option>listaEsercenti</option>
                    <option>visualizzaEsercente</option>
                </select>
                <label class="mdl-textfield__label" for="octane"></label>
            </div>
        </div>
        <form action="#">
            <div class="mdl-textfield mdl-js-textfield" style="padding-top: 0;">
                <textarea class="mdl-textfield__input" type="text" rows="3" maxlength="300" id="report"></textarea>
                <label class="mdl-textfield__label" for="report" style="top: 8px;">Descrivi il problema... </label>
            </div>
        </form>
    </div>

    <div class="mdl-card__title">
        <a class="mdl-button mdl-js-button mdl-js-ripple-effect" id="submitreport" style="margin: auto;">
            Invia segnalazione
        </a>
    </div>

</div>

<!--Fine segnalaBug-->

<?php
require ('parcials/footer.php');
}
?>
