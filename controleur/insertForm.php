<?php

include '../modele/pdo.php';
session_start();

$_SESSION['idApprenant'] = 35;

		

if (isset($_POST['submit'])) {
	// var_dump($_POST);
	function verifSubmit()
	{
		echo "Coucou 0 <br />";
		if (!isset($_POST['userLastNameConfirm']))
			return 0;
		echo "coucou 1 <br />";
		if (!isset($_POST['userFirstNameConfirm']))
			return 0;
		echo "coucou 2 <br />";
		if (!isset($_POST['formationLieu']))
			return 0;
		echo "coucou 3 <br />";
		if (!isset($_POST['formationNom']))
			return 0;
		echo "coucou 4 <br />";
		if (!isset($_POST['formationDate']))
			return 0;
		echo "coucou 5 <br />";
		if (!isset($_POST['formationDate2']))
			return 0;
		echo "coucou 6 <br />";
		if (!isset($_POST['radio-stacked']))
			return 0;
		echo "coucou 7 <br />";
		if (!isset($_POST['checkPratique']) && !isset($_POST['checkConnaissance']) && !isset($_POST['checkAutre']) && !isset($_POST['checkNouvelleTechnique']))
			return 0;
		echo "coucou 8 <br />";
		if (isset($_POST['checkAutre']))
			if (!isset($_POST['autreAttentesDebut']))
				return 0;
		echo "coucou 9 <br />";
		if (!isset($_POST['checkAttente']))
			return 0;
		echo "coucou 10 <br />";
		if (!isset($_POST['autreAttentesFin']))
			return 0;
		echo "coucou 11 <br />";
		if (!isset($_POST['rangeProfess']))
			return 0;
		echo "coucou 12 <br />";
		if (!isset($_POST['rangePerso']))
			return 0;
		echo "coucou 13 <br />";
		if (!isset($_POST['themeAborderPlusLongtemps']))
			return 0;
		echo "coucou 14 <br />";
		if (!isset($_POST['themeAborderPlusLongtemps']))
			return 0;
		echo "coucou 15 <br />";
		if (!isset($_POST['themeEcourter']))
			return 0;
		echo "coucou 16 <br />";
		if (!isset($_POST['themeSupprimer']))
			return 0;
		echo "coucou 17 <br />";
		if (!isset($_POST['interventionQualite']))
			return 0;
		echo "coucou 18 <br />";
		if (!isset($_POST['pourquoiInterv']))
			return 0;
		echo "coucou 19 <br />";
		if (!isset($_POST['checkReutiliser']))
			return 0;
		echo "coucou 20 <br />";
		if (!isset($_POST['rangeSatisfaction']))
			return 0;
		echo "coucou 21 <br />";
		if (!isset($_POST['pourquoiGlobale']))
			return 0;
		echo "coucou 22 <br />";
		if (!isset($_POST['observationPersonnel']))
			return 0;
		if (!isset($_POST['rangeDuree']))
			return 0;
		return 1;
	}

	if (verifSubmit()) 
	{
		// ################################### Indication attentes avant la formation ######################################

		$query = $pdo->prepare('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES (:reponse, :idApprenant, :idProposition)');
		$query->execute(array(
			"reponse" =>$_POST['radio-stacked'],
			"idApprenant" => $_SESSION['idApprenant'],
			"idProposition" => 1
		));


		if (isset($_POST['checkNouvelleTechnique'])) // Acquérir de nouvelles techniques
		{	
			$query = $pdo->prepare('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES (:reponse, :idApprenant, :idProposition)');
			$query->execute(array(
				"reponse" => $_POST['checkNouvelleTechnique'],
				"idApprenant" => $_SESSION['idApprenant'],
				"idProposition" => 2
			));
		}
		

		if (isset($_POST['checkPratique'])) // Améliorer vos pratiques
		{	
			$query = $pdo->prepare('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES (:reponse, :idApprenant, :idProposition)');
			$query->execute(array(
				"reponse" => $_POST['checkPratique'],
				"idApprenant" => $_SESSION['idApprenant'],
				"idProposition" => 2
			));
		}
		

		if (isset($_POST['checkAutre'])) // Autre
		{ 
			$query = $pdo->prepare('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES (:reponse, :idApprenant, :idProposition)');
			$query->execute(array(
				"reponse" => $_POST['checkPratique'],
				"idApprenant" => $_SESSION['idApprenant'],
				"idProposition" => 2
			));

			// Autre attente début (si "autre" a été coché)
			$query = $pdo->prepare('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES (:reponse, :idApprenant, :idProposition)');
			$query->execute(array(
				"reponse" => $_POST['autreAttentesDebut'],
				"idApprenant" => $_SESSION['idApprenant'],
				"idProposition" => 3
			));
		}
	

		if (isset($_POST['checkConnaissance'])) // Elargir vos connaissances
		{
			$query = $pdo->prepare('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES (:reponse, :idApprenant, :idProposition)');
			$query->execute(array(
				"reponse" => $_POST['checkConnaissance'],
				"idApprenant" => $_SESSION['idApprenant'],
				"idProposition" => 2
			));
		}

		// ################################### Indication attentes après la formation ######################################

		$query = $pdo->prepare('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES (:reponse, :idApprenant, :idProposition)');
		$query->execute(array(
				"reponse" => $_POST['checkAttente'],
				"idApprenant" => $_SESSION['idApprenant'],
				"idProposition" => 4
			));

		// Autre attente fin (Pourquoi ?)
		$query = $pdo->prepare('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES (:reponse, :idApprenant, :idProposition)');
		$query->execute(array(
				"reponse" => $_POST['autreAttentesFin'],
				"idApprenant" => $_SESSION['idApprenant'],
				"idProposition" => 5
			));

		// ################################### La durée de formation vous a parrue ######################################

		$query = $pdo->prepare('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES (:reponse, :idApprenant, :idProposition)');
		$query->execute(array(
				"reponse" => $_POST['rangeDuree'],
				"idApprenant" => $_SESSION['idApprenant'],
				"idProposition" => 6
			));

		// ################################### Les contenus vous on parrus ######################################

		// Professionnellement
		$query = $pdo->prepare('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES (:reponse, :idApprenant, :idProposition)');
		$query->execute(array(
				"reponse" => $_POST['rangeProfess'],
				"idApprenant" => $_SESSION['idApprenant'],
				"idProposition" => 8
			));

		// Personnellement
		$query = $pdo->prepare('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES (:reponse, :idApprenant, :idProposition)');
		$query->execute(array(
				"reponse" => $_POST['rangePerso'],
				"idApprenant" => $_SESSION['idApprenant'],
				"idProposition" => 9
			));

		// ################################### Quel thèmes auriez-vous .. ######################################

		// Aborder plus longuement
		$query = $pdo->prepare('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES (:reponse, :idApprenant, :idProposition)');
		$query->execute(array(
				"reponse" => $_POST['themeAborderPlusLongtemps'],
				"idApprenant" => $_SESSION['idApprenant'],
				"idProposition" => 11
			));

		// Ecourter
		$query = $pdo->prepare('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES (:reponse, :idApprenant, :idProposition)');
		$query->execute(array(
				"reponse" => $_POST['themeEcourter'],
				"idApprenant" => $_SESSION['idApprenant'],
				"idProposition" => 12
			));

		// Supprimer
		$query = $pdo->prepare('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES (:reponse, :idApprenant, :idProposition)');
		$query->execute(array(
				"reponse" => $_POST['themeSupprimer'],
				"idApprenant" => $_SESSION['idApprenant'],
				"idProposition" => 13
			));

		// ################################### Selon vous l'intervension des animateurs étaient ######################################

		// Range intervension quélité
		$query = $pdo->prepare('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES (:reponse, :idApprenant, :idProposition)');
		$query->execute(array(
				"reponse" => $_POST['interventionQualite'],
				"idApprenant" => $_SESSION['idApprenant'],
				"idProposition" => 14
			));

		// Pourquoi ?
		$query = $pdo->prepare('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES (:reponse, :idApprenant, :idProposition)');
		$query->execute(array(
				"reponse" => $_POST['pourquoiInterv'],
				"idApprenant" => $_SESSION['idApprenant'],
				"idProposition" => 16
			));

		// ################################### Selon vous l'intervension des animateurs étaient ######################################

		$query = $pdo->prepare('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES (:reponse, :idApprenant, :idProposition)');
		$query->execute(array(
				"reponse" => $_POST['checkReutiliser'],
				"idApprenant" => $_SESSION['idApprenant'],
				"idProposition" => 17
			));


		$query = $pdo->prepare('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES (:reponse, :idApprenant, :idProposition)');
		$query->execute(array(
				"reponse" => $_POST['reutilisation2'],
				"idApprenant" => $_SESSION['idApprenant'],
				"idProposition" => 18
			));


		$query = $pdo->prepare('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES (:reponse, :idApprenant, :idProposition)');
		$query->execute(array(
				"reponse" => $_POST['reutilisation1'],
				"idApprenant" => $_SESSION['idApprenant'],
				"idProposition" => 19
			));


		$query = $pdo->prepare('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES (:reponse, :idApprenant, :idProposition)');
		$query->execute(array(
				"reponse" => $_POST['reutilisation'],
				"idApprenant" => $_SESSION['idApprenant'],
				"idProposition" => 20
			));


		$query = $pdo->prepare('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES (:reponse, :idApprenant, :idProposition)');
		$query->execute(array(
				"reponse" => $_POST['rangeSatisfaction'],
				"idApprenant" => $_SESSION['idApprenant'],
				"idProposition" => 21
			));


		$query = $pdo->prepare('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES (:reponse, :idApprenant, :idProposition)');
		$query->execute(array(
				"reponse" => $_POST['pourquoiGlobale'],
				"idApprenant" => $_SESSION['idApprenant'],
				"idProposition" => 22
			));


		$query = $pdo->prepare('INSERT INTO reponse (reponse, idApprenant, idProposition) VALUES (:reponse, :idApprenant, :idProposition)');
		$query->execute(array(
				"reponse" => $_POST['observationPersonnel'],
				"idApprenant" => $_SESSION['idApprenant'],
				"idProposition" => 23
			));
	}
}
?>