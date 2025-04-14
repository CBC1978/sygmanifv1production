<?php
// Connexion à la base de données
//include('session-verif.php');
include "ConnectionPOO.php";
function debug($v){
	echo "<pre>";
		var_dump($v);
	echo "</pre>";
}
// Insertion du message à l'aide d'une requête préparée
try{
$nb=NouveauNumeroPos($bdd);
$libposte=$_POST['libposte']; $nomresponsable=$_POST['nomresponsable'];
$prenomresponsable=$_POST['prenomresponsable']; $contactposte=$_POST['contactposte'];
$contactposte=$_POST['contactposte']; 
$faxposte=isset($_POST['faxposte'])?$_POST['faxposte']:' ';
$emailposte=$_POST['emailposte']; $titreresponsable=$_POST['titreresponsable'];
$exercice=$_POST['exercice']; $tauxcommi=$_POST['tauxcommi']; 
$tauxcomme=$_POST['tauxcomme']; $nomministere=$_POST['nomministere'];
$ministryname=$_POST['ministryname']; $nomdirectiong=$_POST['nomdirectiong'];
$directoryname=$_POST['directoryname']; $nomsite=$_POST['nomsite'];
$sitename=isset($_POST['sitename'])?$_POST['sitename']:' ';  $pays=$_POST['pays']; 
$adresse=$_POST['adresse']; $idport=$_POST['idport'];
$monnaie=isset($_POST['monnaie'])?$_POST['monnaie']:''; $Autremonnaie=isset($_POST['Autremonnaie'])?$_POST['Autremonnaie']:''; 

$nb=NouveauNumeroPos($bdd);
$req = $bdd->prepare("INSERT INTO poste(idposte, libposte, nomresponsable, 
prenomresponsable, contactposte, faxposte, emailposte,titreposte,
posteexercice,tauxcommi,tauxcomme,nomministere,ministryname, 
nomdirectiong ,directoryname,nomsite,sitename,pays,adresseposte,
idport,monnaie,Autremonnaie) 
VALUES(?,?,?,?,?, ?, ?,?,?,?,?,?, ?, ?,?,?, ?, ?, ?,?,?, ? )");
$req->execute(array($nb, $libposte, 
$nomresponsable,$prenomresponsable,
$contactposte, $faxposte,
 $emailposte, $titreresponsable,
 $exercice, $tauxcommi, $tauxcomme,
 $nomministere, $ministryname,
 $nomdirectiong, $directoryname,
 $nomsite, $sitename,
 $pays, $adresse,$idport,
 $monnaie, $Autremonnaie));
echo "Insérer avec succès";
/*
$req="INSERT INTO poste(idposte, libposte, nomresponsable, 
prenomresponsable, contactposte, faxposte, emailposte,
titreposte,posteexercice,tauxcommi,tauxcomme,nomministere,
ministryname, nomdirectiong ,directoryname,nomsite,sitename,
pays,adresseposte,idport) 
 VALUES('$nb','$libposte','$nomresponsable','$prenomresponsable', '$contactposte', '$faxposte','$emailposte', '$titreresponsable', $exercice, $tauxcommi,$tauxcomme, '$nomministere', '$ministryname','$nomdirectiong','$directoryname','$nomsite','$sitename', '$pays', '$adresse',$idport)";
$bdd->exec($req); 
debug($req);*/

}

catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}

// Redirection du visiteur vers la page du minichat


header('Location: poste.php');
?>