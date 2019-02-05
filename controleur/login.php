<?php 
if(!empty($_POST) && !empty($_POST['userName']) && !empty($_POST['userPassword'])) { // Verifie si c'est remplis pour ne pas aller chercher dans la base de donnée si il n'y a rien

require_once 'inc/db.php';

$req = $pdo->prepare('SELECT * FROM membre WHERE (nomMembre = :nomMembre OR emailMembre = nomMembre) AND confirmedDateMembre IS NOT NULL');
$req->execute(['nomMembre' => $_POST['userName']]);
$user = $req->fetch(); // Récupère l'utilisateur
session_start();

if(password_verify($_POST['userPassword'], $user->motDePasseMembre)){

$_SESSION['auth'] = $user;
$_SESSION['flash']['success'] = 'Vous etes maintenant bien connecté';
header('Location: account.php');
exit();

} else {

$_SESSION['flash']['danger'] = "Heu vous avez fait une erreur d'email ou de mot de passe";
header('Location: login.php');
exit();

}
}
?>