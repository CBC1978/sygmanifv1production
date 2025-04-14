<?php

include "ConnectionPOO.php";
$nomgroupe=strtoupper(addslashes($_POST['nomgroupe']));
$ajouter=$_POST['ajouter'];
$modifier=$_POST['modifier'];
$supprimer=$_POST['supprimer']; 
$gereruser=$_POST['gereruser'];
$administrateur=$_POST['administrateur'];
$gererfacture=$_POST['gererfacture'];
$statistique=$_POST['statistique'];
$statistiquec=$_POST['statistiquec'];
$decideur=$_POST['decideur'];
$parametre=$_POST['parametre'];
$paramuser=$_POST['paramuser'];
$conversion=$_POST['conversion'];
$FactavoirAp=$_POST['FactavoirAp'];

// Insertion du message à l'aide d'une requête préparée
try{
$req = $bdd->prepare("INSERT INTO groupe(nomgroupe, ajouter,
 modifier,supprimer, gereruser, administrateur, 
 gererfacture,statistique, statistiquec,decideur,parametre,
 paramuser,conversion,FactavoirAp) 
VALUES(?,?,?,?,?, ?, ?,?,?,?,?,?,?,?)");
$req->execute(array($nomgroupe, 
$ajouter, $modifier, $supprimer,
 $gereruser, $administrateur, $gererfacture,
 $statistique,$statistiquec,$decideur,
 $parametre,$paramuser,$conversion,$FactavoirAp));
echo "Insérer avec succès";
}

catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}

// Redirection du visiteur vers la page du minichat


header('Location: groupe.php');
?>