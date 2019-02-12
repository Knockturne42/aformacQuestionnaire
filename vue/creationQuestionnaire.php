<?php 
include '../modele/pdo.php';
include '../include/header.php'; ?>

<h2>Creation de questionnaire</h2>

<form method="POST" action="fonctionsDeCreations.php">

<label>Nom de question</label>
<input placeholder="intitulé"><br>

<select class="choixType" name="choixType">
            <?php 
                $types = $pdo->query("SELECT * FROM types ");
                $choixTypes = $types->fetchAll();
                var_dump($choixTypes);
                foreach($choixTypes as $choixType) {?>
                <option value="<?php echo $choixType->idType;?>" name="depSel"><?php echo $choixType->nomType;?></option>
                <?php 
                } 

                ?>
            </select>
<input type="submit">Envoyer
            
</form>
