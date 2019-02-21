<?php

include '../modele/pdo.php';
session_start();

$_SESSION['idApprenant'] = 35;

if (isset($_POST['submit'])) {
	var_dump($_POST);
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
		if (!isset($_POST['checkPratique']) && !isset($_POST['checkConnaissance']) && !isset($_POST['checkAutre']) && !isset($_POST['checkNouvelleTechnique']))
			return 0;
		if (isset($_POST['checkAutre']))
			if (!isset($_POST['autreAttentesDebut']))
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
		echo "coucou";
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['radio-stacked'].'", "'.$_SESSION['idApprenant'].'", "1")');
		if (isset($_POST['checkNouvelleTechnique']))
			$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['checkNouvelleTechnique'].'", "'.$_SESSION['idApprenant'].'", "2")');
		if (isset($_POST['checkPratique']))
			$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['checkPratique'].'", "'.$_SESSION['idApprenant'].'", "2")');
		if (isset($_POST['checkAutre']))
		{
			$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['checkPratique'].'", "'.$_SESSION['idApprenant'].'", "2")');
			$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['autreAttentesFin'].'", "'.$_SESSION['idApprenant'].'", "3")');
		}
		if (isset($_POST['checkConnaissance']))
			$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['checkConnaissance'].'", "'.$_SESSION['idApprenant'].'", "2")');
		
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['checkAttente'].'", "'.$_SESSION['idApprenant'].'", "4")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['autreAttentesFin'].'", "'.$_SESSION['idApprenant'].'", "5")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['rangeDuree'].'", "'.$_SESSION['idApprenant'].'", "6")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['rangeProfess'].'", "'.$_SESSION['idApprenant'].'", "8")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['rangePerso'].'", "'.$_SESSION['idApprenant'].'", "9")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['themeAborderPlusLongtemps'].'", "'.$_SESSION['idApprenant'].'", "11")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['themeEcourter'].'", "'.$_SESSION['idApprenant'].'", "12")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['themeSupprimer'].'", "'.$_SESSION['idApprenant'].'", "13")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['interventionQualite'].'", "'.$_SESSION['idApprenant'].'", "14")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['pourquoiInterv'].'", "'.$_SESSION['idApprenant'].'", "15")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['remarque'].'", "'.$_SESSION['idApprenant'].'", "16")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['checkReutiliser'].'", "'.$_SESSION['idApprenant'].'", "17")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['reutilisation2'].'", "'.$_SESSION['idApprenant'].'", "18")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['reutilisation1'].'", "'.$_SESSION['idApprenant'].'", "19")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['reutilisation'].'", "'.$_SESSION['idApprenant'].'", "20")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['rangeSatisfaction'].'", "'.$_SESSION['idApprenant'].'", "21")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['pourquoiGlobale'].'", "'.$_SESSION['idApprenant'].'", "22")');
		$query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES ("'.$_POST['observationPersonnel'].'", "'.$_SESSION['idApprenant'].'", "23")');
	}
}
?>