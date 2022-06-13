<?php

require_once("relation.php");

	


$query = $db->query("SELECT * FROM evenement");
$evenements = $query->fetchAll();



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
		<a class="retour" href="index.php">< retour à l'écran d'accueil</a>
		<div class="flex">
		
			<?php  foreach($evenements as $evenement){  ?>
				<div class="container">	
		
					<a href="readindex.php?id=<?php echo $evenement['id']; ?>">
						<div class="contain-box"><img src="img/<?php echo $evenement['image']; ?>">
							<div class="box-hover">
								<p class="hover"><?php echo $evenement['participant']; ?></p>
							</div>
						</div>
					</a>
		
				</div>
			<?php } ?>
		</div>
	</main>

	<footer>
		<p>Contact</p>
		<li>rawevent@mail.com </li>
		<li>tel : 0606060606 </li> 

		 

	</footer>

</body>
</html>