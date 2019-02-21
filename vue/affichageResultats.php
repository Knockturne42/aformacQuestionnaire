<?php

// include '../include/footer.php';
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

<div class="container affichage">
    <div class="col-sm-4">
        <select class="form-control" name="formationsSelection" id="formationsSelection"><!-- Affiche les formations existantes -->
            <?php
                // Affiche les formation existantes
                $Forms = $pdo->query("SELECT * FROM formation");
                $selectForms = $Forms->fetchAll();
                foreach($selectForms as $selectForm)
                { ?>
                <option value="<?php echo $selectForm->idFormation; ?>"><?php echo $selectForm->nomFormation; ?></option>
            <?php  } ?>
        </select>
        <input type="checkbox">
    </div>
    <div class="col-sm-4">
        <select class="form-control text-center" name="selectLieux" class="selLieu">
            <?php
                $lieux = $pdo->query("SELECT * FROM ville");
                $selectLieux = $lieux->fetchAll();
                foreach($selectLieux as $selectLieu) { ?>
                <option value="<?php echo $selectLieu->idVille; ?>"><?php echo $selectLieu->nomVille; ?></option>
            <?php  } ?>
        </select>
        <input type="checkbox">
    </div>
    <div class="col-sm-4">
        <select class="form-control" name="selectSession" id="selForm">
            <?php
                $Forms = $pdo->query("SELECT * FROM session NATURAL JOIN formation");
                $selectForms = $Forms->fetchAll();
                foreach($selectForms as $selectForm) { ?>
                <option value="<?php echo $selectForm->idSession; ?>"><?php echo $selectForm->SessionRef.' '.'-'.' '. $selectForm->nomFormation; ?></option>
            <?php  } ?>
        </select>
        <input type="checkbox">
    </div>
</div>
<div class="container-fluid affichageResult" id="affichageResult">

</div>

<?php

}	// SINON SI L'ADMIN N'EST PAS CONNECTE
else {
    
    header('Location : ../index.php');
}

?>
<script src="../js/ajaxAffichageResultats.js"></script>