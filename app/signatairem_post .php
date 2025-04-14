<?php
include "ConnectionPOO.php";
if (isset($_POST['modifier'])) {
try {
	$reponse= $bdd->prepare('update signataire set nomprenom=? where idsignataire=?');
	$reponse->execute(array(addslashes($_POST["nomprenom"]),$_POST['idsignataire']));
	echo 'Modifier avec succès';
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}
$reponse->closeCursor();
header('Location: signataire.php');
}

?>

