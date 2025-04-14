<?php
include('session-verif.php');
include "ConnectionPOO.php";
if(isset($_SESSION['REQUETTE_PRINCIPAl']))
	$_SESSION['REQUETTE_PRINCIPAl']=null;


	$nom=$_SESSION['nomuser'];
	$prenom=$_SESSION['prenomuser'];

	if ($_SESSION['administrateur']=='N'){
        $idposte=$_SESSION['idposte'];
       // $idport=$_SESSION['idport'];
	   }
	$libposte=$_SESSION['libposte'];


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>  Gestion des Bons de chargement</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/font-awesome.min.css" />
		<link rel="stylesheet" href="manifeste.css" />
		<link rel="stylesheet" href="menu.css" />
		<link rel="stylesheet" href="css/mystyle.css" />
    </head>

<body>
    <header class="app-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <img src="images/LOGO_CBC.jpg" alt="" class="img-responsive">
                </div>

                <div class="col-lg-4">
                <center>
               <h4>CONSEIL BURKINABE DES CHARGEURS <br>
			   Système de Gestion des Bons de Chargement <br>
			   (SYGBON)
				</h4> 
				</center>
                </div>
                <div class="col-lg-5 text-right">
                    <b><?php echo $nom. " ".$prenom. "</b><br>".$libposte;?>
                        <br><a href="index.php" class="btn btn-danger">Deconnecter</a>
							<a href="modifiermotdepasse.php" class="btn btn-danger">Changer son mot de passe</a>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="Menu row">
			<center>
            <h3>ACCUEIL</h3>
			</center>
			<hr>
          <?php
          include('parametresgen.php');
         // if ($_SESSION['parametre']=='O')  include('nomenclature.php');

          ?>
        </div>
  
 

    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    Copyright &#169 2020 <br>
                    SYGBON est une Application web développée par le Conseil Burkinabè des Chargeurs(CBC)
                </div>
            </div>
        </div>
    </footer>
</body>
</html>