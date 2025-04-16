<?php
session_start();
if (isset($_POST['btnlogin']) ){
	
	include('Connexion.php');
	$username="";
	$password="";
	
	$mysqli=bdd();

	$username=$_POST['username'];
	$password=$_POST['password'];
	$iduser="";
	$nomuser=""; $prenomuser=""; $idposte="";$idgroupe=""; $lieudetravail="";
	$res = $mysqli->prepare("SELECT iduser,nomuser,prenomuser,idposte,idgroupe,lieudetravail,actif,id FROM user where iduser=? and password=?");
	$reponse = $mysqli->prepare("SELECT idposte,libposte,nomsite,sitename,adresseposte,emailposte,nomresponsable,prenomresponsable,pays,contactposte,titreposte,titreresponsableng from poste where idposte=? ");
	$grp=$mysqli->prepare('select ajouter, modifier, supprimer,gereruser, administrateur,gererfacture,statistique,statistiquec,decideur,parametre,paramuser,conversion,FactavoirAp from groupe where idgroupe=?');
	
	$res->bind_param("ss",$username, $password);
	$res->execute();	
	$res->bind_result($iduser, $nomuser,$prenomuser,$idposte,$idgroupe,$lieudetravail,$actif,$id);
	if (mysqli_stmt_fetch($res) and $actif==1 ){
	
	$_SESSION['iduser']=$_POST['username'];
	$_SESSION['logged']=true;
	$_SESSION['nomuser']=$nomuser;
	$_SESSION['prenomuser']=$prenomuser;
	$_SESSION['idposte']=$idposte;
	$_SESSION['id']=$id;
	mysqli_stmt_close($res);
	
	$grp->bind_param("i",$idgroupe);
	$grp->execute();	
	$grp->bind_result($ajouter,$modifier,$supprimer,$gereruser,$administrateur,$gererfacture,$statistique,$statistiquec,$decideurC,$parametreC,$paramuserC,$conversionC,$FactavoirApC);
			if  (mysqli_stmt_fetch($grp)) {
				$_SESSION['administrateur']=$administrateur;
				$_SESSION['ajouter']=$ajouter;
				$_SESSION['modifier']=$modifier;
				$_SESSION['supprimer']=$supprimer;
				$_SESSION['gereruser']=$gereruser;
				$_SESSION['gererfacture']=$gererfacture;
				$_SESSION['statistique']=$statistique;
				$_SESSION['statistiquec']=$statistiquec;
				$_SESSION['decideur']=$decideurC;
				$_SESSION['parametre']=$parametreC;
				$_SESSION['paramuser']=$paramuserC;
				$_SESSION['conversion']=$conversionC;
				$_SESSION['FactavoirAp']=$FactavoirApC;
				
			}
	mysqli_stmt_close($grp);
	
	if ($administrateur=='N'){
	$reponse->bind_param("s",$idposte);
	$reponse->execute();	
	$reponse->bind_result($idpostee, $libposte,$nomsite,$sitename,$adresseposte,$emailposte,$nomresponsable,$prenomresponsable,$pays,$contactposte,$titreposte,$titreresponsableng);
			
	if  (mysqli_stmt_fetch($reponse)) {
		
			$_SESSION['libposte']=$libposte;
			/*$_SESSION['idport']=$idport;
			$_SESSION['tauxcommi']=$tauxcommi;
			$_SESSION['tauxcomme']=$tauxcomme;*/
			$_SESSION['nomsite']=$nomsite;
			$_SESSION['sitename']=$sitename;
			$_SESSION['adresseposte']=$adresseposte;
			$_SESSION['emailposte']=$emailposte;
			$_SESSION['nomresponsable']=$nomresponsable;
			$_SESSION['prenomresponsable']=$prenomresponsable;
			$_SESSION['titreresponsableng']=$titreresponsableng;
			$_SESSION['titreposte']=$titreposte;
			$_SESSION['pays']=$pays;
			$_SESSION['contactposte']=$contactposte;
			if ($_SESSION['administrateur']=='N') $_SESSION['pays']=$pays;
			
			$_SESSION["nblignes"]=0; 
			mysqli_stmt_close($reponse);
				
			}  } else  $_SESSION['libposte']=$lieudetravail; 
		$_SESSION['repere']=10;	
	header('Location:menup.php');}
	
		else 
	{echo 'Compte ou mot de passe invalide ou compte inactif ' ;
	mysqli_close($mysqli);
	unset($mysqli);
	}
		
		
		}
		// fin du isset
?>	
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
    <meta charset="utf-8">
	
    <title>Gestion des Bons de Chargement</title>
	<style>
	body {
	color:black;
	
	}
	</style>
	<script> 
		function _closeWindow() { window.opener = self; self.close();}
	</script> 
 </head>
 <body>
<form method="post" action="index.php">

<table align='center' class="login">
	<tr>
		
       <td></td>
       <td><img src="images/LOGO_CBC.jpg" alt="Le logo du CBC" /> </td>
	 </tr>
	<tr>
		
       <td><label for="username">Nom utilisateur <span style="color:red" > * </span></label></td>
       <td><input type="text" name="username" id="username" required="required" class="form-control" /> </td>
	 </tr>
	
	 <tr>
		<td> <label for="<tr>
		<td> <label for="password">Mot de passe <span style="color:red" > * </span></label> </td>
       <td><input type="password" name="password" id="password" required="required" class="form-control" /> </td>
     </tr>
<br/> <br/> <br/> <br/> <br/> <br/>



 <tr>
 <td>
 </td>
 <td> 
 <input type="submit"  name="btnlogin" value="Connexion" class="btn btn-primary" /></td>
 <td> <input type="reset" value="Annuler"  class="btn btn-warning"/></td>
 <td> <input type='button' onclick="javascript:_closeWindow();" value="Fermer" class="btn btn-danger" /></td>
 </tr>
</table>

</form>

<style>
	.login{

	}
	.login td{
		padding: 5px;
	}
</style>



 </body>
 </html>