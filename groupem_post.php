<?php

include "ConnectionPOO.php";

// Insertion du message à l'aide d'une requête préparée
if (isset($_POST['modification'])) { 
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
$idgroupe=$_POST['idgroupe'];
$FactavoirAp=$_POST['FactavoirAp'];
try{
$req = $bdd->prepare('update groupe set nomgroupe=?, ajouter=?, modifier=?,
 supprimer=?, gereruser=?, administrateur=?,
 gererfacture=?,statistique=?, statistiquec= ?,decideur= ?,
 parametre= ?,paramuser= ?,FactavoirAp=? where idgroupe=? ') ;
$req->execute(array($nomgroupe, $ajouter, $modifier, 
$supprimer, $gereruser, $administrateur, 
$gererfacture,$statistique,$statistiquec,$decideur,
$parametre,$paramuser,$FactavoirAp,$idgroupe));

echo "Enregsitré avec succès";
}

catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}

// Redirection du visiteur vers la page du minichat


header('Location: groupe.php'); 
}
?>