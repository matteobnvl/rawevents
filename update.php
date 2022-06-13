<?php 

session_start(); 
if (!isset($_SESSION['mail'])) {
	header('location:index.php');
}

require_once("relation.php");

$query = $db->prepare("SELECT * FROM evenement WHERE id = :id");
$query->execute(["id" => $_GET["id"]]);
$evenements = $query->fetchAll();
$evenement = $evenements[0];
$query->closeCursor();


if(!empty($_POST)){

		$query2 = $db->prepare("UPDATE evenement SET participant = :participant, artiste = :artiste, num_rue = :num_rue, nom_rue = :nom_rue, code_postal = :code_postal, ville = :ville, restaurateur = :restaurateur, date = :date, lat = :lat, lng = :lng, image = :image WHERE id = :id");
		$query2->execute([

				'participant' => $_POST['participant'],
				'artiste' => $_POST['artiste'],
				'num_rue' => $_POST['num_rue'],
				'nom_rue' => $_POST['nom_rue'],
				'code_postal' => $_POST['code_postal'],
				'ville' => $_POST['ville'],
				'restaurateur' => $_POST['resto'],
				'date' => $_POST['date'],
				'lat' => $_POST['lat'],
				'lng' => $_POST['long'],
				'image' => $_POST['image'],
				'id' => $evenement['id']
			]);
		header("refresh:0");
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
					<li><a href="tableaubord.php">Accueil</a></li>
					<li><a href="create.php">Créer un évènement</a> </li>
					<li><a href="compte.php"> mon compte</a></li>
				</ul>
			</nav>
		</div>
	</header>
	<main> 

		<section class="contain-form">
			<p><a class="lien2" href="tableaubord.php"> retour à l'écran d'accueil</a></p>
			<form  action="#" method="POST">
			<div class="formulaire">
					

				<div class="information">
					<div class="box-info">
						<label for="name">Nom du participant <span style="color: red;">*</span></label>
						<input autocomplete="off" type="text" name="participant" id="name" value="<?php echo $evenement['participant']; ?> ">
					</div>

					<div class="box-info">
						<label for="Artiste">Artiste de l'évènement <span style="color: red;">*</span></label>
						<input autocomplete="off" type="text" name="artiste" id="Artiste" value="<?php echo $evenement['artiste'];?>">
					</div>
					<div class="box-info">
						<label id="resto">Restaurateurs de l'évènements <span style="color: red;">*</span></label>
						<input autocomplete="off" type="text" name="resto" id="resto" value="<?php  echo $evenement['restaurateur']; ?>">
					</div>
					<div class="box-info">
						<label id="date">date de l'évènements <span style="color: red;">*</span></label>
						<input autocomplete="off" type="date" name="date" id="date" value="<?php echo $evenement['date']; ?>">
					</div>
					<div class="box-info">
						<label for="img">Nom image(ne pas oublier de mettre l'image dans le dossier dédié) <span style="color: red;">*</span></label>
						<input autocomplete="off" type="text" name="image" placeholder="NomImage.format" id="img" value="<?php echo $evenement['image']; ?>">
					</div>
					

				</div>


				<div class="adresse" >
					<div class="box-adresse">
						<label for="num">Numéro du Rue </label>
						<input autocomplete="off" type="number" name="num_rue" id="num" value="<?php echo $evenement['num_rue'];?>">
					</div>

					<div class="box-adresse">
						<label  for="nom">Nom de rue <span style="color: red;">*</span></label>
						<input autocomplete="off" type="text" name="nom_rue" id="nom" value="<?php echo $evenement['nom_rue']; ?>">
					</div>

					<div class="box-adresse">
						<label for="code">Code de postal <span style="color: red;">*</span></label>
						<input autocomplete="off" type="text" name="code_postal" id="code" value="<?php echo $evenement['code_postal']; ?>">
					</div>

					<div class="box-adresse">
						<label for="ville">Ville <span style="color: red;">*</span></label>
						<input autocomplete="off" type="text" name="ville" id="ville" value="<?php echo $evenement['ville']; ?>">
					</div>

					<div class="box-adresse">
						<label for="long">Longitude <span style="color: red;">*</span></label>
						<input autocomplete="off" type="number" step="any" name="long" id="long" value="<?php echo $evenement['lng']; ?>">
					</div>

					<div class="box-adresse">
						<label for="lat">Latitude <span style="color: red;">*</span></label>
						<input autocomplete="off" type="number" step="any" name="lat" id="lat" value="<?php  echo $evenement['lat']; ?>">
					</div>
					
				</div>
				</div>
				<div>
					<button name="send" value="1">Valider</button>
				</div>

			</form>
		</section>

	</main>
	<footer></footer>

</body>
</html>