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

$r = "SELECT COUNT(*) nblignes FROM bonchragement WHERE idbon LIKE '%$motifRecherche%' OR numerovehicule LIKE '%$motifRecherche%'";
$r .= " OR marchandise LIKE '%$motifRecherche%' OR poids LIKE '$motifRecherche%' OR nbrecolis like '%$motifRecherche%' OR nomdestinataire like '%$motifRecherche%'";
$r .= " OR adresse LIKE '%$motifRecherche%' OR datebon LIKE '$motifRecherche%' OR nomchaufeur like '%$motifRecherche%' OR nomtransitaire like '%$motifRecherche%'";
$r .= " OR nomprenom LIKE like '%$motifRecherche%'";

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


// MAINTENANT ON FAIT LA REQUETTE


$requette = "SELECT * FROM bonchargement WHERE idbon LIKE '%$motifRecherche%' OR numerovehicule LIKE '%$motifRecherche%'";
$requette .= " OR marchandise LIKE '%$motifRecherche%' OR poids LIKE '%$motifRecherche%'";
$requette .= " OR nbrecolis like '%$motifRecherche%' OR nomdestinataire like '%$motifRecherche%'";
$requette .= " OR adresse like '%$motifRecherche%' OR nomchaufeur like '%$motifRecherche%'";
$requette .= " OR nomtransitaire like '%$motifRecherche%' OR nomprenom like '%$motifRecherche%'";
$requette .= " ORDER BY idbon DESC LIMIT $limit_debut ,$ligne_par_page ";

