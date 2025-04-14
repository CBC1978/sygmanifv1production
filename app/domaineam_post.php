<?php
include "ConnectionPOO.php";
$nomdomainea=addslashes($_POST['nomdomainea']);
$iddomainea=$_POST['iddomainea'];
if (isset($_POST['modifier'])) {
try {
	$reponse= $bdd->prepare('update domainea set nomdomainea=? where iddomainea=?');
	$reponse->execute(array($nomdomainea,$iddomainea));
	echo 'Modifier avec succès';
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}
$reponse->closeCursor();

}
if (isset($_POST['supprimer'])) {
try {
	$reponse= $bdd->prepare('delete from domainea where iddomainea=?');
	$reponse->execute(array($iddomainea));
	echo 'Supprimer  avec succès';
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}
$reponse->closeCursor();

}



header('Location: domainea.php');
?>

