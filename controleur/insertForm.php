<?php

include '../modele/pdo.php';

if (isset($_POST['submit'])) {

	function verifSubmit()
	{
		if (!isset($_POST['userLastNameConfirm']))
			return 0;
		if (!isset($_POST['userFirstNameConfirm']))
			return 0;
		if (!isset($_POST['formationLieu']))
			return 0;
		if (!isset($_POST['formationNom']))
			return 0;
		if (!isset($_POST['formationDate']))
			return 0;
		if (!isset($_POST['formationDate2']))
			return 0;
		if (!isset($_POST['radio-stacked']))
			return 0;
		if (!isset($_POST['checkNouvelleTechnique']))
			return 0;
		if (!isset($_POST['checkPratique']))
			return 0;
		if (!isset($_POST['checkAutre']))
			if (!isset($_POST['autreAttentesFin']))
				return 0;
		if (!isset($_POST['checkConnaissance']))
			return 0;
		if (!isset($_POST['checkAttente']))
			return 0;
		if (!isset($_POST['autreAttentesFin']))
			return 0;
		if (!isset($_POST['rangeProfess']))
			return 0;
		if (!isset($_POST['rangePerso']))
			return 0;
		if (!isset($_POST['themeAborderPlusLongtemps']))
			return 0;
		if (!isset($_POST['themeEcourter']))
			return 0;
		if (!isset($_POST['themeSupprimer']))
			return 0;
		if (!isset($_POST['interventionQualite']))
			return 0;
		if (!isset($_POST['remarque']))
			return 0;
		if (!isset($_POST['checkReutiliser']))
			return 0;
		if (!isset($_POST['rangeSatisfaction']))
			return 0;
		if (!isset($_POST['pourquoiGlobale']))
			return 0;
		if (!isset($_POST['observationPersonnel']))
			return 0;
		return 1;
	}

	if (verifSubmit()) {
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['radio-stacked'].'", "'.$_SESSION['idApprenant'].'", "1")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['radio-stacked'].'", "'.$_SESSION['idApprenant'].'", "2")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['radio-stacked'].'", "'.$_SESSION['idApprenant'].'", "3")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['radio-stacked'].'", "'.$_SESSION['idApprenant'].'", "4")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['radio-stacked'].'", "'.$_SESSION['idApprenant'].'", "5")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['radio-stacked'].'", "'.$_SESSION['idApprenant'].'", "6")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['radio-stacked'].'", "'.$_SESSION['idApprenant'].'", "7")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['radio-stacked'].'", "'.$_SESSION['idApprenant'].'", "8")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['radio-stacked'].'", "'.$_SESSION['idApprenant'].'", "9")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['radio-stacked'].'", "'.$_SESSION['idApprenant'].'", "10")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['radio-stacked'].'", "'.$_SESSION['idApprenant'].'", "1")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['radio-stacked'].'", "'.$_SESSION['idApprenant'].'", "1")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['radio-stacked'].'", "'.$_SESSION['idApprenant'].'", "1")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['radio-stacked'].'", "'.$_SESSION['idApprenant'].'", "1")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['radio-stacked'].'", "'.$_SESSION['idApprenant'].'", "1")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['radio-stacked'].'", "'.$_SESSION['idApprenant'].'", "1")');
	}
}
?>