<?php 

session_start(); 
if (!isset($_SESSION['mail'])) {
	header('location:index.php');
}


require_once("relation.php");

$error_message = "";
$message_enregistré = "";
if (isset($_GET['error']) && $_GET['error'] == true) {
	$error_message = "Tout les champs ne sont pas remplis";
}


if (isset($_POST['send']) && $_POST['send'] == 1) {
	
	if ($_POST['participant'] == "" ||
		$_POST['artiste'] == "" ||
		$_POST['nom_rue'] == "" ||
		$_POST['code_postal'] == "" ||
		$_POST['ville'] == "" ||
		$_POST['resto'] == "" ||
		$_POST['date'] == "" ||
		$_POST['long'] == "" ||
		$_POST['lat'] == "" ||
		$_POST['image'] == "" ){

			$participant = $_POST['participant'];
			$artiste = $_POST['artiste'];
			$nom_rue = $_POST['nom_rue'];
			$code_postal = $_POST['code_postal'];
			$ville = $_POST['ville'];
			$resto = $_POST['resto'];
			$date = $_POST['date'];
			$lat = $_POST['lat'];
			$long = $_POST['long'];
			$image = $_POST['image'];
			header("location:create.php?error=true&participant=$participant&artiste=$artiste&nom_rue=$nom_rue&code_postal=$code_postal&ville=$ville&resto=$resto&date=$date&lat=$lat&long=$long&image=$image");

	}else{

		if(!empty($_POST)){

			$query = $db->prepare("INSERT INTO evenement (participant,artiste,num_rue,nom_rue,code_postal,ville,restaurateur,date,lat,lng,image) VALUES (:participant,:artiste,:num_rue,:nom_rue,:code_postal,:ville,:restaurateur,:date,:lat,:lng,:image)");

			$query->execute([

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
				'image' => $_POST['image']
			]);
			$message_enregistré = "L'évènement a bien été enregistré";
			header("location:create.php?titre=$message_enregistré");

		}
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
			<center><p style="color:white;">
				<?php  echo $message_enregistré; ?>
			</p></center>
			<form  action="#" method="POST">
				<h2>Créer l'évènement</h2>
				<p>* Tous ces champs sont obligatoires</p>


				<div class="formulaire">
					

				<div class="information">
					<div class="box-info">
						<label for="name">Nom du participant <span style="color: red;">*</span></label>
						<input autocomplete="off" type="text" name="participant" id="name" value="<?php  if(isset($_GET['participant'])){echo $_GET['participant'];} ?> ">
					</div>

					<div class="box-info">
						<label for="Artiste">Artiste de l'évènement <span style="color: red;">*</span></label>
						<input autocomplete="off" type="text" name="artiste" id="Artiste" <?php  if(isset($_GET['artiste'])){echo $_GET['artiste'];} ?>>
					</div>
					<div class="box-info">
						<label id="resto">Restaurateurs de l'évènements <span style="color: red;">*</span></label>
						<input autocomplete="off" type="text" name="resto" id="resto" <?php  if(isset($_GET['resto'])){echo $_GET['resto'];} ?>>
					</div>
					<div class="box-info">
						<label id="date">date de l'évènements <span style="color: red;">*</span></label>
						<input autocomplete="off" type="date" name="date" id="date" <?php  if(isset($_GET['date'])){echo $_GET['date'];} ?>>
					</div>
					<div class="box-info">
						<label for="img">Nom image(ne pas oublier de mettre l'image dans le dossier dédié) <span style="color: red;">*</span></label>
						<input autocomplete="off" type="text" name="image" placeholder="NomImage.format" id="img" value="<?php  if(isset($_GET['image'])){echo $_GET['image'];} ?>">
					</div>
					

				</div>


				<div class="adresse" >
					<div class="box-adresse">
						<label for="num">Numéro du Rue </label>
						<input autocomplete="off" type="number" name="num_rue" id="num">
					</div>

					<div class="box-adresse">
						<label  for="nom">Nom de rue <span style="color: red;">*</span></label>
						<input autocomplete="off" type="text" name="nom_rue" id="nom" <?php  if(isset($_GET['nom_rue'])){echo $_GET['nom_rue'];} ?>>
					</div>

					<div class="box-adresse">
						<label for="code">Code de postal <span style="color: red;">*</span></label>
						<input autocomplete="off" type="text" name="code_postal" id="code" <?php  if(isset($_GET['code_postal'])){echo $_GET['code_postal'];} ?>>
					</div>

					<div class="box-adresse">
						<label for="ville">Ville <span style="color: red;">*</span></label>
						<input autocomplete="off" type="text" name="ville" id="ville" <?php  if(isset($_GET['ville'])){echo $_GET['ville'];} ?>>
					</div>

					<div class="box-adresse">
						<label for="long">Longitude <span style="color: red;">*</span></label>
						<input autocomplete="off" type="number" step="any" name="long" id="long" value="<?php  if(isset($_GET['long'])){echo $_GET['long'];} ?>">
					</div>

					<div class="box-adresse">
						<label for="lat">Latitude <span style="color: red;">*</span></label>
						<input autocomplete="off" type="number" step="any" name="lat" id="lat" value="<?php  if(isset($_GET['lat'])){echo $_GET['lat'];} ?>">
					</div>
					
				</div>
				</div>
				<div>
					<p><?php echo $error_message; ?></p>
					<button name="send" value="1">Valider</button>
				</div>

			</form>
		</section>

	</main>
	<footer></footer>

</body>
</html>