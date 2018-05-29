<?php
function visualizzaPagina(){

    $nomesito = "Non autorizzato!";

    ?>

    <!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Material Design Lite -->
        <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Material Design icon font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <!--Link al file CSS -->
        <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-blue.min.css"/>
        <link rel="stylesheet" type="text/css" href="css/styleClass.css">

        <!--Link al file JS-->
        <script src="js/classi.js"></script>
        <script src="js/funzioni.js"></script>

        <title><?php echo $nomesito ?></title>

    </head>
    <body>
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
            <main class="mdl-layout__content">
                <div class="page-content">

                    <style>
                    #center {
                        position: absolute;
                        margin: auto;
                        text-align: center;
                        height: 227px;
                        right: 0;
                        left: 0;
                        top: 0;
                        bottom: 0;
                    }

                    .mdl-spinner {
                        display: inline-block;
                        position: relative;
                        width: 38px;
                        height: 38px;
                        margin: 16px 0;
                    }

                    .mdl-spinner__circle {
                        border-width: 3.5px;
                    }

                </style>

                <div id="center">
                    <h2>Non autorizzato!</h2>
                    <h4>Non hai abbastanza permessi per visualizzare questa pagina. <br>
                        Verrai reindirizzato automaticamente al login!
                    </h4>
                    <div class="mdl-spinner mdl-spinner--single-color mdl-js-spinner is-active"></div>
                </div>

<?php
    require ('parcials/footer.php');
    echo '
        <script>
            $(document).ready(function(){
                setTimeout(function(){
                    window.open("' . BASE_URL . '/login' . '" , "_self");
                }, 2500);
            });
        </script>';
}
?>
