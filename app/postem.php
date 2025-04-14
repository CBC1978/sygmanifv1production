<?php
include('session-verif.php');
include "ConnectionPOO.php";

try {
$id = $_GET['id'];

$result = $bdd->query("SELECT * FROM poste where idposte=$id ");}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}

while ($resultat= $result->fetch()){

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mise à jour des Postes </title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="manifeste.css" />
		<link rel="stylesheet" href="css/mystyle.css" />
		<link rel="stylesheet" href="manifeste.css" />
    </head>

<body>
	<?php include "inc/app_header.php"; ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<form method="post" action="postem_post.php">
					 <a href="menup.php">Retour au menu précédent</a>    <br> 	  <br>
					   <fieldset>
						   <legend><b>Informations sur le Poste</b></legend> <!-- Titre du fieldset -->
						<table class="table-poste">
						<tr>
						   <td><input type="hidden" name="idposte" id="idposte" value="<?php echo $resultat['idposte'];?>"  /> </td>
						   <td><label for="libposte">Nom du Poste: </label></td>
						   <td><input type="text" name="libposte" id="libposte" value="<?php echo $resultat['libposte'];?>"  onkeyup="this.value=this.value.toUpperCase()"  /> </td>
						   <td><label for="exercice">Exercice </label></td>
						   <td><input type="number" name="exercice" id="exercice" value="<?php echo $resultat['posteexercice'];?>" /> </td>
						 </tr>
						  <tr>
						   <td><label for="nomsite">Nom du site  </label></td>
						   <td><input type="text" name="nomsite" id="nomsite" value="<?php echo $resultat['nomsite'];?>" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
						   <td><label for="sitename">Site name: </label></td>
						   <td><input type="text" name="sitename" id="sitename" value="<?php echo $resultat['sitename'];?>" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
						 </tr>
						  <tr>
						   <td><label for="pays">Pays  </label></td>
						   <td><input type="text" name="pays" id="pays" value="<?php echo $resultat['pays'];?>" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
						   <td><label for="adresse">Adresse: </label></td>
						   <td><input type="text" name="adresse" id="adresse" value="<?php echo $resultat['adresseposte'];?>" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
						 </tr>
						  <tr>
						   <td><label for="nomministere">Nom ministère </label></td>
						   <td><input type="text" name="nomministere" id="nomministere" value="<?php echo $resultat['nomministere'];?>" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
						   <td><label for="ministryname">Ministry name: </label></td>
						   <td><input type="text" name="ministryname" id="ministryname" value="<?php echo $resultat['ministryname'];?>" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
						 </tr>
						 <tr>
						   <td><label for="nomdirectiong">Nom Direction Générale </label></td>
						   <td><input type="text" name="nomdirectiong" id="nomdirectiong" value="<?php echo $resultat['nomdirectiong'];?>" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
						   <td><label for="directoryname">Directory name: </label></td>
						   <td><input type="text" name="directoryname" id="directoryname" value="<?php echo $resultat['directoryname'];?>" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
						 </tr>

						 <tr>
						   <td><label for="nomresponsable">Nom Responsable </label></td>
						   <td><input type="text" name="nomresponsable" id="nomresponsable" value="<?php echo $resultat['nomresponsable'];?>" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
						   <td><label for="prenomresponsable">Prénom Responsable </label></td>
						   <td><input type="text" name="prenomresponsable" id="prenomresponsable" value="<?php echo $resultat['prenomresponsable'];?>" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
						   <td><label for="titreresponsable">Titre </label></td>
						   <td><input type="text" name="titreresponsable" id="titreresponsable" value="<?php echo $resultat['titreposte'];?>" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
							<td><label for="titreresponsableng">Titre en anglais </label></td>
						   <td><input type="text" name="titreresponsableng" id="titreresponsableng" value="<?php  if (isset($resultat['titreresponsableng'])) echo $resultat['titreresponsableng'] ;?>" onkeyup="this.value=this.value.toUpperCase()"  /> </td>

						 </tr>
						 <tr>
						   <td><label for="contactposte">Téléphone: </label></td>
						   <td><input type="tel" name="contactposte" id="contactposte" value="<?php echo $resultat['contactposte'];?>" /> </td>
						   <td><label for="faxpooste">Fax : </label></td>
						   <td><input type="tel" name="faxposte" id="faxposte" value="<?php echo $resultat['faxposte'];?>" /> </td>
						   <td><label for="emailposte">Email</label></td>
						   <td><input type="email" name="emailposte" id="emailposte" value="<?php echo $resultat['emailposte'];?>" onkeyup="this.value=this.value.toLowerCase()"  /> </td>
						 </tr>
						 
						 
						 
						 
						  

						 

						  </table>
						 </fieldset>
						  <script>
							// idport.value='<?php echo $resultat['idport']; ?>';
						  </script >
					<hr>
					 <input type="submit" name="valider" value="Enregistrer"  class="btn btn-primary" />
					 <input type="reset" value="Annuler" class="btn btn-danger" />

</form>

			</div>
		</div>
	</div>


<?php
}
$result->closeCursor();

?>

	<?php include "inc/app_footer.php";?>
</body>
  

</html>
