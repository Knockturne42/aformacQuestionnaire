<?php
include '../modele/pdo.php';
include '../include/fonctions.php';

if(session_status() == PHP_SESSION_NONE) {
    session_start();
};

loggedOnly();

?>

<?php
$statut = $_SESSION['auth']->idRole;
if($_SESSION['auth'] && $statut == 1) {?>
<h1 class="text-center">Page D'administrateur</h1>
<?php
} else {

header('Location : ../index.php');
}
include '../include/header.php';
?>

<a href="../controleur/logout.php">Deconnexion</a>

<div class="container">
    <div class="column">
        <p class="text-center">Vous etes connectez avec le compte de <?php echo $_SESSION['auth']->nomUtilisateur?>
    </div>
        <div class="column">
            <p class="text-center"><a href="../vue/insertion.php">Créer un questionnaire</a></p>
        </div>
</div>

<!------------------------------------- PARTIE DE CREATION D'UTILISATEUR --------------------->
<div class="container">
    <div class="card">
        <div class="card-title">
            <h4 class="text-center" style="margin-top : 3%;">Création d'utilisateur : <h4>
        </div>
<div class="card-body">
        <!-- Formulaire de création d'utilisateur -->
<form method="POST">

    <label>Nom de l'utilisateur</label>
    <input class="form-control" type="text" name="nomUtilisateur" placeholder="Nom"/>

    <label>Prenom de l'utilisateur</label>
    <input class="form-control" type="text" name="prenomUtilisateur" placeholder="Prenom"/>

    <label>Pseudo de l'utilisateur</label>
    <input class="form-control" type="text" name="pseudoUtilisateur" placeholder="Pseudo"/>

    <label>Date d'entrée en formation : </label>
    <input class="form-control" type="date" name="dateEntreeFormation"/>

    <label>Date de fin de formation:</label>
    <input class="form-control" type="date" name="dateFinFormation"/>

    <!-- Select du nom de formation -->
    <label for="selectFormation">Selectionnez la formation:</label>
    <select class="form-control" name="selectFormation" id="selForm">
        <?php
            $Forms = $pdo->query("SELECT * FROM formations");
            $selectForms = $Forms->fetchAll();
            foreach($selectForms as $selectForm) { ?>
            <option value="<?php echo $selectForm->idFormation; ?>"><?php echo $selectForm->nomFormation; ?></option>
            <?php  } ?>
    </select>

    <!-- Select des Lieux de formation -->
    <label for="selectLieux">Selectionnez le lieu de formation:</label>
    <select class="form-control text-center" name="selectLieux" class="selLieu">
        <?php
            $lieux = $pdo->query("SELECT * FROM lieux");
            $selectLieux = $lieux->fetchAll();
            foreach($selectLieux as $selectLieu) { ?>
            <option value="<?php echo $selectLieu->idLieu; ?>"><?php echo $selectLieu->lieuFormation; ?></option>
            <?php  } ?>
    </select>
    <div class="container">
    <button class="btn btn-primary col-12" type="submit" name="creationUtilisateur">Créer l'utilisateur</button>
    </div>           
    <?php
    if(isset($_POST['creationUtilisateur']) && isset($_POST['selectFormation'])) {

        // Vérifie si l'utilisateur n'est pas déjà enregistré
        $req = $pdo->prepare("SELECT * FROM utilisateurs WHERE pseudoUtilisateur = :pseudoUtilisateur");
        $req->bindParam('pseudoUtilisateur', $_POST['pseudoUtilisateur']);
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
</div>
    </div>
</div>

<!----------------------------------- PARTIE CREATION D'ADMINISTRATEUR --------------------------------->
<div class="container">
    <div class="card">
        <div class="card-title">
            <h4 class="text-center" style="margin-top : 3%;">Création d'un administrateur :</h4>
        </div>

<div class="card-body">
<!-- Formulaire de création d'un administrateur -->
<form method="POST">

    <label>Nom de l'administrateur</label>
    <input class="form-control" type="text" name="nomUtilisateur" placeholder="Nom de l'utilisateur"/>

    <label>Prenom de l'administrateur</label>
    <input class="form-control" type="text" name="prenomUtilisateur" placeholder="Prenom de l'utilisateur"/>

    <label>Mot de passe</label>
    <input class="form-control" type="password" name="motDePasse" placeholder="Mot de passe"/>

    <label>Confirmer le mot de passe</label>
    <input class="form-control" type="password" name="motDePasseVerif" placeholder="Confirmation"/>

    <!-- Select des Lieux de formation -->
    <label for="selectLieux">Selectionnez le lieu de formation:</label>
    <select class="form-control" name="selectLieux" class="selLieu">
        <?php
            $lieux = $pdo->query("SELECT * FROM lieux");
            $selectLieux = $lieux->fetchAll();
            foreach($selectLieux as $selectLieu) { ?>
            <option value="<?php echo $selectLieu->idLieu; ?>"><?php echo $selectLieu->lieuFormation; ?></option>
            <?php  } ?>
    </select>

    <div class="container">
        <button class="btn btn-primary col-12" type="submit" name="creationUtilisateur">Créer l'administrateur</button>
    </div>

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
</div>
    </div>
</div>




<!----------------------------------------   PARTIE AFFICHAGE DES UTILISATEURS   ------------------------->
<div class="container">
    <div class="card">
        <div class="card-title">
            <h5 class="text-center">Afficher les utilisateurs par date ou type de formation ou lieu de formation</h5>
        </div>
<!-- Pour selectionner la date -->
<form method="POST">

    <label>Afficher tout les utilisateurs trié par date</label>
    <input class="form-control" type="date" name="afficherUtilisateurDate"/>
    <label>Afficher tout les utilisateurs trié par type de formation</label>
    <select  class="form-control" name="choixTypeFormation">
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
    <div class="container">
        <button class="btn btn-primary col-12"type="submit">Valider</button>
    </div>
</form>

<!-- Pour la selection des formations par lieu -->
<form method="POST">
    <label>Afficher tout les utilisateurs trié par lieu de formation</label>
    <select class="form-control" name="choixLieuFormation">
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
    <div class="container">
        <button class="btn btn-primary col-12" type="submit">Valider</button>
    </div>
</form>
</div>
</div>
<?php

// Les fonctions qui affichent les utilisateurs selon la selections //
if(isset($_POST['afficherUtilisateurDate'])) {

$choixTypesFormationsAffichage = $pdo->prepare('SELECT * FROM utilisateurs NATURAL JOIN suitformation NATURAL JOIN formations NATURAL JOIN lieux NATURAL JOIN selocalise WHERE dateEntreeFormation = :dateEntreeFormation OR idFormation = :idFormation OR idLieu = :idLieu');
$choixTypesFormationsAffichage->bindParam('dateEntreeFormation', $_POST['afficherUtilisateurDate']);
$choixTypesFormationsAffichage->bindParam('idFormation', $_POST['choixTypeFormation']);
$choixTypesFormationsAffichage->bindParam('idLieu', $_POST['choixLieuFormation']);
$choixTypesFormationsAffichage->execute();

if(!empty($_POST['afficherUtilisateurDate'] || $_POST['choixLieuFormation'] || $_POST['choixTypeFormation'] )) { 
?>
<table class="table">
<thead>
    <tr>
        <th scope="col">Nom</th>
        <th scope="col">Prenom</th>
        <th scope="col">Pseudo</th>
        <th scope="col">Date d'entree en formation</th>
        <th scope="col">Date de fin de formation</th>
        <th scope="col">Nom de la formation</th>
    </tr>
</thead>
<?php
while($donneesSelection = $choixTypesFormationsAffichage->fetch()) {
?>
  <tbody>
      <tr>
          <td><?php echo $donneesSelection->nomUtilisateur ?></td>
          <td><?php echo $donneesSelection->prenomUtilisateur ?></td>
          <td><?php echo $donneesSelection->pseudoUtilisateur ?></td>
          <td><?php echo $donneesSelection->dateEntreeFormation ?></td>
          <td><?php echo $donneesSelection->dateFinFormation?></td>
          <td><?php echo $donneesSelection->nomFormation ?></td>
        </tr>
    </tbody>
<?php
}}}

?>

<div class="container text-center" style="width : 100%;">
    <div class="row">
        <div class="card col-5" style="margin : 0.5%;">
            <div class="card-title">
                    <h5>Affichage de la totalité des utilisateurs</h5>
            </div>
    <form method="POST">
            
            <button type="submit" name="afficherMembre">Afficher tout les utilisateurs</button>
            <button type="submit" name="fermerMembre">Fermer l'affichage des utilisateurs</button>
            
            </div>
            
            <div class="card col-5" style="margin : 0.5%;">
            <div class="card-title">
            <h5 class="text-center">Suppression d'un utilisateur<h5>
                </div>
                <label for="">Entrer le pseudo de l'utilisateur a supprimer</label>
                <input type="text" name="deleteUtilisateur" class="form-control-lg-2" />
                <button type="submit" name="deleteMembreExecute">Supprimer l'utilisateur</button> 
            </div>
        </form>
    </div>
    
    
    
    <?php
    $membreDelete = $pdo->prepare("UPDATE utilisateurs SET nomUtilisateur = 'Anonyme', prenomUtilisateur = 'Anonyme', pseudoUtilisateur = 'Anonyme' WHERE nomUtilisateur = :nomUtilisateur");
    $membreDelete->bindParam(':nomUtilisateur', $_POST['deleteUtilisateur']);
    $membreDelete->execute();

    // Afficher toute la liste des utilisateurs //
    if(isset($_POST['afficherMembre']) && ([$_POST['fermerMembre']])) {
        $membre = $pdo->query('SELECT * FROM utilisateurs NATURAL JOIN suitformation NATURAL JOIN formations NATURAL JOIN lieux NATURAL JOIN selocalise ORDER BY dateEntreeFormation DESC');
        
        while ($donnees = $membre->fetch()){
            ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
      <tbody>
          <tr>
              <td><?php echo $donnees->nomUtilisateur ?></td>
              <td><?php echo $donnees->prenomUtilisateur ?></td>
              <td><?php echo $donnees->pseudoUtilisateur ?></td>
              <td><?php echo $donnees->dateEntreeFormation ?></td>
              <td><?php echo $donnees->dateFinFormation?></td>
              <td><?php echo $donnees->nomFormation ?></td>
            </tr>
        </tbody>
    </table>
    <?php
        }}
    ?>