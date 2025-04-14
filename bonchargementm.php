
<?php
include('session-verif.php');
include "ConnectionPOO.php";

try {
    $id = $_GET['id'];
    $result = $bdd->query("SELECT b.* FROM bonchargement b, transitaire t
	where b.idtransitaire=t.idtransitaire and  idbon=$id");}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
//$reqtype = $bdd->query("SELECT * FROM typeop  ORDER BY nomtypeop");
$reqtrans = $bdd->query('SELECT * FROM transitaire ORDER BY nomtransitaire'); //

while ($resultat= $result->fetch()) {
// recuperation de la liste des Bons


    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8"/>
        <title>Mise à jour des bons de chargement</title>
         <meta name="viewport" content="width=device-width ,initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
		<link rel="stylesheet" href="manifeste.css" />
		<link rel="stylesheet" href="css/mystyle.css" />
		<link rel="stylesheet" href="style.css" />
		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/moment.min.js"></script>
		<script src="js/bootstrap-datetimepicker.min.js"></script>
		<link rel="stylesheet" href="controlesaisie.css" />
		<link rel="stylesheet" typePreview post="text/css" href="js/demos.css">
		<link rel="stylesheet" type="text/css" href="js/jquery-ui.css">
		<script src="js/jquery-1.5.1.js"></script>
		<script src="js/jquery.ui.core.js"></script>
		<script src="js/jquery.ui.widget.js"></script>
		<script src="js2/code.jquery.com_jquery-1.10.2.js"></script>
		<script src="js2/code.jquery.com_ui_1.11.4_jquery-ui.js"></script>
	<script>
        $(function () {
            $("#datepicker").datepicker({
                changeMonth: true,
                changeYear: true
            });
            $("#datepicker1").datepicker({
                changeMonth: true,
                changeYear: true
            });
            $("#datepicker2").datepicker({
                changeMonth: true,
                changeYear: true
            });
        });


    </script>
	
	</head>

    <body>
    <?php include "inc/app_header.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" action="bonchargementm_post.php" style="padding-top: 20px;">
                    <a href="menup.php" class="">Retour au menu précédent</a>
                                          
						<table class="champ-table">
						<tr>
							<td>
								<label for="typec">Choisir la nationalité du camion?</label></td>
							<td>  <select name="typec" id="typec">
									<option value="Burkinabe">Burkinabè</option>
									<option value="Togolaise">Togolaise</option>
									<option value="Ghanaeene">Ghanaeene</option>
									<option value="Beninoise">Beninoise</option>
									<option value="Ivoirienne">Ivoirienne</option>
									<option value="Mali">Mali</option>
									<option value="Senegal">Senegal</option>
									<option value="Ivoirienne">Niger</option>
								</select>
							</td>
						</tr>
						
						
						<tr>
                                <td><label for="numerovehicule">Immatriculation Véhicule: <span style="color:red" > </span></label></td>
                                <td><input type="text" name="numerovehicule" id="numerovehicule" value="<?php echo $resultat['numerovehicule']; ?>" maxlength="50"  onkeyup="this.value=this.value.toUpperCase()"  class="form-control "/> </td>
                                                        
                          </tr>
						  
						  <tr>
                                <td><label for="nomchaufeur">Conducteur: <span style="color:red" >  </span></label></td>
                                <td><input type="text" name="nomchaufeur" id="nomchaufeur"  maxlength="60" value="<?php echo $resultat['nomchaufeur']; ?>" onkeyup="this.value=this.value.toUpperCase()"  class="form-control "/> </td>
                                                        
                          </tr>
						  
						  <tr>
						  <td><label for="idtransitaire">Transitaire <span style="color:red" >  </span></label></td>
							<td>  <select  name="idtransitaire" id="idtransitaire" size=1  >
                                <option value=""> Veuillez choisir le transitaire</option>
                                <?php
                                while ($donnees = $reqtrans->fetch()) {
                                    echo '<option value="';
                                    echo $donnees["idtransitaire"];
                                    echo '"> ';
                                    echo $donnees["nomtransitaire"];
                                    echo '</option>';
                                }
                                echo "	</select></td>";
                                ?>
							</tr>
						  
						   <tr>
                                <td><label for="marchandise">Nature de la marchandise: <span style="color:red" > </span></label></td>
                                <td><input type="text" name="marchandise" id="marchandise" value="<?php echo $resultat['marchandise']; ?>" maxlength="80"  onkeyup="this.value=this.value.toUpperCase()"  class="form-control "/> </td>
                         </tr>
						  <tr>
                                <td><label for="poids">Poids estimatif des M/ses en KG: <span style="color:red" >  </span></label></td>
                                <td><input type="number"   step="any"  name="poids" id="poids" value="<?php echo $resultat['poids']; ?>" class="form-control "/> </td>
                           </tr>
						  <tr>
                                <td><label for="nbrecolis">Nombre de colis <span style="color:red" >  </span></label></td>
                                <td><input type="number" name="nbrecolis" id="nbrecolis" value="<?php echo $resultat['nbrecolis']; ?>"   class="form-control "/> </td>
							</tr>
                                <td><label for="nomdestinataire">Destinataire: <span style="color:red" >  </span></label></td>
                                <td><input type="text" name="nomdestinataire" id="nomdestinataire" value="<?php echo $resultat['nomdestinataire']; ?>"  maxlength="80" onkeyup="this.value=this.value.toUpperCase()"   class="form-control "/> </td>
							</tr>
						   <tr>
								<td><label for="adresse">Adresse: <span style="color:red" >  </span></label></td>
                                <td><input type="text" name="adresse" id="adresse" value="<?php echo $resultat['adresse']; ?>" maxlength="80" onkeyup="this.value=this.value.toUpperCase()"   class="form-control "/> </td>
                           </tr>
						   <tr>
                                <td><label for="datebon">Date bon <span style="color:red" >  </span></label></td>
                                <td><input  name="datebon" id="datepicker" value="<?php echo $resultat['datebon']; ?>"   class="form-control "/> </td>
							<td><input type="hidden" name="idbon" id="idbon" value="<?php echo $resultat['idbon']; ?>"   class="form-control "/> </td>
						  </tr>
						   
                            <tr>
                                <td></td>
								<?php	if ($_SESSION['ajouter']=='O') { ?>
                                <td>
                                    <input type="submit" value="Enregistrer" class="btn btn-primary" />
                                </td>
								<?php	} ?>
															
                                  
                            </tr>
                        </table>
					  
                   

                </form>
            </div>

        </div>

        <!-- AFFICHAGE DES DONNÉES  -->
	<script>
		idtransitaire.value="<?php echo $resultat["idtransitaire"];?>";
		typec.value="<?php echo $resultat["typec"];?>";
		
	</script>


    </div>
    <?php include "inc/app_footer.php"; ?>
    </body>
	
    </html>
    <?php
}
$result->closeCursor();