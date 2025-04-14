<?php
include('session-verif.php');
include "ConnectionPOO.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mise à jour des Domaines d'activités</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="manifeste.css" />
        <link rel="stylesheet" href="css/mystyle.css" />
    </head>

<body>

    <?php include "inc/app_header.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" action="domainea.php" >
 <a href="menup.php"><span class="glyphicon glyphicon-arrow-left"> Page précédente</span></a>    <br> 	  <br>
   <fieldset>
       <legend> <b>Informations sur les  Domaines d'activité</b></legend> <!-- Titre du fieldset --> 
	<table>
	      <td><label for="nomdomainea">Nom Domaine d'Activité * </label></td>
       <td><input type="text" name="nomdomainea" id="nomdomainea" required="required" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
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


                echo '<table class="type1"> <tr> <th><strong>' . 'Code Domaine'. '</strong> : </th>  <th>' . 'Nom Domaine dactivité'.'</th> '. '</tr> ' ;
                $reponse = $bdd->query('SELECT * FROM domainea ORDER BY nomdomainea');

                // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
                while ($donnees = $reponse->fetch())
                { ?>
                    <tr> <td><strong><a href="domaineam.php?id=<?php echo  htmlspecialchars($donnees['iddomainea']); ?>"> <?php echo  htmlspecialchars($donnees['iddomainea']); ?> </strong>  </td>  <td><?php echo  htmlspecialchars($donnees['nomdomainea']); ?>  </td></tr>
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
$req = $bdd->prepare('INSERT INTO domainea(nomdomainea) VALUES(?)');
$req->execute(array( $_POST['nomdomainea']));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}

// Redirection du visiteur vers la page du minichat
echo "Insérer avec succès";
header('Location: domainea.php');
}

?>

    <?php include "inc/app_footer.php";?>
</body>
  

</html>
