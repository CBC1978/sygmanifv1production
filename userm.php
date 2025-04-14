<?php
include('session-verif.php');
include "ConnectionPOO.php";

try {
$id = $_GET['id'];
$result = $bdd->query("SELECT * FROM user where iduser='$id'");}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}

while ($resultat= $result->fetch()){

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mise à jour des Utilisateurs</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="manifeste.css" />
		<link rel="stylesheet" href="css/mystyle.css" />
    </head>

<body>
	<?php include "inc/app_header.php"; ?>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<a href="menup.php">Retour au menu précédent</a>    <br> 	  <br>
				<form method="post" action="userm_post.php">
   <fieldset>
       <legend> <b>Informations sur les Utilisateurs </b> </legend> <!-- Titre du fieldset --> 
	<table>
	 <tr>
	
		<td> <label for="nomuser">Nom </label> </td>
       <td><input type="text" name="nomuser" id="nomuser" value="<?php echo $resultat['nomuser'];?>"  onkeyup="this.value=this.value.toUpperCase()" /> </td>
     
	 <td><label for="prenomuser">Prénom </label></td>
       <td><input type="tel" name="prenomuser" id="prenomuser" value="<?php echo $resultat['prenomuser'];?>"  onkeyup="this.value=this.value.toUpperCase()" /> </td>
     </tr>
	 <tr>
		<td> <label for="password">Mot de passe </label> </td>
       <td><input type="password" name="password" id="password"  value="<?php echo $resultat['password'];?>"    /> </td>
      </tr>
	  <tr>
		<td> <label for="emailuser">Email </label> </td>
       <td><input type="email" name="emailuser" id="emailuser" value="<?php echo $resultat['emailuser'];?>"  onkeyup="this.value=this.value.toLowerCase()"  /> </td>
     
	 
	  <td> <label for="lieudetravail">Ville: </label> </td>
      <td><input type="text" name="lieudetravail" id="lieudetravail" value="<?php echo $resultat['lieudetravail'];?>"  onkeyup="this.value=this.value.toUpperCase()" /> </td>
   </tr>
   
   <?php
		
		$req = $bdd->query('SELECT * FROM groupe order by nomgroupe');
		$req1 = $bdd->query('SELECT * FROM poste order by libposte');
	?>
   <tr>
		<td><label for="idgroupe">Groupe </label></td>
	    <td>  <select name="idgroupe" id="idgroupe" size=1 required='required' >
		  <option value=""> Veuillez choisir le groupe</option>
        <?php
		while ($donnees = $req->fetch()) {
		?>
		<option value="<?php echo $donnees['idgroupe'];?>"> <?php  echo $donnees['nomgroupe']; ?></option><?php } ?>
		</select></td>
   </tr>
   <tr>
		<td><label for="idposte">Poste CBC </label></td>
	     <td> <select name="idposte" id="idposte"  size=1 >
		  <option value=""> Veuillez choisir le poste</option>
        <?php
		while ($donnees = $req1->fetch()) {
		?>
		<option value="<?php echo $donnees['idposte'];?>"> <?php  echo $donnees['libposte']; ?></option><?php } ?>
		</select></td>
		<td><input type="hidden" name="iduser" id="iduser" value="<?php echo $resultat['iduser'];?>"/> </td>
     
   </tr>
   <fieldset>
	 <legend> <b>Actif</b></legend> 
	<tr>		
       <td><INPUT type= "radio" name="actif" id="actif1"   value="1"  checked> Actif
			
       <INPUT type= "radio" name="actif" id="actif2"  value="2"> Inactif</td>
	</tr>
	</fieldset> 
   <?php
	if ($resultat['actif']==1)
	echo '<script> document.getElementById("actif1").checked=true;    </script>';
	else echo '<script> document.getElementById("actif2").checked=true; </script>';
	
	?>
   
	</table>
	 </fieldset>
	   <script>
	
		idgroupe.value='<?php echo $resultat['idgroupe']; ?>';
		idposte.value='<?php  echo $resultat['idposte']; ?>';
		
	  </script >

 <table class="type2">
 <tr>
 <td> 
 <input type="submit" name="modifier" value="Modifier"  /></td>
 <td> <input type="submit" name="supprimer" value="Supprimer"  /></td>
 </tr>
</table>
</form>

				<hr>


			</div>
		</div>
	</div>


<?php
}
$result->closeCursor();

?>

</body>
  

</html>
