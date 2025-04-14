<?php
include('session-verif.php');
include "ConnectionPOO.php";
if ($_SESSION['administrateur']='N')
$idposte=$_SESSION['idposte'];

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
                <form method="post" action="transitaire.php" >
 <a href="menup.php"><span class="glyphicon glyphicon-arrow-left"> Page précédente</span></a>    <br> 	  <br>
   <fieldset>
       <legend> <b>Informations sur Transitaires</b></legend> <!-- Titre du fieldset --> 
	<table>
	      <td><label for="nomtransitaire">Nom Transitaire * </label></td>
       <td><input type="text" name="nomtransitaire" id="nomtransitaire" required="required" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
	 </tr>
     </table>
	 </fieldset>
 <table class="type2">
 <tr>
 <td> 
 <input type="submit" name='valider'  value="Enregistrer" /></td>
 <td> <input type="reset" value="Annuler"  /></td>
 <td><a href="imprimetrans.php"><span class="fa fa-edit ">  </span> Imprimer la liste</a></td>
 </tr>
</table>
</form>
                <hr>

                <?php


                echo '<table class="type1"> <tr> <th><strong>' . 'Code Transitaire'. '</strong> : </th>  <th>' . 'Nom Transitaire'.'</th> '. '</tr> ' ;
                $reponse = $bdd->query("SELECT * FROM transitaire where idposte='$idposte' ORDER BY nomtransitaire");

                // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
                while ($donnees = $reponse->fetch())
                { ?>
                    <tr> <td><strong><a href="transitairem.php?id=<?php echo  htmlspecialchars($donnees["idtransitaire"]); ?>"> <?php echo  htmlspecialchars($donnees['idtransitaire']); ?> </strong>  </td>  <td><?php echo  htmlspecialchars($donnees['nomtransitaire']); ?>  </td></tr>
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
$nomtransitaire=addslashes($_POST["nomtransitaire"]);

// Insertion du message à l'aide d'une requête préparée
try{
$req = $bdd->prepare("INSERT INTO transitaire(nomtransitaire,idposte) VALUES(?,?)");
$req->execute(array($nomtransitaire,$idposte));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}

// Redirection du visiteur vers la page du minichat
echo "Insérer avec succès";
header('Location: transitaire.php');
}

?>

    <?php include "inc/app_footer.php";?>
</body>
  

</html>
