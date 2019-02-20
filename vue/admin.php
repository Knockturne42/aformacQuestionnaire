<?php
include '../modele/pdo.php';
include '../include/fonctions.php';

if(session_status() == PHP_SESSION_NONE) {
    session_start();
};

loggedOnly();

$statut = $_SESSION['auth']->idRole;
if($_SESSION['auth'] && $statut == 2 || $statut == 1)
{	// TANT QUE L'ADMIN EST CONNECTE
    include '../include/header.php';
    // var_dump($_SESSION['auth']);
    ?>

<h1 class="text-center">Page administrateur</h1>
<p class="text-center">Vous êtes connecté avec le compte <?php echo $_SESSION['auth']->nomAdmin?></p>

<div class="container">
    <p><a class="form-control text-center col-2" href="../controleur/logout.php">Deconnexion</a></p>
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
                        $Forms = $pdo->query("SELECT * FROM formation");
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
        $formationExist = $pdo->prepare("SELECT * FROM formation WHERE nomFormation = :formationExist");
        $formationExist->bindParam(':formationExist', $_POST['addFormation']);
        $formationExist->execute();
        $formation = $formationExist->fetch();
        
        if($formation)
        {
            echo "<p class=\"text-danger\">La formation <span class=\"erreur\">" . $_POST['addFormation'] . "</span> existe déjà !</p> <br />";
        }
        else
        {
            $createFormation = $pdo->prepare('INSERT INTO formation SET nomFormation = :nomFormation');
            $createFormation->bindParam(':nomFormation', $_POST['addFormation']);
            $createFormation->execute();
            
            echo "<p class=\"text-success\">La formation <span class=\"erreur\">" . $_POST['addFormation'] . "</span> a bien été ajoutée</p> <br />";
        }
    }
    else if(isset($_POST['submAddFormation']) && empty($_POST['addFormation']))
    {
        echo "<p class=\"text-danger\">Veuillez saisir un nom s'il vous plaît !</p>";
    }
    
    // Supprimer une formation
    if (isset($_POST['submDelFormation']))
    {
        $deleteFormation = $pdo->prepare('DELETE FROM formation WHERE idFormation = :deleteFormation');
        $deleteFormation->execute(['deleteFormation' => $_POST['formationsDel']]);
    }
    ?>

<p class="text-center"><a href="../vue/insertion.php">Ajouter un questionnaire</a></p>

<!----------------------- FORMULAIRE D'AJOUT DE VILLE ------------------------->
<div class="container">

    <div class="card">

        <form action="" method="POST">

            <div class="card-title">
                <h4 class="text-center">Ajouter une ville</h4>
            </div>

            <div class="card-body">
                <label for="addVille">Ajouter une ville :</label>
                <input type="text" name="addVille" class="form-control">
            </div>
            <div class="container">
                <button class="btn btn-primary col-12" type="submit" name="creationVille">Créer la ville</button>
            </div>
        </form>
    </div>
</div>

<?php 
    // Ajouter la ville
    if (isset($_POST['creationVille']) && !empty($_POST['addVille'])) {

        $villeExist = $pdo->prepare("SELECT * FROM ville WHERE nomVille = :nomVille");
        $villeExist->bindParam(':nomVille', $_POST['addVille']);
        $villeExist->execute();
        $ville = $villeExist->fetch();

        if ($ville) {
            echo "<p class=\"text-danger\">La ville <span class=\"erreur\">" . $_POST['addVille'] . "</span> existe déjà !</p> <br />";
        } else {
            $createVille = $pdo->prepare("INSERT INTO ville SET nomVille = :nomVille");
            $createVille->bindParam(':nomVille', $_POST['addVille']);
            $createVille->execute();

            echo "<p class=\"text-success\">La formation <span class=\"erreur\">" . $_POST['addVille'] . "</span> a bien été ajoutée</p> <br />";
        }
    } elseif (isset($_POST['creationVille']) && empty($_POST['addVille'])) {
        echo "<p class=\"text-danger\">Veuillez saisir un nom s'il vous plaît !</p>";
    }
