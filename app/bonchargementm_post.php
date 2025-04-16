<?php
// Connexion à la base de données
include('session-verif.php');
include "ConnectionPOO.php";

$idbon=$_POST['idbon'];
//$idtypeop=$_POST['idtypeop'];
$numerovehicule=addslashes($_POST['numerovehicule']);
$marchandise=addslashes($_POST['marchandise']);
$nomdestinataire=addslashes($_POST['nomdestinataire']);
$nomchaufeur=addslashes($_POST['nomchaufeur']);
$idtransitaire=$_POST['idtransitaire'];
$poids=$_POST['poids'];
$typec=$_POST['typec'];
$nbrecolis=$_POST['nbrecolis'];
$adresse=addslashes($_POST['adresse']);
$datebon=$_POST['datebon'];
$modifyby=$_SESSION['iduser'];
//$idsignataire=$_SESSION['idsignataire'];
$curdate = date("Y-m-d H:i:s");
$idposte=$_SESSION['idposte'];
//$nomresponsable=$_SESSION['nomresponsable'];
//$prenomresponsable=$_SESSION['prenomresponsable'];
$date = date_parse($datebon);
$annee = $date['year'];


// Insertion du message à l'aide d'une requête préparée
try{
$req = $bdd->prepare("Update  bonchargement set 
typec=?,numerovehicule=?, nomchaufeur=?, idtransitaire=?,
 marchandise=?, poids=?,nbrecolis=?,nomdestinataire=?,
 adresse=?,datebon=?,modifyby=?,datemodify=?
where idbon=?");
$req->execute(array($typec,$numerovehicule,$nomchaufeur,
$idtransitaire, $marchandise,$poids,$nbrecolis,
$nomdestinataire, $adresse, $datebon,$modifyby,
$curdate,$idbon));

}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}

// Redirection du visiteur vers la page du minichat


header('Location: bonchargement.php');
?>