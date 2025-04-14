<?php

include('session-verif.php');
include("ConnectionPOO.php");

		
$req = $bdd->query('SELECT * FROM pays ORDER BY nompays'); //
$reqp = $bdd->query('SELECT * FROM port ORDER BY nomport');
$reqc= $bdd->query('SELECT * FROM consignataire ORDER BY nomcons'); //
$reqa = $bdd->query('SELECT * FROM armateur ORDER BY nomarmateur');
$reqch= $bdd->query('SELECT * FROM chargeur ORDER BY nomchargeur'); //
$reqd = $bdd->query('SELECT * FROM destinataire ORDER BY nomdestinataire');
$reqn = $bdd->query('SELECT * FROM  partienotfier1 ORDER BY raisonsocnot');
$reqt = $bdd->query('SELECT * FROM  typedecargaison ORDER BY nomtypecargaison');
$reqf = $bdd->query('SELECT * FROM  filiere ORDER BY nomfiliere');
$reqcond = $bdd->query('SELECT * FROM  conditionnement ORDER BY nomcondit');
$reqposte = $bdd->query('SELECT * FROM  poste');

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Statistiques sur les Bons de Chargements</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/bootstrap-select.min.css" />
		<link rel="stylesheet" href="css/font-awesome.min.css" />
		<link rel="stylesheet" href="manifeste.css" />
		<link rel="stylesheet" href="css/mystyle.css" />

		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/bootstrap-select.js"></script>


		<link rel="stylesheet" type="text/css" href="js/jquery-ui.css"/>
		<script src="js/jquery-1.5.1.js"></script>
		<script src="js/jquery.ui.core.js"></script>
		<script src="js/jquery.ui.widget.js"></script>
		<script src="js/jquery.ui.datepicker.js"></script>
	
		<script src="Controledonnees.js"></script>
			<script> 
			$(function() {
				$( "#datepicker" ).datepicker({
					changeMonth: true,
					changeYear: true
				});
				$( "#datepicker1" ).datepicker({
					changeMonth: true,
					changeYear: true
				});
				$( "#datepicker2" ).datepicker({
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
				<a href="menup.php"><span class="glyphicon glyphicon-arrow-left"> Page précédente</span></a>    <br> 	  <br>
				<form method="post" id="myForm" onSubmit="return verifform()" action="statistique1.php" >
					
					<table >
						<tr> <td>  <INPUT type= "radio" name="statistic" id="statistique1"  value="1"  checked> Nombre de Bons de Chargement par pays</td></tr>
						<tr> <td>    <INPUT type= "radio" name="statistic" id="statistique2"   value="2">Nombre de bons par transitaire </td></tr>
						<tr> <td>  <INPUT type= "radio" name="statistic" id="statistique3"  value="3"  > Nombre de bons par nature de marchandises</td></tr>
						<tr> <td>  <INPUT type= "radio" name="statistic" id="statistique4"  value="4"  > Bons émis par période</td></tr>
					

						<tr>
							<td>
								<label for="typef">Choisir le type de fichier?</label></td>
							<td>  <select name="typef" id="typef">
									<option value="excel">Excel</option>
									<option value="pdf">Pdf</option>
									
								</select>
							</td>
						</tr>
						<?php 	if ($_SESSION['administrateur']=='O') {			?>
							<tr>

								<td><label for="idposte">Poste CBC *</label></td>
								<td>  <select name="idposte" id="idposte" size=1 required="required" >
										<option value=""> Veuillez choisir le poste CBC </option>
										<?php
										while ($donnees = $reqposte->fetch()) {

											echo '	<option value="' ;  echo $donnees["idposte"]; echo '"> ';  echo $donnees["libposte"]; echo '</option>';}
										echo '	</select></td>'; ?>


							</tr>  <?php } ?>
					</table>
					<table>
						<tr>
							<td><label for="begindate">Date début *</label></td>
							<td><input    name="begindate" id="datepicker"  reguired="required " /> </td>
						</tr> 	<tr>
							<td> <label for="enddate">Date fin *</label></td>
							<td><input  name="enddate"  id="datepicker1"  reguired="required "   /> </td>

						</tr>
					</table>

					<table>
						<tr> <td>  <button onClick="" name="valider" id="btnAfficherNew"><span>Générer l'état</span></button>  </td></tr>
					</table>
				</form>
			</div>
		</div>
	</div>

	<?php include "inc/app_footer.php";?>
  </body>
</html>
   
	
	
	
		
		
		
