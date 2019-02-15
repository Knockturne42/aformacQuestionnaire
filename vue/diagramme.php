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
    <?php
        $nombreCol = 6;
        $nombreRow = 4;

        for ($i = 1; $i <= $nombreRow; $i++) {
            echo '<div class="row">';
            for ($j = 1; $j<= $nombreCol; $j++) {
                 echo '<div class="col-sm-2">coucou</div>';
                }
            echo '</div>';
        }
    ?>
</div>

<?php
if (isset($_POST['choixTypeFormation'])) {

    $note = $pdo->prepare("SELECT * FROM notes NATURAL JOIN apournote NATURAL JOIN reponses NATURAL JOIN formations NATURAL JOIN suitformation NATURAL JOIN  utilisateurs NATURAL JOIN donnereponse WHERE idFormation = :idFormation");
    $note->bindParam(':idFormation', $_POST['choixTypeFormation']);
    $note->execute();
    
    while ($donneeNote = $note->fetch()) {
        echo '<p> Nom Utilisateur :'.' '.$donneeNote->nomUtilisateur.'<br> Nom de la formation :'.' '.$donneeNote->nomFormation.'<br> Note de la formation :'.' '.$donneeNote->montantNote.'</p>';
    }
}
?>