<?php
include '../modele/pdo.php';
include '../include/fonctions.php';

loggedOnly();

session_start();

$statut = $_SESSION['auth']->idRole;
if($_SESSION['auth'] && $statut == 2)
{	// TANT QUE L'ADMIN EST CONNECTE

	echo 'vous etes sur une page admin ';
	echo '<a href="../controleur/logout.php">Deconnexion</a>'; // Déconnexion (Admin)
?>
	<?php
    	function afficheFilm()
    	{
    		$req = "SELECT nomFormation FROM formations ORDER BY nomFormation";
    		$reqFilm = $pdo->query($req);

			while ($data = $reqFilm->fetch())
			{
	        	echo '<option>' . $data['nomFormation'] . '</option>';
			}	
    	}
	?>

	<!-- Formulaire d'ajout de formation -->
	<form method="post" action="#">
		<input type="text" name="addFormation">

		<input type="submit" name="submAddFormation" value="Ajouter la formation">
	</form>


	<!-- Formulaire de suppression de formation -->
	<form method="post" action="#">
		<label for="formations">Choisir une formation : </label>
		<select name="formations">
			<option checked></option>
			<?php afficheFilm(); ?> <!-- Affiche les formations existantes -->
		</select>

		<input type="submit" name="submDelFormation" value="Supprimer la formation">
	</form>


<?php

if(isset($_POST['submAddFormation']))
{
	$createFormation = $pdo->prepare('INSERT INTO formations SET nomFormation = :nomFormation');
	$createFormation->execute(['nomFormation' => $_POST['addFormation']]);
}


}	// SINON SI L'ADMIN N'EST PAS CONNECTE
else {

header('Location : ../index.php');
}

?>


