<?php
// Connexion à la base de données
include "ConnectionPOO.php";

// Insertion du message à l'aide d'une requête préparée
try{

$req = $bdd->query('SELECT max(id) as nb FROM user');
while ($donnees=$req->fetch()) { $nb=$donnees['nb']+1;}
$iduser=$_POST['iduser'];
$nomuser=addslashes($_POST["nomuser"]);
$prenomuser=addslashes($_POST["prenomuser"]);
$password=addslashes($_POST["password"]);
$emailuser=$_POST['emailuser']; $actif=$_POST['actif'];
$lieudetravail=addslashes($_POST["lieudetravail"]); $idposte=$_POST['idposte'];
$idgroupe=$_POST['idgroupe'];$idgroupe=$_POST['idgroupe'];
if (stripos(NomGroupe($_POST['idgroupe'],$bdd),'ADMIN')===false){

$req = $bdd->prepare("INSERT INTO user(id,iduser, nomuser, prenomuser, password, emailuser, lieudetravail, idgroupe,actif,idposte) VALUES(?,?,?,?,?, ?, ? ,?,?,?)");

$req->execute(array($nb,$iduser, $nomuser, $prenomuser, $password, $emailuser, $lieudetravail, $idgroupe,$actif, $idposte));
}
else { 
	$req = $bdd->prepare("INSERT INTO user(iduser, nomuser, prenomuser, password, emailuser, lieudetravail, idgroupe,idposte,actif) VALUES(?,?,?,?,?, ?, ?,?,?,?)");
	$req->execute(array($nb, $iduser, $nomuser, $prenomuser, $password, $emailuser, $lieudetravail, $idgroupe,' ',$actif));

  }
  echo "Insérer avec succès";
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}

// Redirection du visiteur vers la page du minichat


header('Location: user.php');
?>