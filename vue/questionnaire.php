

<link rel="stylesheet" href="../css/bootstrap.min.css">



<h2 class="text-center text-uppercase"> Evaluation de fin de formation (longue)</h2>
<h2 class="text-center text-uppercase">D / 4.20 / 04</h2>
<h3 class="text-center text-uppercase">Indice D</h3>


<form method="POST" action="traitementReponses.php" class="was-validated">
    <div class="container">

        <input type="text" name="userPasswordConfirm" class="form-control col-lg-2" placeholder="Nom" required/>

        <input type="text" name="userPasswordConfirm" class="form-control col-lg-2" placeholder="Prénom" required/>
         <input type="text" name="formationLieu" class="form-control col-lg-2" placeholder="Lieu" required/>

        <label for="">Titre de formation</label>
        <input type="text" name="formationNom" class="form-control col-lg-2" required/>

        <label for="">Dates d'entree en formation :</label>
        <input type="date" name="formationDate" class="form-control col-lg-2" required/>
        <label for="">Dates de sortie de formation :</label>
        <input type="date" name="formationDate2" class="form-control col-lg-2" required/>

    </div>

<!--- Indication attentes avant la formation ---->
<div class="container">
    <h5>Aviez-vous des attentes concernant cette formation ?</h5>
<div class="">
    <input type="radio" name="radio-stacked" value="oui" class="" required>
    <label class="" for="radio-stacked">Oui</label>
 </div>
 <div class="">
    <input type="radio" class="" name="radio-stacked" value="non" required>
    <label class="" for="radio-stacked">Non</label>
</div>
    <p>Si oui lesquelles:</p>
    <div class="">
    <input type="checkbox" class="" name="checkConnaissance">
    <label for="checkConnaissance" class="">Elargir vos connaissances</label>
    </div>
    <div class="">
    <input class="" type="checkbox" name="checkNouvelleTechnique">
    <label for="checkNouvelleTechnique" class="">Acquérir de nouvelles techniques</label>
    </div>
    <div class="">
    <input class="" type="checkbox" name="checkPratique">
    <label for="checkPratique" class="">Améliorer vos pratiques</label>
    </div>
    <div class="">
    <input class="" type="checkbox" name="checkAutre">
    <label for="checkAutre" class="">Autre</label>
    </div>
    <textarea class="lg-textarea form-control col-lg-2" rows="3" type="text" name="autreAttentesDebut" placeholder="Si autre, precisez..."></textarea>

</div>

<!--- Indication attentes après la formation ---->
<div class="container">
    <h5>Si oui, cette formation a-t-elle répondu à vous attentes ?</h5>

        <input type="radio" name="checkAttente" value="oui">
        <label for="checkAttente">Oui</label>

        <input class="" type="radio" name="checkAttente" value="non">
        <label for="checkAttente">Non</label>

        <input class="" type="radio" name="checkAttente" value="ep">
        <label for="checkAttente">En partie</label>

        <textarea class="lg-textarea form-control col-lg-2" rows="3" type="text" name="autreAttentesFin" placeholder="Pourquoi ?"></textarea>

</div>

<!--- Indication durée de la formation --









-->
<div class="container">
    <h5 for="">La durée de la formation vous a paru : </h5>
        <label for="">Trop courte</label>
        <input class="" type="range" name="rangeDuree" min="0" max="9" required>
        <label for="">Trop longue</label>
</div>

<!--- Indication sur les contenus de la formation ---->
<div class="container">
    <h5>Les contenus vous ont paru : </h5><br>

        <label>- Professionnellement : </label>
        <label for="">Pas utile</label>
        <input type="range" name="rangeProfess" min="0" max="9" required>
        <label for="">Tres utile</label>
        

        <label>- Personnellement : </label>

        <label for="">Pas interessants</label>
        <input type="range" name="rangeProfess" min="0" max="9" required>
        <label for="">Tres interessants</label>

</div>

<!--- Indication sur les thèmes shouaité ---->
<div class="container">
    <h5>Quels thèmes auriez-vous shouaité : </h5>
        <label>- Aborder le plus longtemps ? : </label>
            <textarea class="lg-textarea form-control col-lg-2" rows="3" type="text" name="themeAborderPlusLongtemps" placeholder="Remplire ici" required></textarea>

            <label>- Ecourter ? : </label>
            <textarea class="lg-textarea form-control col-lg-2" rows="3" type="text" name="themeEcourter" placeholder="Remplire ici" required></textarea>

            <label>- Supprimer ? : </label>
            <textarea class="lg-textarea form-control col-lg-2" rows="3" type="text" name="themeSupprimer" placeholder="Remplire ici" required></textarea>
</div>

<!--- Indication sur l'intervention des animateurs ---->
<div class="container">
    <h5>Selon vous, l'intervention des animateurs était : </h5>
        <label for="">mediocre</label>
        <input type="range" name="interventionQualite" min="0" max="9" required>
        <label for="">Tres bonne</label>
</div>

<!--- Indication sur les remarques ---->
<div class="container">
    <h5>A-t-on pris en compte vos remarques à mi-parcours : </h5>
        <textarea class="md-textarea form-control col-lg-2" rows="3" type="text" name="remarque" placeholder="Remplire ici" required></textarea>

</div>

<!--- Indication sur l'utilité des choses apprises en formation ---->
<div class="container">
    <h5>Vous pensez pouvoir réutiliser : </h5>
<div class="">
        <input class="" type="radio" name="checkReutiliser" value="3" required>
        <label class="" for="">Tout ce que vous avez appris durant la formation</label>
</div>
<div class="">
        <input class="" type="radio" name="checkReutiliser" value="2" required>
        <label class="" for="">Une bonne partie de ce que vous avez appris</label>
        <textarea class="" rows="3" type="text" name="reutilisation2" placeholder="precisez laquelle :"></textarea>
</div>
<div class="">
        <input class="" type="radio" name="checkReutiliser" value="1" required>
        <label class="" for="">Une faible partie de ce que vous avez appris</label>
        <textarea class="" rows="3" type="text" name="reutilisation1" placeholder="precisez laquelle :"></textarea>
</div>
<div class="">
        <input class="" type="radio" name="checkReutiliser" value="0" required>
        <label class="" for="">Rien de ce que vous avez appris</label>
        <textarea class="" rows="3" type="text" name="reutilisation0" placeholder="precisez pourquoi :"></textarea>
</div>
</div>

<!--- Indication sur la satisfaction de la formation ---->
<div class="container">
    <h5>Globalement par rapport à cette formation, vous diriez que vous êtes : </h5>

        <label for="">Pas satisfait</label>
        <input type="range" name="rangeSatisfaction" min="0" max="9" required>
        <label for="">Tres satisfait</label>

        <label>Pourquoi ?</label>
        <textarea class="lg-textarea form-control col-lg-2" rows="3" type="text" name="pourquoiGlobale" placeholder="Remplire ici" required></textarea>

</div>

<!--- Indication sur les observations ---->
<div class="container">
    <h5>Observation, réflexions et commentaires personnels :</h5>
        <textarea class="lg-textarea form-control col-lg-2" rows="3" type="text" name="observationPersonnel" placeholder="Remplire ici" required></textarea>

</div>

<button type="submit" class="btn btn-primary">Valider</button>

</form>

<script type="text/javascript" src="../js/ajax.js"></script>
<?php include '../include/footer.php' ?>