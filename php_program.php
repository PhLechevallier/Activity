/* This header is added to the program in order to show that there is a change in the program file
<!DOCTYPE HTML>
<html lang="FR">
<head>
    <title>Livres</title>
    <meta http-equiv="Content-type" content="text/html; charset=latin1"/>
    <link href="css/bib.css" rel="stylesheet" type="text/css">
	<link rel="apple-touch-icon" href="images/bib.jpg">
    <link rel="shortcut icon" sizes="196x196" href="images/bib.jpg">
</head>
<body>
<?php
	echo '<div id="cont" >';
		echo '<h1>Bibliothèque</h1>';
		echo '<table cellpadding="0" cellspacing="0" border="0" width="100%">';
		echo '<td class="lpart" colspan="100"><div class="lhead">';
		echo '<form action="bib-livres.php">';
			echo 'Auteur: <input type="text" name="auteur" value='. $_GET["auteur"] . '>';
			echo ' ou titre: <input type="text" name="titre" value='. $_GET["titre"] . '>';
			echo ' ou genre: <input type="text" name="genre" value='. $_GET["genre"] . '>';
			echo ' ou condition: <input type="text" name="keyword" value='. $_GET["keyword"] . '>';
			echo '<input type="submit" value="Recherche">';
		echo '</form>'; 
	echo '</div>';
	if (trim($_GET["auteur"]) != "") {
		$where = ' WHERE `auteur` LIKE "%' . $_GET["auteur"] . '%"';
	} elseif (trim($_GET["titre"]) != "") {
		$where = ' WHERE `titre` LIKE "%' . $_GET["titre"] . '%"';
	} elseif (trim($_GET["genre"]) != "") {
		$where = ' WHERE `genre` LIKE "%' . $_GET["genre"] . '%"'; 
	} elseif (trim($_GET["keyword"]) != "") {
		$where = ' WHERE ' . $_GET["keyword"] . ' ';
	} else {
		$where = "";
	}
	$servername = "localhost";
	$username = "mahteldphilippe";
	$password = "Plec@1210!";
	$dbname = "mahteldp_gall297"; 
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	echo '<table cellpadding="0" cellspacing="0" border="0" width="100%">';
	echo '</table>';
	echo '</td>';
	echo '</tr>';
	echo '<tr valign="top">';
	$sql = "SELECT count(*) AS nblivres FROM biblivre " . $where;
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo '<td class="lpart" colspan="99"><div class="lhead">'. $row["nblivres"] . ' Livres</div>';
		}
	}
	echo '<table cellpadding="0" cellspacing="0" border="0" width="100%">';
	/* Header*/
	echo '<thead>';
		echo '<tr>';
			echo '<th>Auteur</th>';
			echo '<th>Prénom</th>';
			echo '<th>Titre</th>';
			echo '<th>Genre</th>';
			echo '<th>Langue</th>';
			echo '<th style="text-align:right;">Pages</th>';
			echo '<th>Lu</th>';
			echo '<th style="text-align:right;">Note</th>';
			echo '<th>Catégorie</th>';
			echo '<th>Commentaire</th>';
		echo '</tr>';
	echo '</thead>';
	echo '<tbody>';
	/* Body */
	$sql = "SELECT * FROM biblivre " . $where;
	$sql .= " ORDER BY `auteur`";
	$result = $conn->query($sql);
	$nblivres = 0;
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			++$nblivres;
			echo '<tr VALIGN=TOP>';
			echo '<td>' . $row["auteur"] . '</td>';
			echo '<td>' . $row["prenom"] . '</td>';
			if (trim($row["url"]) == "") {
				echo '<td>' . $row["titre"] . '</td>';
			} else {
				echo '<td>' . $row["url"] . '</td>';
			}
			echo '<td>' . $row["genre"] . '</td>';
			echo '<td>' . $row["langue"] . '</td>';
			echo '<td style="text-align:right;">' . $row["nbpages"] . '</td>';
			if ($row["lu"] == '1') {
				echo '<td>Lu</td>';
				echo '<td style="text-align:right;">' . $row["note"] . '</td>';
			} else {
				echo '<td>Pas lu</td>';
				echo '<td style="text-align:right;"></td>';
			}
			echo '<td>' . $row["categorie"] . '</td>';
			echo '<td>' . $row["commentaire"] . '</td>';
			echo '</tr>';
		}
	} else {
		echo $sql ;
	}
	$conn->close();
	echo '</tbody>';
		echo '<td class="lpart" colspan="99"><div class="lhead">'. $nblivres . ' Livres listés</div>';
	echo '<tfoot>
	</tfoot>';
	echo '</table>';
	echo '</td>';
	echo '</tr>';
	echo '</table>';
?>
</div>
</body>
</html>


