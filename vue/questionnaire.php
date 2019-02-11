<?php if(session_status() == PHP_SESSION_NONE) {
    session_start();
}; 

include '../modele/pdo.php';
?>
<link rel="stylesheet" href="../css/bootstrap.min.css">


<?php
if($_SESSION['auth']->nomUtilisateur == NULL) {
    header('Location: ../index.php');
    exit();
} else {
echo $_SESSION['auth']->nomUtilisateur;

}
?>
<h2 class="text-center text-uppercase"> Evaluation de fin de formation </h2>



<div id="questions" class="container"> <!-- Emplacement des questions posée à l'utilisateur -->
    
</div>

<!--- Indication Formation ---->
<form method="POST" action="traitementReponses.php">
    <div class="container">

        <label for="">Titre de formation</label>
        <input type="text" name="formationNom" class="form-control col-lg-2"/>

        <label for="">Dates</label>
        <input type="date" name="formationDate" class="form-control col-lg-2"/>

        <label for="">Lieu</label>
        <input type="text" name="formationLieu" class="form-control col-lg-2"/><br>

</div>

<!--- Indication utilisateur ---->
<div class="container">

    <label for="">Nom</label>
    <input type="text" name="userPasswordConfirm" class="form-control col-lg-2"/>

    <label for="">Prénom</label>
    <input type="text" name="userPasswordConfirm" class="form-control col-lg-2"/><br><br>

</div>

<!--- Indication attentes avant la formation ---->
<div class="container">
    <h5>Aviez-vous des attentes concernant cette formation ?</h5><br>

    <input type="checkbox" name="checkOui">
    <label for="">Oui</label><br>

    <input class="" type="checkbox" name="checkNon">
    <label for="">Non</label>

    <input class="" type="checkbox" name="checkConnaissance">
    <label for="">Elargir vos connaissances</label>

    <input class="" type="checkbox" name="checkNouvelleTechnique">
    <label for="">Acquérir de nouvelles techniques</label>

    <input class="" type="checkbox" name="checkPratique">
    <label for="">Améliorer vos pratiques</label>

    <input class="" type="checkbox" name="checkAutre">
    <label for="">Autre</label>

    <textarea class="lg-textarea form-control col-lg-2" rows="3" type="text" name="autreAttentesDebut" placeholder="Remplire ici"></textarea><br>

</div>

<!--- Indication attentes après la formation ---->
<div class="container">
    <h5>Si oui, cette formation a-t-elle répondu à vous attentes ?</h5><br>

        <input type="checkbox" name="checkOuiAttente">
        <label for="">Oui</label><br>

        <input class="" type="checkbox" name="checkNonAttenteOui">
        <label for="">Non</label>

        <input class="" type="checkbox" name="checkAutreAttenteNon">
        <label for="">Autre</label>

        <textarea class="lg-textarea form-control col-lg-2" rows="3" type="text" name="autreAttentesFin" placeholder="Remplire ici"></textarea><br>

</div>

<!--- Indication durée de la formation ---->
<div class="container">
    <h5 for="">La durée de la formation vous a paru : </h5><br>

        <input class="" type="checkbox" name="checkDureeLong">
        <label for="">Trop longue</label>

        <input class="" type="checkbox" name="checkDureeSuffisante">
        <label for="">Suffisante</label>

        <input class="" type="checkbox" name="checkDureeCourte">
        <label for="">Trop courte</label><br>

        <label for="">Pourquoi ?</label>
        <textarea class="lg-textarea form-control col-lg-2" rows="3" type="text" name="pourquoiDuree" placeholder="Remplire ici"></textarea><br>

</div>

<!--- Indication sur les contenus de la formation ---->
<div class="container">
    <h5>Les contenus vous ont paru : </h5><br>

        <label>Professionnellement : </label><br>

        <input class="" type="checkbox" name="checkProContenuTresUtiles">
        <label for="">Très utiles</label>

        <input class="" type="checkbox" name="checkProContenuUtiles">
        <label for="">Utiles</label>

        <input class="" type="checkbox" name="checkProContenuPeuUtiles">
        <label for="">Peu utiles</label>

        <input class="" type="checkbox" name="checkProContenuPasUtiles">
        <label for="">Pas utiles</label><br>

        <label>Personnellement : </label><br>

        <input class="" type="checkbox" name="checkPersoContenuTresInteressants">
        <label for="">Très intéressants</label>

        <input class="" type="checkbox" name="checkPersoContenuInteressants">
        <label for="">Intéressants</label>

        <input class="" type="checkbox" name="checkPersoContenuPeuInteressants">
        <label for="">Peu intéressants</label>

        <input class="" type="checkbox" name="checkPersoContenuPasInteressants">
        <label for="">Pas intéressants</label><br>

