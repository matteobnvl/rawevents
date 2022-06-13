<?php 
	
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
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="shortcut icon" href="img/R.png" type="image/x-icon">
	<title>RawEvents</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Knewave&display=swap" rel="stylesheet">

</head>
<body>
	<header>
		<div class="contain-header">
			<div class="lien">
				<p><a href="connexion.php">connexion compte pro</a></p>
			</div>
			<div class="name">
                <a href="index.php"><img src="img/logo.jpg"></a>
            </div>
			
		</div>
	</header>

	<main>
		<section class="contain-lecture">
			<p><a class="retour" href="voirevenement.php">< retour</a></p>
			<h2><span style="text-transform:uppercase;">é</span>vènement de <?php echo $evenement['participant']; ?></h2>
			<div class="lecture" >

				<div class="box-map">
					<p>Nous sommes fière d'avoir pu organiser l'évènement du groupe <?php echo $evenement['participant']; ?>. Lors de cet évènement,nous aurons l'honneur d'accueillir l'artiste <?php  echo $evenement['artiste']; ?> qui aura pour mission d'ambiancer cet évènement. <br><br>Les participants auront la chance d'être accuillit au restaurant <?php  echo $evenement['restaurateur']; ?> qui leur préparons leur meilleur repas.<br> Tous ceci se déroulera au  <?php  echo $evenement['num_rue']; ?> <?php  echo $evenement['nom_rue']; ?>, <?php  echo $evenement['code_postal']; ?> <?php  echo $evenement['ville']; ?>  </p>
					</div>
				<div class="box-map" id="map"></div>
				<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJNDe0zzsPci7D2cBW1q2PIhb544lg__A&callback=initMap&libraries=&v=weekly" async ></script>
			</div>
			


		</section>
	</main>

	<footer>
		<p>Contact</p>
		<li>rawevent@mail.com </li>
		<li>tel : 0606060606 </li> 

		

	</footer>

</body>
</html>

<script>
// Initialize and add the map
function initMap() {
  // The location of coord
  const coord = { lat: <?php echo $evenement['lat'];?>, lng: <?php echo $evenement['lng']; ?> };
  // The map, centered at coord
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 14,
    center: coord,
  });
  // The marker, positioned at coord
  const marker = new google.maps.Marker({
    position: coord,
    map: map,
  });
 }
</script>