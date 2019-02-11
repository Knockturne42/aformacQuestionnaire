<?php

include '../modele/pdo.php';
include '../include/fonctions.php';
include '../include/header.php';
include '../controleur/class/input.php';

?>

        <form action="" method="POST">
            <input type="text" id="nomQuestionnaire" name="nomQuestionnaire" placeholder="Nom du Questionnaire">
            <button type="submit">Poster le Questionnaire</button>
            <div class="container" id="ajout">
            
            </div>
        </form>
    </body>
    <script src="../js/script.js"></script>
</html>
