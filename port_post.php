<?php
include('session-verif.php');
include ("ConnectionPOO.php");


   
	$idport=$_POST['idport'];
	$nomport=$_POST['nomport'];
	$idpays=$_POST['idpays'];
	try{
		$req = "insert into port(idport,nomport,idpays) 
		values ('$idport','$nomport','$idpays')";
		$bdd->exec($req);
		
			//debug($req)	;
			}
		catch(Exception $e)
			{
		die('Erreur : '.$e->getMessage());}
		
	header('Location: port.php');		