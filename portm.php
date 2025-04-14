<?php
include('session-verif.php');
include ("ConnectionPOO.php");

$id = $_GET['id'];
$result = $bdd->query("SELECT * FROM port where idport='$id'");

$por=$result->fetch();
$result->closeCursor();
$listePorts = $bdd->query('SELECT idport, nomport,nompays FROM port ,pays where port.idpays=pays.idpays  ORDER BY nompays, idport ASC');
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
            <form method="post" action="portm_post.php" >
                <a href="menup.php"><span class="glyphicon glyphicon-arrow-left"> Page précedente</span></a>    <br> 	  <br>
                <fieldset>
                    <legend> <b>Informations sur les Ports</b></legend> <!-- Titre du fieldset -->
                    <table class="champ-table">
                        <input type="hidden" name="idport" value="<?=$id?>">
                        <tr>
                            <td><label for="idport">Code port </label></td>
                            <td><input type="text" name="idport" id="idport" required="required" class="form-control" value="<?php echo $por['idport'];?>" /> </td>
                        </tr>
                        <tr>
                            <td><label for="nomport">Nom Port  </label></td>
                            <td><input type="text" name="nomport" id="nomport" required="required" class="form-control" value="<?php echo $por['nomport'];?>"/> </td>
                        </tr>

                        <?php

                        $req = $bdd->query('SELECT * FROM pays');
                        ?>


                        <tr>
                            <td><label for="idpays"> Pays  </label></td>
                            <td>  <select name="idpays" id="idpays" class='selectpicker bs-select-hidden' data-live-search='true' size=1  >
                                    <option value=""> Veuillez choisir le pays </option>
                                    <?php
                                    while ($donnees = $req->fetch()) {
                                        ?>
                                    <option value="<?php echo $donnees['idpays'];?>"> <?php  echo $donnees['nompays']; ?></option><?php } ?>
                                </select></td>
                        </tr>
						
						
                        <tr>
                            <td>
                                <input type="submit" name='valider'  value="Enregsitrer"  class="btn btn-primary"/></td>
                            <td> <input type="reset" value="Annuler"  class="btn btn-danger"/></td>
                        </tr>
                    </table>
                </fieldset>



            </form>
            <hr>
        </div>

    </div>

	<script>
	
idpays.value='<?php echo $por['idpays']; ?>';
		
</script >
    <!-- AFFICHAGE DES DONNÉES  -->
    <div class="row">
        <div class="col-lg-12">

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
                foreach ($listePorts as $port) {
                    ?>
                    <tr>
                        <td><a href="portm.php?id=<?php echo $port['idport'];?>"><span class="fa fa-edit ">  </span>  Modifier</a></td>
                        <td><?php echo  $port['nomport'];?></td>
                        <td><?php echo  $port['nompays'];?></td>
                    </tr>
                    <?php
                }
                $listePorts->closeCursor();
                ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
</div>

<?php
// Connexion à la base de données



// Redirection du visiteur vers la page du minichat

    //header('Location: port.php');


?>


</body>


</html>
