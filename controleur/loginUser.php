<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
};
?>
<?php
if(!empty($_POST) && !empty($_POST['userName'])) { // Verifie si c'est remplis pour ne pas aller chercher dans la base de donnée si il n'y a rien
    
    require_once '../modele/pdo.php';
    
    $req = $pdo->prepare('SELECT * FROM Utilisateurs WHERE NomUtilisateur = :nomMembre ');
    $req->execute(['nomMembre' => $_POST['userName']]);
    $user = $req->fetch(); // Récupère l'utilisateur
    session_start();
    
    $_SESSION['auth'] = $user;
    $_SESSION['flash']['success'] = 'Vous etes maintenant bien connecté';
    header('Location: ../vue/questionnaire.php');
    exit();
    
    } else {
    
    $_SESSION['flash']['danger'] = "Heu vous avez fait une erreur d'email ou de mot de passe";
    header('Location: ../index.php');
    exit();
    
    }
    
    