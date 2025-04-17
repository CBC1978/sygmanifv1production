<?php
	ob_start(); // Commence la mise en tampon tout de suite
	// $content = ob_get_clean(); // fin de la mise en tampon
	include('session-verif.php');
	include("ConnectionPOO.php");
	include('FonctionsManifeste.php');
	header('Content-type: text/html; charset=UTF-8');
	$id = $_GET['id'];
    $result = $bdd->query("SELECT b.*,t.nomtransitaire FROM bonchargement b, transitaire t
	where b.idtransitaire=t.idtransitaire and  idbon=$id");	?>
	<style>
	table {border-collapse:collapse;width: 100%}
	</style>	<?php	
	?>
		<page><?php $i=0; 
		if ($_SESSION["administrateur"]=="N") include('entetebon.php');?><br>
	<?php  while ($resultat=$result->fetch()) {  ?> 
			<?php 
			if ($_SESSION["administrateur"]=="O") {
			
			$reponse=$resultat["idposte"];
			$reqtrans = $bdd->query("SELECT * from poste where idposte='$reponse'");
			while ($reqposte = $reqtrans->fetch()) {
			$_SESSION["nomsite"]=$reqposte["nomsite"] ;  $_SESSION['contactposte']=$reqposte["contactposte"];
			$_SESSION["sitename"]=$reqposte["sitename"] ; $_SESSION['emailposte']=$reqposte["emailposte"]; 
			$_SESSION["adresseposte"]=$reqposte["adresseposte"];
			$_SESSION["titreposte"]=$reqposte["titreposte"];
			$_SESSION["titreresponsableng"]=$reqposte["titreresponsableng"];
			include('entetebon.php'); }
			}		
			EntetefactureBon($bdd,$resultat["idposte"],$resultat['datebon'],$resultat['numbon']);
		
		?>
		<p>
			<span style="font-style:normal">
			VEHICULE REGISTRATION NUMBER:</span><br>
			<span style="font-style:italic">
			(NUMERO D'IMMATRICULATION):</span>
			<span style="font-style:normal" >
			<font face="Trattatello, fantasy"><b><?php echo $resultat["numerovehicule"] ; ?></b></font></span> 
			</p>
			<p>
			
			<span style="font-style:normal" >
			DRIVER NAME: </span><br>
			<span style="font-style:italic">
			(NOM DU CHAUFFEUR):</span>
			<span style="font-style:normal" >
			<font face="Trattatello, fantasy"><b><?php echo $resultat["nomchaufeur"] ; ?></b></font></span> 
			
			</p>
			
			
			<p>
			<span style="font-style:normal" >
			FREIGHT FORWARDER: <br></span>
			<span style="font-style:italic">
			(TRANSITAIRE): </span><span style="font-style:normal" >
			<font face="Impact, fantasy"><b><?php echo $resultat["nomtransitaire"] ; ?></b></font></span> 
			
			
			</p>
			
			
			<p>
			<span style="font-style:normal" >
			DESCRIPTION OF THE GOODS <br></span>
			<span style="font-style:italic">
			(NATURE DES MARCHANDISES):</span><span style="font-style:normal" > 
			<font face="Impact, fantasy"><b><?php echo $resultat["marchandise"] ; ?></b></font></span> 
		
			</p>
			
			
			<p>
			<span style="font-style:normal" >
			ESTIMATED WEIGHT OF THE GOODS: <br></span>
			<span style="font-style:italic">
			(POIDS ESTIMATIF DES MARCHANDISES):</span> <span style="font-style:normal" > 
			<font face="Impact, fantasy"><b><?php echo $resultat["poids"].''.'KG' ; ?></b></font></span> 
		
			</p>
			
			<p>
			<span style="font-style:normal" >
			NUMBER OF PACKAGES/UNITS: <br></span>
			<span style="font-style:italic">(NOMBRE DE COLIS):</span> <span style="font-style:normal" >
			<font face="Impact, fantasy"><b><?php echo $resultat["nbrecolis"] ; ?></b></font></span> 
		
			</p>
			
			<p>
			<span style="font-style:normal" >
			NAME OF CONSIGNEE: <br> </span>
			<span style="font-style:italic">(DESTINATAIRE):</span> <span style="font-style:normal" >
			<font face="Impact, fantasy"><b><?php echo $resultat["nomdestinataire"] ; ?></b></font></span> 
			</p>
			
			
			<p>
			<span style="font-style:normal" >
			ADDRESS: <br> </span>
			<span style="font-style:italic">(ADRESSE): </span><span style="font-style:normal" >
			<font face="Impact, fantasy"><b><?php echo $resultat["adresse"] ; ?></b></font></span> 
			</p>
			<p>
			<span style="font-style:normal" >
			DATE OF ESTABLISHMENT: <br> </span>
			<span style="font-style:italic">(DATE DE CREATION): </span><span style="font-style:normal" >
			<font face="Impact, fantasy"><b><?php echo $resultat["datebon"] ; ?></b></font></span> 
			</p>
   <?php
	
	if (isset($resultat["modifyby"]))
	$iduser=$resultat["modifyby"]; else $iduser=$resultat["createdby"];
	$res = $bdd->query("SELECT * FROM user
	where iduser ='$iduser'");
	while ($resul=$res->fetch()){ 
		$nom=$resul["nomuser"];
		$prenom=$resul["prenomuser"];
	}
	?>

			
			<p>
			<span style="font-style:normal" >
			ESTABLISHED BY: <br> </span>
			<span style="font-style:italic">(ETABLIE PAR): </span><span style="font-style:normal" >
			<font face="Impact, fantasy"><b><?php echo $nom." ".$prenom ; ?></b></font></span> 
			</p>
			
				
			
		
			<?php   }   ?>
			<br><br>
			<p style="text-align:right" > 
			<span style="font-style:normal" >
			<b> <?php echo $_SESSION['titreposte']; ?> </b></span> <br>
			<span style="font-style:italic">
			<b><?php echo "(".$_SESSION['titreresponsableng'].")"; ?></b> </span>
			<?php     ?>
			</p>
			</page>
			<?php 
				$content= ob_get_clean();			
				require_once('html2pdf/html2pdf.class.php');

				try{

					$pdf=  new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8') ;
					$pdf->writeHTML($content);
					@ob_end_clean();
					$filename = 'Bon' .'_'.date('Ymd');
					$pdf->Output($filename.'.pdf','D'); 
					exit;
				}
					catch(HTML2PDF_exception $e) {
					echo $e;
					exit;} 
			 ?> 
			
			
