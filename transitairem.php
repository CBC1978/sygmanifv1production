<?php
include('session-verif.php');
include "ConnectionPOO.php";
try {
$id = $_GET['id'];
$result = $bdd->query("SELECT * FROM transitaire where idtransitaire='$id'");}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}

while ($resultat= $result->fetch()){

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mise à jour des Transitaires</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="manifeste.css" />
        <link rel="stylesheet" href="css/mystyle.css" />
    </head>

<body>
    <?php include "inc/app_header.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" action="transitairem_post.php" >
 <a href="menup.php">Retour au menu précédent</a>    <br> 	  <br>
   <fieldset>
       <legend> <b>Informations sur les  Types Transitaires</b></legend> <!-- Titre du fieldset --> 
	<table>
	      <td><label for="nomtransitaire">Nom Transitaire  </label></td>
       <td><input type="text" name="nomtransitaire" id="nomtransitaire" value="<?php echo $resultat['nomtransitaire'];?>"  onkeyup="this.value=this.value.toUpperCase()"  /> </td>
	    
	 </tr>
	  <tr>
	 <td><input type="hidden" name="idtransitaire" id="idtransitaire" value="<?php echo $resultat['idtransitaire'];?>"   /> </td>
	  </tr>
     </table>
	 </fieldset>
 <table class="type2">
 <tr>
 <td> 
 <input type="submit" name='modifier'  value="Modifier" /></td>
 <td> <input type="submit"  name='supprimer' value="Supprimer"  /></td>
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
