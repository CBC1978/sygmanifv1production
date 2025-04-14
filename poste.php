
<?php
include('session-verif.php');
include "ConnectionPOO.php";

// recuperation de la liste des chargeurs

$listePostes=$bdd->query( "SELECT * FROM poste ORDER BY idposte ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Mise à jour des Postes</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="manifeste.css" />
    <link rel="stylesheet" href="css/mystyle.css" />

    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.js"></script>
</head>

<body>
<?php include "inc/app_header.php"; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <form method="post" action="poste_post.php">
                <a href="menup.php"><span class="glyphicon glyphicon-arrow-left"> Page précédente</span></a>    <br> 	  <br>
                <fieldset>
                    <legend><b>Informations sur le Poste</b></legend> <!-- Titre du fieldset -->
                    <table class="champ-table">
                        <tr>
                            <td><label for="libposte">Nom du Poste: <span style="color:red" > * </span></label></td>
                            <td><input type="text" name="libposte" id="libposte" required="required"  onkeyup="this.value=this.value.toUpperCase()"  /> </td>
                            <td><label for="exercice">Exercice <span style="color:red" > * </span></label></td>
                            <td><input type="number" name="exercice" id="exercice" required="required" /> </td>
                           
                        </tr>
                        <tr>
                            <td><label for="nomsite">Nom du site  <span style="color:red" > <span style="color:red" > * </span> </span></label></td>
                            <td><input type="text" name="nomsite" id="nomsite" required="required" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
                            <td><label for="sitename">Site name: <span style="color:red" > * </span></label></td>
                            <td><input type="text" name="sitename" id="sitename" required="required" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
                            <td><label for="emailposte">Email<span style="color:red" > * </span></label></td>
                            <td><input type="email" name="emailposte" id="emailposte" required="required" onkeyup="this.value=this.value.toLowerCase()"  /> </td>

                        </tr>
                        <tr>
                            <td><label for="pays">Pays  <span style="color:red" > * </span></label></td>
                            <td><input type="text" name="pays" id="pays" required="required" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
                            <td><label for="adresse">Adresse: <span style="color:red" > * </span></label></td>
                            <td><input type="text" name="adresse" id="adresse" required="required" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
                        </tr>
                        <tr>
                            <td><label for="nomministere">Nom ministère <span style="color:red" > * </span></label></td>
                            <td><input type="text" name="nomministere" id="nomministere" required="required" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
                            <td><label for="ministryname">Ministry name: <span style="color:red" > * </span></label></td>
                            <td><input type="text" name="ministryname" id="ministryname" required="required" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
                        </tr>
                        <tr>
                            <td><label for="nomdirectiong">Nom Direction Générale <span style="color:red" > * </span></label></td>
                            <td><input type="text" name="nomdirectiong" id="nomdirectiong" required="required" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
                            <td><label for="directoryname">Directory name: <span style="color:red" > * </span></label></td>
                            <td><input type="text" name="directoryname" id="directoryname" required="required" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
                        </tr>

                        <tr>
                            <td><label for="nomresponsable">Nom Responsable <span style="color:red" > * </span></label></td>
                            <td><input type="text" name="nomresponsable" id="nomresponsable" required="required" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
                            <td><label for="prenomresponsable">Prénom Responsable <span style="color:red" > * </span></label></td>
                            <td><input type="text" name="prenomresponsable" id="prenomresponsable" required="required" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
							 <td><label for="titreresponsable">Titre <span style="color:red" > * </span></label></td>
                            <td><input type="text" name="titreresponsable" id="titreresponsable" required="required" onkeyup="this.value=this.value.toUpperCase()"  /> </td>
							<td><label for="titreresponsableng">Titre en anglais <span style="color:red" > * </span></label></td>
                            <td><input type="text" name="titreresponsableng" id="titreresponsableng" required="required" onkeyup="this.value=this.value.toUpperCase()"  /> </td>

                        </tr>
                        <tr>
                            <td><label for="contactposte">Téléphone: <span style="color:red" > * </span></label></td>
                            <td><input type="tel" name="contactposte" id="contactposte" required="required" /> </td>
                            <td><label for="faxposte">Fax : <span style="color:red" > * </span></label></td>
                            <td><input type="tel" name="faxposte" id="faxposte" required="required" /> </td>
                        </tr>
					<!--	<tr>
                            <td><label for="monnaie">Nom Monnaie utilisée: <span style="color:red" > * </span></label></td>
                            <td><input type="text" name="monnaie" id="monnaie" required="required" /> </td>
                            <td><label for="Autremonnaie">Nom Autre monnaie utilisée : </label></td>
                            <td><input type="text" name="Autremonnaie" id="Autremonnaie"  /> </td>
						                       	
						</tr>
						
						
                        <tr>
                            <td><label for="tauxcommi">Taux Commision Import: <span style="color:red" > * </span></label></td>
                            <td><input type="number" step='any' name="tauxcommi" id="tauxcommi" required="required" /> </td>
                            <td><label for="tauxcomme">Taux Commission Export : <span style="color:red" > * </span></label></td>
                            <td><input type="number" step='any'  name="tauxcomme" id="tauxcomme" required="required" /> </td>
							-->	
                            <?php

                          //  $req = $bdd->query('SELECT * FROM port order by nomport');
                            ?>
							
							<!--
                            <td><label for="idport">Port  <span style="color:red" > * </span></label></td>
                            <td>  <select name="idport" size=1  class="selectpicker bs-select-hidden" data-live-search="true">
                                    <option value=""> Veuillez choisir le Port de Transit</option>
                                    <?php
                                   // while ($donnees = $req->fetch()) {
                                        ?>
                                    <option value="<?php //echo $donnees['idport'];?>"> <?php // echo $donnees['nomport']; ?></option><?php // } ?>
                                </select></td> -->
                        

                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <input type="submit" value="Enregsitrer"  class="btn btn-primary"/></td>
                            <td> <input type="reset" value="Annuler" class="btn btn-danger" /></td>
                        </tr>
                    </table>
                </fieldset>

            </form>
        </div>

    </div>
    <hr>

    <!-- AFFICHAGE DES DONNÉES  -->
    <div class="row">
        <div class="col-lg-12 table-responsive ">

            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th>Code poste</th>
                        <th>Nom poste</th>
                        <th>Nom </th>
                        <th>Prénom</th>
                        <th>Contact</th>
                        <th>Fax</th>
                        <th>Email: </th>
                        <th>Titre: </th>
                        <th>Exercice</th>
                       
                        <th>Nom ministère </th>
                        <th>Ministry name</th>
                        <th>Nom direction </th>
                        <th>Directory name</th>
                        <th>Nomsite </th>
                        <th>Site name</th>
                        <th>Pays</th>
                        <th>Adresse</th>
						
                    </tr>
                </thead>
                <tbody>
                <?php

                while ($donnees = $listePostes->fetch())
                { ?>
                    <tr> <td><strong><a href="postem.php?id= <?php echo  $donnees['idposte']; ?>" > </strong> <?php echo  htmlspecialchars($donnees['idposte']); ?><span class="fa fa-pencil fa-fw ">  </span>  </a></td>  </td>  
					<td><?php echo  htmlspecialchars($donnees['libposte']); ?> </td> <td><?php echo htmlspecialchars($donnees['nomresponsable']); ?> </td> <td>
                            <?php echo htmlspecialchars($donnees['prenomresponsable']); ?>  </td>
							<td> <?php echo htmlspecialchars($donnees['contactposte']); ?>  </td>
							<td> <?php echo htmlspecialchars($donnees['faxposte']) ; ?> </td>
							<td> <?php echo htmlspecialchars($donnees['emailposte']); ?>  </td>
							<td> <?php echo htmlspecialchars($donnees['titreposte']); ?>  </td> 
							<td> <?php echo htmlspecialchars($donnees['posteexercice']); ?> </td> 
							<td><?php echo htmlspecialchars($donnees['nomministere']); ?>  </td>
							<td><?php echo htmlspecialchars($donnees['ministryname']); ?>  </td>
							<td><?php echo htmlspecialchars($donnees['nomdirectiong']); ?>  </td>
							<td> <?php echo htmlspecialchars($donnees['directoryname']); ?>  </td>
							<td><?php echo htmlspecialchars($donnees['nomsite']) ; ?> </td> 
							<td> <?php echo htmlspecialchars($donnees['sitename']); ?>  </td>
							<td><?php echo htmlspecialchars($donnees['pays']); ?>  </td> 
							<td> <?php echo htmlspecialchars($donnees['adresseposte']); ?>  </td>
							
							
							
							</tr>

                    <?php
                }
                $listePostes->closeCursor();

                ?>
                </tbody>
            </table>

        </div>
    </div>



</div>
<?php include "inc/app_footer.php";?>
</body>


</html>
