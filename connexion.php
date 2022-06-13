<?php 
$error_message = "";
if (isset($_GET['error']) && $_GET['error'] == true) {
    $error_message = "Vos identifiants ne sont pas correct Veuillez réssayer";
}



?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="shortcut icon" href="img/R.png" type="image/x-icon">
    <title>connexion</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Knewave&display=swap" rel="stylesheet">

</head>

<body>
    <header>
        <div class="contain-header">
            <div class="name">
                <a href="index.php"><img src="img/logo.jpg"></a>
            </div>
            
        </div>
    </header>
    <main>
        <p><a class="retour" href="index.php"> < retour </a></p>
        <section class="container-form">
            <h2 class="titre-connexion">Connexion</h2>
            <form class="box-form" action="treatment.php" method="POST">

                
                <div>
                    <label form="mail"> adresse mail</label>
                </div>
                <div>
                    <input  type="mail" name="mail" id="mail" placeholder="votre mail" autocomplete="off">
                </div>
                
                <div>
                    <label for="password">Mot de passe</label>
                </div>
                <div>
                    <input type="password" name="password" id="password" placeholder=" votre mot de passe">
                </div>
                <div>
                    <p class="error"><?php echo $error_message;?></p>
                </div>
                 

                <button type="submit">Connexion</button>

     </form>            
        </section>
    </main>



</body>

</html>



    