<?php
include('session-verif.php');
include "ConnectionPOO.php";

try {
$id = $_GET['id'];
$result = $bdd->query("SELECT * FROM groupe where idgroupe='$id'");}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}

while ($resultat= $result->fetch()){
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mise à jour des Groupes</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="manifeste.css" />
        <link rel="stylesheet" href="css/mystyle.css" />
    </head>

<body>
    <?php include "inc/app_header.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" action="groupem_post.php">
 <a href="menup.php"><span class="glyphicon glyphicon-arrow-left"> Page précedente</span></a>    <br> 	  <br>
   <fieldset>
       <legend> <b>Informations sur les Groupes </b></legend> <!-- Titre du fieldset --> 
	<table>
	<tr>
       <td><label for="nomgroupe">Nom Groupe </label></td>
       <td><input type="text" name="nomgroupe" id="nomgroupe" value="<?php echo $resultat['nomgroupe']; ?>"  onkeyup="this.value=this.value.toUpperCase()"   /> </td>
	 </tr>
	 <tr>
	 
	<td> <label for="ajouter">Ajouter </label></td>
     <td>  <select name="ajouter" id="ajouter">
           <option value="O">Oui</option>
           <option value="N">Non</option>
       </select> </td>
	 </tr>
	 	 <tr>
	 <td> <label for="modifier">Modifier </label></td>
    <td><select name="modifier" id="modifier">
            <option value="O">Oui</option>
           <option value="N">Non</option>
       </select> </td>
	 </tr>	
	 <tr> <td> <label for="supprimer">Supprimer </label></td>
        <td><select name="supprimer" id="supprimer">
           <option value="O">Oui</option>
           <option value="N">Non</option>
		</select>  </td>  </tr>
		
	<tr> <td> <label for="gereruser">Gérer utilistateur </label></td>
        <td><select name="gereruser" id="gereruser">
           <option value="O">Oui</option>
           <option value="N">Non</option>
		</select>  </td>  </tr>	
	<tr> <td> <label for="administrateur">Administrateur </label></td>
        <td><select name="administrateur" id="administrateur">
           <option value="O">Oui</option>
           <option value="N">Non</option>
		</select>  </td>  </tr>	
	<tr> <td> <label for="gererfacture">Gérer les factures </label></td>
        <td><select name="gererfacture" id="gererfacture">
           <option value="O">Oui</option>
           <option value="N">Non</option>
		</select>  </td>  </tr>	
<tr> <td> <label for="statistique">Statistique par poste </label></td>
        <td><select name="statistique" id="statistique">
           <option value="O">Oui</option>
           <option value="N">Non</option>
		</select>  </td>  </tr>	
		<tr> <td> <label for="statistique">Statistique consolidée </label></td>
        <td><select name="statistiquec" id="statistiquec">
           <option value="O">Oui</option>
           <option value="N">Non</option>
		</select>  </td>  </tr>	
		<tr> <td> <label for="decideur">Décideur </label></td>
        <td><select name="decideur" id="decideur">
           <option value="O">Oui</option>
           <option value="N">Non</option>
		</select>  </td>  </tr>	
		<tr> <td> <label for="parametre">Paramètre </label></td>
        <td><select name="parametre" id="parametre">
           <option value="O">Oui</option>
           <option value="N">Non</option>
		</select>  </td>  </tr>	
		<tr> <td> <label for="paramuser">Paramètre utilisateur </label></td>
        <td><select name="paramuser" id="paramuser">
           <option value="O">Oui</option>
           <option value="N">Non</option>
		</select>  </td>  </tr>	
		<tr> <td> <label for="conversion">Table de conversion de la monnaie </label></td>
        <td><select name="conversion" id="conversion">
           <option value="O">Oui</option>
           <option value="N">Non</option>
		</select>  </td>  </tr>	
		<tr> <td> <label for="FactavoirAp">Facture d'Avoir et Factures Autres prestations </label></td>
        <td><select name="FactavoirAp" id="FactavoirAp">
           <option value="O">Oui</option>
           <option value="N">Non</option>
		</select>  </td>  </tr>
		
		  <tr> 
		   <td><input type="hidden" name="idgroupe" id="idgroupe" value="<?php echo $resultat['idgroupe']; ?>" /> </td>
		 </tr>
		 <script>
	
		ajouter.value='<?php echo $resultat['ajouter']; ?>';
		modifier.value='<?php echo $resultat['modifier']; ?>';
		supprimer.value='<?php echo $resultat['supprimer']; ?>';
		gereruser.value='<?php echo $resultat['gereruser']; ?>';
		administrateur.value='<?php echo $resultat['administrateur']; ?>';
		gererfacture.value='<?php echo $resultat['gererfacture']; ?>';
		statistique.value='<?php echo $resultat['statistique']; ?>';
		statistiquec.value='<?php echo $resultat['statistiquec']; ?>';
		decideur.value='<?php echo $resultat['decideur']; ?>';
		parametre.value='<?php echo $resultat['parametre']; ?>';
		paramuser.value='<?php echo $resultat['paramuser']; ?>';
		conversion.value='<?php echo $resultat['conversion']; ?>';
		FactavoirAp.value='<?php echo $resultat['FactavoirAp']; ?>';
	  </script >
		
		
     </table>
	 </fieldset>
 <table class="type2">
 <tr>
 <td> 
 <input type="submit" name ='modification' value="Enregistrer"  /></td>
 <td> <input type="submit"  name ='supprimer' value="Supprimer"  /></td>
 </tr>
</table>
</form>
            </div>
        </div>
    </div>

<?php
}
$result->closeCursor();

?>

</table>
    <?php include "inc/app_footer.php";?>
</body>
  

</html>
