<?php include '../include/header.php'; ?>

<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/style.css">


<div class="container">

<div class="card">

<div class="row">

    <img src="../img/logoAformac.jpg" class="img-responsive col-2" alt="Responsive image">
    <img src="../img/datadock.jpg" class="img-responsive col-2" alt="Responsive image">
    <img src="../img/logo_opqf.jpg" class="img-responsive col-2" alt="Responsive image">
    <img src="../img/FFP.png" class="img-responsive col-2" alt="Responsive image">

</div>

    <h2 class="text-center text-uppercase titreVert"><strong>Evaluation de fin de formation (longue)</strong></h2>
    <h2 class="text-center text-uppercase titreOrange"><strong>D / 4.20 / 04</strong></h2>
    <h3 class="text-center text-uppercase titreBleu"><strong>Indice D</strong></h3>

</div>

</div>


<div class="container">
<form method="POST" action="traitementReponses.php" class="was-validated">
    <div class="container">
       <div class="card">
           <div class="card-body">
                        
        <label class="form-control text-center titreVert" for=""><strong>Titre de formation :</strong></label>
        <input class="form-control" type="text" name="formationNom" class="form-control col-lg-2" placeholder="Titre de la formation" required/>
               
        <label class="form-control text-center titreVert" for=""><strong>Nom de l'apprenant :</strong></label>
        <input class="form-control" type="text" name="userPasswordConfirm" class="form-control col-lg-2" placeholder="Nom" required/>
        
        <label class="form-control text-center titreOrange" for=""><strong>Prénom de l'apprenant :</strong></label>
        <input class="form-control" type="text" name="userPasswordConfirm" class="form-control col-lg-2" placeholder="Prénom" required/>

        <label class="form-control text-center titreOrange" for=""><strong>Lieu de formation :</strong></label>
        <input class="form-control" type="text" name="formationLieu" class="form-control col-lg-2" placeholder="Lieu" required/>
        
        <label class="form-control text-center titreBleu" for=""><strong>Date d'entrée en formation :</strong></label>
        <input class="form-control" type="date" name="formationDate" class="form-control col-lg-2" required/>
        
        <label class="form-control text-center titreBleu" for=""><strong>Date de sortie de formation :</strong></label>
        <input class="form-control" type="date" name="formationDate2" class="form-control col-lg-2" required/>
        
        </div>
            </div>
    </div>

<!--- Indication attentes avant la formation ---->
<div class="container">

    <div class="card">
   
    <h5 class="card-title text-center titreVert"><strong><span class="titreVert">Aviez-vous des </span><span class="titreOrange">attentes concernant</span><span class="titreBleu"> cette formation ?</span></strong></h5>

    <div class="card-body text-center">
    
    <div class="custom-control custom-radio">
    <input id="test" type="radio" name="radio-stacked" value="oui" class="custom-control-input" required>
    <label for="test" class="custom-control-label" for="radio-stacked">Oui</label>
    </div>
    
    <div class="custom-control custom-radio">
    <input id="test2" type="radio" class="custom-control-input" name="radio-stacked" value="non" required>
    <label for="test2" class="custom-control-label" for="radio-stacked">Non</label>
    </div>
<!-------------------          --------------------------------------------------------------------------->
    <p class="card-title text-center"><strong>Si oui lesquelles :</strong></p>

    <div class="">

    <input   id="checkConnaissance"  type="checkbox" class="" name="checkConnaissance">
    <label  for="checkConnaissance" class="">Elargir vos connaissances</label>

    </div>

    <div class="">

    <input  id="checkNouvelleTechnique" class="" type="checkbox" name="checkNouvelleTechnique">
    <label  for="checkNouvelleTechnique" class="">Acquérir de nouvelles techniques</label>

    </div>

    <div class="">

    <input  id="checkPratique" class="" type="checkbox" name="checkPratique">
    <label  for="checkPratique" class="">Améliorer vos pratiques</label>

    </div>

    <div class="">
        
    <input   id="checkAutre" class="" type="checkbox" name="checkAutre">
    <label  for="checkAutre" class="">Autre</label>

    </div>

    <div class='container'>

    <textarea class="lg-textarea form-control col-lg-12" rows="3" type="text" name="autreAttentesDebut" placeholder="Si autre, precisez..."></textarea>

    </div>

    </div>

