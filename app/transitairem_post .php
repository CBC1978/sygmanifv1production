<?php
include "ConnectionPOO.php";
if (isset($_POST['modifier'])) {
try {
	$reponse= $bdd->prepare('update transitaire set nomtransitaire=? where idtransitaire=?');
	$reponse->execute(array(addslashes($_POST["nomtransitaire"]),$_POST['idtransitaire']));
	echo 'Modifier avec succès';
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}
$reponse->closeCursor();
header('Location: transitaire.php');
}

?>

