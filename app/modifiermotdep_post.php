<?php

include "ConnectionPOO.php";

// Insertion du message à l'aide d'une requête préparée
if (isset($_POST['valider'])) {
$iduser=$_POST['iduser1'];
$motdepasse=$_POST['motdepasse'];
if ($_POST['motdepasse']==$_POST['motdepassec'] and $motdepasse<>$iduser and strlen($motdepasse)>=6) {


try{
$req = $bdd->prepare('update user set password=? where iduser=? ') ;
$req->execute(array($motdepasse,$iduser));
?>
<script>
	confirm('Modifier avec succès');
	window.location.href="index.php"
</script>
<?php

// header('Location: index.php'); 
}

catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());}

// Redirection du visiteur vers la page du minichat
} else { 	?>
			<script>
			confirm("Mot de passe et Confirmation de mot de passe non conformes ou Mot de passe=Nom utilisateur-Resaisir");
			window.location.href="modifiermotdepasse.php"
			</script>
			<?php
			//header('Location: modifiermotdepasse.php'); 
		}


}
?>