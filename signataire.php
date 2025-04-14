<?php
include('session-verif.php');
include "ConnectionPOO.php";
if ($_SESSION["administrateur"]="N")
	$idposte=$_SESSION["idposte"];
$reqposte = $bdd->query('SELECT * FROM  Poste');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mise à jour des Signataires</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="manifeste.css" />
        <link rel="stylesheet" href="css/mystyle.css" />
    </head>

<body>

    <?php include "inc/app_header.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" action="signataire.php" >
 <a href="menup.php"><span class="glyphicon glyphicon-arrow-left"> Page précédente</span></a>    <br> 	  <br>
   <fieldset>
       <legend> <b>Informations sur les signataires</b></legend> <!-- Titre du fieldset --> 
	<table>
	<tr>
	   <td><label for="nomprenom">Nom Prenom * </label></td>
       <td><input type="text" name="nomprenom" id="nomprenom" required="required" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
	</tr>
	<?php if ($_SESSION['administrateur']=='O') { ?>
						

				<tr><td><label for="idposte">Poste CBC <span style="color:red" > * </span></label></td>
				<td>  <select name="idposte" id="idposte" size=1 required="required" >
					<option value=""> Veuillez choisir le poste </option>
						<?php
					while ($donnees = $reqposte->fetch()) { ?>

					<option value= '<?php echo $donnees['idposte']; ?>'> <?php echo $donnees["libposte"];?></option> <?php  } ?>
					</select></td> </tr>

				<?php } ?>
			<tr><td> <label for="actif"> Actif(O/N)</label></td>
			<td><select name="actif" id="actif">
           <option value="N">Non</option>
           <option value="N">Oui</option>
			</select>  </td>
	</tr>
     </table>
	 </fieldset>
 <table class="type2">
 <tr>
 <td> 
 <input type="submit" name='valider'  value="Enregistrer" /></td>
 <td> <input type="reset" value="Annuler"  /></td>
 </tr>
</table>
</form>
                <hr>

                <?php


                echo '<table class="type1"> <tr> <th><strong>' . 'Code Signataire'. '</strong> : </th>  <th>' . "Nom  Signataire".'</th> '. '</tr> ' ;
                $reponse = $bdd->query('SELECT * FROM signataire ORDER BY nomprenom');

                // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
                while ($donnees = $reponse->fetch())
                { ?>
                    <tr> <td><strong><a href="signatairem.php?id=<?php echo  htmlspecialchars($donnees['idsignataire']); ?>"> <?php echo  htmlspecialchars($donnees['idsignataire']); ?> </strong>  </td>  <td><?php echo  htmlspecialchars($donnees['nomprenom']); ?>  </td></tr>
                <?php }


                $reponse->closeCursor();

                ?>
                </table>
            </div>
        </div>
    </div>



<?php
// Connexion à la base de données


if (isset($_POST['valider'])) {
// Insertion du message à l'aide d'une requête préparée
try{
$req = $bdd->prepare("INSERT INTO signataire(nomprenom,idposte,actif) VALUES(?,?,?)");
$nomprenom=addslashes($_POST['nomprenom']);
$actif=$_POST['actif'];
if ($_SESSION["administrateur"]=="O")
	$idposte=$_POST["idposte"];
$req->execute(array($nomprenom,$idposte));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}

// Redirection du visiteur vers la page du minichat
echo "Insérer avec succès";
header('Location: signataire.php');
}

?>

    <?php include "inc/app_footer.php";?>
</body>
  

</html>
