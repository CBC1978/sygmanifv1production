<?php
ob_start();
session_start();

if (isset($_POST['btnlogin'])) {
    include('Connexion.php');
    $username = $_POST['username'];
    $password = $_POST['password'];

    $mysqli = bdd();

    $res = $mysqli->prepare("SELECT iduser, nomuser, prenomuser, idposte, idgroupe, lieudetravail, actif, id FROM user WHERE iduser=? AND password=?");
    $reponse = $mysqli->prepare("SELECT idposte, libposte, nomsite, sitename, adresseposte, emailposte, nomresponsable, prenomresponsable, pays, contactposte, titreposte, titreresponsableng FROM poste WHERE idposte=?");
    $grp = $mysqli->prepare("SELECT ajouter, modifier, supprimer, gereruser, administrateur, gererfacture, statistique, statistiquec, decideur, parametre, paramuser, conversion, FactavoirAp FROM groupe WHERE idgroupe=?");

    $res->bind_param("ss", $username, $password);
    $res->execute();
    $res->bind_result($iduser, $nomuser, $prenomuser, $idposte, $idgroupe, $lieudetravail, $actif, $id);

    if ($res->fetch() && $actif == 1) {
        $_SESSION['iduser'] = $username;
        $_SESSION['logged'] = true;
        $_SESSION['nomuser'] = $nomuser;
        $_SESSION['prenomuser'] = $prenomuser;
        $_SESSION['idposte'] = $idposte;
        $_SESSION['id'] = $id;
        $res->close();

        $grp->bind_param("i", $idgroupe);
        $grp->execute();
        $grp->bind_result($ajouter, $modifier, $supprimer, $gereruser, $administrateur, $gererfacture, $statistique, $statistiquec, $decideurC, $parametreC, $paramuserC, $conversionC, $FactavoirApC);

        if ($grp->fetch()) {
            $_SESSION['administrateur'] = $administrateur;
            $_SESSION['ajouter'] = $ajouter;
            $_SESSION['modifier'] = $modifier;
            $_SESSION['supprimer'] = $supprimer;
            $_SESSION['gereruser'] = $gereruser;
            $_SESSION['gererfacture'] = $gererfacture;
            $_SESSION['statistique'] = $statistique;
            $_SESSION['statistiquec'] = $statistiquec;
            $_SESSION['decideur'] = $decideurC;
            $_SESSION['parametre'] = $parametreC;
            $_SESSION['paramuser'] = $paramuserC;
            $_SESSION['conversion'] = $conversionC;
            $_SESSION['FactavoirAp'] = $FactavoirApC;
        }
        $grp->close();

        if ($administrateur == 'N') {
            $reponse->bind_param("s", $idposte);
            $reponse->execute();
            $reponse->bind_result($idpostee, $libposte, $nomsite, $sitename, $adresseposte, $emailposte, $nomresponsable, $prenomresponsable, $pays, $contactposte, $titreposte, $titreresponsableng);

            if ($reponse->fetch()) {
                $_SESSION['libposte'] = $libposte;
                $_SESSION['nomsite'] = $nomsite;
                $_SESSION['sitename'] = $sitename;
                $_SESSION['adresseposte'] = $adresseposte;
                $_SESSION['emailposte'] = $emailposte;
                $_SESSION['nomresponsable'] = $nomresponsable;
                $_SESSION['prenomresponsable'] = $prenomresponsable;
                $_SESSION['titreresponsableng'] = $titreresponsableng;
                $_SESSION['titreposte'] = $titreposte;
                $_SESSION['pays'] = $pays;
                $_SESSION['contactposte'] = $contactposte;
                $_SESSION["nblignes"] = 0;
            }
            $reponse->close();
        } else {
            $_SESSION['libposte'] = $lieudetravail;
        }

        $_SESSION['repere'] = 10;
        header('Location: menup.php');
        exit;
    } else {
        echo 'Compte ou mot de passe invalide ou compte inactif.';
        $mysqli->close();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Gestion des Bons de Chargement</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <style>
        body {
            color: black;
        }
        .login td {
            padding: 5px;
        }
    </style>
    <script>
        function _closeWindow() {
            window.opener = self;
            self.close();
        }
    </script>
</head>
<body>
    <form method="post" action="index.php">
        <table align='center' class="login">
            <tr>
                <td></td>
                <td><img src="images/LOGO_CBC.jpg" alt="Le logo du CBC" /></td>
            </tr>
            <tr>
                <td><label for="username">Nom utilisateur <span style="color:red">*</span></label></td>
                <td><input type="text" name="username" id="username" required class="form-control" /></td>
            </tr>
            <tr>
                <td><label for="password">Mot de passe <span style="color:red">*</span></label></td>
                <td><input type="password" name="password" id="password" required class="form-control" /></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="btnlogin" value="Connexion" class="btn btn-primary" />
                    <input type="reset" value="Annuler" class="btn btn-warning" />
                    <input type="button" onclick="javascript:_closeWindow();" value="Fermer" class="btn btn-danger" />
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
<?php ob_end_flush(); ?>
