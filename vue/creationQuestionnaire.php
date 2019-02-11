<?php require_once '../modele/pdo.php';
include '../include/header.php'?>

<h2>Creation de questionnaire</h2>

<form method="POST" action="fonctionsDeCreations.php">

<label>Nom de question</label>
<input placeholder="intitulé"><br>

<select class="choixType" name="choixType">
            <?php 
                $pdo = new PDO('mysql:dbname=aformacQuestionnaire;host=localhost', 'maxAformacQuestionnaire', '14759');
       
                $types = $pdo->prepare("SELECT * FROM types ");
                $types->execute(array());
                $choixTypes = $types->fetchAll();
                foreach($choixTypes as $choixType) {?>
                <option value="<?php echo $choixType['idType'];?>" name="depSel"><?php echo $choixType['nomType'];?></option>
                <?php 
                } 

                ?>
            </select>
<input type="submit">Envoyer
            
</form>
