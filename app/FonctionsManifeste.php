

<?php 

function EntetefactureC($conn,$idcons,$typedetrafic,$numerovoyage,$idposte,$datevoyage,$nomnavire) {
	 $date = date_parse($datevoyage);
	 $idmois = $date['month'];
     $annee = $date['year'];
	VerifierFacture($annee,$idposte,$conn,$numerovoyage,$idcons,$datevoyage,$nomnavire,$typedetrafic);
		$reqcons=$conn->prepare("select * from consignataire where idconsignataire=?");
		$reqcons->execute(array($idcons));
		$cons=$reqcons->fetch();
		
		$reqfac=$conn->prepare("select * from facture where idconsignataire=?
		and voyage=? and idposte=? and datevoyage=?  and nomnavire=?");
		$reqfac->execute(array($idcons,$numerovoyage,$idposte,$datevoyage,$nomnavire));
		
		
		
	?>
	<table>
	<tr>
		<td>
		DATE:

		<i><?php echo date("Y-m-d");?></i>

		</td> 
		
		<td>&nbsp;&nbsp;
		N°:
		 
			
		<b><?php echo $_SESSION['idport'].'-'.$cons['idconsignataire']; if ($donnees=$reqfac->fetch()) echo '-'.$donnees['numerofac'].'-'.$donnees['annee'] ;else {  
		
		}  //$mois.'-'.$an ;  ?></b>
		&nbsp;&nbsp;
		</td> 
		<td><?php if ($typedetrafic==1) echo 'Import'; else echo 'Export' ;?> <b> Mois/Month:<?php echo $idmois.'/'.$annee ;?></b>  </td> 
	</tr>
	</table>
	<table border=1 >
	<tr>
		<td> <span style="font-style:normal" >Doit </span><span style="font-style:italic" >/Debit to:</span>
		<p> <span><?php echo $cons['nomcons'] ;?> </span><br>
		<span> <?php echo $cons['adressecons'] ;?> </span><br>
		<span> <?php echo $cons['villecons'] ;?> </span><br>
		<span> <?php echo $cons['emailcons'] ;?></span> </p>
		</td>
		
	</tr>
	</table>
		
	
	<?php }
	
	
	
	
	
	
	function EntetefactureGC($conn,$idcons,$typedetrafic,$idposte,$idmois,$annee) {
		 VerifierFacturegc($idposte,$idmois,$idcons,$annee,$conn,$typedetrafic);
		//VerifierFactureGc($annee,$idposte,$conn,$numerovoyage,$idcons,$datevoyage,$nomnavire,$typedetrafic);
		$reqcons=$conn->prepare("select * from consignataire where idconsignataire=?");
		$reqcons->execute(array($idcons));
		$cons=$reqcons->fetch();
		
		$reqfac=$conn->prepare("select numerofac,annee from facturegc where idconsignataire=?
		and annee=? and idposte=? and idmois=?  and typedetrafic=?");
		$reqfac->execute(array($idcons,$annee,$idposte,$idmois,$typedetrafic));
		
		
		
	?>
	<table>
	<tr>
		<td>
		DATE:

		<i><?php echo date("Y-m-d");?></i>

		</td> 
		
		<td>&nbsp;&nbsp;
		N°:
		 
			
		<b><?php echo $_SESSION['idport'].'-'.$cons['idconsignataire']; if ($donnees=$reqfac->fetch()) echo '-R-'.$donnees['numerofac'].'-'.$donnees['annee'] ;  //$mois.'-'.$an ;  ?></b>
		&nbsp;&nbsp;
		</td> 
		<td><?php if ($typedetrafic==1) echo 'Import'; else echo 'Export' ;?> &nbsp;&nbsp; <b> Mois/Month:<?php echo $idmois.'/'.$annee ;?></b>  </td>  
	</tr>
	</table>
	<table border=1 >
	<tr>
		<td> <span style="font-style:normal" >Doit </span><span style="font-style:italic" >/Debit to:</span>
		<p> <span><?php echo $cons['nomcons'] ;?> </span><br>
		<span> <?php echo $cons['adressecons'] ;?> </span><br>
		<span> <?php echo $cons['villecons'] ;?> </span><br>
		<span> <?php echo $cons['emailcons'] ;?></span> </p>
		</td>
		
	</tr>
	</table>
		
	
	<?php }
	
	
	
	
		
	
	
	function EnteteJustification($conn,$idcons,$typedetrafic,$numerovoyage,$idposte,$datevoyage,$nomnavire) {

		$reqcons=$conn->prepare("select * from consignataire where idconsignataire=?");
		$reqcons->execute(array($idcons));
		$cons=$reqcons->fetch();
				
		
	?>
	<p></p> <p></p>
	Consignataire/Agent:<?php echo $cons['nomcons']; ?> <br>
	Type de Trafic: <?php if ($typedetrafic==1) echo 'Import'; else echo 'Export' ;?>  &nbsp; &nbsp;  <br>
	<?php echo 'Voyage'; ?> &nbsp;&nbsp; <?php  echo $numerovoyage; ?> &nbsp;&nbsp;  du Navire/Vessel <?php echo $nomnavire; ?> &nbsp; &nbsp; du &nbsp; &nbsp; <?php echo $datevoyage; ?>
	
	
	<?php }
	//cbc lome cotonou Tema et Abidjan Nouvelle version
	function NouveauNumeroFacture($idposte,$annee,$conn,$typedetrafic){
		try{
		$req = $conn->prepare("select max(numerofac) as nb from facture where idposte=? and annee=? and typedetrafic=? ");
		$req->execute(array($idposte,$annee,$typedetrafic));
				
			}
		catch(Exception $e)
			{
		die('Erreur : '.$e->getMessage());}
		$donnees = $req->fetch();
		return intval($donnees['nb'])+1;
		}	

//cbc lome cotonou Tema Cote d'ivoire
	function VerifierFacture($annee,$idposte,$conn,$voyage,$cons,$date,$nomnavire,$typedetrafic){
	try{
	$res=$conn->prepare("select * From facture where annee=? and 
	idposte=? and voyage=? and idconsignataire=? and datevoyage=? 
	and nomnavire=? and typedetrafic=?)");
	//$res->bindParam('ss',$annee,$idposte);
	$res->execute(array($annee,$idposte,$voyage,$cons,$date,$nomnavire,$typedetrafic));
		}
		catch(Exception $e)
			{
		die('Erreur : '.$e->getMessage());}
		//$resultat = $res->fetchAll();
		$test=1;
	while ($resultat = $res->fetch()){ 
	//$res->bind_result($an,$pos,$numi,$nume);
	//if (count($resultat) > 0) {
		$_SESSION['numerofac']=$resultat['numerofac'];
		//$_SESSION['nume']=$resultat['derniernumeroe'];
		 $test=2;}
	if ($test==1) {
		$nb=NouveauNumeroFacture($idposte,$annee,$conn,$typedetrafic);
		
		$stmt = "INSERT INTO facture (idposte,idconsignataire,annee,voyage,datevoyage,numerofac,nomnavire,typedetrafic)
		VALUES ($idposte,'$cons',$annee,'$voyage','$date',$nb,'$nomnavire',$typedetrafic)";
		//debug($stmt);
		$conn->exec($stmt);
			
		 }
		}
		
		//cbc ghana 
		function NouveauNumeroFacturegc($idposte,$annee,$idmois,$typedetrafic,$conn){
		try{
		$req = $conn->prepare("select max(numerofac) as nb from facturegc 
		where idposte=? and annee=? and typedetrafic=?");
		$req->execute(array($idposte,$annee,$typedetrafic));
				
			}
		catch(Exception $e)
			{
		die('Erreur : '.$e->getMessage());}
		$donnees = $req->fetch();
		return intval($donnees['nb'])+1;
		}	

	//ghana 
	function VerifierFacturegc($idposte,$idmois,$cons,$annee,$conn,$typedetrafic){
	try{
	$res=$conn->prepare("select * From facturegc where annee=? and 
	idposte=? and idmois=? and idconsignataire=? and typedetrafic=?");
	//$res->bindParam('ss',$annee,$idposte);
	$res->execute(array($annee,$idposte,$idmois,'$cons',$typedetrafic));
		}
		catch(Exception $e)
			{
		die('Erreur : '.$e->getMessage());}
		//$resultat = $res->fetchAll();
		$test=1;
	while ($resultat = $res->fetch()){ 
	
		 $test=2;}
	if ($test==1) {
		$nb=NouveauNumeroFacturegc($idposte,$annee,$idmois,$typedetrafic, $conn);
		
		$stmt = "INSERT INTO facturegc (idposte,
		idconsignataire,annee,idmois,numerofac,typedetrafic)
		VALUES ($idposte,'$cons',$annee,$idmois,$nb,$typedetrafic)";
		//debug($stmt);
		$conn->exec($stmt);
			
		 }
		}
	
	function NouveauNumeroFactureAC($idposte,$annee,$conn,$typedetrafic){
		try{
		$req = $conn->prepare("select max(numerofac) as nb from factureac where idposte=? and annee=? and typedetrafic=?");
		$req->execute(array($idposte,$annee,$typedetrafic));
				
			}
		catch(Exception $e)
			{
		die('Erreur : '.$e->getMessage());}
		$donnees = $req->fetch();
		return intval($donnees['nb'])+1;
		}
		
	function NouveauNumeroDetailfactac($conn){
		try{
		$req = $conn->prepare("select max(numero) as nb from detailfactac");
		$req->execute();
			}
		catch(Exception $e)
			{
		die('Erreur : '.$e->getMessage());}
		$donnees = $req->fetch();
		return intval($donnees['nb'])+1;
		}	
	
	function EntetefactureBon($conn,$idposte,$datebon,$numbon) {
	 $date = date_parse($datebon);
	 $idmois = $date['month'];
     $annee = $date['year'];
	$libposte=Nomposte($idposte,$conn)	;
	?>
	
		<br>
		DATE:

		<i><?php echo date("Y-m-d");?></i>

		<p style="text-align:center" >
		<span style="font-style:normal"><b>LOADING NOTE</b> </span>
		<span style="font-style:italic"><b>/(BON DE CHARGEMENT)</b></span>
		&nbsp;&nbsp;
		<b><?php echo 'N°'.$libposte.'-'; echo $numbon ; ?></b>
		</p>
		
		
		
	
	
		
	
	<?php }
	function NouveauNumeroFactureAP($idposte,$annee,$conn){
		try{
		$req = $conn->prepare("select max(numerofac) as nb from factureap where idposte=? and annee=? ");
		$req->execute(array($idposte,$annee));
				
			}
		catch(Exception $e)
			{
		die('Erreur : '.$e->getMessage());}
		$donnees = $req->fetch();
		return intval($donnees['nb'])+1;
		}
	
	function NouveauNumeroDetailfactap($conn){
		try{
		$req = $conn->prepare("select max(numero) as nb from detailfactap");
		$req->execute();
			}
		catch(Exception $e)
			{
		die('Erreur : '.$e->getMessage());}
		$donnees = $req->fetch();
		return intval($donnees['nb'])+1;
		}	
	
	
	// Facture Autres Prestations
	function EntetefactureAP($conn,$idcli,$idposte,$datefact,$numerofact) {
	 $date = date_parse($datefact);
	 $idmois = $date['month'];
     $annee = $date['year'];
	
		$reqcli=$conn->prepare("select * from client where idcli=?");
		$reqcli->execute(array($idcli));
		$cli=$reqcli->fetch();
		
		$reqfac=$conn->prepare("select * from factureap where numerofact=?");
		$reqfac->execute(array($numerofact));
		
	
		
		
		
	?>
	<table>
	<tr>
		<td>
		DATE:

		<i><?php echo date("Y-m-d");?></i>

		</td> 
		
		<td>&nbsp;&nbsp;
		N°:
		 
			
		<b><?php echo $_SESSION['idport'].'-'.$cli['idcli']; if ($donnees=$reqfac->fetch()) echo '-AP'.'-'.$donnees['numerofac'].'-'.$donnees['annee'] ;else {  
		
		}  //$mois.'-'.$an ;  ?></b>
		&nbsp;&nbsp;
		</td> 
		<td><b> &nbsp;&nbsp;  Mois/Month:<?php echo $idmois.'/'.$annee ;?></b>  </td> 
	</tr>
	
	<tr>
	 <td>Référence: <?php echo $donnees['reference']; ?> </td>
	</tr>
	</table>
	<table border=1 >
	<tr>
		<td> <span style="font-style:normal" >Doit </span><span style="font-style:italic" >/Debit to:</span>
		<p> <span><?php echo $cli['raisoc'] ;?> </span><br>
		<span> <?php echo $cli['adressecli'] ;?> </span><br>
		<span> <?php echo $cli['ville'] ;?> </span><br>
		<span> <?php echo $cli['email'] ;?></span> </p>
		</td>
		
	</tr>
	</table>
		
	
	<?php }
	
	
	?>
	
	
	