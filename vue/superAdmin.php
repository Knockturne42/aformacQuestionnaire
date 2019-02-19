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
<h1 class="text-center">Page super administrateur</h1>
<?php
} else {

header('Location : ../index.php');
}
include '../include/header.php';
?>

<div class="container">
<a class="form-control text-center col-2" href="../controleur/logout.php">Deconnexion</a>
</div>

<div class="container">
    <div class="column">
        <p class="text-center">Vous etes connectez avec le compte de <?php echo $_SESSION['auth']->nomAdmin?>
    </div>
        <div class="column">
            <p class="text-center"><a href="../vue/insertion.php">Créer un questionnaire</a></p>
        </div>
</div>





<!------------------------ FORMULAIRE D'AJOUT DE FORMATION ----------------------------------------------->
<div class="container">
    <div class="row">
        <div class="card col-6">
            <div class="card-title">
                <h4 class="text-center">Ajouter une formation</h4>
            </div>
    <form method="post" action="">
    <label>Ajouter une formation</label>
    <input class="form-control" type="text" name="addFormation">
    
        <input class="btn btn-primary col-12"  type="submit" name="submAddFormation" value="Ajouter la formation">
    </form>
        </div>





<!----------------------- FORMULAIRE DE SUPRESSION DE FORMATION ------------------------------------------>
<div class="card col-6">
    <form method="post" action="">
        <div class="card-title">
            <h4 class="text-center">Supprimer une formation</h4>
        </div>

        <label for="formations">Choisir une formation à supprimer : </label>

        <select class="form-control" name="formationsDel"><!-- Affiche les formations existantes -->
        <?php
                // Affiche les formation existantes
                $Forms = $pdo->query("SELECT * FROM formations");
                $selectForms = $Forms->fetchAll();
                foreach($selectForms as $selectForm)
               { ?>
            <option value="<?php echo $selectForm->idFormation; ?>"><?php echo $selectForm->nomFormation; ?></option>
            <?php  } ?>
        </select>
        
        <input class="btn btn-primary col-12" type="submit" name="submDelFormation" value="Supprimer la formation">
    
    </form>
</div>
    </div>
</div>

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

<?php echo '<br /><br/><br/>' . $erreur; // Message retourné lorsque l'on tente d'ajouté une formation (n'est pas forcément une erreur)
?>
<p class="text-center"><a href="../vue/insertion.php">Ajouter un questionnaire</a></p>





<!------------------------ FORMULAIRE D'AJOUT DE SESSION ------------------------------------------------->
<div class="container">

    <div class="card">

        <form method="post" action="">

            <div class="card-title">
                <h4 class="text-center">Ajouter une session</h4>
            </div>

                <div class=card-body>
        <label for="formations">Choisir une formation : </label>

        <select class="form-control" name="formationsSelection"><!-- Affiche les formations existantes -->
        <?php
                // Affiche les formation existantes
                $Forms = $pdo->query("SELECT * FROM formations");
                $selectForms = $Forms->fetchAll();
                foreach($selectForms as $selectForm)
               { ?>
            <option value="<?php echo $selectForm->idFormation; ?>"><?php echo $selectForm->nomFormation; ?></option>
            <?php  } ?>
        </select>
        
    <label>Identifiant de la session</label>
    <input class="form-control" name="codeSessions">

    <label>Date de début de formation</label>
    <input type="date" class="form-control" name="dateDebutSession">

    <label>Date de fin de formation</label>
    <input type="date" class="form-control" name="dateFinSession">

    <div class="container">
    <button class="btn btn-primary col-12" type="submit" name="creationSession">Creer la session</button>
    
        </form>
                </div>
    </div>

</div>

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
?>





