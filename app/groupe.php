<?php
include('session-verif.php');
include "ConnectionPOO.php";
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
                <form method="post" action="groupe_post.php">
 <a href="menup.php"><span class="glyphicon glyphicon-arrow-left"> Page précédente</span></a>    <br> 	  <br>
   <fieldset>
       <legend> <b>Informations sur les Groupes </b></legend> <!-- Titre du fieldset --> 
	<table>
	<tr>
       <td><label for="nomgroupe">Nom Groupe <span style="color:red"  > * </span></label></td>
       <td><input type="text" name="nomgroupe" id="nomgroupe" required="required"  onkeyup="this.value=this.value.toUpperCase()"   /> </td>
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
<tr> <td> <label for="statistique">Statistique par port de transit</label></td>
        <td><select name="statistique" id="statistique">
           <option value="O">Oui</option>
           <option value="N">Non</option>
		</select>  </td>  </tr>	
	<tr> <td> <label for="statistique">Statistique Consolidée </label></td>
        <td><select name="statistiquec" id="statistiquec">
           <option value="O">Oui</option>
           <option value="N">Non</option>
		</select>  </td>  </tr>	
	<tr> <td> <label for="decideur">Decideur </label></td>
        <td><select name="decideur" id="decideur">
           <option value="O">Oui</option>
           <option value="N">Non</option>
		</select>  </td>  </tr>
	<tr> <td> <label for="parametre">Paramètres </label></td>
        <td><select name="parametre" id="parametre">
           <option value="O">Oui</option>
           <option value="N">Non</option>
		</select>  </td>  </tr>
		<tr> <td> <label for="paramuser">Paramètres utilisateur</label></td>
        <td><select name="paramuser" id="paramuser">
           <option value="O">Oui</option>
           <option value="N">Non</option>
		</select>  </td>  </tr>
		<tr> <td> <label for="conversion">Accès à la table de conversion</label></td>
        <td><select name="conversion" id="conversion">
           <option value="O">Oui</option>
           <option value="N">Non</option>
		</select>  </td>  </tr>
		<tr> <td> <label for="FactavoirAp">Facture d'Avoir et Factures Autres prestations </label></td>
        <td><select name="FactavoirAp" id="FactavoirAp">
           <option value="O">Oui</option>
           <option value="N">Non</option>
		</select>  </td>  </tr>
		
     </table>
	 </fieldset>
 <table class="type2">
 <tr>
 <td> 
 <input type="submit" name ='valider' value="Enregistrer" class=" "  /></td>
 <td> <input type="reset" value="Annuler"  /></td>
 </tr>
</table>
</form>

                <hr>

                <?php

                echo '<table class="type1 table table-bordered"><thead> <tr> <th><strong>' . 'Code groupe'. '</strong> : </th>  <th>' . 'Nom groupe'.'</th> <th>'. 'Ajouter'. '</th> <th>' . 'Modifier'. '</th><th>'. 'Supprimer'. '</th><th>'. 'Gérer utilisateur'. '</th><th>'. 'Administrateur:'. '</th><th>'. 'Gérer facture'. '</th><th>'.'Statistique par poste'.'</th><th>' . 'Statistique consolidée'.'</th><th>'. 'Decideur consolidée'.'</th> <th>'. 'Pramètre'.'</th><th>'. 'Paramètre user'.'</th><th>'. 'Conversion'.'</th><th>'.'Facture Avoir'.'</th> </thead>' ;
                $reponse = $bdd->query('SELECT * FROM groupe ORDER BY nomgroupe ASC');

                // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
                while ($donnees = $reponse->fetch())
                { ?>
                    <tr> <td><strong><a href="groupem.php?id= <?php echo htmlspecialchars($donnees['idgroupe']); ?>"> <?php echo htmlspecialchars($donnees['idgroupe']); ?> </strong> </td>  
					<td> <?php echo htmlspecialchars($donnees['nomgroupe']); ?> </td> 
					<td> <?php echo htmlspecialchars($donnees['ajouter']); ?> </td>
					<td><?php echo htmlspecialchars($donnees['modifier']); ?></td>
					<td><?php echo htmlspecialchars($donnees['supprimer']); ?></td>
					<td> <?php echo htmlspecialchars($donnees['gereruser']); ?></td>
					<td><?php echo htmlspecialchars($donnees['administrateur']); ?></td>
					<td> <?php echo htmlspecialchars($donnees['gererfacture']); ?> </td>
					<td><?php echo htmlspecialchars($donnees['statistique']); ?></td>
					<td><?php echo htmlspecialchars($donnees['statistiquec']); ?></td>
					<td><?php echo htmlspecialchars($donnees['decideur']); ?></td>
					<td><?php echo htmlspecialchars($donnees['parametre']); ?></td> 
					<td><?php echo htmlspecialchars($donnees['paramuser']); ?></td> 
					<td><?php echo htmlspecialchars($donnees['conversion']); ?></td> 
					<td><?php echo htmlspecialchars($donnees['FactavoirAp']); ?></td>
					</tr>
                    <?php
                }


                $reponse->closeCursor();

                ?>
                </table>
            </div>
        </div>
    </div>


    <?php include "inc/app_footer.php";?>
</body>
  

</html>
