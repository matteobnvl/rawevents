<?php

session_start();


include('relation.php');
$validation = false;


if ($_POST['mail'] != "" and $_POST['password'] != "") {
	$query = $db->query("SELECT * FROM connexion");
	$users = $query->fetchAll();

	foreach ($users as $user) {
		if ($_POST['mail'] == $user['mail'] && md5($_POST['password']) == $user['password'] ) {
			$validation = true;
			
		}
	}
	echo $_POST['mail'];
	$req = $db->prepare("SELECT * FROM connexion WHERE mail = :mail");
	$req->execute(["mail" => $_POST['mail']]);

	$user1 = $req->fetchAll();
	$user2 = $user1[0];

	$date = new DateTime();
	$date = $date->format('Y-m-d');

	$age = $date - $user2['date_naissance'];



	if ($validation == true) {
		$_SESSION['id'] = $user2['id'];
		$_SESSION['mail'] = $_POST['mail'];
		$_SESSION['nom'] = $user2['nom'];
		$_SESSION['prenom'] = $user2['prenom'];
		$_SESSION['role'] = $user2['role'];
		$_SESSION['age'] = $age;
		$_SESSION['date_naissance'] = $user2['date_naissance'];
		header('location:tableaubord.php');
	}
	else{
		header('location:connexion.php?error=true');
	}



}else{
	header('location:connexion.php?error=true');
}






















?>