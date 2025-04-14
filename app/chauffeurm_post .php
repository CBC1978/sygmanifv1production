<?php
include "ConnectionPOO.php";
if (isset($_POST['modifier'])) {
try {
	$reponse= $bdd->prepare('update chauffeur set nomchaufeur=? where idchauffeur=?');
	$reponse->execute(array(addslashes($_POST['nomchaufeur']),$_POST['idchauffeur']));
	echo 'Modifier avec succès';
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}
$reponse->closeCursor();
header('Location: chauffeur.php');
}

?>

