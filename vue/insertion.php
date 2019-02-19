<?php

include '../modele/pdo.php';
include '../include/fonctions.php';
include '../include/header.php';
include '../controleur/class/input.php';

?>

    <div class="container" id="ajout">
        <form action="" method="POST">
            <div>
                <input type="text" id="nomQuestionnaire" name="nomQuestionnaire" placeholder="Nom du Questionnaire">
            </div>
            <br>
            <div id="zoneQuestRep">
                <div id="toto">
                    <div class="question">
                        <input type="text" placeholder="Question">
                        <select class="choixType" name="choixType">
            <?php 
                
                $types = $pdo->prepare("SELECT * FROM types ");
                $types->execute(array());
                while($choixType = $types->fetch())
                {
                    $choixType = json_decode(json_encode($choixType), true);
                    echo '<option value="'.$choixType['idType'].'" name="depSel">'.$choixType['nomType'].'</option>';
                } 

                ?>
            </select>
                    </div>
                    <br>
                    <div class="repPlus">+</div>
                </div>
            </div>
            <div class="zoneQuestPlus">+</div>
            <br>
            <button type="submit">Poster le Questionnaire</button>
        </form>
    </div>
    </body>
    <script src="../js/script.js"></script>
</html>
