<?php
include('session-verif.php');
include "ConnectionPOO.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mise à jour des Produits</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="manifeste.css" />
        <link rel="stylesheet" href="css/mystyle.css" />
    </head>

<body>

    <?php include "inc/app_header.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" action="Produit.php" >
 <a href="menup.php"><span class="glyphicon glyphicon-arrow-left"> Page précédente</span></a>    <br> 	  <br>
   <fieldset>
       <legend> <b>Informations sur les  Produits</b></legend> <!-- Titre du fieldset --> 
	<table>
	      <td><label for="nomprod">Nom Produit * </label></td>
       <td><input type="text" name="nomprod" id="nomprod" required="required" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
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


                echo '<table class="type1"> <tr> <th><strong>' . 'Code Produit'. '</strong> : </th>  <th>' . 'Nom Produit'.'</th> '. '</tr> ' ;
                $reponse = $bdd->query('SELECT * FROM Produit ORDER BY nomprod');

                // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
                while ($donnees = $reponse->fetch())
                { ?>
                    <tr> <td><strong><a href="Produitm.php?id=<?php echo  htmlspecialchars($donnees['idprod']); ?>"> <?php echo  htmlspecialchars($donnees['idprod']); ?> </strong>  </td>  <td><?php echo  htmlspecialchars($donnees['nomprod']); ?>  </td></tr>
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
$req = $bdd->prepare('INSERT INTO Produit(nomprod) VALUES(?)');
$req->execute(array( $_POST['nomprod']));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}

// Redirection du visiteur vers la page du minichat
echo "Insérer avec succès";
header('Location: Produit.php');
}

?>

    <?php include "inc/app_footer.php";?>
</body>
  

</html>
