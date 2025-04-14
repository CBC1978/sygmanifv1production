
<?php
// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=bcproduction;charset=utf8','root','Cbcfaso2009');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

function VerifierExercice($annee,$idposte,$conn){
	try{
	$res=$conn->prepare("select annee,idposte,derniernumeroi,derniernumeroe From exercice where annee=? and idposte=?");
	//$res->bindParam('ss',$annee,$idposte);
	$res->execute(array($annee,$idposte));
		}
		catch(Exception $e)
			{
		die('Erreur : '.$e->getMessage());}
		//$resultat = $res->fetchAll();
		$test=1;
	while ($resultat = $res->fetch()){ 
	//$res->bind_result($an,$pos,$numi,$nume);
	//if (count($resultat) > 0) {
		$_SESSION['numi']=$resultat['derniernumeroi'];
		$_SESSION['nume']=$resultat['derniernumeroe'];
		 $test=2;}
	if ($test==1) {
	
		$stmt = $conn->prepare("INSERT INTO exercice (annee, idposte,derniernumeroi,derniernumeroe) VALUES (?,?,?,?)");
		$stmt->execute(array($annee,$idposte,0,0));
		//$stmt->bind_result($an, $pos,$prenomuser,$idposte);
		$_SESSION['numi']=0;
		$_SESSION['nume']=0 ; }
		}
	
function Nomposte($idposte,$conn){
		try{
		$req = $conn->prepare("select libposte from poste where idposte=?");
		$req->execute(array($idposte));
				
			}
		catch(Exception $e)
			{
		die('Erreur : '.$e->getMessage());}
		$donnees = $req->fetch();
		return $donnees['libposte'];
		}	
function NomConsignataire($idcons,$conn){
		try{
		$req = $conn->prepare("select nomcons from consignataire where idconsignataire=?");
		$req->execute(array($idcons));
				
			}
		catch(Exception $e)
			{
		die('Erreur : '.$e->getMessage());}
		$donnees = $req->fetch();
		return $donnees['nomcons'];
		}	
		
function NomGroupe($idgroupe,$conn){
		try{
		$req = $conn->prepare("select nomgroupe from groupe where idgroupe=?");
		$req->execute(array($idgroupe));
				
			}
		catch(Exception $e)
			{
		die('Erreur : '.$e->getMessage());}
		$donnees = $req->fetch();
		return $donnees['nomgroupe'];
		}	
		
function Nomport($idport,$conn){
		try{
		$req = $conn->prepare("select nomport from port where idport=?");
		$req->execute(array($idport));
			}
		catch(Exception $e)
			{
		die('Erreur : '.$e->getMessage());}
		$donnees = $req->fetch();
		return $donnees['nomport'];
		}
		
	function NouveauNumero($conn,$annee,$idposte){
		try{
		$req = $conn->prepare("select max(numero) as nb from compteur
		where annee=$annee and idposte=$idposte ");
		$req->execute();
			}
		catch(Exception $e)
			{
		die('Erreur : '.$e->getMessage());}
		$donnees = $req->fetch();
		return intval($donnees['nb'])+1;
		}	
		
	function NouveauNumeroT($conn){
		try{
		$req = $conn->prepare("select max(numero) as nb from tracabilite");
		$req->execute();
			}
		catch(Exception $e)
			{
		die('Erreur : '.$e->getMessage());}
		$donnees = $req->fetch();
		return intval($donnees['nb'])+1;
		}		
	function NouveauNumeroPos($conn){
		try{
		$req = $conn->prepare("select max(idposte) as nb from Poste");
		$req->execute();
			}
		catch(Exception $e)
			{
		die('Erreur : '.$e->getMessage());}
		$donnees = $req->fetch();
		return intval($donnees['nb'])+1;
		}		
		
	function NouveauNumeroConv($conn){
		try{
		$req = $conn->prepare("select max(idconv) as nb from conversion");
		$req->execute();
			}
		catch(Exception $e)
			{
		die('Erreur : '.$e->getMessage());}
		$donnees = $req->fetch();
		return intval($donnees['nb'])+1;
		}					
		
		function tofrench($date)
  {
              $date = explode('-',$date); 
              $date2 = "$date[2]-$date[1]-$date[0]";
              return $date2;
  }
		
?>