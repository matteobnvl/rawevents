<?php 
	session_start();
	if (!isset($_SESSION['mail'])) {
		header('location:index.php');
	}

	require_once("relation.php");

	if(!isset($_GET["id"])){
		header("Location:tableaubord.php");
	}

	$query = $db->prepare("SELECT * FROM evenement WHERE id = :id");
	$query->execute(["id" => $_GET["id"]]);


	$evenements = $query->fetchAll();
	$evenement = $evenements[0];
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
					<li><a  href="tableaubord.php">Accueil</a></li>
					<li><a href="create.php">Créer un évènement</a> </li>
					<li><a href="compte.php"> mon compte</a></li>
				</ul>
			</nav>
		</div>
	</header>
	<main> 
		<section class="container">
			<p><a class="lien" href="tableaubord.php"> retour à l'écran d'accueil</a></p><br>
			<div class="contain-box">
				<h2><span style="text-transform:uppercase;">é</span>vènement de <?php echo $evenement['participant']; ?></h2>
			</div>
			<div class="contain-map">
				<div class="box-map">
					<p class="box" >Artiste : <span class="style-input"><?php  echo $evenement['artiste']; ?></span></p>
					<p class="box" >Numéro de rue : <span class="style-input"><?php  echo $evenement['num_rue']; ?></span></p>
					<p class="box" >Nom de la rue : <span class="style-input"><?php  echo $evenement['nom_rue']; ?></span></p>
					<p class="box" >Code postal : <span class="style-input"><?php  echo $evenement['code_postal']; ?></span></p>
					<p class="box" >Ville : <span class="style-input"><?php  echo $evenement['ville']; ?></span></p>
					<p class="box" >Restaurateur : <span class="style-input"><?php  echo $evenement['restaurateur']; ?></span></p>
				</div>

				<div class="box-map" id="map"></div>
				<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJNDe0zzsPci7D2cBW1q2PIhb544lg__A&callback=initMap&libraries=&v=weekly" async ></script>
			</div>
			<div class="box-a-map">
				<a class="lien" href="update.php?id=<?php echo $evenement['id'];  ?>">Modifier</a>
				<a class="lien" href="delete.php?id=<?php echo $evenement['id'];  ?>">Supprimer</a>
			</div>
			


		</section>
	</main>
	<footer></footer>

</body>



</html>
<script>
// Initialize and add the map
function initMap() {
  // The location of Uluru
  const uluru = { lat: <?php echo $evenement['lat'];?>, lng: <?php echo $evenement['lng']; ?> };
  // The map, centered at Uluru
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 14,
    center: uluru,
  });
  // The marker, positioned at Uluru
  const marker = new google.maps.Marker({
    position: uluru,
    map: map,
  });
 }
</script>


							