</div>

<!--- Indication sur les thèmes shouaité ---->
<div class="container">
    <h5>Quels thèmes auriez-vous shouaité : </h5>
        <ul>

            <li>Aborder le plus longtemps</li>
            <textarea class="lg-textarea form-control col-lg-2" rows="3" type="text" name="themeAborderPlusLongtemps" placeholder="Remplire ici"></textarea><br>

            <li>Ecourter</li>
            <textarea class="lg-textarea form-control col-lg-2" rows="3" type="text" name="themeEcourter" placeholder="Remplire ici"></textarea><br>

            <li>Supprimer</li>
            <textarea class="lg-textarea form-control col-lg-2" rows="3" type="text" name="themeSupprimer" placeholder="Remplire ici"></textarea><br>

        </ul>

</div>

<!--- Indication sur l'intervention des animateurs ---->
<div class="container">
    <h5>Selon vous, l'intervention des animateurs était : </h5><br>

        <input class="" type="checkbox" name="checkInterventionTresBonne">
        <label for="">Très bonne</label>

        <input class="" type="checkbox" name="checkInterventionBonne">
        <label for="">Bonne</label>

        <input class="" type="checkbox" name="checkInterventionMoyenne">
        <label for="">Moyenne</label>

        <input class="" type="checkbox" name="checkInterventionMediocre">
        <label for="">Médiocre</label><br>

</div>

<!--- Indication sur les remarques ---->
<div class="container">
    <h5>A-t-on pri en compte vos remarques à mi-parcours : </h5><br>
        <textarea class="md-textarea form-control col-lg-2" rows="3" type="text" name="remarque" placeholder="Remplire ici"></textarea><br>

</div>

<!--- Indication sur l'utilité des choses apprises en formation ---->
<div class="container">
    <h5>Vous pensez pouvoir réutiliser : </h5><br>

        <input class="" type="checkbox" name="checkReutiliserTout">
        <label for="">Tout ce que vous avez appris durant la formation</label><br>

        <input class="" type="checkbox" name="checkReutiliserBonne">
        <label for="">Une bonne partie de ce que vous avez appris</label><br>

        <input class="" type="checkbox" name="checkReutiliserFaible">
        <label for="">Une faible partie de ce que vous avez appris</label><br>

        <input class="" type="checkbox" name="checkReutiliserRien">
        <label for="">Rien de ce que vous avez appris</label><br><br>

</div>

<!--- Indication sur la satisfaction de la formation ---->
<div class="container">
    <h5>Globalement par rapport à cette formation, vous diriez que vous êtes : </h5><br>

        <input class="" type="checkbox" name="checkGlobalementTresSatisfait">
        <label for="">Très satisfait</label><br>

        <input class="" type="checkbox" name="checkGlobalementSatisfait">
        <label for="">Satisfait </label><br>

        <input class="" type="checkbox" name="checkGlobalementPeuSatisfait">
        <label for="">Peu satisfait</label><br>

        <input class="" type="checkbox" name="checkGlobalementPasSatisfait">
        <label for="">Pas satisfait</label><br>   

        <label>Pourquoi ?</label><br>
        <textarea class="lg-textarea form-control col-lg-2" rows="3" type="text" name="pourquoiGlobale" placeholder="Remplire ici"></textarea><br>

</div>

<!--- Indication sur les observations ---->
<div class="container">
    <h5>Observation, réflexions et commentaires personnels :</h5><br>
        <textarea class="lg-textarea form-control col-lg-2" rows="3" type="text" name="observationPersonnel" placeholder="Remplire ici"></textarea><br>

</div>

<button type="submit" class="btn btn-primary">Valider</button>

</form>

<script type="text/javascript" src="../js/ajax.js"></script>
<?php include '../include/footer.php' ?>