<?php
include('session-verif.php');
include "ConnectionPOO.php";
if (isset($_POST['rechercheC'])) {
    $motifRecherche = addslashes(htmlspecialchars($_POST["rechercheC"]));
    
    if (isset($_GET['page'])) {
    $page_actuelle = $_GET['page'];
} else {
    $page_actuelle = 1;
}
if ($_SESSION['administrateur']='N')
$idposte=$_SESSION['idposte'];

$r = "SELECT COUNT(*) nblignes FROM bonchargement b,transitaire t"; 
$r .= " WHERE b.idtransitaire=t.idtransitaire ";
if ($_SESSION['administrateur']=='N')
	$r .=" AND b.idposte='$idposte'";
$r .="and (b.numbon LIKE '%$motifRecherche%' OR b.numerovehicule LIKE '%$motifRecherche%' ";
$r .= " OR b.marchandise LIKE '%$motifRecherche%' OR b.poids LIKE '$motifRecherche%' OR b.nbrecolis like '%$motifRecherche%' OR b.nomdestinataire like '%$motifRecherche%' ";
$r .= " OR b.adresse LIKE '%$motifRecherche%' OR b.datebon LIKE '$motifRecherche%' OR b.nomchaufeur like '%$motifRecherche%' OR t.nomtransitaire like '%$motifRecherche%') ";

$reponse = $bdd->query($r);
$rep = $reponse->fetch();
$reponse->closeCursor();
$nblignes = (int) $rep['nblignes'];
$ligne_par_page = 15;
$nb_pages = 0;  // nombre page total

/* --- fin recuperation du nombre de ligne --- */

if ($nblignes % $ligne_par_page == 0) {

    $nb_pages = $nblignes / $ligne_par_page;
} else {

    $nb_pages = (int) ($nblignes / $ligne_par_page) + 1;
}


//  recuperation de la page actuelle

if (!isset($page_actuelle)) {

    if (isset($_GET['page']) and ! empty($_GET['page'])) {

        $page_actuelle = $_GET['page'];  // si on demande une page qq ex: 2 ou 4
    } else {

        $page_actuelle = 1; // si on ne demande aucune page
    }
}
$limit_debut = ($ligne_par_page * $page_actuelle) - $ligne_par_page;


// MAINTENANT ON FAIT LA requete


$requete = "SELECT b.*,t.nomtransitaire FROM bonchargement b,transitaire t";
$requete .= " WHERE b.idtransitaire=t.idtransitaire";
if ($_SESSION['administrateur']='N')
	$requete .= " AND b.idposte='$idposte'";
$requete .= " and (b.numbon LIKE '%$motifRecherche%' OR b.numerovehicule LIKE '%$motifRecherche%'";
$requete .= " OR b.marchandise LIKE '%$motifRecherche%' OR b.poids LIKE '%$motifRecherche%'";
$requete .= " OR b.nbrecolis like '%$motifRecherche%' OR b.nomdestinataire like '%$motifRecherche%'";
$requete .= " OR b.datebon like '%$motifRecherche%' OR  b.adresse like '%$motifRecherche%' OR b.nomchaufeur like '%$motifRecherche%'";
$requete .= " OR b.typec like '%$motifRecherche%' OR t.nomtransitaire like '%$motifRecherche%')";
$requete .= " ORDER BY b.idbon DESC LIMIT $limit_debut ,$ligne_par_page ";

$listeBons = $bdd->query($requete);
// recuperation de la liste des Bons de Chargement
} else {
    if (isset($_GET['page'])) {
    $page_actuelle = $_GET['page'];
} else {
    $page_actuelle = 1;
}

$r = "SELECT COUNT(*) nblignes FROM bonchargement";
if ($_SESSION['administrateur']=='N')
	$r .=" where idposte='$idposte'";
$reponse = $bdd->query($r);
$rep = $reponse->fetch();
$reponse->closeCursor();
$nblignes = (int) $rep['nblignes'];

$ligne_par_page = 15;
$nb_pages = 0;  // nombre page total

/* --- fin recuperation du nombre de ligne --- */

if ($nblignes % $ligne_par_page == 0) {

    $nb_pages = $nblignes / $ligne_par_page;
} else {

    $nb_pages = (int) ($nblignes / $ligne_par_page) + 1;
}


//  recuperation de la page actuelle

if (!isset($page_actuelle)) {

    if (isset($_GET['page']) and ! empty($_GET['page'])) {

        $page_actuelle = $_GET['page'];  // si on demande une page qq ex: 2 ou 4
    } else {

        $page_actuelle = 1; // si on ne demande aucune page
    }
}
$limit_debut = ($ligne_par_page * $page_actuelle) - $ligne_par_page;


// MAINTENANT ON FAIT LA requete


$requete = "SELECT b.*,t.nomtransitaire FROM bonchargement b";
$requete .=",transitaire t";
$requete .=" where b.idtransitaire=t.idtransitaire ";
if ($_SESSION['administrateur']=='N')
	$requete .=" and b.idposte='$idposte'";
$requete .=" ORDER BY idbon DESC LIMIT $limit_debut ,$ligne_par_page ";
$listeBons = $bdd->query($requete);
// recuperation de la liste des Bons de Chargement
}
$reqrep="SELECT * FROM transitaire ";
if ($_SESSION['administrateur']=='N')
	$reqrep .=" where idposte='$idposte'";
	$reqrep .=" ORDER BY nomtransitaire";	
