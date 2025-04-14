<?php
include('session-verif.php');
include ("ConnectionPOO.php");
if (isset($_POST['rechercheC'])) {
    $motifRecherche = addslashes(htmlspecialchars($_POST["rechercheC"]));
    
    if (isset($_GET['page'])) {
    $page_actuelle = $_GET['page'];
} else {
    $page_actuelle = 1;
}

$r = "SELECT COUNT(*) nblignes FROM port,pays where port.idpays=pays.idpays and (nomport LIKE '%$motifRecherche%' OR nompays LIKE '%$motifRecherche%'";
$r .= " OR idport LIKE '%$motifRecherche%' OR port.idpays LIKE '%$motifRecherche%')";

//echo 'requete : '. $r;
//var_dump($r);

$reponse = $bdd->query($r);
//echo 'reponse : ';
//var_dump($reponse);
$rep = $reponse->fetch();
//echo 'rep : ' . $rep['nblignes'];
//var_dump($rep);
$reponse->closeCursor();
$nblignes = (int) $rep['nblignes'];

$ligne_par_page = 10;
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


$requette = "SELECT idport,nomport,nompays FROM port, pays where port.idpays=pays.idpays and (nomport LIKE '%$motifRecherche%' OR nompays LIKE '%$motifRecherche%'";
$requette .= " OR port.nomport LIKE '%$motifRecherche%')";
$requette .= " ORDER BY nompays,nomport LIMIT $limit_debut ,$ligne_par_page ";

$listePorts = $bdd->query($requette);
// recuperation de la liste des chargeurs
} else {
    if (isset($_GET['page'])) {
    $page_actuelle = $_GET['page'];
} else {
    $page_actuelle = 1;
}

$r = "SELECT COUNT(*) nblignes FROM port";

$reponse = $bdd->query($r);
$rep = $reponse->fetch();
$reponse->closeCursor();
$nblignes = (int) $rep['nblignes'];

$ligne_par_page = 10;
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


$requette = "SELECT idport, nomport,nompays FROM port ,pays where port.idpays=pays.idpays  ORDER BY nompays, nomport LIMIT $limit_debut ,$ligne_par_page";
$listePorts = $bdd->query($requette);
}

//$listePorts = $bdd->query('SELECT idport, nomport,nompays FROM port ,pays where port.idpays=pays.idpays  ORDER BY nompays, idport ASC');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mise à jour des Ports </title>
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
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <form method="post" action="port_post.php" >
                 <a href="menup.php"><span class="glyphicon glyphicon-arrow-left"> Page précedente</span></a>    <br> 	  <br>
                   <fieldset>
                       <legend> <b>Informations sur les Ports</b></legend> <!-- Titre du fieldset -->
                    <table class="champ-table">
                    <tr>
                       <td><label for="idport">Code port <span style="color:red" > * </span> </label></td>
                       <td><input type="text" name="idport" id="idport" required="required" class="form-control" /> </td>
                     </tr>
                    <tr>
                       <td><label for="nomport">Nom Port <span style="color:red" > * </span>  </label></td>
                       <td><input type="text" name="nomport" id="nomport" required="required" class="form-control"/> </td>
                     </tr>

                      <?php

                        $req = $bdd->query('SELECT * FROM pays');
                        ?>


                      <tr>
                        <td><label for="idpays"> Pays  <span style="color:red" > * </span> </label></td>
                        <td>  <select name="idpays" required="required" size=1 class="selectpicker bs-select-hidden" data-live-search="true">
                          <option value=""> Veuillez choisir le pays </option>
                        <?php
                        while ($donnees = $req->fetch()) {
                        ?>
                        <option value="<?php echo $donnees['idpays'];?>"> <?php  echo $donnees['nompays']; ?></option><?php } ?>
                        </select></td>
                   </tr>
                        <tr>
                            <td>
                                <input type="submit" name='valider'  value="Enregistrer"  class="btn btn-primary"/></td>
                            <td> <input type="reset" value="Annuler"  class="btn btn-danger"/></td>
                        </tr>
                     </table>
                     </fieldset>



    </form>
            <hr>
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

                <div class="col-lg-12" id="divListeArmateurs">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ACTION </th>
								<th>NOM PORT</th>
								<th>PAYS PORT </th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
						foreach($listePorts as $port) {
							?>
							<tr>
								<td><a href="portm.php?id=<?php echo $port['idport'];?>"><span class="fa fa-edit ">  </span>  Modifier</a></td>
								<td><?php echo $port['nomport'];?></td>
								<td><?php echo $port['nompays'];?></td>
							</tr>
							<?php
						}
						$listePorts->closeCursor();
						?>
                        </tbody>
                    </table>
                    <ul class="pagination">



                        <?php
                        $p = 1;
                        while ($p <= $nb_pages) {
                            ?>
                            <li class="pagination<?php echo $p; ?>"><a href="armateur.php?page=<?php echo $p; ?>"><?php echo $p; ?></a></li>
                                <?php
                                $p++;
                            }
                            ?>
                    </ul>

                </div>
            </div>




        </div>
        <?php include "inc/app_footer.php"; ?>
        <script>
            $(function () {
                $(".pagination<?php echo $page_actuelle; ?>").attr('class', 'active');
            });
        </script>

	      
	   
	   
</body>
 <?php
 
  
   ?>

</html>