</div>  

</div>






<!--- Indication attentes après la formation ---->
<div class="container">

    <div class="card">

        <h5 class="card-title text-center"><span class="titreVert">Si oui, cette formation</span><span class="titreOrange"> a-t-elle répondu à</span> <span class="titreBleu">vous attentes ?</span></h5>

            <div class="card-body text-center">

        <div class="custom-control custom-radio">
        <input id="input3" class="custom-control-input" type="radio" name="checkAttente" value="oui" required>
        <label  for="input3" class="custom-control-label" for="checkAttente">Oui</label>
        </div>

        <div class="custom-control custom-radio">
        <input id="input4" class="custom-control-input" type="radio" name="checkAttente" value="non" required>
        <label  for="input4" class="custom-control-label" for="checkAttente">Non</label>
        </div>

        <div class="custom-control custom-radio">
        <input id="input5" class="custom-control-input" type="radio" name="checkAttente" value="ep" required>
        <label  for="input5" class="custom-control-label" for="checkAttente">En partie</label>
        </div>

        <div class='container'>

        <textarea class="lg-textarea form-control col-lg-12 text-center" rows="3" type="text" name="autreAttentesFin" placeholder="Pourquoi ?"></textarea>
           
        </div>

        </div>

    </div>
    
</div>


<!--- Indication durée de la formation --









-->
<div class="container">

    <div class='card'>

    <h5 class="card-title text-center" for=""><strong><span class="titreVert">La durée</span><span class="titreOrange"> de la formation </span><span class="titreBleu">vous a paru : </span></strong></h5>

    <div class='card-body'>

    <div class="container">

        <div class="row">

            <div class="col-10">

                <label for="">Trop courte</label>
            </div>

        <div class="col-2">

            <label for="">Trop longue</label>

        </div>

        </div>

    </div>

        <input class="form-control rangeStyle" type="range" name="rangeDuree" min="0" max="9" required>

    </div>

    </div>

</div>





<!--- Indication sur les contenus de la formation ---->
<div class="container">

    <div class="card">

        <h5 class="card-title text-center"><strong><span class="titreVert">Les contenus</span><span class="titreOrange"> vous ont</span><span class="titreBleu"> paru : </span></strong></h5><br>

        <div class="card-body">

            
            <label><strong>- Professionnellement : </strong></label>

            <div class="row">

            <label class="col-10" for="">Pas utile</label>
            <label class="col-2" for="">Tres utile</label>
            <input class="form-control rangeStyle" type="range" name="rangeProfess" min="0" max="9" required>
            
            </div>
            
            <label><strong>- Personnellement : </strong></label>    

            <div class="row">

            <label class="col-10" for="">Pas interessants</label>
            <label class="col-2" for="">Tres interessants</label>
            <input class="form-control rangeStyle" type="range" name="rangePerso" min="0" max="9" required>

            </div>

        </div>

    </div>

</div>





<!--- Indication sur les thèmes shouaité ---->
<div class="container">

    <div class="card">

    <h5 class="card-title text-center"><strong><span class="titreVert">Quels thèmes</span><span class="titreOrange"> auriez-vous </span><span class="titreBleu">shouaité : </span></strong></h5>
    
    <div class="card-body">
        
        <div class="container">

            <label class="text-center">- Aborder le plus longtemps ? : </label>
            <textarea class="lg-textarea form-control col-lg-12" rows="3" type="text" name="themeAborderPlusLongtemps" placeholder="Remplire ici" required></textarea>
        </div>
        
        <div class="container">

            <label class="text-center">- Ecourter ? : </label>
            <textarea class="lg-textarea form-control col-lg-12" rows="3" type="text" name="themeEcourter" placeholder="Remplire ici" required></textarea>
        </div>
        
        <div class="container">

            <label class="text-center">- Supprimer ? : </label>
            <textarea class="lg-textarea form-control col-lg-12" rows="3" type="text" name="themeSupprimer" placeholder="Remplire ici" required></textarea>
        
        </div>
    
    </div>

    </div>

</div>






