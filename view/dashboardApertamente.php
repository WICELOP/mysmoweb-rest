<?php
function visualizzaPagina($dbc){

    $nomesito = "Apertamente Dashboard";

    require ('parcials/header.php');
    ?>

    <!--Inizio dashboardApertamente-->

    <style>

    .demo-card-wide > .mdl-card__title {
        color: #fff;
        background-color: rgb(63, 81, 181);
    }

    .card-dashboard{
        height: 150px;
    }

    .demo-card-wide.mdl-card {
        width: 512px;
        margin: auto 5%;
        margin-top: 0;
    }

    .dashboard {
        display: flex;
        margin: 10% auto;
        justify-content: center;
    }

    .demo-list-two {
        width: auto;
        margin: 0;
        padding: 0;
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

    .mdl-list__item-avatar, .mdl-list__item-avatar.material-icons {
        height: 40px;
        width: 40px;
        box-sizing: border-box;
        border-radius: 0;
        background-color: transparent;
        font-size: 40px;
        color: grey;
    }

    .mdl-card__supporting-text {
        color: rgba(0, 0, 0, .54);
        font-size: 1rem;
        line-height: 18px;
        overflow: hidden;
        padding: 16px 0;
        width: auto;
    }

    .mdl-list__item {
        font-family: "Roboto", "Helvetica", "Arial", sans-serif;
        font-size: 16px;
        font-weight: 400;
        letter-spacing: .04em;
        line-height: 1;
        min-height: 48px;
        -webkit-flex-direction: row;
        -ms-flex-direction: row;
        flex-direction: row;
        -webkit-flex-wrap: nowrap;
        -ms-flex-wrap: nowrap;
        flex-wrap: nowrap;
        padding: 16px 32px;
        cursor: default;
        color: rgba(0, 0, 0, .87);
        overflow: hidden;
    }

    li.questlist:hover {
        background-color: rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }

    .emptylist{
        margin: 16px;
        font-size: large;
    }

</style>

<div class="dashboard">

    <!--Card per grafici sommativi-->
    <div class="demo-card-wide mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title card-dashboard">
            <h2 class="mdl-card__title-text">Grafici sommativi</h2>
        </div>
        <div class="mdl-card__supporting-text" style="padding: 12px;">

            <canvas id="myChart" width="400" height="400"></canvas>
            <script>
                var ctx = document.getElementById("myChart").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ["Lunedì", "Martedì", "Mercoledì", "Giovedì", "Venerdì", "Sabato", "Domenica"],
                        datasets: [{
                            label: 'questionari per giorno',
                            data: [9, 7, 11, 3, 5, 2, 3],
                            backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(190, 159, 64, 0.2)'
                            ],
                            borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(190, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>

        </div>

    </div>

    <!--Card per ultimi questionari (ordinati per data creazione)-->
    <div class="demo-card-wide mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title card-dashboard">
            <h2 class="mdl-card__title-text">Ultimi questionari creati</h2>
        </div>
        
        <div class="mdl-card__supporting-text">

            <ul class="demo-list-two mdl-list">

                <?php

                ob_start();
                require ('../model/backEnd_json/ottieni_questionari_dashboard.php');
                $output = ob_get_clean();
                $esercenti = json_decode($output, true);
                if ($esercenti == null) {
                    echo '<div class="emptylist">Lista vuota!</div>';
                } else {
                    foreach ($esercenti as $esercente) {
                        echo '<li class="mdl-list__item mdl-list__item--two-line questlist"
                        onclick="location.href = \'grafici.php?id=' . $esercente['id_questionario'] . '\'">
                        <span class="mdl-list__item-primary-content">
                        <i class="material-icons mdl-list__item-avatar">assignment</i>
                        <span>' . $esercente['nome'] . '</span>
                        <span class="mdl-list__item-sub-title">' . $esercente['esercente'] . '</span>
                        </span>
                        <span class="mdl-list__item-secondary-content">
                        <div class="mdl-list__item-secondary-action"><i class="material-icons gr">keyboard_arrow_right</i></div>
                        </span>
                        </li>';
                    }

                }

                ?>

            </ul>

        </div>

        <div class="mdl-card__title">
            <a class="mdl-button mdl-js-button mdl-js-ripple-effect" href="listaEsercenti"
            style="margin: auto;">
            Vai a lista esercenti
        </a>
    </div>

</div>

</div>

<!--Fine dashboardApertamente-->

<?php
require ('parcials/footer.php');
}
?>
