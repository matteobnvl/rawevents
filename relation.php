<?php

try {
		$db = new PDO('mysql:host=localhost;
			dbname=rawevents;
			port=3307;
			charset=utf8',
			'root',
			'matteo');
		}
		catch (Exception $e) {
		die('erreur : '.$e->getMessage());
	}


?>	