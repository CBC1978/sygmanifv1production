
<?php

include('session-verif.php');
include("ConnectionPOO.php");
include('FonctionsManifeste.php');
include('Montantenlettres.php');
header ('Content-type: text/html; charset=UTF-8');





$numerofact=$_SESSION["numerofact"];
//$datefact=$_POST["datefact"];

if ($_SESSION['administrateur']=='O') {
	$idposte=$_POST['idposte']; 
	$reqposte = $bdd->query("SELECT * FROM  Poste where idposte=$idposte ");
	$donnees=$reqposte->fetch(); 
	$_SESSION['nomsite']=$donnees['nomsite'];
	$_SESSION['sitename']=$donnees['sitename'];
	$_SESSION['adresseposte']=$donnees['adresseposte'];
	$_SESSION['emailposte']= $donnees['emailposte'];
	$_SESSION['prenomresponsable']=$donnees['prenomresponsable'];
	$_SESSION['nomresponsable']=$donnees['nomresponsable'];
	$_SESSION['idport']=$donnees['idport'];
	$_SESSION['pays']=$donnees['pays'];
	
	}
	
			
		if ($_SESSION['administrateur']=='N') $idposte=$_SESSION['idposte'];
		$reqposte = $bdd->query("SELECT * FROM  poste where idposte=$idposte ");
		$donnees=$reqposte->fetch(); 

		$requete="Select ac.*,c.nomcons 
		from factureac ac, consignataire c
		where ac.idconsignataire=c.idconsignataire and ac.numerofact='$numerofact'";
			
		$requete1="select * from detailfactac
		where numerofact='$numerofact'";
		
		
	try{
	$requete = $bdd->prepare($requete);
	var_dump($numerofact);
	$requete1= $bdd->prepare($requete1);
	$requete->execute();
	$requete1->execute();
	}
	catch(Exception $e)
		{
					
		die('Erreur : '.$e->getMessage());}
		
	$resultat1=$requete->fetch();
	
	
	$totalp=0; $totalpp=0;
	$totalm=0; $totalmm=0;
	
	
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
		include('entetefactA.php');?><br>
		<?php 
			EntetefactureAC($bdd,$resultat1['idconsignataire'],$resultat1['typedetrafic'],$idposte,$resultat1['datefact'],$resultat1['numerofact']);
		?>
		<table border='1'>
		<tr>
			<td> <p> <span style="font-style:normal"><b>Référence Facture</b></span>  <br> <span style="font-style:italic"> (Reference Bill N°) </span> </p>    </td>
			<td> <p> <span style="font-style:normal"><b>Navire/N°Voyage</b></span>  <br> <span style="font-style:italic"> (Vessel/Voyage N°) </span> </p>    </td>
			<td>  <p> <span style="font-style:normal"  ><b> Date </b></span>  <br> <span style="font-style:italic"   > </span></p>    </td>
			<td>  <p> <span style="font-style:normal"  ><b>Poids total(T)</b> </span>  <br> <span style="font-style:italic"  >(Gross weight (T)) </span> </p>    </td>
			<td>  <p> <span style="font-style:normal" ><b>Taux unitaire </b></span>  <br> <span style="font-style:italic"  >(Charge per Ton) </span> </p>    </td>
			<td>  <p> <span style="font-style:normal"  ><b>Total </b></span>  <br> <span style="font-style:italic"   >(Total amount) </span> </p>     </td>
		</tr>
			
	<?php  while ($resultat=$requete1->fetch()) {  ?> 
		<tr>
			<td> <p><?php  echo $resultat['factref'];?>   </p> <p> <?php   ?> </p> </td>
			<td> <p><?php  echo $resultat['nomnavire'];?> &nbsp;&nbsp; <?php echo $resultat['numerovoyage']; ?>  </p> <p> <?php   ?> </p> </td>
			<td> <p><?php  echo $resultat['datevoyage'];  ?>  </p> <p> <?php  ?></p>  </td>
			<td> <?php 
			if (stripos($_SESSION['pays'],'TO')!==false) echo number_format(round($resultat['quantite']),0, ',', ' '); 
			else if (stripos($_SESSION['pays'],'BE')!==false OR stripos($_SESSION['pays'],'GH')!==false) echo number_format($resultat['quantite'],3, ',', ' ') ; 
			else if (stripos($_SESSION['pays'],'CO')!==false) { 
			$p=intval($resultat['quantite']); 
			if (($resultat['quantite']-$p)>0) $p=$p+1; 
			echo number_format($p,0, ',', ' ');  }
			?>  </td>
			<td> <?php  echo $resultat['prixunitaire']; ?>  </td>
			<td> <?php if (stripos($_SESSION['pays'],'TO')!==false) echo  number_format($resultat['prixunitaire']*round($resultat['quantite']),0,',', ' '); 
			else if (stripos($_SESSION['pays'],'BE')!==false) echo number_format($resultat['prixunitaire']*$resultat['quantite'],0, ',', ' '); 
			else if (stripos($_SESSION['pays'],'GH')!==false) { $tot=$resultat['prixunitaire']*$resultat['quantite'];  echo number_format($tot,3, ',', ' '); }
			else if (stripos($_SESSION['pays'],'CO')!==false) {
				$p=intval($resultat['quantite']); 
				if (($resultat['quantite']-$p)>0) $p=$p+1; 
				echo number_format($resultat['prixunitaire']*$p,0, ',', ' ');
				} ?>  </td>
		</tr>		
		<?php if (stripos($_SESSION['pays'],'TO')!==false)  $totalm=$resultat['prixunitaire']*round($resultat['quantite']); 
		else  if (stripos($_SESSION['pays'],'BE')!==false or stripos($_SESSION['pays'],'GH')!==false) $totalm=$resultat['prixunitaire']*$resultat['quantite'];
		else if (stripos($_SESSION['pays'],'CO')!==false) { $p=intval($resultat['quantite']); 
			if (($resultat['quantite']-$p)>0) $p=$p+1; 
			 $totalm=$resultat['prixunitaire']*$p;
			}
		 if (stripos($_SESSION['pays'],'TO')!==false)   $totalp=round($resultat['quantite']);
		 else if (stripos($_SESSION['pays'],'BE')!==false or stripos($_SESSION['pays'],'GH')!==false)  $totalp=$resultat['quantite']; 
		 else if (stripos($_SESSION['pays'],'CO')!==false) { $p=intval($resultat['quantite']); 
				if (($resultat['quantite']-$p)>0) $p=$p+1; $totalp=$p;  }
		$totalmm=$totalmm+$totalm;
		$totalpp=$totalpp+$totalp;
		}
		 ?> 
			<tr>
				<td>   </td> 
				<td>   </td> 
				<td><span style="font-style:normal" ><b>  Poids total</b></span> <br><span style="font-style:italic" >(Total weight)</span> </td>
				<td>   <?php if (stripos($_SESSION['pays'],'BE')!==false or stripos($_SESSION['pays'],'GH')!==false)  echo number_format($totalpp,3, ',', ' '); else echo number_format($totalpp,0, ',', ' ') ; ?>  </td> 
				<td> <span style="font-style:normal" > <b> Montant total</b></span> <br><span style="font-style:italic" >(Total amount) </span></td> 
				<td>   <?php if (stripos($_SESSION['pays'],'GH')!==false) echo number_format($totalmm,3, ',', ' '); else echo number_format($totalmm,0, ',', ' ');?>   </td> 
			</tr>
			</table>
			
			<?php if (stripos($_SESSION['pays'],'GH')===false) { ?>
			<p> <?php echo "Arrêté la presente facture Avoir a la somme de:  ".convertir(round($totalmm,0),'F CFA','fr'); ?><br>
			<i> <?php echo 'Total amount of this invoice Credit :  '.convertir(round($totalmm,0),'F CFA','en'); ?></i></p>
			<?php } else {  ?>
			<p> <?php echo "Arrêté la presente facture Avoir a la somme de:  ".convertir($totalmm,'USD','fr'); ?><br>
			<i> <?php echo "Total amount of this invoice Credit :  ".convertir($totalmm,'USD','en'); ?></i></p>
			<br>
			
			<br>
				
			<br>
		
			<?php  }   ?>
			<br><br><br><br><br><br>
			<p style="text-align:right" > 
			<span style="font-style:normal" >
			<b> LE REPRESENTANT </b></span> <br>
			<span style="font-style:italic">
			<b>(The Representative)</b> </span>
			</p>
			<p></p><p></p><p style="text-align:right" >
			 <?php echo $_SESSION['prenomresponsable'].'   '.$_SESSION['nomresponsable'];  ?> </p>
			</page>
			
				
			<?php 
			
				 	
			
			
				// $content=ob_get_contents() ;
				$content= ob_get_clean();
					
					try{
					
					$pdf->writeHTML($content);
					ob_end_clean();
					$filename = 'FactureAvoir' .'_'.date('Ymd');
					$pdf->Output($filename.'.pdf','D'); }
					catch(HTML2PDF_exception $e) {
					echo $e;
					exit;} 


					//echo  $content;
			 ?> 
			
			
			