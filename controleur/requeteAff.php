<?php
    include '../modele/pdo.php';

    $idForm = $_GET['idFormation']
?>

<div class="row partie">
    <?php 
        $partie = $pdo->query("SELECT * FROM partie NATURAL JOIN question NATURAL JOIN proposition NATURAL JOIN reponse NATURAL JOIN apprenant NATURAL JOIN session NATURAL JOIN formation WHERE idPartie = 1 AND idFormation = ".$idForm." GROUP BY idPartie");
        $partieAff = $partie->fetchAll();
        var_dump($partieAff);
        echo '<span>'.$partieAff->intitulePartie.'</span>';
        echo '<div class="col-sm-6"><strong>'.$partieAff->reponse.'</strong></div>';
    ?>
</div>
<div class="row partie">
    <?php 
        $partie = $pdo->query("SELECT * FROM partie NATURAL JOIN reponse NATURAL JOIN question NATURAL JOIN proposition WHERE idPartie = 2");
        $partieAff = $partie->fetch();
        echo '<span>'.$partieAff->intitulePartie.'</span>';
        echo '<div class="col-sm-6"><strong>'.$partieAff->reponse.'</strong></div>'; 
    ?>
</div>
<div class="row partie">
    <?php 
        $partie = $pdo->query("SELECT * FROM partie NATURAL JOIN reponse NATURAL JOIN question NATURAL JOIN proposition WHERE idPartie = 3");
        $partieAff = $partie->fetch();
        echo '<span>'.$partieAff->intitulePartie.'</span>'; 
        echo '<div class="col-sm-6"><strong>'.$partieAff->reponse.'</strong></div>';
    ?>
</div>
<div class="row partie">
    <?php 
        $partie = $pdo->query("SELECT * FROM partie NATURAL JOIN reponse NATURAL JOIN question NATURAL JOIN proposition WHERE idPartie = 4");
        $partieAff = $partie->fetch();
        echo '<span>'.$partieAff->intitulePartie.'</span>'; 
        echo '<div class="col-sm-6"><strong>'.$partieAff->reponse.'</strong></div>';
    ?>
</div>
<div class="row partie">
    <?php 
        $partie = $pdo->query("SELECT * FROM partie NATURAL JOIN reponse NATURAL JOIN question WHERE idPartie = 5");
        $partieAff = $partie->fetch();
        echo '<span>'.$partieAff->intitulePartie.'</span>'; 
        echo '<div class="col-sm-6"><strong>'.$partieAff->reponse.'</strong></div>';
    ?>
</div>
<div class="row partie">
    <?php 
        $partie = $pdo->query("SELECT * FROM partie NATURAL JOIN reponse NATURAL JOIN question WHERE idPartie = 6");
        $partieAff = $partie->fetch();
        echo '<span>'.$partieAff->intitulePartie.'</span>';
        echo '<div class="col-sm-6"><strong>'.$partieAff->reponse.'</strong></div>';
    ?>
</div>
<div class="row partie">
    <?php 
        $partie = $pdo->query("SELECT * FROM partie NATURAL JOIN reponse NATURAL JOIN question WHERE idPartie = 7");
        $partieAff = $partie->fetch();
        echo '<span>'.$partieAff->intitulePartie.'</span>';
        echo '<div class="col-sm-6"><strong>'.$partieAff->reponse.'</strong></div>';
    ?>
</div>