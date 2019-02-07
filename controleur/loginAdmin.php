<?php 
if(!empty($_POST) && !empty($_POST['userName']) && !empty($_POST['userPassword'])) { // Verifie si c'est remplis pour ne pas aller chercher dans la base de donnée si il n'y a rien

require_once '../modele/pdo.php';

$req = $pdo->prepare('SELECT * FROM utilisateurs WHERE (NomUtilisateur = :nomMembre)');
$req->execute(['nomMembre' => $_POST['userName']]);
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