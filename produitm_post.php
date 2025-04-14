<?php
include "ConnectionPOO.php";
if (isset($_POST['modifier'])) {
try {
	$reponse= $bdd->prepare('update produit set nomprod=? where idprod=?');
	
	$nomprod=addslashes($_POST['nomprod']);
	$reponse->execute(array($nomprod,$_POST['idprod']));
	echo 'Modifier avec succès';
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}
$reponse->closeCursor();
header('Location: produit.php');
}

?>

