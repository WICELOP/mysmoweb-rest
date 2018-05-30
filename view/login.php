<?php
function visualizzaPagina($alert){

	$nomesito = "Login MySmartOpinion";

	handleAlerts($alert);

	// Se l'utente è già loggato, fa il redirect sulla homepage
	if (isset($_SESSION[KEY_LOGGED_IN])) {
		echo '<script type="text/javascript"> window.open("'.BASE_URL.'" , "_self");</script>';
	}

	?>

	<!--Inizio login-->

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

		<script>
			$(document).ready(function () {
				$("#alertbox").slideDown();
			});
		</script>

		<title><?php echo $nomesito ?></title>

	</head>
	<body>
		<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
			<main class="mdl-layout__content">
				<div class="page-content">

					<style>

					.demo-card-wide.mdl-card {
						width: 512px;
						height: 370px;
						margin: auto;
						position: absolute;
						top: 0;
						right: 0;
						bottom: 0;
						left: 0;
					}

					.demo-card-wide > .mdl-card__title, form .mdl-card__title {
						color: #fff;
						background-color: rgb(63, 81, 181);
					}

					.mdl-button.mdl-button--colored {
						color: white;
						margin: auto;
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

					.menu-login {
						margin: 0 0 auto auto;
					}

					a {
						color: rgba(0, 0, 0, 0);
						font-weight: 500;
						width: 100%;
					}

				</style>

				<div class="demo-card-wide mdl-card mdl-shadow--2dp">

					<div class="mdl-card__title" style="height: 120px;">
						<h2 class="mdl-card__title-text">Login MySmartOpinion</h2>
				</div>
				<form action="login" method="post" style="margin-bottom: 0px;">
					<div class="mdl-card__supporting-text" style="height: 150px">

						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							<input class="mdl-textfield__input" type="email" id="nome"
							name="<?php echo KEY_LOGIN_USERNAME ?>">
							<label class="mdl-textfield__label" for="nome">Username</label>
						</div>

						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
							<input class="mdl-textfield__input" type="password" id="pass"
							name="<?php echo KEY_LOGIN_PASSWORD ?>">
							<label class="mdl-textfield__label" for="pass">Password</label>
						</div>

					</div>

					<div class="mdl-card__title">
						<input class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="logsubmit"
						type="submit" name="<?php echo KEY_LOGIN_SUBMIT ?>" value="Sign In">
					</div>
				</form>


			</div>

			<!--Fine login-->

			<?php
			require ('parcials/footer.php');
		}
		?>