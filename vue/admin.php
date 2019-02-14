<?php
include '../modele/pdo.php';
include '../include/fonctions.php';

if(session_status() == PHP_SESSION_NONE) {
    session_start();
};

loggedOnly();

$statut = $_SESSION['auth']->idRole;
if($_SESSION['auth'] && $statut == 2)
{	// TANT QUE L'ADMIN EST CONNECTE
    include '../include/header.php';
    ?>

	<!-- Formulaire d'ajout de formation -->
	<form method="post" action="">
        <input type="text" name="addFormation">
        
		<input type="submit" name="submAddFormation" value="Ajouter la formation">
	</form>
    
    
	<!-- Formulaire de suppression de formation -->
	<form method="post" action="">
        <label for="formations">Choisir une formation à supprimer : </label>
		<select name="formationsDel"><!-- Affiche les formations existantes -->
        <?php
				// Affiche les formation existantes
				$Forms = $pdo->query("SELECT * FROM formations");
	            $selectForms = $Forms->fetchAll();
	            foreach($selectForms as $selectForm)
	       	{ ?>
            <option value="<?php echo $selectForm->idFormation; ?>"><?php echo $selectForm->nomFormation; ?></option>
            <?php  } ?>
		</select>
        
		<input type="submit" name="submDelFormation" value="Supprimer la formation">
	</form>
    
    
<?php
	// Ajouter une formation
	if(isset($_POST['submAddFormation']) && !empty($_POST['addFormation']))
	{
		$formationExist = $pdo->prepare("SELECT * FROM formations WHERE nomFormation = :formationExist");
        $formationExist->bindParam(':formationExist', $_POST['addFormation']);
        $formationExist->execute();
        $formation = $formationExist->fetch();
        
		if($formation)
		{
            $erreur = "<p class=\"text-danger\">La formation <span class=\"erreur\">" . $_POST['addFormation'] . "</span> existe déjà !</p> <br />";
		}
		else
		{
            $createFormation = $pdo->prepare('INSERT INTO formations SET nomFormation = :nomFormation');
			$createFormation->bindParam(':nomFormation', $_POST['addFormation']);
			$createFormation->execute();
            
			$erreur = "<p class=\"text-danger\">La formation <span class=\"erreur\">" . $_POST['addFormation'] . "</span> a bien été ajoutée</p> <br />";
		}
	}
	else if(isset($_POST['submAddFormation']) && empty($_POST['addFormation']))
	{
        $erreur = "<p class=\"text-danger\">Veuillez saisir un nom s'il vous plaît !</p>";
	}
    
	// Supprimer une formation
	if (isset($_POST['submDelFormation']))
	{
        $deleteFormation = $pdo->prepare('DELETE FROM formations WHERE idFormation = :deleteFormation');
		$deleteFormation->execute(['deleteFormation' => $_POST['formationsDel']]);
	}?>

<a href="../controleur/logout.php">Deconnexion</a>

<p>Vous etes connectez avec le compte de <?php echo $_SESSION['auth']->nomUtilisateur?>

<a href="../vue/insertion.php">Ajouter un questionnaire</a>

<h5>Création d'utilisateur:<h5>
<!-- Formulaire de création d'utilisateur -->
<form method="POST">

    <input type="text" name="nomUtilisateur" placeholder="Nom de l'utilisateur"/>
    <input type="text" name="prenomUtilisateur" placeholder="Prenom de l'utilisateur"/>
    <input type="text" name="pseudoUtilisateur" placeholder="Pseudo de l'utilisateur"/>
    <label>Date d'entrée en formation:</label>
    <input type="date" name="dateEntreeFormation" />
    <label>Date de fin de formation:</label>
    <input type="date" name="dateFinFormation" />

    <!-- Select du nom de formation -->
    <label for="selectFormation">Selectionnez la formation:</label>
    <select name="selectFormation" id="selForm">
        <?php
            $Forms = $pdo->query("SELECT * FROM formations");
            $selectForms = $Forms->fetchAll();
            foreach($selectForms as $selectForm) { ?>
            <option value="<?php echo $selectForm->idFormation; ?>"><?php echo $selectForm->nomFormation; ?></option>
            <?php  } ?>
    </select>

    <!-- Select des Lieux de formation -->
    <label for="selectLieux">Selectionnez le lieu de formation:</label>
    <select name="selectLieux" id="selLieu">
        <?php
            $lieux = $pdo->query("SELECT * FROM lieux");
            $selectLieux = $lieux->fetchAll();
            foreach($selectLieux as $selectLieu) { ?>
            <option value="<?php echo $selectLieu->idLieu; ?>"><?php echo $selectLieu->lieuFormation; ?></option>
            <?php  } ?>
    </select>
    <button type="submit" name="creationUtilisateur">Créer l'utilisateur</button>

    <?php
    if(isset($_POST['creationUtilisateur']) && isset($_POST['selectFormation'])) {

        $req = $pdo->prepare("SELECT * FROM utilisateurs WHERE pseudoUtilisateur = :pseudoUtilisateur");
        $req->bindParam(':pseudoUtilisateur', $_POST['pseudoUtilisateur']);
        $req->execute();
        $membre = $req->fetch();

        if($membre) {
            echo 'Ce pseudo est déjà pris';
        } else {

            $creationUtilisateur = $pdo->prepare('INSERT INTO utilisateurs SET nomUtilisateur = :nomUtilisateur, prenomUtilisateur = :prenomUtilisateur, pseudoUtilisateur= :pseudoUtilisateur, dateEntreeFormation = :dateEntreeFormation, dateFinFormation = :dateFinFormation, idRole = 3');
            $creationUtilisateur->bindParam(':nomUtilisateur', $_POST['nomUtilisateur']);
            $creationUtilisateur->bindParam(':prenomUtilisateur', $_POST['prenomUtilisateur']);
            $creationUtilisateur->bindParam(':pseudoUtilisateur', $_POST['pseudoUtilisateur']);
            $creationUtilisateur->bindParam(':dateEntreeFormation', $_POST['dateEntreeFormation']);
            $creationUtilisateur->bindParam(':dateFinFormation', $_POST['dateFinFormation']);
            $creationUtilisateur->execute();
           
            // Récupération du dernier Id inséré
            $dernierId =  $pdo->lastInsertId();
            
            // Insérer l'id formation et l'id utilisateurs dans la table de jonction suitformation
    
            $selectFormation = $pdo->prepare("INSERT INTO suitformation SET idUtilisateur = :idUtilisateur, idFormation = :idFormation");
            $selectFormation->bindParam(':idUtilisateur', $dernierId);
            $selectFormation->bindParam(':idFormation', $_POST['selectFormation']);
            $selectFormation->execute();
    
            // Insérer l'id lieu de formation et l'id utilisateurs dans la table de jonction suitformation
    
            $selectLieuFormation = $pdo->prepare("INSERT INTO selocalise SET idUtilisateur = :idUtilisateur, idLieu = :idLieu");
            $selectLieuFormation->bindParam(':idUtilisateur', $dernierId);
            $selectLieuFormation->bindParam(':idLieu', $_POST['selectLieux']);
            $selectLieuFormation->execute();
        }

    }
    ?>
<br>
<br>
<h5>Suppression d'un utilisateur:<h5>
    <form method="POST">

        <button type="submit" name="afficherMembre">Afficher les utilisateurs</button>
        <button type="submit" name="fermerMembre">Fermer l'affichage des utilisateurs</button>
        <label for="">Entrer le pseudo de l'utilisateur a supprimer</label>
        <input type="text" name="deleteUtilisateur" class="form-control-lg-2" />
        <button type="submit" name="deleteMembreExecute">Supprimer l'utilisateur</button> 

    </form>

<?php
    // Afficher la liste des membres //
    if(isset($_POST['afficherMembre']) && ([$_POST['fermerMembre']])) {
        $membre = $pdo->query('SELECT nomUtilisateur, prenomUtilisateur,  DATE_FORMAT(dateEntreeFormation, \'%d/%m/%Y \') AS dateEntreeFormationFr , idRole FROM utilisateurs ORDER BY dateEntreeFormation DESC');

        while ($donnees = $membre->fetch()){
            echo '<p> NOM DE L\'UTILISATEUR <strong>' . htmlspecialchars($donnees->nomUtilisateur) . '</strong> 
            : Le prenom de l\'utilisateur <strong>'. htmlspecialchars($donnees->prenomUtilisateur) . '</strong> date d\'entrée en formation <strong>'. htmlspecialchars($donnees->dateEntreeFormationFr) . '</strong> . <strong>' .$donnees->idRole . '</strong> </p>';
        }
    }

    $membreDelete = $pdo->prepare("UPDATE utilisateurs SET nomUtilisateur = 'Anonyme', prenomUtilisateur = 'Anonyme', pseudoUtilisateur = 'Anonyme' WHERE nomUtilisateur = :nomUtilisateur");
    $membreDelete->bindParam(':nomUtilisateur', $_POST['deleteUtilisateur']);
    $membreDelete->execute();

?>

<?php echo '<br /><br/><br/>' . $erreur; // Message retourné lorsque l'on tente d'ajouté une formation (n'est pas forcément une erreur)

}	// SINON SI L'ADMIN N'EST PAS CONNECTE
else {
    
    header('Location : ../index.php');
}

?>