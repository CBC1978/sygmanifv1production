



 		<div class="col-lg-3">
			<a href="bonchargement.php">
				<div>
					<span class="fa fa-gears  fa-2x"></span><br>
				Gestion des Bons de Chargement <br><span><i> (Loading Note Management)</i> </span>
				</div>
			</a>
		</div>
				
		
   
		<?php  if ($_SESSION['parametre']=='O') { ?>
		 <div class="col-lg-3">
			 <a href="poste.php" >

			<div>
				<span class="fa fa-2x fa-ship"></span><br>
				Mise a jour des postes
			</div>
			 </a>
		 </div>
		<?php    }   ?>
		<?php  if ($_SESSION['administrateur']=='N') { ?>
		<div class="col-lg-3">
			<a href="transitaire.php" >
				<div>
					<span class="fa fa-user-plus  fa-2x"></span><br>
					Transitaires
				</div>
			</a>
		</div>
		<?php    }   ?>
		
	
	<?php  if ($_SESSION['gereruser']=='O') { ?>
		<div class="col-lg-3">
			<a href="groupe.php" >
				<div>
					<span class="fa fa-users  fa-2x"></span><br>
					Gestion des Groupes d'utilisateurs
				</div>
			</a>
		</div>
		<div class="col-lg-3">
			<a href="user.php" >
				<div>
					<span class="fa fa-user  fa-2x"></span><br>
					Gestion des utilisateurs
				</div>
			</a>
		</div>

	<?php    }    ?>
			 
	<div class="col-lg-3">
			<a href="statistique.php">
				<div>
					<span class="fa fa-gears  fa-2x"></span><br>
				Statistiques <br><span><i> (Statistic)</i> </span>
				</div>
			</a>
		</div>
				
		




