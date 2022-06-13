<?php
session_start(); 
if (!isset($_SESSION['mail'])) {
	header('location:index.php');
}

if (isset($_GET['modif']) && $_GET['modif'] == 1) {
	header('location:update_compte.php?valid=true');
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>tableau de bord</title>
	<link rel="stylesheet" type="text/css" href="style_tableaubord.css">

</head>
<body>
	<header>
		<div class="en-tete">
			<p><span style="text-transform:uppercase; "> <?php  echo $_SESSION['nom']; ?></span> <?php echo $_SESSION['prenom']; ?> - <?php echo $_SESSION['role']; ?> - <?php echo $_SESSION['age']; ?> ans</p>
			<p><a href="deconnexion.php">deconnexion</a></p>
		</div>
		<div class="navigation">
			<nav>
				<ul>
					<li><a href="tableaubord.php"> Accueil</a></li>
					<li><a href="create.php">Créer un évènement</a> </li>
					<li><a href="compte.php"> mon compte</a></li>
				</ul>
			</nav>
		</div>
	</header>
	<main> <div><p><a class="lien2" href="tableaubord.php"> retour à l'écran d'accueil</a></p></div>
		<section class="contain-info">

			<div>
				<h1 class="titre">Informations personnelles</h1>
			</div>
			<div>
				<p class="box" >Nom : <span class="style-input"><?php  echo $_SESSION['nom']; ?></span></p>
				<p class="box" >Prénom : <span class="style-input"> <?php echo $_SESSION['prenom']; ?></span> </p>
				<p class="box" >Rôle dans l'entreprise : <span class="style-input"> <?php echo $_SESSION['role']; ?></span></p>
				<p class="box" >Date de naissance : <span class="style-input"> <?php echo $_SESSION['date_naissance']; ?> (<?php echo $_SESSION['age']; ?>ans)</span></p>
			</div>
			<div class="box-button">
				<form action="#" method="GET"><button name="modif" value="1" >Modifier</button></form>
				
			</div>
		</section>
	</main>
	<footer></footer>

</body>
</html>