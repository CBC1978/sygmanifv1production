<?php
include('session-verif.php');
include "ConnectionPOO.php";
try {
$id = $_GET['id'];
$result = $bdd->query("SELECT * FROM domainea where iddomainea='$id'");}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}

while ($resultat= $result->fetch()){

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Modification des Domaines d'activité</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="manifeste.css" />
        <link rel="stylesheet" href="css/mystyle.css" />
    </head>

<body>
    <?php include "inc/app_header.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" action="domaineam_post.php" >
 <a href="menup.php">Retour au menu précédent</a>    <br> 	  <br>
   <fieldset>
       <legend> <b>Informations sur les  Domaines d'activité</b></legend> <!-- Titre du fieldset --> 
	<table>
	      <td><label for="nomdomainea">Nom Domaine d'activité  </label></td>
       <td><input type="text" name="nomdomainea" id="nomdomainea" value="<?php echo $resultat['nomdomainea'];?>"  onkeyup="this.value=this.value.toUpperCase()"  /> </td>
	    
	 </tr>
	  <tr>
	 <td><input type="hidden" name="iddomainea" id="iddomainea" value="<?php echo $resultat['iddomainea'];?>"   /> </td>
	  </tr>
     </table>
	 </fieldset>
 <table class="type2">
 <tr>
 <td> 
 <input type="submit" name='modifier'  value="Modifier" /></td>
 <td> <input type="submit"  name="supprimer" value="Supprimer"  /></td>
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
    <?php include "inc/app_footer.php";?>
</body>
  

</html>