<!------------------------------------- PARTIE DE CREATION D'UTILISATEUR --------------------->
<div class="container">
    <div class="card">
        <div class="card-title">
            <h4 class="text-center">Création d'utilisateur : <h4>
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

    <!-- Select du nom de formation -->
    <label for="selectFormation">Selectionnez la session de formation:</label>
    <select class="form-control" name="selectFormation" id="selForm">
        <?php
            $Forms = $pdo->query("SELECT * FROM session NATURAL JOIN formation");
            $selectForms = $Forms->fetchAll();
            foreach($selectForms as $selectForm) { ?>
            <option value="<?php echo $selectForm->idSession; ?>"><?php echo $selectForm->SessionRef.' '. $selectForm->nomFormation; ?></option>
            <?php  } ?>
    </select>

    <div class="container">
    <button class="btn btn-primary col-12" type="submit" name="creationUtilisateur">Créer l'utilisateur</button>
    </div>           
    
    <?php
    if(isset($_POST['creationUtilisateur']) && isset($_POST['selectFormation'])) {

        // Vérifie si l'utilisateur n'est pas déjà enregistré
        $req = $pdo->prepare("SELECT * FROM apprenant WHERE pseudo = :pseudoUtilisateur");
        $req->bindParam(':pseudoUtilisateur', $_POST['pseudoUtilisateur']);
        $req->execute();
        $membre = $req->fetch();

        if($membre) {
            echo 'Ce pseudo est déjà pris';
        } else {

            // Insertion de l'utilisateur dans la BDD
            $creationUtilisateur = $pdo->prepare('INSERT INTO apprenant SET nomApprenant = :nomUtilisateur, prenomApprenant = :prenomUtilisateur, pseudo = :pseudoUtilisateur, idSession = :idSess');
            $creationUtilisateur->bindParam(':nomUtilisateur', $_POST['nomUtilisateur']);
            $creationUtilisateur->bindParam(':prenomUtilisateur', $_POST['prenomUtilisateur']);
            $creationUtilisateur->bindParam(':pseudoUtilisateur', $_POST['pseudoUtilisateur']);
            $creationUtilisateur->bindParam(':idSess', $_POST['selectFormation']);
            $creationUtilisateur->execute();
           
            // Récupération du dernier Id inséré
            $dernierId =  $pdo->lastInsertId();
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
            <h4 class="text-center">Création d'un administrateur :</h4>
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

    <div class="container">
        <button class="btn btn-primary col-12" type="submit" name="creationUtilisateur">Créer l'administrateur</button>
    </div>

<?php
    if(isset($_POST['creationUtilisateur']) && isset($_POST['selectFormation'])) {

        // Vérifie si l'utilisateur n'est pas déjà enregistré
        $req = $pdo->prepare("SELECT * FROM admin WHERE nomAdmin = :nomUtilisateur");
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
                $creationUtilisateur = $pdo->prepare('INSERT INTO admin SET nomAdmin = :nomUtilisateur, prenomAdmin = :prenomUtilisateur, motDePasse = :motDePasse, idRole = 2');
                $password = password_hash($_POST['motDePasse'], PASSWORD_BCRYPT);
                $creationUtilisateur->bindParam(':nomUtilisateur', $_POST['nomUtilisateur']);
                $creationUtilisateur->bindParam(':prenomUtilisateur', $_POST['prenomUtilisateur']);
                $creationUtilisateur->bindParam(':motDePasse', $password);
                $creationUtilisateur->execute();
            
                // Récupération du dernier Id inséré
                // $dernierId =  $pdo->lastInsertId();

            }
        }
    }
?>
</div>
    </div>
</div>




<!-----------------------  PARTIE AFFICHAGE DES UTILISATEURS AVEC SELECTION  ------------------------->
<div class="container" style="margin-bottom : 3%;">

    <div class="card">

        <div class="card-title">
            <h4 class="text-center">Affichage des utilisateurs</h4>
        </div>

<!-- Pour selectionner la date -->
<form method="POST">

    <div class="row">

        <div class="col">
    <h5 class="text-center">Afficher par date</h5>
    <input class="form-control" type="date" name="afficherUtilisateurDate"/>
        </div>

<div class="col">
    <h5 class="text-center">Afficher par type de formation</h5>
    <select  class="form-control" name="choixTypeFormation">
        <?php 
            $types = $pdo->query("SELECT * FROM formation ");
            $choixTypesFormations = $types->fetchAll(); ?>
            <option value="">Selection de formation</option>
            <?php
            foreach($choixTypesFormations as $choixTypeFormation) { ?>
            <option value="<?php echo $choixTypeFormation->idFormation;?>" name="depSel"><?php echo $choixTypeFormation->nomFormation;?></option>
            <?php 
            }   
        ?>
    </select>
</div>

<div class="col">
<!-- Pour la selection des formations par lieu -->
    <h5 class="text-center">Afficher par lieu de formation</h5>
    <select class="form-control" name="choixLieuFormation">
        <?php 
            $lieux = $pdo->query("SELECT * FROM ville ");
            $choixLieuxFormations = $lieux->fetchAll();?>
            <option value="">Selection du lieux</option>
            <?php
            foreach($choixLieuxFormations as $choixLieuFormation) {?>
                <option value="<?php echo $choixLieuFormation->idVille;?>" name="depSel"><?php echo $choixLieuFormation->nomVille;?></option>
            <?php 
            } 
            ?>
    </select>
