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
<h5>Suppression d'un utilisateur</h5>

<!-- Formulaire pour afficher les membres -->
<form method="POST">

    <button type="submit" name="afficherMembre">Afficher tout les utilisateurs</button>
    <button type="submit" name="fermerMembre">Fermer l'affichage des utilisateurs</button>
    <label for="">Entrer le pseudo de l'utilisateur a supprimer</label>

    <input type="text" name="deleteUtilisateur" class="form-control-lg-2" />
    <button type="submit" name="deleteMembreExecute">Supprimer l'utilisateur</button> 

</form>

<?php
        // Afficher la liste des membres //
if(isset($_POST['afficherMembre']) && ([$_POST['fermerMembre']])) {
$membre = $pdo->query('SELECT * FROM utilisateurs NATURAL JOIN suitformation NATURAL JOIN formations NATURAL JOIN lieux  ORDER BY dateEntreeFormation DESC');

while ($donnees = $membre->fetch()){
    echo '<table><tr><td> nom : ' . $donnees->nomUtilisateur . '</td>' . '<td>' .' prenom : ' . $donnees->prenomUtilisateur . '</td>' . '<td>' . ' date d\'entrée en formation : ' . $donnees->dateEntreeFormation . '</td>' . '<td>' . 'formation suivis : ' . $donnees->nomFormation . '</td>' . '<td>' . ' lieux de formation ' . $donnees->lieuFormation . '</td>' . '</tr></table>';
    
}}

$membreDelete = $pdo->prepare('DELETE FROM utilisateurs WHERE nomUtilisateur = :nomUtilisateur');
$membreDelete->execute(['nomUtilisateur' => $_POST['deleteUtilisateur']]);

?>

<h5>Afficher les utilisateurs par date ou type de formation ou lieu de formation</h5>

<!-- Pour selectionner la date -->
<form method="POST">

    <label>Afficher tout les utilisateurs trié par date</label>
    <input type="date" name="afficherUtilisateurDate"/>
    <label>Afficher tout les utilisateurs trié par type de formation</label>

<!-- Pour selectionner par formations -->
    <select class="choixTypeFormation" name="choixTypeFormation">
        <?php 
        $types = $pdo->query("SELECT * FROM formations ");
        $choixTypesFormations = $types->fetchAll();
        var_dump($choixTypesFormations);?>
        <option value="">Selection de formation</option>
        <?php
        foreach($choixTypesFormations as $choixTypeFormation) {?>
        <option value="<?php echo $choixTypeFormation->idFormation;?>" name="depSel"><?php echo $choixTypeFormation->nomFormation;?></option>
        <?php 
        }  
        ?>
    </select>

<!-- Pour selectionner par lieu de formation -->
    <select class="choixLieuFormation" name="choixLieuFormation">
            <?php 
                $lieux = $pdo->query("SELECT * FROM lieux ");
                $choixLieuxFormations = $lieux->fetchAll();?>
                <option value="">Selection du lieux</option>
                <?php
                foreach($choixLieuxFormations as $choixLieuFormation) {?>
                <option value="<?php echo $choixLieuFormation->idLieu;?>" name="depSel"><?php echo $choixLieuFormation->lieuFormation;?></option>
                <?php 
                } 
                ?>
    </select>

    <button type="submit">Valider</button>

</form>

<?php

// Les fonctions qui affichent les utilisateurs selon la selections //
if(isset($_POST['afficherUtilisateurDate'])) {

$choixTypesFormationsAffichage = $pdo->prepare('SELECT * FROM utilisateurs NATURAL JOIN suitformation NATURAL JOIN formations NATURAL JOIN lieux NATURAL JOIN selocalise WHERE dateEntreeFormation = :dateEntreeFormation OR idFormation = :idFormation OR idLieu = :idLieu');

$choixTypesFormationsAffichage->execute(['dateEntreeFormation' => $_POST['afficherUtilisateurDate'], 
'idFormation' => $_POST['choixTypeFormation'], 'idLieu' => $_POST['choixLieuFormation']]);

while($donneesSelection = $choixTypesFormationsAffichage->fetch()) {

echo '<table><tr><td> nom : ' . $donneesSelection->nomUtilisateur . '</td>' . '<td>' .' prenom : ' . $donneesSelection->prenomUtilisateur . '</td>' . '<td>' . ' date d\'entrée en formation : ' . $donneesSelection->dateEntreeFormation . '</td>' . '<td>' . 'formation suivis : ' . $donneesSelection->nomFormation . '</td>' . '<td>' . ' lieux de formation ' . $donneesSelection->lieuFormation . '</td>' . '</tr></table>';

}}

?>

<!-- Formulaire pour créer un utilisateur -->
<h5>Création d'utilisateur<h5>

<form method="POST">

    <input type="text" name="nomUtilisateur" placeholder="Nom de l'utilisateur"/>
    <input type="text" name="prenomUtilisateur" placeholder="Prenom de l'utilisateur"/>
    <input type="text" name="motDePasse" placeholder="Mot de passe"/>

    <label>Date d'entrée en formation</label>
    <input type="date" name="dateEntreeFormation" />
  
    <label for="selectFormation">Selectionnez la formation</label>

<!-- Selection de la formation via requête sql, on récup l'id et le nom -->
    <select name="selectFormation" id="selForm">
        <?php
            $Forms = $pdo->query("SELECT * FROM formations");
            $selectForms = $Forms->fetchAll();
            foreach($selectForms as $selectForm) { ?>
            <option value="<?php echo $selectForm->idFormation; ?>"><?php echo $selectForm->nomFormation; ?></option>
            <?php  } ?>
    </select>

    <label for="selectLieux">Selectionnez le lieu de formation</label>

<!-- Selection du lieu de formation via requête sql, on récup l'id et le nom -->
    <select name="selectLieux" id="selLieu">
        <?php
            $lieux = $pdo->query("SELECT * FROM lieux");
            $selectLieux = $lieux->fetchAll();
            foreach($selectLieux as $selectLieu) { ?>
            <option value="<?php echo $selectLieu->idLieu; ?>"><?php echo $selectLieu->lieuFormation; ?></option>
            <?php  } ?>
    </select>
    <label>Selection du rôle de l'utilisateur</label>

<!-- Selection du role via requête sql, on récup l'id et le nom -->
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

<!-- Requête qui vas créer l'utilisateur avec tout les paramètres selectionnés -->
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
