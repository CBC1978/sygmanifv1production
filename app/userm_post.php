<?php
// Connexion à la base de données
include "ConnectionPOO.php";

if (isset($_POST['modifier'])) {
$actif=intval($_POST['actif']);
try{
if (stripos(NomGroupe($_POST['idgroupe'],$bdd),'ADMIN')===false){

$req = $bdd->prepare('Update user set actif=?, nomuser=?, prenomuser=?, password=?, emailuser=?, lieudetravail=?, idgroupe=?,idposte=? where iduser=?');
$req->execute(array($actif,$_POST['nomuser'], $_POST['prenomuser'], $_POST['password'], $_POST['emailuser'], $_POST['lieudetravail'], $_POST['idgroupe'], $_POST['idposte'],$_POST['iduser']));
}
else { 
	$req = $bdd->prepare('Update user set actif=?, nomuser=?, prenomuser=?, password=?, emailuser=?, lieudetravail=?, idgroupe=?,idposte=? where iduser=?');
	$req->execute(array($actif, $_POST['nomuser'], $_POST['prenomuser'], $_POST['password'], $_POST['emailuser'], $_POST['lieudetravail'], $_POST['idgroupe'],' ',$_POST['iduser']));
	
  }
  echo "Modifier avec succès";
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}

// Redirection du visiteur vers la page du minichat


header('Location: user.php');
 }
?>