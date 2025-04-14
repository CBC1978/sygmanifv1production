<?php
// Connexion à la base de données
include "ConnectionPOO.php";
/*
function debug($v){
	echo "<pre>";
		var_dump($v);
	echo "</pre>";
} */
// Insertion du message à l'aide d'une requête préparée
try{
$libposte=$_POST['libposte'];
$nomresponsable=$_POST['nomresponsable'];
$prenomresponsable=$_POST['prenomresponsable']; 
$contactposte=$_POST['contactposte'];
$faxposte=$_POST['faxposte'];
$emailposte=$_POST['emailposte'];
 $titreresponsable=$_POST['titreresponsable'];
 $titreresponsableng=$_POST['titreresponsableng'];
$exercice=$_POST['exercice']; 
/*$tauxcommi=$_POST['tauxcommi']; 
$tauxcomme=$_POST['tauxcomme']; */
 $nomministere=$_POST['nomministere'];
$ministryname=$_POST['ministryname']; $nomdirectiong=$_POST['nomdirectiong'];
$directoryname=$_POST['directoryname']; $nomsite=$_POST['nomsite'];
$sitename=$_POST['sitename'];  $pays=$_POST['pays']; 
$adresse=$_POST['adresse']; //$idport=$_POST['idport'];
//$monnaie=isset($_POST['monnaie'])?$_POST['monnaie']:''; $Autremonnaie=isset($_POST['Autremonnaie'])?$_POST['Autremonnaie']:''; 
$idposte=$_POST['idposte'];

$req = $bdd->prepare("Update poste set libposte=?,
 nomresponsable=?, prenomresponsable=?, contactposte=?,
 faxposte=?, emailposte=?,titreposte=?,titreresponsableng=?,posteexercice=?,
 nomministere=?,ministryname=?, 
 nomdirectiong=? ,directoryname=?,nomsite=?,sitename=?,
 pays=?,adresseposte=?
 where idposte=?") ;
$req->execute(array($libposte, $nomresponsable, $prenomresponsable,
$contactposte, $faxposte,$emailposte,$titreresponsable,
$titreresponsableng,$exercice,  $nomministere,
$ministryname,$nomdirectiong,$directoryname,$nomsite,
$sitename, $pays,$adresse,$idposte));
echo "Modifier avec succès";



}

catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}

// Redirection du visiteur vers la page du minichat


header('Location: poste.php');
?>