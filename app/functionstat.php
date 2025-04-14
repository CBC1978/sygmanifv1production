			
				
				<?php  
			set_time_limit(0); // 0 signifie qu'il n'y a pas de limite. Le script peut s’exécuter indéfiniment.
				function Afficher2cpdf($titre,$libposte, $conn,$i,$begindate,$enddate,$idposte,$typef) {
					$total = 0;
					if ($i==1) //Nombre de bon de chargement par pays
					$requete="SELECT count(idbon) AS nb, typec 
					FROM bonchargement 
					where  idposte=? and datebon between ? and ?
					group by typec";
				
					else if ($i==2)  // par transitaire
					$requete="SELECT count(idbon) AS nb, t.nomtransitaire
					FROM bonchargement b, transitaire t
					where b.idtransitaire = t.idtransitaire and 
					b.idposte=? and b.datebon Between ? and ? 
					group by t.nomtransitaire
					order by t.nomtransitaire" ;
					//nature de marchandises
					else if ($i==3) 	
					$requete="SELECT count(idbon) AS nb, marchandise
					FROM bonchargement 
					where idposte= ? and datebon between ? and ?
					group by marchandise
					order by marchandise" ;

					 else if ($i==4)  // bons emis par periode
					 $requete="SELECT *
					FROM bonchargement
					where idposte=? and datebon between ? and ?
					order BY typec, datebon" ;
					
					
					
				
					$reponse = $conn->prepare($requete);
					//$totale = $conn->prepare($requete);
					$reponse->execute(array($idposte,$begindate, $enddate));
					
					if ($typef=='excel'){
					header("Content-type: application/vnd.ms-excel");
					header("Content-Disposition: attachment; filename=Donnees.xls");
					}
					else if ($typef=='pdf') {
					ob_start();
					
					
					?>	
					
					<page> 
					 <page_footer>
					[[page_cu]]/[[page_nb]]
					</page_footer> <?php  } ?>
					<style>
						table {border-collapse:collapse;width: 100%}
					</style>
					<?php  include 'entete.php' ; echo '<br><br><br>'; ?>
					<h4><?php echo $titre; ?>	</h4>
					<h4> Poste:<?php  echo $libposte;  ?>  </h4>
					<h4> Date debut:<?php   echo $begindate.'   '; ?>  Date Fin:<?php   echo $enddate; ?>   </h4>
					<h4></h4>
					
					<table border=1 > 
						<tr style='background-color:silver;'>
						<?php if ($i==1) echo "<th> Typec </th><th> Nombre de bons </th>";  ?>
						<?php if ($i==2) echo "<th> Transitaire </th><th> Nombre de bons </th>";  ?>
						<?php if ($i==3) echo "<th> Nature marchandise </th><th> Nombre de bons </th>";  ?>
						<?php if ($i==4) echo "<th> Typec </th><th> Numero Bon </th><th> Numero vehicule </th><th> Chauffeur</th><th>Marchandises </th><th>Poids(kg)</th><th>Destinataire</th><th>Date</th>";  ?>
						</tr>			
					<?php  
											
					
			
					 while ($donnees = $reponse->fetch()) {
					?>	
					<tr>  <?php if ($i=="1") echo "<td>".$donnees["typec"]."</td>"."<td>".$donnees["nb"]."</td>";  	
					 if ($i=="2") echo "<td>".$donnees["nomtransitaire"]."</td>"."<td>".$donnees["nb"]."</td>";  	
					 if ($i=="3") echo "<td>".$donnees["marchandise"]."</td>"."<td>".$donnees["nb"]."</td>";  	
					 if ($i=="4") echo "<td>".$donnees["typec"]."</td>"."<td>".$donnees["numbon"]."</td>"."<td>".$donnees["numerovehicule"]."</td>"."<td>".$donnees["nomchaufeur"]."</td>"."<td>".$donnees["marchandise"]."</td>"."<td>".$donnees["poids"]."</td>"."<td>".$donnees["nomdestinataire"]."</td>"."<td>".$donnees["datebon"]."</td>";  ?>	
					
					
					</tr>
					<?php
					}
					//$total = $total+$donnees["SommeDepoids"];}
					?>
					<tr> <?php 
					if ($i=="1") echo "<td></td><td></td>";  	
					 if ($i=="2") echo "<td></td><td></td>";  	
					 if ($i=="3") echo "<td></td><td></td>";  	
					 if ($i=="4") echo "<td></td><td></td><td></td><td></td><td></td><td></td><td></td>";  ?>	
					</tr> </table>
					<?php if ($typef=='pdf') { ?>
					</page> 
					<?php	}
					if ($typef=='pdf') {
					 $content=ob_get_contents() ;
					 ob_get_clean();
					require_once('html2pdf/html2pdf.class.php');
					try{
					
					$pdf=  new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8') ;
					$pdf->writeHTML($content);
					ob_end_clean();
					$filename = 'Donnees'.'_'.date('Ymd');
					$pdf->Output($filename.'.pdf','D'); }
					catch(HTML2PDF_exception $e) {
					echo $e;
					exit;}} 
					}
					
					
					
					// fonction qui affiche 3  colonnes
					function Afficher3cpdf($titre,$libposte, $conn,$i,$j,$begindate,$enddate,$idposte,$datedeb,$datef, $nom,$nom1,$typef) {
					
					$total = 0;
					//type de cargaison
					if ($i==1 and $j==4) 	$requete='SELECT c.nomtypecargaison nom1, Sum(d.poids) AS SommeDepoids, Sum(d.nbrecolis) nom2 
					FROM trmaritime t, detailproduit d,  typedecargaison c
					where t.idmanifeste = d.idmanifeste and d.idtpecarg =c.idtpecarg and t.idposte=?  AND t.Effdate Between ? And ? and t.typedetrafic=?
					GROUP BY c.nomtypecargaison order by c.nomtypecargaison ;' ;
					
					else if ($i==2 and $j==4) 	$requete='SELECT c.nomtypecargaison as nom1, Sum(d.poids) AS SommeDepoids, Sum(d.nbrecolis) as nom2
					FROM trmaritime t, detailproduit d, typedecargaison c
					where t.idmanifeste = d.idmanifeste and d.idtpecarg =c.idtpecarg and t.idposte=?  AND t.etd Between ? And ? and t.typedetrafic=?
					GROUP BY c.nomtypecargaison order by c.nomtypecargaison ;' ;
					//Par section
								
					else if ($i==1 and $j==8)  $requete='SELECT Sum(d.poids) AS SommeDepoids, s.idsection as nom1,s.nomsection as nom2
					FROM trmaritime t, detailproduit d,filiere f ,souschapitre sc,chapitre c,section s
					WHERE t.idmanifeste=d.idmanifeste And d.idfiliere=f.idfiliere 
					And  f.idschapitre=sc.idschapitre And sc.idchapitre=c.idchapitre 
					And c.idsection=s.idsection and t.idposte=?   And t.effdate Between ?  And ? And t.typedetrafic= ?
					GROUP BY s.idsection,s.nomsection;' ;

					else if ($i==2 and $j==8)  $requete='SELECT Sum(d.poids) AS SommeDepoids, s.idsection as nom1,s.nomsection as nom2
					FROM trmaritime t, detailproduit d, filiere f ,souschapitre sc,chapitre c,section s
					WHERE t.idmanifeste=d.idmanifeste And d.idfiliere=f.idfiliere 
					And  f.idschapitre=sc. idschapitre And sc.idchapitre=c.idchapitre 
					And c.idsection=s.idsection and t.idposte=?   
					And t.etd Between ?  And ? And t.typedetrafic= ?
					GROUP BY s.idsection,s.nomsection;' ;					
					
					

					$reponse = $conn->prepare($requete);
					$totale = $conn->prepare($requete);
					
					$reponse->execute(array($idposte,$datedeb, $datef,$i));
					$totale->execute(array($idposte,$datedeb, $datef,$i));
					 while ($tot = $totale->fetch()) {
					 $total = $total+$tot["SommeDepoids"];}
					 
					if ($typef=='excel'){
					header("Content-type: application/vnd.ms-excel");
				// la ligne suivante est facultative, elle sert à donner un nom au fichier Excel
					header("Content-Disposition: attachment; filename=Donnees.xls");
					}
					else if ($typef=='pdf') {
					ob_start();
					
					?>	
					
					<page> 
					 <page_footer>
					[[page_cu]]/[[page_nb]]
					</page_footer> <?php  } ?>

					<h4><?php echo $titre; ?>	</h4>
					<h4> Poste:<?php  echo $libposte;  ?>  </h4>
					<h4> Date debut:<?php   echo $begindate.'   '; ?>  Date Fin:<?php   echo $enddate; ?>   </h4>
					<h4></h4>
					
					<table border=1> 
						<tr><th> <?php  echo $nom;  ?>   </th><th> <?php  echo $nom1;  ?> </th>  <th>  Tonnage </th> <th>  Pourcentage(%) </th> </tr>
					<?php  
											
					
			
					 while ($donnees = $reponse->fetch()) {
					?>	
					<tr> <td>  <?php echo  $donnees["nom1"]; ?>	</td> 
					 <td>  <?php echo  $donnees["nom2"]; ?>	</td> 
					<td>  <?php echo number_format($donnees["SommeDepoids"], 3, ',', ' '); ; ?> </td> 
					<td>  <?php echo number_format($donnees['SommeDepoids']/$total*100,2); ?> </td> </tr>
					<?php
					}
					//$total = $total+$donnees["SommeDepoids"];}
					?>
					<tr> <td> TOTAL </td>  <td>  </td> <td><?php echo  number_format($total, 3, ',', ' ');?>  </td > </tr> </table>
					<?php if ($typef=='pdf') { ?>
					</page> 
					
					<?php	
					
					 $content=ob_get_contents() ;
					 ob_get_clean();
					require_once('html2pdf/html2pdf.class.php');
					try{
					
					$pdf=  new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8') ;
					$pdf->writeHTML($content);
					ob_end_clean();
					$filename = 'donnees3c' .'_'.date('Ymd');
					$pdf->Output($filename.'.pdf','D'); }
					catch(HTML2PDF_exception $e) {
					echo $e;
					exit;} }// fin du type pdf
					} 
					
					
					
					//function à 4  colonnes
					function Afficher4cpdf($titre,$libposte, $conn,$i,$j,$begindate,$enddate,$idposte,$datedeb,$datef, $nom,$nom1,$typef) {
					
					$total = 0;
					$totalnbc = 0;
					//type de cargaison
					if ($i==1 and $j==4) 	
					$requete='SELECT c.nomtypecargaison nom1,sum(d.nbc) as nbc, Sum(d.poids) AS SommeDepoids, Sum(d.nbrecolis) nom2 
					FROM trmaritime t, detailproduit d,  typedecargaison c
					where t.idmanifeste = d.idmanifeste and d.idtpecarg =c.idtpecarg and t.idposte=?  AND t.Effdate Between ? And ? and t.typedetrafic=?
					GROUP BY c.nomtypecargaison order by c.nomtypecargaison ;' ;
					
					else if ($i==2 and $j==4) 	
					$requete='SELECT c.nomtypecargaison as nom1, sum(d.nbc) as nbc, Sum(d.poids) AS SommeDepoids, Sum(d.nbrecolis) as nom2
					FROM trmaritime t, detailproduit d, typedecargaison c
					where t.idmanifeste = d.idmanifeste and d.idtpecarg =c.idtpecarg and t.idposte=?  AND t.etd Between ? And ? and t.typedetrafic=?
					GROUP BY c.nomtypecargaison order by c.nomtypecargaison ;' ;
					
					

					$reponse = $conn->prepare($requete);
					$totale = $conn->prepare($requete);
					
					$reponse->execute(array($idposte,$datedeb, $datef,$i));
					$totale->execute(array($idposte,$datedeb, $datef,$i));
					 while ($tot = $totale->fetch()) {
					  $totalnbc = $totalnbc+$tot["nbc"];
					 $total = $total+$tot["SommeDepoids"];}
					 
					if ($typef=='excel'){
					header("Content-type: application/vnd.ms-excel");
				// la ligne suivante est facultative, elle sert à donner un nom au fichier Excel
					header("Content-Disposition: attachment; filename=Donnees.xls");
					}
					else if ($typef=='pdf') {
					ob_start();
					
					?>	
					
					<page> 
					 <page_footer>
					[[page_cu]]/[[page_nb]]
					</page_footer> <?php  } ?>

					<h4><?php echo $titre; ?>	</h4>
					<h4> Poste:<?php  echo $libposte;  ?>  </h4>
					<h4> Date debut:<?php   echo $begindate.'   '; ?>  Date Fin:<?php   echo $enddate; ?>   </h4>
					<h4></h4>
					
					<table border=1> 
						<tr><th> <?php  echo $nom;  ?>   </th><th> <?php  echo $nom1;  ?> </th>  <th>  Nombre Type de Cargaison </th> <th>  Tonnage </th> <th>  Pourcentage(%) </th> </tr>
					<?php  
											
					
			
					 while ($donnees = $reponse->fetch()) {
					?>	
					<tr> <td>  <?php echo  $donnees["nom1"]; ?>	</td> 
					 <td>  <?php echo  $donnees["nom2"]; ?>	</td> 
					 <td>  <?php echo  $donnees["nbc"]; ?>	</td>
					<td>  <?php echo number_format($donnees["SommeDepoids"], 3, ',', ' '); ; ?> </td> 
					<td>  <?php echo number_format($donnees['SommeDepoids']/$total*100,2); ?> </td> </tr>
					<?php
					}
					//$total = $total+$donnees["SommeDepoids"];}
					?>
					<tr> <td> TOTAL </td>  <td>  </td><td> <?php echo  $totalnbc;?> </td>  <td><?php echo  number_format($total, 3, ',', ' ');?>  </td > </tr> </table>
					<?php if ($typef=='pdf') { ?>
					</page> 
					
					<?php	
					
					 $content=ob_get_contents() ;
					 ob_get_clean();
					require_once('html2pdf/html2pdf.class.php');
					try{
					
					$pdf=  new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8') ;
					$pdf->writeHTML($content);
					ob_end_clean();
					$filename = 'donnees3c' .'_'.date('Ymd');
					$pdf->Output($filename.'.pdf','D'); }
					catch(HTML2PDF_exception $e) {
					echo $e;
					exit;} }// fin du type pdf
					 } // fin de la procedure à 4 colonnes
					
						
					// Différentes Listes	
					
					
						
									
						 
						