<!--- Indication sur l'intervention des animateurs ---->
<div class="container">

    <div class="card">

    <h5 class="card-title text-center"><strong><span class="titreVert">Selon vous, </span><span class="titreOrange">l'intervention des </span><span class="titreBleu">animateurs était : </span></strong></h5>

    <div class="card-body">

        <div class="row">

        <label class="col-10" for="">mediocre</label>
        <label class="col-2" for="">Tres bonne</label>
        <input class="form-control" type="range" name="interventionQualite" min="0" max="9" required>

        </div>

        <div class='container'>

        <textarea class="lg-textarea form-control col-lg-12 text-center" rows="3" type="text" name="pourquoiInterv" placeholder="Pourquoi ?"></textarea>
   
        </div>

    </div>

    </div>

</div>





<!--- Indication sur les remarques ---->
<div class="container">

    <div class='card'>

    <h5 class="card-title text-center"><strong><span class="titreVert">A-t-on pris en compte</span><span class="titreOrange"> vos remarques à </span><span class="titreBleu">mi-parcours : </span></strong></h5>

    <div class='card-body'>
</strong>
        <div class="container">

        <textarea class="md-textarea form-control col-lg-12" rows="3" type="text" name="remarque" placeholder="Remplire ici" required></textarea>
    
        </div>
    
    </div>

    </div>

</div>





<!--- Indication sur l'utilité des choses apprises en formation ---->
<div class="container">

    <div class="card">

    <h5 class="card-title text-center"><strong><span class="titreVert">Vous pensez</span><span class="titreOrange"> pouvoir </span><span class="titreBleu">réutiliser : </span></strong></h5>

    <div class='card-body text-center'>

    <div class="container">
        <input class="" type="radio" name="checkReutiliser" value="3" required>
        <label class="" for="">Tout ce que vous avez appris durant la formation</label>
    </div>

        <input class="" type="radio" name="checkReutiliser" value="2" required>
        <label class="" for="">Une bonne partie de ce que vous avez appris</label>

        <div class="container">

        <textarea class="md-textarea form-control col-lg-12" rows="3" type="text" name="reutilisation2" placeholder="precisez laquelle :"></textarea>
        
        </div>

        <input class="" type="radio" name="checkReutiliser" value="1" required>
        <label class="" for="">Une faible partie de ce que vous avez appris</label>

        <div class='container'>

        <textarea class="md-textarea form-control col-lg-12" rows="3" type="text" name="reutilisation1" placeholder="precisez laquelle :"></textarea>
        
        </div>  

        <input class="" type="radio" name="checkReutiliser" value="0" required>
        <label class="" for="">Rien de ce que vous avez appris</label>

        <div class="container">

        <textarea class="md-textarea form-control col-lg-12" rows="3" type="text" name="reutilisation0" placeholder="precisez pourquoi :"></textarea>

        </div>

    </div>

    </div>

</div>





<!--- Indication sur la satisfaction de la formation ---->
<div class="container">

    <div class="card">

    <h5 class="card-title text-center"><strong><span class="titreVert">Globalement par rapport à </span><span class="titreOrange">cette formation, vous diriez</span><span class="titreBleu"> que vous êtes : </span></strong></h5>

    <div class="card-body">

        <div class="row">

        <label class="col-10"for="">Pas satisfait</label>
        <label class="col-2"for="">Tres satisfait</label>
        
        </div>  

        <input class="form-control rangeStyle" type="range" name="rangeSatisfaction" min="0" max="9" required>

        <label >Pourquoi ?</label>
        <textarea class="lg-textarea form-control col-lg-12 text-center" rows="3" type="text" name="pourquoiGlobale" placeholder="Remplire ici" required></textarea>

    </div>

    </div>

</div>





<!--- Indication sur les observations ---->
<div class="container">

    <div class="card">

        <h5 class="card-title text-center"><strong><span class="titreVert">Observation, réflexions</span><span class="titreOrange"> et commentaires </span><span class="titreBleu">personnels :</span></strong></h5>

    <div class="card-body">

    <div class="container">

        <textarea class="lg-textarea form-control col-lg-12" rows="3" type="text" name="observationPersonnel" placeholder="Remplire ici" required></textarea>
   
    </div>

    </div>

    </div>

</div>

<div class="container">

<button type="submit" class="btn btn-primary col-12">Valider</button>

</div>

</form>
</div>

<script type="text/javascript" src="../js/ajax.js"></script>
<?php include '../include/footer.php' ?>