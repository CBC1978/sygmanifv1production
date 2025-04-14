<?php
// Connexion à la base de données
include('session-verif.php');
include "ConnectionPOO.php";

$idop=$_POST['idop'];
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
$localisationgeo=$_POST['localisationgeo'];
$paysop=addslashes($_POST['paysop']);
$Personnedecontact=addslashes($_POST['Personnedecontact']);
$modifyby=$_SESSION['iduser'];
$curdate = date("Y-m-d H:i:s");
$statut=addslashes($_POST['statut']);
$siteweb=addslashes($_POST['siteweb']);
$boitep=addslashes($_POST['boitep']);
$region=addslashes($_POST['region']);
$province=addslashes($_POST['province']);

// Insertion du message à l'aide d'une requête préparée
try{
$req = $bdd->prepare("Update operateur set 
nomope=?, idtypeop=?, adresseop=?, telephoneop1=?, 
telephoneop2=?,telephoneop3=?,faxop=?,emailop1=?,emailop2=?,villeop=?,
localisationgeo=?,paysop=?,Personnedecontact=?,nomabrege=?,numeroifu=?,
anneecreation=?,effectif=?,statut=?,siteweb=?,boitep=?,region=?,province=?,
modifyby=?,modifydate=? where
idop=?");
$req->execute(array($nomope,$idtypeop,
$adresseop, $telephoneop1,$telephoneop2,$telephoneop3,
$faxop, $emailop1,$emailop2, $villeop, $localisationgeo,
$paysop,$Personnedecontact,
$nomabrege,$numeroifu,$anneecreation,$effectif,
$statut,$siteweb,$boitep,$region,$province,
$modifyby,$curdate,$idop));
echo "Modifié avec succès";
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}

// Redirection du visiteur vers la page du minichat


header('Location: operateur.php');
?>