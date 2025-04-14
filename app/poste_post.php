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
$libposte=addslashes($_POST['libposte']); $nomresponsable=addslashes($_POST['nomresponsable']);
$prenomresponsable=addslashes($_POST['prenomresponsable']); $contactposte=addslashes($_POST['contactposte']);
$contactposte=$_POST['contactposte']; 
$faxposte=isset($_POST['faxposte'])?$_POST['faxposte']:' ';
$emailposte=$_POST['emailposte']; $titreresponsable=addslashes($_POST['titreresponsable']);
$titreresponsableng=addslashes($_POST['titreresponsableng']);
$exercice=$_POST['exercice']; 
//$tauxcommi=$_POST['tauxcommi']; 
//$tauxcomme=$_POST['tauxcomme'];
 $nomministere=addslashes($_POST['nomministere']);
$ministryname=addslashes($_POST['ministryname']); $nomdirectiong=addslashes($_POST['nomdirectiong']);
$directoryname=addslashes($_POST['directoryname']); $nomsite=addslashes($_POST['nomsite']);
$sitename=isset($_POST['sitename'])?$_POST['sitename']:' ';  $pays=$_POST['pays']; 
$adresse=addslashes($_POST['adresse']); //$idport=$_POST['idport'];
//$monnaie=isset($_POST['monnaie'])?$_POST['monnaie']:''; $Autremonnaie=isset($_POST['Autremonnaie'])?$_POST['Autremonnaie']:''; 

$nb=NouveauNumeroPos($bdd);
$req = $bdd->prepare("INSERT INTO poste(idposte,libposte, 
nomresponsable, prenomresponsable, contactposte, faxposte,
 emailposte,titreposte,titreresponsableng,posteexercice,
 nomministere,ministryname, nomdirectiong ,directoryname,
 nomsite,sitename,pays,adresseposte) 
VALUES(?,?,?,?,?, ?, ?,?,?,?,?, ?,?,?, ?, ?, ?,?)");
$req->execute(array($nb,$libposte, 
$nomresponsable,$prenomresponsable,
$contactposte, $faxposte,
 $emailposte, $titreresponsable,
 $titreresponsableng, $exercice, 
 $nomministere, $ministryname,
 $nomdirectiong, $directoryname,
 $nomsite, $sitename,
 $pays, $adresse));
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