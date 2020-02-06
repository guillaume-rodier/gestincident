<?php
	// Intégration du fichier de fonctions afin de se connecter à la base de données
	include('connexionbd.php');
?>

<!DOCTYPE HTML>
<html>
	<!-- Titre dans l'onglet du navigateur et définition du mode de codage du texte -->
	<head>
		<Title>Rapport d'incident technique</title>
		<meta charset= "UTF-8" />
		<link rel="stylesheet" type="text/css" href="css/bmenu.css" />
		<link rel="stylesheet" type="text/css" href="css/blockquote.css" />
		<link rel="stylesheet" type="text/css" href="css/header.css" />
		<link rel="stylesheet" type="text/css" href="css/style_input.css" />
		<link rel="stylesheet" type="text/css" href="css/liens.css" />
		<link rel="stylesheet" type="text/css" href="css/menu.css" />
		<link rel="stylesheet" type="text/css" href="css/nav_item.css" />
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/footer.css">
		<link rel="stylesheet" href="css/background.css">
		<link rel="icon" type="image/jpg" href="Images/logo_st_vincent.jpg" />
	</head>
	
	<!-- Bannière -->
	<header class="yellow">
		<!-- Logo et phrases du lycée Saint Vincent -->
		<h1>
			<img src="Images/logo.png" alt="Logo du lycée Saint Vincent" />
			<center>
				SAINT VINCENT « SUAVITER ET FORTITER »
			</center>
		</h1>
		
		<center>
			<h2>
				Bienveillance et exigence : un cadre exceptionnel pour s'épanouir
			</h2>
		</center>
		
		<header class="beige">
			<!-- Liens vers les différentes pages du site dy lycée -->
			<center>
					<ul class="bmenu">
						<li class="nav-item"><a href="http://www.lycee-stvincent.fr/actualite.html">Actualités</a></li>
						<li class="nav-item"><a href="">Présentation</a></li>
						<li class="nav-item"><a href="index.php">Enseignement</a></li>
						<li class="nav-item"><a href="index.php">Vie au lycée</a></li>
						<li class="nav-item"><a href="index.php">Europe</a></li>
						<li class="nav-item"><a href="index.php">Anciens</a></li>
					</ul>
				
			</center>
		</header>
	</header>
	
	<body>
		
			<blockquote class="corps">
				<?php
					
		
		// Ecran qui s'affiche si on clique sur OK
		if (isset($_POST['valider']))
		{
						// On récupère les valeurs saisies par l'utilisateur
						// $valeurs=$_POST['prof', 'nature_incident', 'lieu', 'description', 'severite', 'date_incident']
						
						$prof=$_POST['idRapporteur'];
						$nature_incident=$_POST['idNature'];
						$lieu=$_POST['lieu_incident'];
						$description=$_POST['description_incident'];
						$severite=$_POST['severite_incident'];
						$date_incident=$_POST['date_incident'];
						$libelle_etat=$_POST['libelle_etat'];
						
						// On se connecte à la BD
						$base = connectMaBase();
						
						// On remplit la BD
						
						$sql = "INSERT INTO incident VALUES('',".$_POST['idRapporteur'].", ".$_POST['idNature'].", '".$_POST['lieu_incident']."', '".$_POST['description_incident']."', '".$_POST['severite_incident']."', '".$_POST['date_incident']."', ".$_POST['libelle_etat'].")";
						// echo $sql;
						
						
						$req = $base->exec($sql);
						// $req -> execute(array(
							// 'idRapporteur' => $prof,
							// 'idNature' => $nature_incident, 
							// 'lieu_incident' => $lieu,
							// 'description_incident' => $description,
							// 'severite_incident' => $severite,
							// 'date_incident' => $date_incident,
							// 'libelle_etat' => $libelle_etat
							// ));
						
						// On ferme la connexion à la BD
						// $base = null;
						
						// Récapitulatif des données saisies par l'utilisateur :
						echo '<blockquote class="application"><h1>Récapitulatif de la déclaration</h1>';
						
						// Affichage du nom du prof rapporteur de l'incident en fonction de la valeur récupéré dans la variable $prof
						echo '<h3>VOUS ÊTES :</h3>';
						
						if ($prof == 1)
						{
							echo 'Mikaël Idasiak';
						}
						else if ($prof == 2)
						{
							echo 'Fethi Ammar';
						}
						else if ($prof == 3)
						{
							echo 'Kintzler Agnès';
						}
						else if ($prof == 4)
						{
							echo 'Hélène Laloy';
						}
						else if ($prof == 5)
						{
							echo 'Claire Plaisance';
						}
						else if ($prof == 6)
						{
							echo 'Annie Blanchard';
						}
						else if ($prof == 7)
						{
							echo 'Gaël Daniel';
						}
						else if ($prof == 8)
						{
							echo 'Jean-Bernard Dodemont';
						}
						
						// Affichage de la nature de l'incident
						echo '<h3>Nature de l\'incident :</h3>';
						if ($nature_incident == 1)
						{
							echo 'Informatique';
						}
						else if ($nature_incident == 2)
						{
							echo 'Propreté';
						}
						else if ($nature_incident == 3)
						{
							echo 'Matériel';
						}
						else if ($nature_incident == 4)
						{
							echo 'Santé';
						}
						else if ($nature_incident == 5)
						{
							echo 'Vandalisme';
						}
						
						// Affichage du lieu de l'incident
						echo '<h3>Lieu de l\'incident :</h3>'
						.$lieu;
						
						// Affichage de la description de l'incident
						echo '<h3>Description de l\'incident :</h3>'
						.$description;
						
						// Affichage de la sévérité de l'incident
						echo '<h3>Sévérité de l\'incident :</h3>'
						.$severite;
						
						// Affichage de la date de l'incident
						echo '<h3>Date de l\'incident :</h3>'
						.$date_incident;
						
						// Confirmation de l'enregistrement des valeurs saisies
						echo '<h3>Votre déclaration d\'incident a bien été pris en compte</h3>
						Nous allons la prendre en compte rapidement.<br/><br/>
						<input type="button" onclick="document.location.href=\'rapport_incident.php\';" value="Retour"></blockquote></blockquote><body>';	
		}
		// Écran d'arrivée sur la page
		else
		{
	?>
				<form name="form" method="post" action="rapport_incident.php">
					<!-- Titre de la page -->
					<h1 color="white">Rapport d'incident</h1>
					
					<!-- Liens vers d'autres pages -->
					<div class="page">
						<ul class="page">
							<li><a href="rapport_incident.php" class="bouton bleu medium">Rapporter Incident</a></li>
							<li><a href="incident.php" class="bouton bleu medium"> Suivi des Incidents </a></li>
						</ul>
					</div>
					
						<br/><br/>
					
					<blockquote class="application">
						<!-- Liste permettant de saisir le rapporteur -->
						<p>
							Rapporteur
							<select name="idRapporteur">
								<option>Sélectionner un professeur</option>
								<option value="1">Idasiak Mikaël</option>
								<option value="2">Ammar Fethi</option>
								<option value="3">Kintzler Agnès</option>
								<option value="4">Laloy Hélène</option>
								<option value="5">Plaisance Claire</option>
								<option value="6">Blanchard Annie</option>
								<option value="7">Daniel Gaël</option>
								<option value="8">Dodemont Jean-Bernard</option>
							</select>
						
						<!-- Liste permettant de saisir la nature de l'incident -->
							Nature de l'incident
							<select name="idNature">
								<option>Sélectionner la nature de l'incident</option>
								<option value="1">Informatique</option>
								<option value="2">Propreté</option>
								<option value="3">Matériel</option>
								<option value="4">Santé</option>
								<option value="5">Vandalisme</option>
							</select>
						</p>
						
						<!-- Liste permettant de saisir la nature de l'incident -->
						<p>
							<label for="lieu_incident">Lieu précis de l'incident :</label>
							<input type="text" name="lieu_incident" id="lieu_incident" />
						</p>
						
						<!-- Liste permettant de saisir la description de l'incident -->
						<input type="text" name="description_incident" class="style_input" id="id1" value="Description de l'incident" onclick="effacer(value,this.id);" />
						
						<table>
							<tr>
								<td>
									<!-- Liste permettant de saisir la séverité de l'incident -->
									<p>Sévérité de l'incident : 
										<input type="radio" name= "severite_incident" value="important"/>Important
										<input type="radio" name= "severite_incident" value="moyen"/>Moyen
										<input type="radio" name= "severite_incident" value="faible"/>Faible
									</p>
								</td>
							</tr>
							<tr>
								<td>
									<!-- Liste permettant de saisir la séverité de l'incident -->
									<p>état de l'incident : 
										<input type="radio" name= "libelle_etat" value="1"/>Ouvert
										<input type="radio" name= "libelle_etat" value="2"/>En cours 
										<input type="radio" name= "libelle_etat" value="3"/>Cloturé
									</p>
								</td>
								<td>
									<!-- Objet permettant de saisir la date -->
									<input type="date" name="date_incident">
								</td>
							</tr>
						</table>
						
						<!-- Bouton pour envoyer les infos à la base de données -->
						<!--<input type="submit" name="valider" value="Envoyer"/>-->
						<input type="submit" name="valider" value="Envoyer"> 
						</br> 
						</br>
						
						<!-- <a href="index.php" class="bouton bleu medium"> Suivi des Incidents </a> -->
					</blockquote>
				</form>
			</blockquote>
	<?php
		}
	?>
				<!-- Fonction JavaScript pour effacer le texte dans l'aire de saisie de la description de l'incident, entre autres -->
				<script type="text/javascript">
					function effacer(value_defaut,id)
					{
						truk=document.getElementById(id);
						type=truk.tagName;
						type=type.toLowerCase();
						if (type=='input')
						{
							if (truk.value==value_defaut)
							truk.value='';
						}
						else if (type=='textarea')
						{
							if (truk.innerHTML==value_defaut)
							truk.innerHTML='';
						}
					}
				</script>
		</body>
			<footer>
				<p>Copyright Thouin Rodier Edeyer Duprey - Tous droits réservés<br />
				<a href="mentionlegal.html" class="bouton bleu medium"> Mentions Légales </a></p>
			</footer>
</html>