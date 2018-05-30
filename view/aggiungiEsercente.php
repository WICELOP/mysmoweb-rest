<?php
function visualizzaPagina(){

$nomesito = "Aggiungi un nuovo esercente";

    require ('parcials/header.php');
?>

<!--Inizio aggiungiEsercente-->

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

    /*modifico le classi dello spinner*/
    .mdl-spinner {
        display: inline-block;
        position: relative;
        margin: 14px 0;
    }

    .mdl-spinner--single-color .mdl-spinner__layer-1 {
        border-color: rgb(255, 255, 255);
    }

    .mdl-spinner--single-color .mdl-spinner__layer-2 {
        border-color: rgb(255, 255, 255);
    }

    .mdl-spinner--single-color .mdl-spinner__layer-3 {
        border-color: rgb(255, 255, 255);
    }

    .mdl-spinner--single-color .mdl-spinner__layer-4 {
        border-color: rgb(255, 255, 255);
    }

    #demo-snackbar-example{
        margin-bottom: 14px;
    }

</style>

<script type="text/javascript" src="js/aggEsScript.js"></script>

<div class="demo-card-wide mdl-card mdl-shadow--2dp">

    <div id="topcard" class="mdl-card__title" style="height: 200px;">
        <h2 class="mdl-card__title-text" style="width: 100%;">
            <div id="nomees" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input id="nome" class="mdl-textfield__input" type="text">
                <label id="labnome" class="mdl-textfield__label" for="nome">Nome Azienda</label>
            </div>
        </h2>
    </div>
    <div class="mdl-card__supporting-text">

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="email" id="email">
            <label class="mdl-textfield__label" for="email">Email</label>
        </div>

        <input type="file" id="file" onchange="uploadImg()" accept=".jpg, .jpeg, .png, .gif" style="display: none;">
        <label for="file" id="uploadfile"
               class="pr mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons" id="icona_upload">file_upload</i>
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
            <li class="mdl-list__item ftm">
                <span class="mdl-list__item-primary-content spc">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="puntovendita0">
                        <label class="mdl-textfield__label" for="puntovendita0">Nuovo punto vendita...</label>
                    </div>
                </span>
                <a class="mdl-list__item-secondary-action mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect"
                   onclick="cancellaOpzione(this)">
                    <i class="material-icons gr">delete</i>
                </a>
            </li>
        </ul>
        <button id="addopt" class="pr mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored"
                onclick="aggiungiOpzione(this)">
            <i class="material-icons">add</i>
        </button>
        <div class="mdl-tooltip" for="addopt">
            Aggiungi punto vendita
        </div>
    </div>
    <div class="mdl-card__title">
        <button id="demo-show-toast" class="mdl-button mdl-js-button mdl-js-ripple-effect" style="margin: auto;"
                onclick="aggiungiEsercente()">
            aggiungi esercente
        </button>
    </div>
</div>
<div id="demo-snackbar-example" class="mdl-js-snackbar mdl-snackbar">
    <div class="mdl-snackbar__text"></div>
    <button class="mdl-snackbar__action" type="button"></button>
</div>

<!--Fine aggiungiEsercente-->

<?php
require ('parcials/footer.php');
}
?>
