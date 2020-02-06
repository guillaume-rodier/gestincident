<?php	
	include('connexionbd.php');
?>
<?php
	$base = connectMaBase();
	/*Constantes*/
	$nbDataParPage = 10;
	/* Gestion de la page actuelle */
	if(!array_key_exists('nrPage', $_GET))
	{
		$pageActuelle = 1;
	}
	else
	{
		$pageActuelle =  $_GET['nrPage'];
	}
	//Recuperation nombre de pages necessaires
	$sql = "SELECT COUNT(*) AS total FROM incident";
	
	foreach  ($base->query($sql) as $row) {
		$nbTotalDonnees = $row['total'];
	}

	$nbPages = ceil($nbTotalDonnees / $nbDataParPage);
	// Système pour éviter des données non comprise dans la barre de recherche 
	if($pageActuelle > $nbPages || $pageActuelle < 1)
	{
		$pageActuelle = 1;
	}
?>
<html>
	<head>
		<meta charset="utf-8" />
			<link rel="stylesheet" type="text/css" href="css/bmenu.css" />
			<link rel="stylesheet" type="text/css" href="css/tableau.css" />
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
		
		<title>Rapport d'incident technique</title>				
	</head>
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
				
			<div class="page">
			<ul class="page">
				<h1>Suivi d'incident</h1>
				<li><a href="rapport_incident.php" class="bouton bleu medium">Rapporter Incident</a></li>
				<li><a href="incident.php" class="bouton bleu medium"> Suivi des Incidents </a></li>
			</ul>
			</div>
			
			<br />
			<br />
			<br />
			<blockquote class="application">
			<form name="info" method="post" action = "incident.php">
				Filtres:
				<select name="Nom" size="1">
					<option> Séléctionner un professeur </option>
					<?php
					// Connexion à la BD
					// $base = ConnectMaBase();
					// On exécute la requete
					$reponse = $base->query('SELECT * FROM rapporteur ORDER BY nom_rapporteur ASC');
					// On affiche chaque entrée
					while ($donnees = $reponse->fetch())
					{
						echo '<option value=' .$donnees['id_rapporteur']. '>' .$donnees['nom_rapporteur'].' '.$donnees['prenom_rapporteur']. '</option>';
					}
					$reponse->closeCursor();
					// Deconnexion de la BD
					// $base=NULL;
					?>
				</select>
				<select name="Nature" size="1">
					<option> Séléctionner une nature </option>
					<?php
						// Connexion à la BD
					// $base = ConnectMaBase();
					// On exécute la requete
					$reponse = $base->query('SELECT * FROM nature_incident');
					// On affiche chaque entrée
					while ($donnees = $reponse->fetch())
					{
						
						echo '<option value=' . $donnees['id_nature'].'>'.$donnees['libelle_nature']. '</option>';
					}
					$reponse->closeCursor();
					// Deconnexion de la BD
					// $base=NULL;
					?>
				</select>
				<select name="Etat" size="1">
					<option> Séléctionner un état </option>
					<?php
						// Connexion à la BD
					// $base = ConnectMaBase();
					// On exécute la requete
					$reponse = $base->query('SELECT * FROM etat');
					// On affiche chaque entrée
					while ($donnees = $reponse->fetch())
					{
						
						echo '<option value=' . $donnees['id_etat'].'>'.$donnees['libelle_etat']. '</option>';
					}
					$reponse->closeCursor();
					// Deconnexion de la BD
					// $base=NULL;
					?>
				</select>
				
				<input type='date'  name='date' value='date'/>	
				
				<input type='submit' name='Valider' value='ok'/>
			</form>
			
			<table border="1" class="tableau">
				<thead>
					<tr>
						<td>Nom</td>
						<td>Date</td>
						<td>Nature de l'incident</td>
						<td>Sévérité</td>
						<td>État</td>
					</tr>
				</thead>
				<tbody>
			<?php
				$where = "";
				if (isset($_POST['Valider']))
				{
					// $base = connectMaBase();
					// echo '<pre>';
					// print_r($_POST);
					// echo '</pre>';
					
					if (is_numeric($_POST['Nom']))
					{
						$where = $where . ' AND i.idRapporteur = "' . $_POST['Nom'].'"';
					}
					
					if (is_numeric($_POST['Nature']))
					{
						$where = $where . ' AND i.idNature = "' . $_POST['Nature'].'"';
					}
					
					if (is_numeric($_POST['Etat']))
					{
						$where = $where . ' AND i.idEtat = "' . $_POST['Etat'].'"';
					}
					
					if($_POST['date'] != "")
					{
						$where = $where . ' AND i.date_incident = "' . $_POST['date'].'"';
					}
				}
				
					// si je n'ai pas de resultat dans la requete le nombre de données est donc egale à zero et il faut que je fasse un petit message comme quoi il n'y a pas de données 
					// On récupère tout le contenu de la table incident
					$sqlLimit = $nbDataParPage;
					$sqlOffset = $nbDataParPage*($pageActuelle-1);
					$sql = 'SELECT 
								i.id_incident,
								i.idRapporteur,
								i.idNature,
								i.date_incident,
								i.severite_incident,
								i.idEtat,
								r.nom_rapporteur,						
								r.prenom_rapporteur,
								n.libelle_nature,
								e.libelle_etat
							FROM incident i, rapporteur r, nature_incident n, etat e
							WHERE i.idRapporteur = r.id_rapporteur
							AND i.idNature = n.id_nature
							AND i.idEtat = e.id_etat
							'.$where.' 
							ORDER BY i.date_incident DESC
							LIMIT '. $sqlLimit .' OFFSET '.$sqlOffset;
							
							// echo $sql;
					$reponse = $base->query($sql);
					
					// indexer l'offset de la requete en fonction du numero de la page actuel
					// $donnees = $reponse->fetch();
					// On affiche chaque entrée une à une
					
					
					while ($donnees = $reponse->fetch())
					{
						echo "<tr>";
						// var_dump($donnees);
							echo "<td>".$donnees['nom_rapporteur']." ".$donnees['prenom_rapporteur']."</td> ";
							echo "<td>".$donnees['date_incident']."</td> ";
							echo "<td>".$donnees['libelle_nature']."</td> ";
							echo "<td>".$donnees['severite_incident']."</td> ";
							echo "<td>".$donnees['libelle_etat']."</td> ";
						echo "</tr>";
					}
					$reponse->closeCursor(); // Termine le traitement de la requête
				// 
			?>
				</tbody>
			</table>
				<br/>
			<?php
			 // fqire ici le traitement des pages
				$query = $base->query('SELECT COUNT(*) AS filtre FROM incident i WHERE 1 '.$where);
				$retourQueryCountTotal = $query->fetch();
				$nbTotalDonnees = $retourQueryCountTotal['filtre'];
				$nbPages = ceil($nbTotalDonnees / $nbDataParPage);
				// Système pour éviter des données non comprise dans la barre de recherche 
				if($pageActuelle > $nbPages || $pageActuelle < 1)
				{
					$pageActuelle = 1;
				}
			
			// WHERE 1 $where
				// virer les jointures; limites et ordre, remplacer la selection de donnees par un count
			
				echo '<p align="center">Page : '; //Pour affichage
				// Ecrire la liste des pages disponibles
				for($i = 1 ; $i <= $nbPages ; $i++) //On boucle
				{
					if($i == $pageActuelle)
					{
						echo "<b>".$i."</b> ";
					}
					else
					{
						echo "<a href=\"incident.php?nrPage=$i\">".$i."</a> ";
					}
					// SI je suis sur la page actuelle, j'affiche en gras
					// SINON j'affiche un lien en précisant le numero de la page choisie
				}
				echo '</p>';
			?>
			</blockquote>
		</blockquote>
			
	</body>
		<footer>
			<p>Copyright Thouin Rodier Edeyer Duprey - Tous droits réservés<br />
			<a href="mentionlegal.html" class="bouton bleu medium"> Mentions Légales </a></p>
		</footer>
</html>