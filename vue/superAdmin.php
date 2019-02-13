<?php
include '../modele/pdo.php';
include '../include/fonctions.php';

if(session_status() == PHP_SESSION_NONE) {
    session_start();
};

loggedOnly();

$statut = $_SESSION['auth']->idRole;
if($_SESSION['auth'] && $statut == 1) {?>
<h1>vous etes sur une page superAdmin</h1>
<?php
} else {

header('Location : ../index.php');
}
include '../include/header.php';
?>



<a href="../controleur/logout.php">Deconnexion</a>

<p>Vous etes connectez avec le compte de <?php echo $_SESSION['auth']->nomUtilisateur?>

<a href="../vue/insertion.php">Ajouter un questionnaire</a>

<h5>Suppression d'un utilisateur<h5>
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
$membreDelete = $pdo->prepare('DELETE FROM utilisateurs WHERE nomUtilisateur = :nomUtilisateur');
$membreDelete->execute(['nomUtilisateur' => $_POST['deleteUtilisateur']]);

?>

<h5>Création d'utilisateur<h5>

<form method="POST">

    <input type="text" name="nomUtilisateur" placeholder="Nom de l'utilisateur"/>
    <input type="text" name="prenomUtilisateur" placeholder="Prenom de l'utilisateur"/>
    <input type="text" name="motDePasse" placeholder="Mot de passe"/>
    <label>Date d'entrée en formation</label>
    <input type="date" name="dateEntreeFormation" />
    <label for="selectFormation">Selectionnez la formation</label>
    <select name="selectFormation" id="selForm">
        <?php
            $Forms = $pdo->query("SELECT * FROM formations");
            $selectForms = $Forms->fetchAll();
            foreach($selectForms as $selectForm) { ?>
            <option value="<?php echo $selectForm->idFormation; ?>"><?php echo $selectForm->nomFormation; ?></option>
            <?php  } ?>
    </select>
    <label for="selectLieux">Selectionnez le lieu de formation</label>
    <select name="selectLieux" id="selLieu">
        <?php
            $lieux = $pdo->query("SELECT * FROM lieux");
            $selectLieux = $lieux->fetchAll();
            foreach($selectLieux as $selectLieu) { ?>
            <option value="<?php echo $selectLieu->idLieu; ?>"><?php echo $selectLieu->lieuFormation; ?></option>
            <?php  } ?>
    </select>
    <label>Selection du rôle de l'utilisateur</label>
        <select class="choixRole" name="choixRole">
            <?php 
                $roles = $pdo->query("SELECT * FROM roles ");
                $choixRoles = $roles->fetchall();
                foreach($choixRoles as $choixRole) { ?>
                <option value="<?php echo $choixRole->idRole;?>" name="depSel"><?php echo $choixRole->nomRole;?></option>
            <?php 
            } 
            ?>
        </select>
    <button type="submit" name="creationUtilisateur">Créer l'utilisateur</button>

    <?php
    if(isset($_POST['creationUtilisateur']) && isset($_POST['selectFormation'])) {

    $creationUtilisateur = $pdo->prepare('INSERT INTO utilisateurs SET nomUtilisateur = :nomUtilisateur, prenomUtilisateur = :prenomUtilisateur, motDePasse = :motDePasse, dateEntreeFormation = :dateEntreeFormation, idRole = :idRole');
    $creationUtilisateur->execute(['nomUtilisateur' => $_POST['nomUtilisateur'],
                            'prenomUtilisateur' => $_POST['prenomUtilisateur'],
                            'motDePasse' => $_POST['motDePasse'], 
                            'dateEntreeFormation' => $_POST['dateEntreeFormation'],
                            'idRole' => $_POST['choixRole']]);
    $dernierId =  $pdo->lastInsertId();
    
    // Insérer l'id formation et l'id utilisateurs dans la table de jonction suitformation

    $selectFormation = $pdo->prepare("INSERT INTO suitformation SET idUtilisateur = :idUtilisateur, idFormation = :idFormation");
    $selectFormation->execute(['idUtilisateur' => $dernierId,
                            'idFormation' => $_POST['selectFormation']]);

    // Insérer l'id lieu de formation et l'id utilisateurs dans la table de jonction suitformation

    $selectLieuFormation = $pdo->prepare("INSERT INTO selocalise SET idUtilisateur = :idUtilisateur, idLieu = :idLieu");
    $selectLieuFormation->execute(['idUtilisateur' => $dernierId,
                            'idLieu' => $_POST['selectLieux']]);
    }
    ?>
