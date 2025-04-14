<?php
session_start();
if (isset($_SESSION['logged']) OR $_SESSION['logged'] ) {
$username=isset($_SESSION['nomuser']) ? $_SESSION['nomuser']:'' ;
	$nom=$_SESSION['nomuser'];
	$prenom=$_SESSION['prenomuser'];

	if ($_SESSION['administrateur']=='N'){
		$idposte=$_SESSION['idposte'];
		//$idport=$_SESSION['idport'];
		}
	$libposte=$_SESSION['libposte'];
}
else {
	header('Location: index.php?error=3'); }
	