</div>

    </div>

    <div class="container">
        <button class="btn btn-primary col-12"  type="submit">Valider</button>
    </div>
</form>

</div>


<div class="container" >
<?php

// Les fonctions qui affichent les utilisateurs selon la selection //
if(isset($_POST['afficherUtilisateurDate'])) {

$choixTypesFormationsAffichage = $pdo->prepare('SELECT * FROM apprenant NATURAL JOIN formation NATURAL JOIN ville NATURAL JOIN session WHERE dateDebutSession = :dateDebutSession OR idFormation = :idFormation OR idVille = :idLieu');
$choixTypesFormationsAffichage->bindParam(':dateDebutSession', $_POST['afficherUtilisateurDate']);
$choixTypesFormationsAffichage->bindParam(':idFormation', $_POST['choixTypeFormation']);
$choixTypesFormationsAffichage->bindParam(':idLieu', $_POST['choixLieuFormation']);
$choixTypesFormationsAffichage->execute();

if(!empty($_POST['afficherUtilisateurDate'] || $_POST['choixLieuFormation'] || $_POST['choixTypeFormation'] )) { 
?>

<div class="container">
    <div class="row">
    
        <div class="col-2 titreTableau">NOM</div>
        <div class="col-2 titreTableau">PRENOM</div>
        <div class="col-2 titreTableau">PSEUDO</div>
        <div class="col-2 titreTableau">DATE D'ENTREE EN FORMATION</div>
        <div class="col-2 titreTableau">DATE DE FIN DE FORMATION</div>
        <div class="col-2 titreTableau">NOM DE LA FORMATION</div>

    </div>

<?php
while($donneesSelection = $choixTypesFormationsAffichage->fetch()) {
?>
    <div class="row">
     
          <div class="col-2 donneesTableau"><?php echo $donneesSelection->nomApprenant ?></div>
          <div class="col-2 donneesTableau"><?php echo $donneesSelection->prenomApprenant ?></div>
          <div class="col-2 donneesTableau"><?php echo $donneesSelection->pseudo ?></div>
          <div class="col-2 donneesTableau"><?php echo $donneesSelection->dateDebutSession ?></div>
          <div class="col-2 donneesTableau"><?php echo $donneesSelection->dateFinSession ?></div>
          <div class="col-2 donneesTableau"><?php echo $donneesSelection->nomFormation ?></div>
       
    </div>
<?php
}}}

?>
</div>


<!---------------------------------------- PARTIE QUI AFFICHE TOUT LES UTILISATEURS ---------------------->
<div class="container text-center">
    <div class="row">
        <div class="card col-6">

            <div class="card-title">
                <h5 class="text-center">Affichage de la totalité des utilisateurs</h5>
            </div>

    <form method="POST">
            
            <button class="btn btn-primary" type="submit" name="afficherMembre"><a href="#afficheUtilisateurs"></a>Afficher tout les utilisateurs</button>
            <button class="btn btn-primary" type="submit" name="fermerMembre"><a href="#fermerAfficheUtilisateurs"></a>Fermer l'affichage des utilisateurs</button>
            
        </div>
            
            <div class="card col-6">
                <div class="card-title">
                    <h5 class="text-center">Rendre annonyme l'utilisateur<h5>
                </div>

                <label for="">Entrer le pseudo de l'utilisateur</label>
                <input type="text" name="deleteUtilisateur" class="form-control-lg-2" />

                <button class="btn btn-primary" type="submit" name="deleteMembreExecute"><a href="#afficheUtilisateurs"></a>Rendre annonyme l'utilisateur</button> 
    </div>
    </form>
            </div>
