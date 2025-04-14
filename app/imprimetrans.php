<?php
include('session-verif.php');
include("ConnectionPOO.php");
include('FonctionsManifeste.php');
if ($_SESSION['administrateur']='N')
$idposte=$_SESSION['idposte'];
//include('Montantenlettres.php');
header ('Content-type: text/html; charset=UTF-8');

$requete="SELECT t.nomtransitaire,p.libposte 
from transitaire t, poste p 
where t.idposte=p.idposte";
if ($_SESSION['administrateur']='N')
	$requete.="  and  t.idposte='$idposte'";
	//$id = $_GET['id'];
  $result = $bdd->query($requete);


	
	ob_start();	
	?>
	<style>
	table {border-collapse:collapse;width: 100%}
	</style>

	<?php
	require_once('html2pdf/html2pdf.class.php');
	try{
					
		$pdf=  new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8') ;
		}
		catch(HTML2PDF_exception $e) {
		echo $e;
		exit;}		
	?>
	
	
	
	
	
		<page><?php 
		include('entetebon.php');?><br>
		
		<table border='1'>
		<tr> <th>Nom transitaire</th><th> Pays</th> </tr>				
			
	<?php  while ($resultat=$result->fetch()) {  ?> 
			<?php 
			//EntetefactureBon($bdd,$idposte,$resultat['datebon'],$resultat['numbon']);
		
		?>
		<tr><td><?php echo $resultat["nomtransitaire"] ; ?>  </td><td> <?php echo $resultat["libposte"] ; ?>  </td></tr>
		
		<?php  }   ?>
			</table >	
			
			
			</page>
			
				
			<?php 
			
				 	
			
			
				// $content=ob_get_contents() ;
				$content= ob_get_clean();
					
					try{
					
					$pdf->writeHTML($content);
					ob_end_clean();
					$filename = 'Liste' .'_'.date('Ymd');
					$pdf->Output($filename.'.pdf','D'); }
					catch(HTML2PDF_exception $e) {
					echo $e;
					exit;} 


					//echo  $content;
			 ?> 
			
			
			