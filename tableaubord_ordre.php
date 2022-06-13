<?php
session_start(); 
if (!isset($_SESSION['mail'])) {
	header('location:index.php');
}


require_once("relation.php");


	
$query = $db->query("SELECT * FROM evenement ORDER BY date");
$evenements = $query->fetchAll();



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
			<section class="container">
				<div class="box-ordre">
					<a href="tableaubord.php"> ranger par date la plus proche</a>
				</div>
			
			<?php  foreach($evenements as $evenement){  ?>
				
    			<div class="contain-box">
						<div class="box-velo">
							<div class="box-read2"><a href="read.php?id=<?php echo $evenement['id'];  ?>"><img src="img/<?php echo $evenement['image']; ?>"></a>
							</div>
							<div class="box-read">
								<div><h1><?php echo $evenement['participant']; ?></h1></div>
								<div><p class="date"><?php echo$evenement['date'] ?></p></div>
								<div class="box-a">
									<a class="lien" href="read.php?id=<?php echo $evenement['id'];  ?>">Voir</a>
									<a class="lien" href="update.php?id=<?php echo $evenement['id'];  ?>">Modifier</a>
									<a class="lien" href="delete.php?id=<?php echo $evenement['id'];  ?>">Supprimer</a>
								</div>
								
							</div>

							
							
						</div>
				</div>
				
				
			<?php } ?>

			
		</section>
	</main>
	<footer></footer>

</body>



</html>