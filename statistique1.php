 <?php  
 include('session-verif.php');
include("ConnectionPOO.php");
include("functionstat.php");
		if (isset($_POST['valider']) ) {
			if ($_POST['enddate']<$_POST['begindate']) {
			?>
			<script>
			alert('Date fin ne peut pas être inférieure à la date de départ Veuillez ressaisir SVP');
			
			</script>
			 <?php }
			$begindate=$_POST['begindate'];	
			$datedebut=$_POST['begindate'];	
				
			$enddate=$_POST['enddate'];	
			$datefin=$_POST['enddate'];
			$typef=$_POST['typef'];
		    if ($_SESSION['administrateur']=='O') $idposte= $_POST['idposte']; else $idposte=$_SESSION['idposte'];
		
			$libposte=Nomposte($idposte,$bdd);	     
					switch($_POST['statistic']){
					case 1:
					 Afficher2cpdf("Nombre de chargement par pays",$libposte,$bdd,1,$begindate,$enddate,$idposte,$typef);
					break;
					case 2:	
					Afficher2cpdf("Nombre de bons émis par transitaire",$libposte,$bdd,2,$begindate,$enddate,$idposte,$typef);
					
					break; 
					case 3:	
					Afficher2cpdf("Nombre de bons par nature de marchandises",$libposte,$bdd,3,$begindate,$enddate,$idposte,$typef);
					break; 
					case 4:	
					Afficher2cpdf("Bons émis par période",$libposte,$bdd,4,$begindate,$enddate,$idposte,$typef);
					break; 
										
			}  
		           				
	
		} 
						
		?>