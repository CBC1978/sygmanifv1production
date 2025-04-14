<?php
// Connexion à la base de données
include('session-verif.php');
include "ConnectionPOO.php";

$nomope=addslashes($_POST['nomope']);
$nomabrege=addslashes($_POST['nomabrege']);
$effectif=$_POST['effectif'];
$numeroifu=$_POST['numeroifu'];
$anneecreation=$_POST['anneecreation'];
$idtypeop=$_POST['idtypeop'];
$adresseop=addslashes($_POST['adresseop']);
$telephoneop1=$_POST['telephoneop1'];
$telephoneop2=$_POST['telephoneop2'];
$telephoneop3=$_POST['telephoneop3'];
$faxop=$_POST['faxop'];
$emailop1=$_POST['emailop1'];
$emailop2=$_POST['emailop2'];
$villeop=addslashes($_POST['villeop']);
$localisationgeo=addslashes($_POST['localisationgeo']);
$paysop=addslashes($_POST['paysop']);
$personnedecontact=addslashes($_POST['personnedecontact']);
$statut=addslashes($_POST['statut']);
$siteweb=addslashes($_POST['siteweb']);
$boitep=addslashes($_POST['boitep']);
$region=addslashes($_POST['region']);
$province=addslashes($_POST['province']);
$createdby=$_SESSION['iduser'];
$curdate = date("Y-m-d H:i:s");
// Insertion du message à l'aide d'une requête préparée
try{

$req = $bdd->prepare("INSERT INTO operateur
(nomope, idtypeop, adresseop, telephoneop1, 
telephoneop2,telephoneop3,faxop,emailop1,emailop2,
villeop,localisationgeo,paysop,personnedecontact,
nomabrege,numeroifu,anneecreation,effectif,
createdby,datecreation,statut,siteweb,boitep,region,province) 
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");


$req->execute(array($nomope,$idtypeop,
$adresseop, $telephoneop1,$telephoneop2,$telephoneop3,
$faxop, $emailop1,$emailop2, $villeop, $localisationgeo,
$paysop,$personnedecontact,$nomabrege,$numeroifu,$anneecreation,$effectif,
$createdby,$curdate,$statut,$siteweb,$boitep,$region,$province));

}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}



header('Location: operateur.php');
?>