$reqtrans = $bdd->query($reqrep);


//$reqtrans = $bdd->query("SELECT * FROM transitaire ORDER BY nomtransitaire"); 
$reqsign = $bdd->query("SELECT * FROM signataire ORDER BY nomprenom where actif='O'");


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mise à jour des Bons de Chargement</title>
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
	 <!-- <script src="input_constraint.js"></script><!-- on charge la librairie -->
		
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
                <form method="post" action="bonchargement_post.php" style="padding-top: 20px;">
                   
				   <a href="menup.php" class=""><span class="glyphicon glyphicon-arrow-left"> Page précédente</span></a>
                    <fieldset>
                        <legend><h3>Informations sur les Bons de Chargement</h3></legend> <!-- Titre du fieldset -->

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
                                <td><label for="numerovehicule">Immatriculation Véhicule: <span style="color:red" > * </span></label></td>
                                <td><input type="text" name="numerovehicule" id="numerovehicule" maxlength="50" required="required" onkeyup="this.value=this.value.toUpperCase()"  class="form-control "/> </td>
                                                        
                          </tr>
						  
						  <tr>
                                <td><label for="nomchaufeur">Conducteur: <span style="color:red" > * </span></label></td>
                                <td><input type="text" name="nomchaufeur" id="nomchaufeur" maxlength="60" required="required" onkeyup="this.value=this.value.toUpperCase()"  class="form-control "/> </td>
                                                        
                          </tr>
						  
						  <tr>
						  <td><label for="idtransitaire">Transitaire <span style="color:red" > * </span></label></td>
							<td>  <select class="selectpicker" data-live-search="true" name="idtransitaire" id="idtransitaire" size=1 required="required" >
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
                                <td><label for="marchandise">Nature de la marchandise: <span style="color:red" > * </span></label></td>
                                <td><input type="text" name="marchandise" id="marchandise" maxlength="80"  onkeyup="this.value=this.value.toUpperCase()"  class="form-control "/> </td>
                         </tr>
						  <tr>
                                <td><label for="poids">Poids estimatif des M/ses en KG: <span style="color:red" > * </span></label></td>
                                <td><input type="number"   step="any"  name="poids" id="poids"  class="form-control "/> </td>
                           </tr>
						  <tr>
                                <td><label for="nbrecolis">Nombre de colis <span style="color:red" > * </span></label></td>
                                <td><input type="number" name="nbrecolis" id="nbrecolis"    class="form-control "/> </td>
							</tr>
                                <td><label for="nomdestinataire">Destinataire: <span style="color:red" > * </span></label></td>
                                <td><input type="text" name="nomdestinataire" id="nomdestinataire" maxlength="80" onkeyup="this.value=this.value.toUpperCase()"   class="form-control "/> </td>
							</tr>
						   <tr>
								<td><label for="adresse">Adresse: <span style="color:red" > * </span></label></td>
                                <td><input type="text" name="adresse" id="adresse" maxlength="80" onkeyup="this.value=this.value.toUpperCase()"   class="form-control "/> </td>
                           </tr>
						   <tr>
                                <td><label for="datebon">Date bon <span style="color:red" > * </span></label></td>
                                <td><input  name="datebon" id="datepicker"    class="form-control" value="<?php echo date("Y/m/d"); ?>" /> </td>
                         
						  </tr>
						   
                            <tr>
                                <td></td>
								<?php	if ($_SESSION['ajouter']=='O') { ?>
                                <td>
                                    <input type="submit" value="Enregistrer" class="btn btn-primary" />
                                </td>
								<?php	} ?>
		
	                           <td>
                                    <input type="reset" value="Annuler"  class="btn btn-danger"/>
                                </td>	
														
                                  
                            </tr>
                        </table>
                    </fieldset>
					 <table>
                    
                </table >

              
                </form>
            </div>

        </div>
		
		
        <hr>

        <!-- AFFICHAGE DES DONNÉES  -->
        <div class="row">
			 <form class="form-inline" role="form" id="formRechercheArmateur" method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="glyphicon glyphicon-search"></i></div>
                            <input name="rechercheC" class="form-control" type="text" placeholder="Rechercher ...">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-default">Rechercher</button>
                </form>
            <div class="col-lg-12">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                           <th>ACTION </th>
							<th>IMPRIMER</th>
							<th>NUMERO BON</th>
							<th>VEHICULE</th>
							<th>CHAUFFEUR</th>
							<th>TRANSITAIRE</th>	
							<th>MARCHANDISE</th>
                            <th>POIDS</th>
							<th>NBRE DE COLIS</th>
							<th>DESTINATAIRE</th>
							<th>ADRESSE</th>
                            <th>DATE</th>
                            <th>CREE PAR </th>
							<th>DATECREATION</th>
							<th>MODIFIE PAR </th>
							<th>DATE DE MODIFICATION</th>
							
							
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listeBons as $operateur) {
                            ?>
                            <tr>
                              <!--   <td><a href="bonchargementm.php?id=<?php echo $operateur["idbon"];?>"><span class="fa fa-pencil fa-fw ">  </span>  </a></td> -->
                             	

								<td><a href="bonchargementm.php?id=<?php echo $operateur['idbon'];?>"><span class="fa fa-edit ">  </span>  Modifier</a></td>
                     			<td><a href="imprimebon.php?id=<?php echo $operateur['idbon'];?>"><span class="fa fa-edit ">  </span>Imprimer</a></td>
								<td><?php echo $operateur['numbon'];?></td>
								<td><?php echo $operateur['numerovehicule'];?></td>
								<td><?php echo $operateur['nomchaufeur'];?></td>
								<td><?php echo $operateur['nomtransitaire'];?></td>
								<td><?php echo $operateur['marchandise'];?></td>
                                <td><?php echo $operateur['poids'];?></td>
                                <td><?php echo $operateur['nbrecolis'];?></td>
								<td><?php echo $operateur['nomdestinataire'];?></td>
								<td><?php echo $operateur['adresse'];?></td>
                                <td><?php echo $operateur['datebon']; ?></td>
                                <td><?php echo $operateur['createdby'];?></td>
                                <td><?php echo $operateur["datecreation"];?></td>
								<td><?php echo $operateur["modifyby"];?></td>
								<td><?php echo $operateur["datemodify"];?></td>
								
								
								
                            </tr>
                        <?php
                            }
                        $listeBons->closeCursor();
                        ?>
                    </tbody>
                </table>
				<ul class="pagination">



                <?php
                $p=1;
                while($p<=$nb_pages ){
                    ?>
                    <li class="pagination<?php echo $p; ?>"><a href="bonchargement.php?page=<?php echo $p; ?>"><?php echo $p; ?></a></li>
                    <?php
                    $p++;
                }
                ?>
            </ul>
            </div>
        </div>


    </div>
    <?php include "inc/app_footer.php";?>
	<script>
    $(function () {
        $(".pagination<?php echo $page_actuelle;?>").attr('class','active');
    })
</script>
 <script>
			
                           
            </script>

</body>
  

</html>