?>

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
                        $Forms = $pdo->query("SELECT * FROM formation");
                        $selectForms = $Forms->fetchAll();
                        foreach($selectForms as $selectForm)
                    { ?>
                    <option value="<?php echo $selectForm->idFormation; ?>"><?php echo $selectForm->nomFormation; ?></option>
                    <?php  } ?>
                </select>

                <label>Identifiant de la session :</label>
                <input class="form-control" name="codeSessions">

                <label>Date de début de formation :</label>
                <input type="date" class="form-control" name="dateDebutSession">

                <label>Date de fin de formation :</label>
                <input type="date" class="form-control" name="dateFinSession">

                <!-- Select des Lieux de formation -->
                <label for="selectLieux">Selectionnez le lieu de formation :</label>
                <select class="form-control text-center" name="selectLieux" class="selLieu">
                    <?php
                        $lieux = $pdo->query("SELECT * FROM ville");
                        $selectLieux = $lieux->fetchAll();
                        foreach($selectLieux as $selectLieu) { ?>
                        <option value="<?php echo $selectLieu->idVille; ?>"><?php echo $selectLieu->nomVille; ?></option>
                        <?php  } ?>
                </select>

                <div class="container">
                    <button class="btn btn-primary col-12" type="submit" name="creationSession">Créer la session</button>
                </div>
            </div>
        </form>
    </div>
</div>


<?php
    // Ajouter une session
    if(isset($_POST['creationSession']) && !empty($_POST['codeSessions']))
    {
        $formationExist = $pdo->prepare("SELECT * FROM session WHERE SessionRef = :sessionExist");
        $formationExist->bindParam(':sessionExist', $_POST['codeSessions']);
        $formationExist->execute();
        $formation = $formationExist->fetch();
        
        if($formation)
        {
            echo "<p class=\"text-danger\">La session <span class=\"erreur\">" . $_POST['codeSessions'] . "</span> existe déjà !</p> <br />";
        }
        else
        {
            $ajoutSession = $pdo->prepare("INSERT INTO session SET idFormation = :idFormation, SessionRef = :sessionRef, dateDebutSession = :dateDebutSession, dateFinSession = :dateFinSession, idVille = :idVille");
            $ajoutSession->bindParam(':idFormation', $_POST['formationsSelection']);
            $ajoutSession->bindParam(':sessionRef', $_POST['codeSessions']);
            $ajoutSession->bindParam(':dateDebutSession', $_POST['dateDebutSession']);
            $ajoutSession->bindParam(':dateFinSession', $_POST['dateFinSession']);
            $ajoutSession->bindParam(':idVille', $_POST['selectLieux']);
            $ajoutSession->execute();
            
            echo "<p class=\"text-danger\">La session <span class=\"erreur\">" . $_POST['codeSessions'] . "</span> a bien été ajoutée</p> <br />";
        }
    }
    else if(isset($_POST['creationSession']) && empty($_POST['codeSessions']))
    {
        echo "<p class=\"text-danger\">Veuillez saisir un nom s'il vous plaît !</p>";
    }

?>


<!----------------------- FORMULAIRE DE CREATION D'UTILISATEUR ------------------------------------------->
<div class="container">
    <div class="card">
        <div class="card-title">
            <h4 class="text-center">Création d'utilisateur  <h4>
        </div>
        <div class="card-body">
            <form method="POST">

                <label>Nom de l'utilisateur :</label>
                <input class="form-control" type="text" name="nomUtilisateur" placeholder="Nom"/>

                <label>Prénom de l'utilisateur :</label>
                <input class="form-control" type="text" name="prenomUtilisateur" placeholder="Prénom"/>

                <label>Pseudo de l'utilisateur :</label>
                <input class="form-control" type="text" name="pseudoUtilisateur" placeholder="Pseudo"/>

                <!-- Select de la session-->
                <label for="selectFormation">Sélectionnez la session :</label>
                <select class="form-control" name="selectSession" id="selForm">
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
            </form>
            <?php
                if(isset($_POST['creationUtilisateur']) && isset($_POST['selectSession'])) {
                    
                    $req = $pdo->prepare("SELECT * FROM apprenant WHERE pseudo = :pseudoUtilisateur");
                    $req->bindParam(':pseudoUtilisateur', $_POST['pseudoUtilisateur']);
                    $req->execute();
                    $membre = $req->fetch();
                    
                    if($membre) {
                        echo 'Ce pseudo est déjà pris';
                    } else {
                        
                        $creationUtilisateur = $pdo->prepare('INSERT INTO apprenant SET nomApprenant = :nomUtilisateur, prenomApprenant = :prenomUtilisateur, pseudo = :pseudoUtilisateur, idSession = :choixSession');
                        $creationUtilisateur->bindParam(':nomUtilisateur', $_POST['nomUtilisateur']);
                        $creationUtilisateur->bindParam(':prenomUtilisateur', $_POST['prenomUtilisateur']);
                        $creationUtilisateur->bindParam(':pseudoUtilisateur', $_POST['pseudoUtilisateur']);
                        $creationUtilisateur->bindParam(':choixSession', $_POST['selectSession']);
                        $creationUtilisateur->execute();
                        
                    }
                    
                }
            ?>
        </div>
    </div>
