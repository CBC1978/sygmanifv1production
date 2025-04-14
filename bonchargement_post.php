<?php
// Connexion à la base de données
include('session-verif.php');
include "ConnectionPOO.php";

$numerovehicule=addslashes($_POST["numerovehicule"]);
$marchandise=addslashes($_POST["marchandise"]);
$nomdestinataire=addslashes($_POST["nomdestinataire"]);
$nomchaufeur=addslashes($_POST["nomchaufeur"]);
$idtransitaire=$_POST["idtransitaire"];
$poids=$_POST["poids"];
$typec=$_POST["typec"];
$nbrecolis=$_POST["nbrecolis"];
$adresse=addslashes($_POST["adresse"]);
$datebon=$_POST["datebon"];
$createdby=$_SESSION["iduser"];
//$idsignataire=$_SESSION["idsignataire"];
$curdate = date("Y-m-d H:i:s");
$idposte=$_SESSION["idposte"];
$nomresponsable=$_SESSION["nomresponsable"];
$prenomresponsable=$_SESSION["prenomresponsable"];
$date = date_parse($datebon);
$annee = $date['year'];
$num=NouveauNumero($bdd,$annee,$idposte);
//$chaine=" ";
//$chaine = $num;
$numbon=$annee; $numbon=$numbon."-".$num;
// Insertion du message à l'aide d'une requête préparée


try {
 $bdd->beginTransaction();

$req = $bdd->prepare("INSERT INTO bonchargement
(num,numbon,idposte,typec, numerovehicule, marchandise, nomdestinataire, 
nomchaufeur,idtransitaire,poids,nbrecolis,adresse,
createdby,datecreation,datebon) 
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");


$req->execute(array($num,$numbon, $idposte,$typec,$numerovehicule,
$marchandise, $nomdestinataire,$nomchaufeur,$idtransitaire,
$poids, $nbrecolis,$adresse,$createdby,$curdate,$datebon));

if ($num==1) {
$compt= $bdd->prepare("INSERT INTO compteur
(numero,idposte, annee) values (?,?,?)");
$compt->execute(array($num,$idposte,$annee));}
else { 
$compt= $bdd->prepare("Update  compteur
set numero=? where idposte=? and  annee=?");
$compt->execute(array($num,$idposte,$annee));
 }
$bdd->commit();
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage()); // $bdd->rollback();
		}



header('Location: bonchargement.php');
?>