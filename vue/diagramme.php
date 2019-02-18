<?php

require_once ('../modele/pdo.php');
include ('jpgraph/src/jpgraph.php');
include ('jpgraph/src/jpgraph_radar.php');
include ('jpgraph/src/jpgraph_log.php');
include ('../include/header.php');
// include ('../include/footer.php');

?>

<h1>Résultats de l'enquête</h1>

<form action="" method="POST" name="formQualite">
    <label for="">Par formations:</label>
    <select class="choixTypeFormation" name="choixTypeFormation">
        <?php 
            $types = $pdo->query("SELECT * FROM formations ");
            $choixTypesFormations = $types->fetchAll(); ?>
            <option value="">Selection de formation</option>
            <?php
            foreach($choixTypesFormations as $choixTypeFormation) { ?>
            <option value="<?php echo $choixTypeFormation->idFormation;?>" name="depSel"><?php echo $choixTypeFormation->nomFormation;?></option>
            <?php 
            }   
        ?>
    </select>
    <button type="submit" name="typeForm">Afficher</button>
</form>
<form action="">
    <label for="qualiGen">Qualité générale de toute les formations:</label>
    <button type="submit" name="qualiGen">Générale</button>
</form>

<div class="container">
    <div class="row">
        <div class="col-sm-2 titreTable">Nom de la formation</div>
        <div class="col-sm-2 titreTable">Montant de qualité</div>
    </div>
    <?php
        
        if (isset($_POST['choixTypeFormation'])) {

            $moyenne = $pdo->prepare("SELECT *, ROUND(AVG(montantNote), 2) as moyenne FROM notes NATURAL JOIN apournote NATURAL JOIN reponses NATURAL JOIN donnereponse NATURAL JOIN  utilisateurs NATURAL JOIN formations NATURAL JOIN suitformation WHERE idFormation = :idFormation GROUP BY nomFormation");
            $moyenne->bindParam(':idFormation', $_POST['choixTypeFormation']);
            $moyenne->execute();
            var_dump($_POST['choixTypeFormation']);

            while ($moyenneQual = $moyenne->fetch()) {
                // var_dump($moyenneQual);
                $nombreCol = 1;
                $nombreRow = 1;
                    
                for ($i = 1; $i <= $nombreRow; $i++) {
                    echo '<div class="row">';
                        for ($j = 1; $j<= $nombreCol; $j++) { ?>
                            <div class="col-sm-2"><?php echo $moyenneQual->nomFormation ?></div>
                            <div class="col-sm-2"><?php echo $moyenneQual->moyenne ?></div>
                        <?php    }
                    echo '</div>';
                }
            }
        }
    ?>
</div>