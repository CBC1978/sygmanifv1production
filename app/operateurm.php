
<?php
include('session-verif.php');
include "ConnectionPOO.php";

try {
    $id = $_GET['id'];
    $result = $bdd->query("SELECT * FROM operateur where idop=$id");}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
$reqtype = $bdd->query("SELECT * FROM typeop  ORDER BY nomtypeop");
//$reqdom = $bdd->query('SELECT * FROM domainea ORDER BY nomdomainea'); //

while ($resultat= $result->fetch()) {
// recuperation de la liste des operateurs


    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8"/>
        <title>Mise à jour des operateurs</title>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
        <link rel="stylesheet" href="css/font-awesome.min.css"/>
        <link rel="stylesheet" href="manifeste.css"/>
        <link rel="stylesheet" href="css/mystyle.css"/>
    </head>

    <body>
    <?php include "inc/app_header.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" action="operateurm_post.php" style="padding-top: 20px;">
                    <a href="menup.php" class="">Retour au menu précédent</a>
                    <fieldset>
                        <legend><h3>Informations sur les operateurs</h3></legend> <!-- Titre du fieldset -->
						<table class="champ-table">
                            <tr>
                                <td><label for="nomope">Raison sociale: <span style="color:red" > * </span></label></td>
                                <td><input type="text" name="nomope" id="nomope" value="<?php echo $resultat['nomope']; ?>" maxlength="50" onkeyup="this.value=this.value.toUpperCase()"  class="form-control "/> </td>
								<td><label for="nomabrege">Nom abrégé: <span style="color:red" >  </span></label></td>
                                <td><input type="text" name="nomabrege" id="nomabrege" maxlength="20" value="<?php echo $resultat['nomabrege']; ?>" onkeyup="this.value=this.value.toUpperCase()"  class="form-control "/> </td>
                   			 
						  </tr>
						  <tr>
                                <td><label for="statut">Statut: <span style="color:red" >  </span></label></td>
                                <td><input type="text" name="statut" id="statut" maxlength="15" value="<?php echo $resultat['statut']; ?>" onkeyup="this.value=this.value.toUpperCase()"  class="form-control "/> </td>
                         
                                <td><label for="siteweb">Site web: <span style="color:red" >  </span></label></td>
                                <td><input type="text" name="siteweb" id="siteweb" maxlength="20" value="<?php echo $resultat['siteweb']; ?>"
						  </tr>
						  <tr>
                                <td><label for="boitep">B P: <span style="color:red" >  </span></label></td>
                                <td><input type="text" name="boitep" id="boitep" maxlength="10" value="<?php echo $resultat['boitep']; ?>" onkeyup="this.value=this.value.toUpperCase()"  class="form-control "/> </td>
                         
                                <td><label for="region">Région: <span style="color:red" >  </span></label></td>
                                <td><input type="text" name="region" id="region" maxlength="20" value="<?php echo $resultat['region']; ?>"  class="form-control "/> </td>
								<td><label for="province">Province: <span style="color:red" >  </span></label></td>
                                <td><input type="text" name="province" id="province" maxlength="30" value="<?php echo $resultat['province']; ?>" class="form-control "/> </td>
                         
						  </tr>
						  
						  
						  
						  <tr>
                                <td><label for="numeroifu">Numéro IFU: <span style="color:red" >  </span></label></td>
                                <td><input type="text" name="numeroifu" id="numeroifu" maxlength="15" value="<?php echo $resultat['numeroifu']; ?>" onkeyup="this.value=this.value.toUpperCase()"  class="form-control "/> </td>
                          
                                <td><label for="anneecreation">Année de Création : <span style="color:red" >  </span></label></td>
                                <td><input type="number" name="anneecreation" id="anneecreation" value="<?php echo $resultat['anneecreation']; ?>" maxlength="4"   class="form-control "/> </td>
								<td><label for="effectif">Effectif : <span style="color:red" >  </span></label></td>
                                <td><input type="number" name="effectif" id="effectif" maxlength="4" value="<?php echo $resultat['effectif']; ?>"  class="form-control "/> </td>
                     

						 </tr>
						  
						  <tr>
						  <td><label for="idtypeop">Type d'opérateur <span style="color:red" > * </span></label></td>
							<td>  <select class="selectpicker" data-live-search="true" name="idtypeop" id="idtypeop" size=1 >
                                <option value=""> Veuillez choisir le Type d'opérateur </option>
                                <?php
                                while ($donnees = $reqtype->fetch()) {
                                    echo '<option value="';
                                    echo $donnees["idtypeop"];
                                    echo '"> ';
                                    echo $donnees["nomtypeop"];
                                    echo '</option>';
                                }
                                echo "	</select></td>";
                                ?>

			  
						   </tr>
						   <script>
							idtypeop.value='<?php echo $resultat['idtypeop'];?>';
							</script>
						   
                            <tr>

                                <td> <label for="adresse">Adresse <span style="color:red" > * </span></label> </td>
                                <td><input type="text" name="adresseop" id="adresseop" value="<?php echo $resultat['adresseop']; ?>" maxlength="50"  onkeyup="this.value=this.value.toUpperCase()" class="form-control " /> </td>
                            </tr>
                            <tr>
                                <td><label for="telephone1">Téléphone 1<span style="color:red" > * </span></label></td>
                                <td><input type="tel" name="telephoneop1" id="telephoneop1" value="<?php echo $resultat['telephoneop1']; ?>" maxlength="15"  class="form-control "/> </td>
								 <td><label for="telephone2">Téléphone 2<span style="color:red" >  </span></label></td>
                                <td><input type="tel" name="telephoneop2" id="telephoneop2" value="<?php echo $resultat['telephoneop2']; ?>" maxlength="15"  class="form-control "/> </td>
								<td><label for="telephone3">Téléphone 3<span style="color:red" >  </span></label></td>
                                <td><input type="tel" name="telephoneop3" id="telephoneop3" value="<?php echo $resultat['telephoneop3']; ?>" maxlength="15"  class="form-control "/> </td>
                            </tr>
                            <tr>
                                <td> <label for="fax">Fax </label> </td>
                                <td><input type="tel" name="faxop" id="faxop" value="<?php echo $resultat['faxop']; ?>" maxlength="15" class="form-control "/> </td>
                            </tr>
                            <tr>
                                <td> <label for="email">Email 1 <span style="color:red" > * </span></label> </td>
                                <td><input type="email" name="emailop1" id="emailop1" value="<?php echo $resultat['emailop1']; ?>"  maxlength="40"  class="form-control "/> </td>
								<td> <label for="email">Email 2 <span style="color:red" > </span></label> </td>
                                <td><input type="email" name="emailop2" id="emailop2" value="<?php echo $resultat['emailop2']; ?>" maxlength="40"   class="form-control "/> </td>
							 </tr>
                            <tr>
                                <td> <label for="ville">Ville: <span style="color:red" > * </span></label> </td>
                                <td><input type="text" name="villeop" id="villeop" value="<?php echo $resultat['villeop']; ?>" maxlength="20" onkeyup="this.value=this.value.toUpperCase()" class="form-control " /> </td>
								<td> <label for="ville">Localisation Géographique: <span style="color:red" > * </span></label> </td>
                                <td><input type="text" name="localisationgeo" id="localisationgeo" value="<?php echo $resultat['localisationgeo']; ?>" maxlength="100" onkeyup="this.value=this.value.toUpperCase()" class="form-control " /> </td>
                       
                            </tr>
                            <tr>
                                <td> <label for="pays">Pays: </label> </td>
                                <td><input type="text" name="paysop" id="paysop" value="<?php echo $resultat['paysop']; ?>" maxlength="20" onkeyup="this.value=this.value.toUpperCase()"  class="form-control "/> </td>
                            </tr>
							<tr>
                                <td> <label for="pays">Personne de Contact: </label> </td>
                                <td><input type="text" name="personnedecontact" id="personnedecontact" value="<?php echo $resultat['personnedecontact']; ?>" maxlength="80" onkeyup="this.value=this.value.toUpperCase()"  class="form-control "/> </td>
                             </tr>
							 <tr>
                               	<td>
                                    <input type="hidden" name="idop"
                                           value="<?php echo $resultat['idop']; ?>" class="form-control"/>
                                </td>
							</tr>
							 
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" value="Enregistrer" class="btn btn-primary" />
                                </td>
                                <td>
                                    <input type="reset" value="Annuler"  class="btn btn-danger"/>
                                </td>	
														
                                  
                            </tr>
							
                        </table>
					  
                    </fieldset>
				
                </form>
            </div>

        </div>

        <!-- AFFICHAGE DES DONNÉES  -->


    </div>
    <?php include "inc/app_footer.php"; ?>
    </body>
	

    </html>
    <?php
}
$result->closeCursor();