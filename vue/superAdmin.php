<?php
include '../modele/pdo.php';
include '../include/fonctions.php';

loggedOnly();

// session_start();

$statut = $_SESSION['auth']->idRole;
if($_SESSION['auth'] && $statut == 1) {
echo 'vous etes sur une page superAdmin';

} else {

header('Location : ../index.php');
}

?>
<a href="../controleur/logout.php">Deconnexion</a>
<?php echo $_SESSION['auth']->NomUtilisateur; ?>
