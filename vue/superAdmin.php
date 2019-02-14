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
    <select name="selectLieux" class="selLieu">
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

        // Vérifie si l'utilisateur n'est pas déjà enregistré
        $req = $pdo->prepare("SELECT * FROM utilisateurs WHERE pseudoUtilisateur = :pseudoUtilisateur");
        $req->bindParam(':pseudoUtilisateur', $_POST['pseudoUtilisateur']);
        $req->execute();
        $membre = $req->fetch();

        if($membre) {
            echo 'Ce pseudo est déjà pris';
        } else {

            // Insertion de l'utilisateur dans la BDD
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
<h5>Création d'un administrateur:</h5>

<!-- Formulaire de création d'un administrateur -->
<form method="POST">

    <input type="text" name="nomUtilisateur" placeholder="Nom de l'utilisateur"/>
    <input type="text" name="prenomUtilisateur" placeholder="Prenom de l'utilisateur"/>
    <input type="password" name="motDePasse" placeholder="Mot de passe"/>
    <input type="password" name="motDePasseVerif" placeholder="Confirmation"/>

    <!-- Select des Lieux de formation -->
    <label for="selectLieux">Selectionnez le lieu de formation:</label>
    <select name="selectLieux" class="selLieu">
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

        // Vérifie si l'utilisateur n'est pas déjà enregistré
        $req = $pdo->prepare("SELECT * FROM utilisateurs WHERE nomUtilisateur = :nomUtilisateur");
        $req->bindParam(':nomUtilisateur', $_POST['nomUtilisateur']);
        $req->execute();
        $membre = $req->fetch();

        if($membre) {
            echo 'Ce nom est déjà utilisé';
        } else {
            // vérification du MDP, s'il correspond bien à celui confirmé
            if(empty($_POST['motDePasse']) || $_POST['motDePasse'] != $_POST['motDePasseVerif']) {
                $errors['pass'] = "Vous devez rentrer un mot de passe valide";
            } else {

                // Insertion de l'utilisateur, si tout est bon
                $creationUtilisateur = $pdo->prepare('INSERT INTO utilisateurs SET nomUtilisateur = :nomUtilisateur, prenomUtilisateur = :prenomUtilisateur, motDePasse = :motDePasse, idRole = 2');
                $password = password_hash($_POST['motDePasse'], PASSWORD_BCRYPT);
                $creationUtilisateur->bindParam(':nomUtilisateur', $_POST['nomUtilisateur']);
                $creationUtilisateur->bindParam(':prenomUtilisateur', $_POST['prenomUtilisateur']);
                $creationUtilisateur->bindParam(':motDePasse', $password);
                $creationUtilisateur->execute();
            
                // Récupération du dernier Id inséré
                $dernierId =  $pdo->lastInsertId();

                // Insérer l'id lieu de formation et l'id utilisateurs dans la table de jonction selocalise
            
                $selectLieuFormation = $pdo->prepare("INSERT INTO selocalise SET idUtilisateur = :idUtilisateur, idLieu = :idLieu");
                $selectLieuFormation->bindParam(':idUtilisateur', $dernierId);
                $selectLieuFormation->bindParam(':idLieu', $_POST['selectLieux']);
                $selectLieuFormation->execute();
            }
        }
    }
?>
<br>
<br>
<h5>Afficher les utilisateurs par date ou type de formation ou lieu de formation</h5>

<form method="POST">

    <label>Afficher tout les utilisateurs trié par date</label>
    <input type="date" name="afficherUtilisateurDate"/>
    <label>Afficher tout les utilisateurs trié par type de formation</label>
    <select class="choixTypeFormation" name="choixTypeFormation">
        <?php 
            $types = $pdo->query("SELECT * FROM formations ");
            $choixTypesFormations = $types->fetchAll(); ?>
            <option value="">Selection de formation</option>
            <?php
            foreach($choixTypesFormations as $choixTypeFormation) { ?>
            <option value="<?php echo $choixTypeFormation->idFormation;?>" name="depSel"><?php echo $choixTypeFormation->nomFormation;?></option>
            <?php 
            }   
        ?>
    </select>
    <button type="submit">Valider</button>
</form>
<form method="POST">
    <label>Afficher tout les utilisateurs trié par lieu de formation</label>
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
if(isset($_POST['afficherUtilisateurDate'])) {

$choixTypesFormationsAffichage = $pdo->prepare('SELECT * FROM utilisateurs NATURAL JOIN suitformation NATURAL JOIN formations NATURAL JOIN lieux NATURAL JOIN selocalise WHERE dateEntreeFormation = :dateEntreeFormation OR idFormation = :idFormation OR idLieu = :idLieu');
$choixTypesFormationsAffichage->bindParam('dateEntreeFormation', $_POST['afficherUtilisateurDate']);
$choixTypesFormationsAffichage->bindParam('idFormation', $_POST['choixTypeFormation']);
$choixTypesFormationsAffichage->bindParam('idLieu', $_POST['choixLieuFormation']);
$choixTypesFormationsAffichage->execute();

while($donneesSelection = $choixTypesFormationsAffichage->fetch()) {

echo '<p> nom : ' . $donneesSelection->nomUtilisateur . ' prenom : ' . $donneesSelection->prenomUtilisateur . ' date d\'entrée en formation : ' . $donneesSelection->dateEntreeFormation . ' formation suivis : ' . $donneesSelection->nomFormation . ' lieux de formation ' . $donneesSelection->lieuFormation . '</p>';

}}

?>

<h5>Suppression d'un utilisateur<h5>
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
$membre = $pdo->query('SELECT * FROM utilisateurs NATURAL JOIN suitformation NATURAL JOIN formations NATURAL JOIN lieux ORDER BY dateEntreeFormation DESC');

while ($donnees = $membre->fetch()){
    echo '<p> nom : ' . $donnees->nomUtilisateur . ' prenom : ' . $donnees->prenomUtilisateur . ' date d\'entrée en formation : ' . $donnees->dateEntreeFormation . ' formation suivis : ' . $donnees->nomFormation . ' lieux de formation : ' . $donnees->lieuFormation . '</p>';
    
}
}
$membreDelete = $pdo->prepare("UPDATE utilisateurs SET nomUtilisateur = 'Anonyme', prenomUtilisateur = 'Anonyme', pseudoUtilisateur = 'Anonyme' WHERE nomUtilisateur = :nomUtilisateur");
    $membreDelete->bindParam(':nomUtilisateur', $_POST['deleteUtilisateur']);
    $membreDelete->execute();
?>