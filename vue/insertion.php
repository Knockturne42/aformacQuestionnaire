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
                    </div>
                    <br>
                    <div class="reponse">
                        <!-- Mettre ici le select + la génération de l'input suivant le type, à la place de celui en place -->
                        <input type="text" placeholder="Réponse">
                    </div>
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
