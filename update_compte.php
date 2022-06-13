<?php
session_start(); 
if (!isset($_SESSION['mail'])) {
	header('location:index.php');
}


if (!isset($_GET['valid'])) {
	header('location:compte.php');
}

$message_error = "";

require_once("relation.php");

$query = $db->prepare("SELECT * FROM connexion WHERE id = :id");
$query->execute(["id" => $_SESSION["id"]]);
$connexions = $query->fetchAll();
$connexion = $connexions[0];
$query->closeCursor();

if(!empty($_POST)){
	if ($_POST['password'] == $_POST['password2']) {
		$query2 = $db->prepare("UPDATE connexion SET nom = :nom, prenom = :prenom, role = :role, date_naissance =:date, mail = :mail, password = :password  WHERE id = :id");
		$query2->execute([

				'nom' => $_POST['nom'],
				'prenom' => $_POST['prenom'],
				'role' => $_POST['role'],
				'date' => $_POST['date'],
				'mail' => $_POST['mail'],
				'password'=> md5($_POST['password']),
				'id' => $_SESSION['id']
			]);
		$date = new DateTime();
		$date = $date->format('Y-m-d');
		$age = $date - $_POST['date'];
		$_SESSION['mail'] = $_POST['mail'];
		$_SESSION['nom'] = $_POST['nom'];
		$_SESSION['prenom'] = $_POST['prenom'];
		$_SESSION['role'] = $_POST['role'];
		$_SESSION['age'] = $age;
		$_SESSION['date_naissance'] = $_POST['date'];
		
		header('location:compte.php');
	}
	else{
		$message_error = "Les mots de passe sont différents";
	}
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
	<main>
		<section class="contain-form">
			<form action="#" method="POST">
				<div class="formulaire">
				<div class="information">
					<div class="box-info">
						<label for="name">Nom</label>
						<input autocomplete="off" type="text" name="nom" id="name" value="<?php  echo $connexion['nom']; ?> ">
					</div>

					<div class="box-info">
						<label for="prenom">Prénom </label>
						<input autocomplete="off" type="text" name="prenom" id="prenom" value="<?php  echo $connexion['prenom']; ?>">
					</div>
					<div class="box-info">
						<label for="mdp">Nouveau mot de passe</label>
						<input type="password" name="password" id="mdp" autocomplete="off">
					</div>
					<div class="box-info">
						<label for="mdp2">Répéter nouveau mot de passe</label>
						<input type="password" name="password2" id="mdp2" autocomplete="off">
					</div>
					<p><?php echo $message_error  ?></p>

				</div>

				<div class="adresse">
					<div class="box-adresse">
						<label for="role">Role</label>
						<input autocomplete="off" type="text" name="role" id="role" value="<?php  echo $connexion['role']; ?> ">
					</div>

					<div class="box-adresse">
						<label for="date">Date de naissance </label>
						<input autocomplete="off" type="date" name="date" id="date" value="<?php  echo $connexion['date_naissance']; ?>">
					</div>
					<div class="box-adresse">
						<label for="mail">Email </label>
						<input autocomplete="off" type="text" name="mail" id="mail" value="<?php  echo $connexion['mail']; ?>">
					</div>
				</div>
				
			</div>
			<div>
					<button>Modifier</button>
				</div>
			</form>
			
		</section>
	</main>
	<footer></footer>

</body>
</html>