$listeBons = $bdd->query($requette);
// recuperation de la liste des Bons de Chargement
} else {
    if (isset($_GET['page'])) {
    $page_actuelle = $_GET['page'];
} else {
    $page_actuelle = 1;
}

$r = "SELECT COUNT(*) nblignes FROM operateur";

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


// MAINTENANT ON FAIT LA REQUETTE


$requette = "SELECT * FROM bonchargement ORDER BY idbon DESC LIMIT $limit_debut ,$ligne_par_page ";
$listeBons = $bdd->query($requette);
// recuperation de la liste des Bons de Chargement
}
$reqchau = $bdd->query("SELECT * FROM chauffeur  ORDER BY nomchaufeur");
$reqtrans = $bdd->query("SELECT * FROM transitaire ORDER BY nomtransitaire"); //
$reqsign = $bdd->query("SELECT * FROM signataire ORDER BY nomprenom where actif='O'");


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mise à jour des Bons de Chargement</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css" />
		<link rel="stylesheet" href="manifeste.css" />
        <link rel="stylesheet" href="css/mystyle.css" />
		<script src="codeJDetail.js"></script> 
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
                                <td><label for="nomope">Raison sociale: <span style="color:red" > * </span></label></td>
                                <td><input type="text" name="nomope" id="nomope" maxlength="50" required="required" onkeyup="this.value=this.value.toUpperCase()"  class="form-control "/> </td>
                         
                                <td><label for="nomabrege">Nom abrégé: <span style="color:red" >  </span></label></td>
                                <td><input type="text" name="nomabrege" id="nomabrege" maxlength="20"  onkeyup="this.value=this.value.toUpperCase()"  class="form-control "/> </td>
                          </tr>
						   <tr>
                                <td><label for="statut">Statut: <span style="color:red" >  </span></label></td>
                                <td><input type="text" name="statut" id="statut" maxlength="15"  onkeyup="this.value=this.value.toUpperCase()"  class="form-control "/> </td>
                         
                                <td><label for="siteweb">Site web: <span style="color:red" >  </span></label></td>
                                <td><input type="text" name="siteweb" id="siteweb" maxlength="20"  class="form-control "/> </td>
                          </tr>
						  <tr>
                                <td><label for="boitep">B P: <span style="color:red" >  </span></label></td>
                                <td><input type="text" name="boitep" id="boitep" maxlength="25"  onkeyup="this.value=this.value.toUpperCase()"  class="form-control "/> </td>
                         
                                <td><label for="region">Région: <span style="color:red" >  </span></label></td>
                                <td><input type="text" name="region" id="region" maxlength="20"  class="form-control "/> </td>
								<td><label for="province">Province: <span style="color:red" >  </span></label></td>
                                <td><input type="text" name="province" id="province" maxlength="30"  class="form-control "/> </td>
                         
						  </tr>
						  
						  
						  
						   <tr>
                                <td><label for="numeroifu">Numéro IFU: <span style="color:red" >  </span></label></td>
                                <td><input type="text" name="numeroifu" id="numeroifu" maxlength="15"  onkeyup="this.value=this.value.toUpperCase()"  class="form-control "/> </td>
                          
                                <td><label for="anneecreation">Année de Création : <span style="color:red" >  </span></label></td>
                                <td><input type="number" name="anneecreation" id="anneecreation" maxlength="4"   class="form-control "/> </td>
								<td><label for="effectif">Effectif : <span style="color:red" >  </span></label></td>
                                <td><input type="number" name="effectif" id="effectif" maxlength="4"   class="form-control "/> </td>
                     
                          </tr>
						
						
						  <tr>
						  <td><label for="idtypeop">Type d'opérateur <span style="color:red" > * </span></label></td>
							<td>  <select class="selectpicker" data-live-search="true" name="idtypeop" id="idtypeop" size=1 required="required" >
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
							 <tr>
                                 <td> <label for="adresseop"> Adresse <span style="color:red" > * </span></label> </td>
                                <td><input type="text" name="adresseop" id="adresseop" maxlength="50" required="required" onkeyup="this.value=this.value.toUpperCase()" class="form-control " /> </td>
                            </tr>
                            <tr>
                                <td><label for="telephoneop1">Téléphone 1<span style="color:red" > * </span></label></td>
                                <td><input type="tel" name="telephoneop1" id="telephoneop1" maxlength="15" required="required" class="form-control "/> </td>
								 <td><label for="telephoneop2">Téléphone 2<span style="color:red" >  </span></label></td>
                                <td><input type="tel" name="telephoneop2" id="telephoneop2" maxlength="15"  class="form-control "/> </td>
								<td><label for="telephoneop3">Téléphone 3<span style="color:red" >  </span></label></td>
                                <td><input type="tel" name="telephoneop3" id="telephoneop3" maxlength="15"  class="form-control "/> </td>
                            </tr>
                            <tr>
                                <td> <label for="faxop">Fax </label> </td>
                                <td><input type="tel" name="faxop" id="faxop" maxlength="15" class="form-control "/> </td>
                            </tr>
                            <tr>
                                <td> <label for="email">Email 1 <span style="color:red" > * </span></label> </td>
                                <td><input type="email" name="emailop1" id="emailop1" maxlength="40" required="required" onkeyup="this.value=this.value.toLowerCase()"  class="form-control "/> </td>
								<td> <label for="email">Email 2 <span style="color:red" > </span></label> </td>
                                <td><input type="email" name="emailop2" id="emailop2" maxlength="40" onkeyup="this.value=this.value.toLowerCase()"  class="form-control "/> </td>
							 </tr>
                            <tr>
                                <td> <label for="villeop">Ville: <span style="color:red" > * </span></label> </td>
                                <td><input type="text" name="villeop" id="villeop" maxlength="20" onkeyup="this.value=this.value.toUpperCase()" class="form-control " /> </td>
								<td> <label for="ville">Localisation Géographique: <span style="color:red" > * </span></label> </td>
                                <td><input type="text" name="localisationgeo" id="localisationgeo" maxlength="100" onkeyup="this.value=this.value.toUpperCase()" class="form-control " /> </td>
                       
                            </tr>
                            <tr>
                                <td> <label for="paysop">Pays: </label> </td>
                                <td><input type="text" name="paysop" id="paysop" maxlength="20" onkeyup="this.value=this.value.toUpperCase()"  class="form-control "/> </td>
                            </tr>
							<tr>
                                <td> <label for="personnedecontact">Personne de Contact: </label> </td>
                                <td><input type="text" name="personnedecontact" id="personnedecontact" maxlength="80" onkeyup="this.value=this.value.toUpperCase()"  class="form-control "/> </td>
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
                            <th>NOM operateur</th>
							<th>NOM abrégé</th>
							<th>IFU</th>
							<th>Année Création</th>	
							<th>Type Opérateur</th>
                            <th>ADRESSE</th>
							<th>TEL 1</th>
							<th>TEL 2</th>
							<th>TEL 3</th>
                            <th>FAX</th>
                            <th>EMAIL 1</th>
							<th>EMAIL 2</th>
							<th>VILLE</th>
							<th>Localisation</th>
							<th>Pays</th>
							<th>CONTACT</th>
							
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listeBons de Chargement as $operateur) {
                            ?>
                            <tr>
                                <td><a href="operateurm.php?id=<?php echo $operateur['idop'];?>"><span class="fa fa-pencil fa-fw ">  </span>  </a></td> 
                                <td><?php echo $operateur['nomope'];?></td>
								<td><?php echo $operateur['nomabrege'];?></td>
								<td><?php echo $operateur['numeroifu'];?></td>
								<td><?php echo $operateur['anneecreation'];?></td>
								<td><?php echo $operateur['idtypeop'];?></td>
                                <td><?php echo $operateur['adresseop'];?></td>
                                <td><?php echo $operateur['telephoneop1'];?></td>
								<td><?php echo $operateur['telephoneop2'];?></td>
								<td><?php echo $operateur['telephoneop3'];?></td>
                                <td><?php echo $operateur['faxop']; ?></td>
                                <td><?php echo $operateur['emailop1'];?></td>
                                <td><?php echo $operateur["emailop2"];?></td>
								<td><?php echo $operateur["villeop"];?></td>
								<td><?php echo $operateur["localisationgeo"];?></td>
								<td><?php echo $operateur["paysop"];?></td>
                                <td><?php echo $operateur["personnedecontact"];?></td>
								
								
								
                            </tr>
                        <?php
                            }
                        $listeBons de Chargement->closeCursor();
                        ?>
                    </tbody>
                </table>
				<ul class="pagination">



                <?php
                $p=1;
                while($p<=$nb_pages ){
                    ?>
                    <li class="pagination<?php echo $p; ?>"><a href="operateur.php?page=<?php echo $p; ?>"><?php echo $p; ?></a></li>
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
