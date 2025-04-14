<?php
// Connexion à la base de données
include "ConnectionPOO.php";
if (isset($_POST['valider'])) {
// Insertion du message à l'aide d'une requête préparée
    try{
        $req = $bdd->prepare("Update port set nomport=? , idpays=? WHERE idport=?");
        $req->execute(array($_POST['nomport'],$_POST['idpays'],$_POST['idport']));
        echo "Modifier avec succès";
       
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
	header('Location: port.php');
	
}