</div>

<!---------------------------------------- Formulaire création Admin ------------------------------------------->
<?php
$statut = $_SESSION['auth']->idRole;
if($_SESSION['auth'] && $statut == 1) { 
    require 'superAdmin.php';
}
?>


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
</div>


<div class="container" >
    <?php

    // Les fonctions qui affichent les utilisateurs selon la selection //
    if(isset($_POST['afficherUtilisateurDate'])) {

    $choixTypesFormationsAffichage = $pdo->prepare('SELECT * FROM apprenant NATURAL JOIN session NATURAL JOIN formation NATURAL JOIN ville WHERE dateDebutSession = :dateDebutSession OR idFormation = :idFormation OR idVille = :idLieu');

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
</div>


<!---------------------------- PARTIE QUI AFFICHE TOUT LES UTILISATEURS ---------------------------------->
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
                <h5 class="text-center">Rendre anonyme l'utilisateur<h5>
            </div>

            <label for="">Entrer le pseudo de l'utilisateur :</label>
            <input type="text" name="deleteUtilisateur" class="form-control-lg-2" />

            <button class="btn btn-primary" type="submit" name="deleteMembreExecute"><a href="#afficheUtilisateurs"></a>Rendre anonyme l'utilisateur</button> 
        </div>
            </form>
    </div>
</div>

<?php
    // Afficher toute la liste des utilisateurs //
    if(isset($_POST['afficherMembre']) && ([$_POST['fermerMembre']])) {
        $membre = $pdo->query('SELECT * FROM apprenant NATURAL JOIN session NATURAL JOIN formation NATURAL JOIN ville ORDER BY dateDebutSession DESC');
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
            <!-- Formulaire d'affichage -->
            <form method="POST">

                <!-- Select des Lieux de formation -->
                <label for="selectLieuxFormation">Affichage par Lieu de formation :</label>
                <select class="form-control" name="afficheResultatLieux" class="selLieu">
                    <?php
                        $lieux = $pdo->query("SELECT * FROM ville");
                        $selectLieux = $lieux->fetchAll();
                        foreach($selectLieux as $selectLieu) { ?>
                        <option value="<?php echo $selectLieu->idVille; ?>"><?php echo $selectLieu->nomVille; ?></option>
                        <?php  } ?>
                </select>

                <label class="text-center">Afficher par date :</label>
                <input class="form-control" type="date" name="afficherResultatDate"/>
                    
                <label for="selectFormation">Affichage par formation :</label>
                <select class="form-control" name="afficheResultatLieux" class="selLieu">
                    <?php
                        $lieux = $pdo->query("SELECT * FROM formation");
                        $selectLieux = $lieux->fetchAll();
                        foreach($selectLieux as $selectLieu) { ?>
                        <option value="<?php echo $selectLieu->idFormation; ?>"><?php echo $selectLieu->nomFormation; ?></option>
                        <?php  } ?>
                </select>

                <label for="selectSession">Affichage par session de formation :</label>
                <select class="form-control" name="afficheResultatSession" class="selLieu">
                    <?php
                        $lieux = $pdo->query("SELECT * FROM session");
                        $selectLieux = $lieux->fetchAll();
                        foreach($selectLieux as $selectLieu) { ?>
                        <option value="<?php echo $selectLieu->idSession; ?>"><?php echo $selectLieu->SessionRef; ?></option>
                        <?php  } ?>
                </select>

                <div class="container">
                    <button class="btn btn-primary col-12" type="submit" name="creationUtilisateur">Afficher les résultats</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

}	// SINON SI L'ADMIN N'EST PAS CONNECTE
else {
    
    header('Location : ../index.php');
}

?>