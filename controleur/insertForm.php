<?php

include '../modele/pdo.php';
session_start();

$_SESSION['idApprenant'] = 20;

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
		if (!isset($_POST['remarque']))
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
		return 1;
	}

	if (verifSubmit()) 
	{
		$query = $pdo->prepare('INSERT INTO reponse SET reponse = :reponse, idApprenant = :idApprenant, idProposition = :idProposition');
		$query->bindParam(":reponse", $_POST['radio-stacked']);
		$query->bindParam(":idApprenant", $_SESSION['idApprenant']);
		$query->bindParam(":idProposition", 1);
		$query->execute();

		if (isset($_POST['checkNouvelleTechnique']))
		{
			$query = $pdo->prepare('INSERT INTO reponse SET reponse = :reponse, idApprenant = :idApprenant, idProposition = :idProposition');
			$query->bindParam(":reponse", $_POST['checkNouvelleTechnique']); 
			$query->bindParam(":idApprenant", $_SESSION['idApprenant']);
			$query->bindParam(":idProposition", 2);
			$query->execute();
		}
		
		if (isset($_POST['checkPratique']))
		{
			$query = $pdo->prepare('INSERT INTO reponse SET reponse = :reponse, idApprenant = :idApprenant, idProposition = :idProposition');
			$query->bindParam(":reponse", $_POST['checkPratique']);
			$query->bindParam(":idApprenant", $_SESSION['idApprenant']);
			$query->bindParam(":idProposition", 2);
			$query->execute();
		}
		
		if (isset($_POST['checkAutre']))
		{
			$query = $pdo->prepare('INSERT INTO reponse SET reponse = :reponse, idApprenant = :idApprenant, idProposition = :idProposition');
			$query->bindParam(":reponse", $_POST['checkPratique']);
			$query->bindParam(":idApprenant", $_SESSION['idApprenant']);
			$query->bindParam(":idProposition", 2);
			$query->execute();

			$query = $pdo->prepare('INSERT INTO reponse SET reponse = :reponse, idApprenant = :idApprenant, idProposition = :idProposition');
			$query->bindParam(":reponse", $_POST['autreAttentesFin']);
			$query->bindParam(":idApprenant", $_SESSION['idApprenant']);
			$query->bindParam(":idProposition", 3);
			$query->execute();
		}
		
		if (isset($_POST['checkConnaissance']))
		{
			$query = $pdo->prepare('INSERT INTO reponse SET reponse = :reponse, idApprenant = :idApprenant, idProposition = :idProposition');
			$query->bindParam(":reponse", $_POST['checkConnaissance']);
			$query->bindParam(":idApprenant", $_SESSION['idApprenant']);
			$query->bindParam(":idProposition", 2);
			$query->execute();
		}

		$query = $pdo->prepare('INSERT INTO reponse SET reponse = :reponse, idApprenant = :idApprenant, idProposition = :idProposition');
		$query->bindParam(":reponse", $_POST['checkAttente']);
		$query->bindParam(":idApprenant", $_SESSION['idApprenant']);
		$query->bindParam(":idProposition", 4);
		$query->execute();

		$query = $pdo->prepare('INSERT INTO reponse SET reponse = :reponse, idApprenant = :idApprenant, idProposition = :idProposition');
		$query->bindParam(":reponse", $_POST['autreAttentesFin']);
		$query->bindParam(":idApprenant", $_SESSION['idApprenant']);
		$query->bindParam(":idProposition", 5);
		$query->execute();

		$query = $pdo->prepare('INSERT INTO reponse SET reponse = :reponse, idApprenant = :idApprenant, idProposition = :idProposition');
		$query->bindParam(":reponse", $_POST['rangeDuree']);
		$query->bindParam(":idApprenant", $_SESSION['idApprenant']);
		$query->bindParam(":idProposition", 6);
		$query->execute();

		$query = $pdo->prepare('INSERT INTO reponse SET reponse = :reponse, idApprenant = :idApprenant, idProposition = :idProposition');
		$query->bindParam(":reponse", $_POST['rangeProfess']);
		$query->bindParam(":idApprenant", $_SESSION['idApprenant']);
		$query->bindParam(":idProposition", 8);
		$query->execute();

		$query = $pdo->prepare('INSERT INTO reponse SET reponse = :reponse, idApprenant = :idApprenant, idProposition = :idProposition');
		$query->bindParam(":reponse", $_POST['rangePerso']);
		$query->bindParam(":idApprenant", $_SESSION['idApprenant']);
		$query->bindParam(":idProposition", 9);
		$query->execute();

		$query = $pdo->prepare('INSERT INTO reponse SET reponse = :reponse, idApprenant = :idApprenant, idProposition = :idProposition');
		$query->bindParam(":reponse", $_POST['themeAborderPlusLongtemps']);
		$query->bindParam(":idApprenant", $_SESSION['idApprenant']);
		$query->bindParam(":idProposition", 11);
		$query->execute();

		$query = $pdo->prepare('INSERT INTO reponse SET reponse = :reponse, idApprenant = :idApprenant, idProposition = :idProposition');
		$query->bindParam(":reponse", $_POST['themeEcourter']);
		$query->bindParam(":idApprenant", $_SESSION['idApprenant']);
		$query->bindParam(":idProposition", 12);
		$query->execute();

		$query = $pdo->prepare('INSERT INTO reponse SET reponse = :reponse, idApprenant = :idApprenant, idProposition = :idProposition');
		$query->bindParam(":reponse", $_POST['themeSupprimer']);
		$query->bindParam(":idApprenant", $_SESSION['idApprenant']);
		$query->bindParam(":idProposition", 13);
		$query->execute();

		$query = $pdo->prepare('INSERT INTO reponse SET reponse = :reponse, idApprenant = :idApprenant, idProposition = :idProposition');
		$query->bindParam(":reponse", $_POST['interventionQualite']);
		$query->bindParam(":idApprenant", $_SESSION['idApprenant']);
		$query->bindParam(":idProposition", 14);
		$query->execute();

		$query = $pdo->prepare('INSERT INTO reponse SET reponse = :reponse, idApprenant = :idApprenant, idProposition = :idProposition');
		$query->bindParam(":reponse", $_POST['remarque']);
		$query->bindParam(":idApprenant", $_SESSION['idApprenant']);
		$query->bindParam(":idProposition", 16);
		$query->execute();

		$query = $pdo->prepare('INSERT INTO reponse SET reponse = :reponse, idApprenant = :idApprenant, idProposition = :idProposition');
		$query->bindParam(":reponse", $_POST['checkReutiliser']);
		$query->bindParam(":idApprenant", $_SESSION['idApprenant']);
		$query->bindParam(":idProposition", 17);
		$query->execute();

		$query = $pdo->prepare('INSERT INTO reponse SET reponse = :reponse, idApprenant = :idApprenant, idProposition = :idProposition');
		$query->bindParam(":reponse", $_POST['reutilisation2']);
		$query->bindParam(":idApprenant", $_SESSION['idApprenant']);
		$query->bindParam(":idProposition", 18);
		$query->execute();

		$query = $pdo->prepare('INSERT INTO reponse SET reponse = :reponse, idApprenant = :idApprenant, idProposition = :idProposition');
		$query->bindParam(":reponse", $_POST['reutilisation1']);
		$query->bindParam(":idApprenant", $_SESSION['idApprenant']);
		$query->bindParam(":idProposition", 19);
		$query->execute();

		$query = $pdo->prepare('INSERT INTO reponse SET reponse = :reponse, idApprenant = :idApprenant, idProposition = :idProposition');
		$query->bindParam(":reponse", $_POST['reutilisation']);
		$query->bindParam(":idApprenant", $_SESSION['idApprenant']);
		$query->bindParam(":idProposition", 20);
		$query->execute();

		$query = $pdo->prepare('INSERT INTO reponse SET reponse = :reponse, idApprenant = :idApprenant, idProposition = :idProposition');
		$query->bindParam(":reponse", $_POST['rangeSatisfaction']);
		$query->bindParam(":idApprenant", $_SESSION['idApprenant']);
		$query->bindParam(":idProposition", 21);
		$query->execute();

		$query = $pdo->prepare('INSERT INTO reponse SET reponse = :reponse, idApprenant = :idApprenant, idProposition = :idProposition');
		$query->bindParam(":reponse", $_POST['pourquoiGlobale']);
		$query->bindParam(":idApprenant", $_SESSION['idApprenant']);
		$query->bindParam(":idProposition", 22);
		$query->execute();

		$query = $pdo->prepare('INSERT INTO reponse SET reponse = :reponse, idApprenant = :idApprenant, idProposition = :idProposition');
		$query->bindParam(":reponse", $_POST['observationPersonnel']);
		$query->bindParam(":idApprenant", $_SESSION['idApprenant']);
		$query->bindParam(":idProposition", 23);
		$query->execute();
		
		// $query = $pdo->query('INSERT INTO reponse (reponse, idApprenant, idProposition) SET ("'.$_POST['pourquoiInterv'].'", "'.$_SESSION['idApprenant'].'", "15")');
	}
}
?>

<!-- Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. -->

<?php

	echo "yo";

?>