<!--Inizio header-->

<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="images/ico.png">

  <!-- Material Design Lite -->
  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Material Design icon font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <!-- Chart.js references -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>

  <!-- Link al file CSS -->
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-blue.min.css"/>
  <link rel="stylesheet" type="text/css" href="css/styleClass.css">

  <!-- Link al file JS -->
  <script src="js/classi.js"></script>
  <script src="js/funzioni.js"></script>

  <title><?php echo $nomesito ?></title>
</head>
<body>

<script>

    function ottieniImmagine(percorso) {
        var array = percorso.split("/");
        return "proxyImage?pic=" + array[3];
    }

    $(document).ready(function(){
        if(ottieniImmagine("<?php echo $_SESSION[KEY_POS] ?>") != "proxyImage?pic="){
            document.getElementById("nav-md").className += " topcard";
            var percorso = "<?php echo $_SESSION[KEY_POS] ?>";
            document.getElementById("nav-md").style.backgroundImage = "url('"+ottieniImmagine(percorso)+"')";
            componentHandler.upgradeDom();
        }
    });

</script>

  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
      <div class="mdl-layout__header-row header-style">
        <!-- Assegnazione titolo dinamica -->
        <span class="mdl-layout-title"><?php echo $nomesito ?></span>
        <!-- Add spacer, to align navigation to the right -->
        <div class="mdl-layout-spacer"></div>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" onclick="location.href='/'">
            <button id="bt1" class="mdl-button mdl-js-button mdl-button--icon">
              <i class="material-icons">dashboard</i>
            </button>
            <div class="mdl-tooltip" data-mdl-for="bt1">
              Dashboard
            </div>
          </a>
          <!--creo un campo hidden per comunicare al js il percorso relativo-->
          <input type="hidden" id="url" value="<?php echo BASE_URL ?>">

          <a class="mdl-navigation__link" onclick="logOut()">
            <button id="bt2" class="mdl-button mdl-js-button mdl-button--icon">
              <i class="material-icons">exit_to_app</i>
            </button>
            <div class="mdl-tooltip" data-mdl-for="bt2">
              Logout
            </div>
          </a>
        </nav>
      </div>
    </header>
    <div class="mdl-layout__drawer">
      <div id="nav-md" class="nav-md">
        <span class="mdl-layout-title nome_dr"><?php echo $_SESSION[KEY_NAME] ?></span>
        <span class="mdl-layout-title tipo_dr"><?php
        if(isset($_SESSION[KEY_ROLE]) && $_SESSION[KEY_ROLE] == 1){
          echo "Apertamente";
        }else{
          echo "Esercente";
        } 
        ?></span>
      </div>
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="listaEsercenti"><i class="material-icons md-ip">list</i> Lista
        esercenti</a>
        <a class="mdl-navigation__link" href="aggiungiEsercente"><i class="material-icons md-ip">person_add</i>
        Aggiungi esercente</a>
        <a class="mdl-navigation__link" href="aggiungiBuono"><i class="material-icons md-ip">library_add</i>
        Aggiungi buoni sconto</a>
        <div class="mdl-layout-spacer"></div>
        <a class="mdl-navigation__link" href="segnalaBug"><i class="material-icons md-ip">feedback</i> Feedback</a>
      </nav>
    </div>
    <main class="mdl-layout__content">
      <div class="page-content">

        <!--Fine header-->
