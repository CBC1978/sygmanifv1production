<?php
     $ress_mysql = mysql_connect('localhost', 'root', '');
     $db = mysql_select_db('calendrier', $ress_mysql) or die ("Connexion impossible");
?>