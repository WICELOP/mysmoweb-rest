<?php
function visualizzaPagina($dbc){

    ob_start();
    require ('../model/backEnd_json/ottieni_esercente_da_id.php');
    $output = ob_get_clean();
    $esercente = json_decode($output, true);

    $nomesito = "Visualizza " . $esercente['nome'];

    require ('parcials/header.php');
    ?>

    <!--Inizio visualizzaEsercente-->

    <!-- <script type="text/javascript" src="js/html2canvas.min.js"></script> -->

    <style>

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
        padding: 4px 0;
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

    #edit{
        align-self: flex-end;
    }

    .mdl-chip__text{
        font-size: 16px;
    }

</style>

<script>

    function ottieniImmagine(percorso) {
        var array = percorso.split("/");
        return "proxyImage?pic=" + array[3];
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

    <div id="topcard" class="mdl-card__title" style="height: 200px;">
        <h2 class="mdl-card__title-text"><?php echo $esercente['nome']; ?></h2>
        <button id="edit" class="mdl-button mdl-js-button mdl-button--icon"
        onclick="window.location.href='modificaEsercente?id=<?php echo $_GET['id'] ?>'">
        <i class="material-icons">edit</i>
    </div>

    <div class="mdl-card__supporting-text">
        <ul class="demo-list-icon mdl-list">
            <li class="mdl-list__item">
              <span class="mdl-list__item-primary-content" style="font-size: 18px;">
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
    href="<?php echo "creaQuestionario?id=" . $_GET['id'] . "&mail=" . $esercente['email']; ?>">
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

<!-- <div class="demo-card-wide mdl-card mdl-shadow--2dp">
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
</div> -->
<!-- <div id="myModal" class="modal">

  Modal content
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
</div> -->

<!--Fine visualizzaEsercente-->

<?php
require ('parcials/footer.php');
}
?>
