<?php 

	require_once("relation.php");


	$query = $db->prepare("DELETE FROM evenement WHERE id=:id");

	$query->execute(["id" => $_GET["id"]]);

	header("Location:tableaubord.php");



?>