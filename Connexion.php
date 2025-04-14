<?php
// Connexion à la base de données
function bdd() {
$mysqli = new mysqli("localhost", "root", 'Cbcfaso2009', "bcproduction");
	if ($mysqli->connect_errno) {
    echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}

return $mysqli;
}




?>