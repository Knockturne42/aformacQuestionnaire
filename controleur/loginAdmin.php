<?php 
if(!empty($_POST) && !empty($_POST['userName']) && !empty($_POST['userPassword'])) { // Verifie si c'est remplis pour ne pas aller chercher dans la base de donnée si il n'y a rien

require_once '../modele/pdo.php';

$req = $pdo->prepare('SELECT * FROM utilisateurs WHERE (NomUtilisateur = :nomMembre)');
$req->execute(['nomMembre' => $_POST['userName']]);
<<<<<<< HEAD:controleur/login.php
$user = $req->fetch(); // Récupère l'utilisateur

if($_POST['userPassword'] == $user->MotDePasse) {
    session_start();

    $_SESSION['auth'] = $user;
    $_SESSION['flash']['success'] = 'Vous etes maintenant bien connecté';
    header('Location: account.php');
    exit();

} else {

    $_SESSION['flash']['danger'] = "Heu vous avez fait une erreur d'email ou de mot de passe";
    header('Location: ../index.php');
    exit();

}
}
?>
<div class="container">
    <?php if(isset($_SESSION['flash'])): ?> <!----- Gère les messages d'erreurs ----------->
    <?php foreach($_SESSION['flash'] as $type => $message): ?>

    <div class="alert alert-<?= $type; ?>">
        <?= $message; ?>
    </div>

    <?php endforeach; ?>
    <?php unset($_SESSION['flash']); ?> <!--------- Supprime le message d'erreur ---------------->
    <?php endif; ?>

</div> 
=======
$user = $req->fetch(); 
session_start();

if($_POST['userPassword'] == $user->MotDePasse){

$_SESSION['auth'] = $user;

$statut = $_SESSION['auth']->idRole;
    
$_SESSION['flash']['success'] = 'Vous etes maintenant bien connecté';

if($_SESSION['auth'] && $statut == 1) {
header('Location: ../vue/superAdmin.php');
exit();

} else if ($_SESSION['auth'] && $statut == 2) {
header('Location: ../vue/admin.php');
exit();

} else {

header('Location: ../index.php');
exit();

}
}}
?>
>>>>>>> fcd7af75fb7d5d6208cbe1f938c58a6fa9c66f06:controleur/loginAdmin.php
