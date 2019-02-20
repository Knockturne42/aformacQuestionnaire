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
            </form>
            <?php
                if(isset($_POST['creationUtilisateur'])) 
                {

                    // Vérifie si l'utilisateur n'est pas déjà enregistré
                    $req = $pdo->prepare("SELECT * FROM admin WHERE nomAdmin = :nomUtilisateur");
                    $req->bindParam(':nomUtilisateur', $_POST['nomUtilisateur']);
                    $req->execute();
                    $membre = $req->fetch();

                    if($membre) 
                    {
                        echo 'Ce nom est déjà utilisé';
                    } else {
                        // vérification du MDP, s'il correspond bien à celui confirmé
                        if(empty($_POST['motDePasse']) || $_POST['motDePasse'] != $_POST['motDePasseVerif']) 
                        {
                            $errors['pass'] = "Vous devez rentrer un mot de passe valide";
                        } else 
                        {

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