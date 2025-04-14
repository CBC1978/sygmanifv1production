<?php
// Connexion à la base de données
include "ConnectionPOO.php";
function debug($v){
	echo "<pre>";
		var_dump($v);
	echo "</pre>";
}
if (isset($_POST["valider"])){
$idconsignataire=$_POST['idconsignataire'];
$raisoc=addslashes($_POST['raisoc']);
$adresse=addslashes($_POST['adresse']);
$telephone=$_POST['telephone'];
$fax=$_POST['fax'];
$email= $_POST['email'];
$ville=addslashes($_POST['ville']);
$pays=addslashes($_POST['pays']);
// Insertion du message à l'aide d'une requête préparée
try{
$req = "INSERT INTO consignataire(idconsignataire, 
nomcons, adressecons, telcons, faxcons, emailcons, 
villecons, payscons) VALUES ($idconsignataire,'$raisoc','$adresse',
'$telephone','$fax', '$email', '$ville', '$pays')";

$bdd->exec($req );
echo "Insérer avec succès";
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}

// Redirection du visiteur vers la page du minichat


header('Location: consignataire.php'); 
}
?>