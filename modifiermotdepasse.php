<?php
include('session-verif.php');
include "ConnectionPOO.php";

try {
$id = $_SESSION['iduser'];
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
        <title>Modification du mot de passe</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="manifeste.css" />
        <link rel="stylesheet" href="css/mystyle.css" />
    </head>

<body>
    <?php include "inc/app_header.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" action="modifiermotdep_post.php">
 <a href="menup.php"><span class="glyphicon glyphicon-arrow-left"> Page précedente</span></a>    <br> 	  <br>
   <fieldset>
       <legend> <b>Informations sur l'utilisateur </b></legend> <!-- Titre du fieldset --> 
	<table>
	<tr>
       <td><label for="iduser">Login</label></td>
       <td><input type="text" disabled='true' name="iduser" id="iduser" value="<?php echo $resultat['iduser']; ?>"   /> </td>
	 </tr>
	 <tr>
	 
	<td> <label for="motdepasse">Nouveau mot de passe(Minumum 6 caractères) </label></td>
     <td>  <input type="password" name="motdepasse" id="motdepasse" required="required" /> </td>
     </tr><tr>
	<td> <label for="motdepassec">Confirmer mot de passe </label></td>
     <td>  <input type="password" name="motdepassec" required="required" id="motdepassec" /> </td>
     <td><input type="hidden"  name="iduser1" id="iduser1" value="<?php echo $resultat['iduser']; ?>"   /> </td>

	 </tr>
	
		
		
		
     </table>
	 </fieldset>
 <table class="type2">
 <tr>
 <td> 
 <input type="submit" name ='valider' value="Enregistrer"  /></td>
 
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