</div>


    <?php
    // Afficher toute la liste des utilisateurs //
    if(isset($_POST['afficherMembre']) && ([$_POST['fermerMembre']])) {
        $membre = $pdo->query('SELECT * FROM apprenant NATURAL JOIN formation NATURAL JOIN ville ORDER BY dateDebutSession DESC');
   ?>     
   <div class="container">
            <div class="row">

             <div class="col-2 titreTableau">NOM</div>
             <div class="col-2 titreTableau">PRENOM</div>
             <div class="col-2 titreTableau">PSEUDO</div>
             <div class="col-2 titreTableau">DATE D'ENTREE EN FORMATION</div>
             <div class="col-2 titreTableau">DATE DE FIN DE FORMATION</div>
             <div class="col-2 titreTableau">NOM DE LA FORMATION</div>
         
            </div>
            <?php
        while ($donnees = $membre->fetch()){
            ?>
    <div class="row">
          
              <div class="col-2 donneesTableau"><?php echo $donnees->nomApprenant ?></div>
              <div class="col-2 donneesTableau"><?php echo $donnees->prenomApprenant ?></div>
              <div class="col-2 donneesTableau"><?php echo $donnees->pseudo ?></div>
              <div class="col-2 donneesTableau"><?php echo $donnees->dateDebutSession ?></div>
              <div class="col-2 donneesTableau"><?php echo $donnees->dateFinSession ?></div>
              <div class="col-2 donneesTableau"><?php echo $donnees->nomFormation ?></div>
           
    </div>
    <?php
        }}
    ?>    
    </div>
    <?php
    $membreDelete = $pdo->prepare("UPDATE apprenant SET nomApprenant = 'Anonyme', prenomApprenant = 'Anonyme', pseudo = 'Anonyme' WHERE nomApprenant = :nomUtilisateur");
    $membreDelete->bindParam(':nomUtilisateur', $_POST['deleteUtilisateur']);
    $membreDelete->execute();
?>





<!--------------------------- FORMULAIRE AFFICHAGE RESULTAT ----------------------------------------------->
<div class="container">
    <div class="card">
        <div class="card-title">
            <h4 class="text-center">Affichage des résultats</h4>
        </div>

<div class="card-body">
<!-- Formulaire de création d'un administrateur -->
<form method="POST">

    <!-- Select des Lieux de formation -->
    <label for="selectLieuxFormation">Affichage par Lieu de formation</label>
    <select class="form-control" name="afficheResultatLieux" class="selLieu">
        <?php
<<<<<<< HEAD
            $lieux = $pdo->query("SELECT * FROM lieux");
            $selectLieux = $lieux->fetchAll();
            foreach($selectLieux as $selectLieu) { ?>
            <option value="<?php echo $selectLieu->idLieu; ?>"><?php echo $selectLieu->lieuFormation; ?></option>
=======
                // Affiche les formation existantes
                $Forms = $pdo->query("SELECT * FROM formation");
                $selectForms = $Forms->fetchAll();
                foreach($selectForms as $selectForm)
               { ?>
            <option value="<?php echo $selectForm->idFormation; ?>"><?php echo $selectForm->nomFormation; ?></option>
>>>>>>> 852d4df4f39d789cb3d56ab7b978c2e1097edcad
            <?php  } ?>
    </select>

<<<<<<< HEAD
    <label class="text-center">Afficher par date</label>
    <input class="form-control" type="date" name="afficherResultatDate"/>
        
    <label for="selectFormation">Affichage par formtaion</label>
    <select class="form-control" name="afficheResultatFormation" class="selLieu">
        <?php
            $lieux = $pdo->query("SELECT * FROM lieux");
            $selectLieux = $lieux->fetchAll();
            foreach($selectLieux as $selectLieu) { ?>
            <option value="<?php echo $selectLieu->idLieu; ?>"><?php echo $selectLieu->lieuFormation; ?></option>
            <?php  } ?>
    </select>
=======
<?php
    // Ajouter une formation
    if(isset($_POST['submAddFormation']) && !empty($_POST['addFormation']))
    {
        $formationExist = $pdo->prepare("SELECT * FROM formation WHERE nomFormation = :formationExist");
        $formationExist->bindParam(':formationExist', $_POST['addFormation']);
        $formationExist->execute();
        $formation = $formationExist->fetch();
        
        if($formation)
        {
            $erreur = "<p class=\"text-danger\">La formation <span class=\"erreur\">" . $_POST['addFormation'] . "</span> existe déjà !</p> <br />";
        }
        else
        {
            $createFormation = $pdo->prepare('INSERT INTO formation SET nomFormation = :nomFormation');
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
        $deleteFormation = $pdo->prepare('DELETE FROM formation WHERE idFormation = :deleteFormation');
        $deleteFormation->execute(['deleteFormation' => $_POST['formationsDel']]);
    }?>
>>>>>>> 852d4df4f39d789cb3d56ab7b978c2e1097edcad

    <label for="selectSession">Affichage par session de formation</label>
    <select class="form-control" name="afficheResultatSession" class="selLieu">
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
    </div>
</div>