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
$r = "SELECT COUNT(*) nblignes FROM user WHERE iduser LIKE '%$motifRecherche%' OR nomuser LIKE '%$motifRecherche%'";
$r .= " OR prenomuser LIKE '%$motifRecherche%' OR emailuser LIKE '$motifRecherche%' OR lieudetravail like '%$motifRecherche%'";
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
if (!isset($page_actuelle)) {

    if (isset($_GET['page']) and ! empty($_GET['page'])) {

        $page_actuelle = $_GET['page'];  // si on demande une page qq ex: 2 ou 4
    } else {

        $page_actuelle = 1; // si on ne demande aucune page
    }
}
$limit_debut = ($ligne_par_page * $page_actuelle) - $ligne_par_page;
$requette = "SELECT  u.id, u.iduser,u.nomuser,u.prenomuser,u.emailuser,u.lieudetravail,g.nomgroupe
FROM user u, groupe g
where (u.iduser LIKE '%$motifRecherche%' OR u.nomuser LIKE '%$motifRecherche%'";
$requette .= " OR u.prenomuser LIKE '%$motifRecherche%' OR u.emailuser LIKE '%$motifRecherche%'";
$requette .= " OR u.lieudetravail like '%$motifRecherche%' OR u.id like '%$motifRecherche%')";
$requette .= " and u.idgroupe=g.idgroupe ";
$requette .= " LIMIT $limit_debut ,$ligne_par_page; ";

$listeUsers = $bdd->query($requette);
// recuperation de la liste des chargeurs
} else {
    if (isset($_GET['page'])) {
    $page_actuelle = $_GET['page'];
} else {
    $page_actuelle = 1;
}

$r = "SELECT COUNT(*) nblignes FROM user";

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


$requette = "SELECT  u.id,u.iduser,u.nomuser,u.prenomuser,u.emailuser,u.lieudetravail,g.nomgroupe
FROM user u, groupe g  
where u.idgroupe=g.idgroupe 
ORDER BY u.id
LIMIT $limit_debut ,$ligne_par_page; ";
$listeUsers = $bdd->query($requette);
// recuperation de la liste des chargeurs
}


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mise à jour des Utilisateurs</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/font-awesome.min.css" />
		<link rel="stylesheet" href="manifeste.css" />
        <link rel="stylesheet" href="css/mystyle.css" />
    </head>

<body>
	<?php include "inc/app_header.php"; ?>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<a href="menup.php"><span class="glyphicon glyphicon-arrow-left"> Page précedente</span></a>    <br> 	  <br>
				<form method="post" action="user_post.php">
   <fieldset>
       <legend> <b>Informations sur les Utilisateurs </b> </legend> <!-- Titre du fieldset --> 
	<table style="td">
	<tr>
       <td><label for="iduser">Login: <span style="color:red"  > * </span></label></td>
       <td><input type="text" name="iduser" id="iduser" required="required" onkeyup="this.value=this.value.toLowerCase()" /> </td>
	 </tr>
	 <tr>
		
		<td> <label for="nomuser">Nom <span style="color:red"  > * </span></label> </td>
       <td><input type="text" name="nomuser" id="nomuser" required="required" onkeyup="this.value=this.value.toUpperCase()" /> </td>
     
	 <td><label for="prenomuser">Prénom <span style="color:red"  > * </span></label></td>
       <td><input type="tel" name="prenomuser" id="prenomuser" required="required" onkeyup="this.value=this.value.toUpperCase()" /> </td>
     </tr>
	 <tr>
		<td> <label for="password">Mot de passe <span style="color:red"  > * </span></label> </td>
       <td><input type="password" name="password" id="password"  required='required'   /> </td>
      </tr>
	  <tr>
		<td> <label for="emailuser">Email <span style="color:red"  > * </span></label> </td>
       <td><input type="email" name="emailuser" id="emailuser" required="required" onkeyup="this.value=this.value.toLowerCase()"  /> </td>
     
	 
	  <td> <label for="lieudetravail">Ville: <span style="color:red"  > * </span></label> </td>
      <td><input type="text" name="lieudetravail" id="lieudetravail"  required='required' onkeyup="this.value=this.value.toUpperCase()" /> </td>
   </tr>
   
   
   
   <?php
		
		$req = $bdd->query('SELECT * FROM groupe order by nomgroupe');
		$req1 = $bdd->query('SELECT * FROM poste order by libposte');
	?>
   <tr>
		<td><label for="idgroupe">Groupe <span style="color:red"  > * </span></label></td>
	    <td>  <select name="idgroupe" size=1 required='required' >
		  <option value=""> Veuillez choisir le groupe</option>
        <?php
		while ($donnees = $req->fetch()) {
		?>
		<option value="<?php echo $donnees['idgroupe'];?>"> <?php  echo $donnees['nomgroupe']; ?></option><?php } ?>
		</select></td>
   </tr>
   <tr>
		<td><label for="idposte">Poste CBC </label></td>
	     <td> <select name="idposte" size=1 >
		  <option value=""> Veuillez choisir le poste</option>
        <?php
		while ($donnees = $req1->fetch()) {
		?>
		<option value="<?php echo $donnees['idposte'];?>"> <?php  echo $donnees['libposte']; ?></option><?php } ?>
		</select></td>
   </tr>
   
   <fieldset>
	 <legend> <b>Actif</b></legend> 
	<tr>		
       <td><INPUT type= "radio" name="actif" id="actif1"   value="1"  checked> Actif
			
       <INPUT type= "radio" name="actif" id="actif2"  value="2"> Inactif</td>
	</tr>
	</fieldset> 
   
    
   
	</table>
	 </fieldset>
 <table class="type2">
 <tr>
 <td> 
 <input type="submit" value="Enregistrer"  /></td>
 <td> <input type="reset" value="Annuler"  /></td>
 </tr>
</table>
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
                          	<th>ID </th>
                            <th>NOM UTILISTAUER</th>
							<th>PRENOM </th>
                            <th>EMAIL</th>
                            <th>VILLE</th>
                            <th>GROUPE</th>
                           
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($listeUsers as $Users) {
                            ?>
                            <tr>
                                 <td><a href="userm.php?id=<?php echo $Users['iduser'];?>"><span class="fa fa-pencil fa-fw ">  </span>  </a></td> 
                                <td><?php echo $Users['id'];?></td>
                                <td><?php echo  $Users['nomuser'];?></td>
                                <td><?php echo $Users['prenomuser'];?></td>
                                <td><?php echo $Users['emailuser']; ?></td>
                                <td><?php echo $Users['lieudetravail'];?></td>
                                <td><?php echo $Users["nomgroupe"];?></td>
						
                                
                            </tr>
                        <?php
                            }
                        $listeUsers->closeCursor();
                        ?>
                    </tbody>
                </table>
				<ul class="pagination">



                <?php
                $p=1;
                while($p<=$nb_pages ){
                    ?>
                    <li class="pagination<?php echo $p; ?>"><a href="user.php?page=<?php echo $p; ?>"><?php echo $p; ?></a></li>
                    <?php
                    $p++;
                }
                ?>
            </ul>
            </div>
        </div>


    </div>

	<?php include "inc/app_footer.php";?>
</body>
  

</html>
