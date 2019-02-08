<?php // Génération des types 

$pdo = new PDO('mysql:dbname=aformacQuestionnaire;host=localhost', 'maxAformacQuestionnaire', '14759');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

$choixDuType = $pdo->prepare("SELECT * FROM types WHERE idType = ?");
$choixDuType->execute([$_POST['choixType']]);

$choixType = $choixDuType->fetch();

if($choixType->idType == 1) {
    echo "<textarea type='text' name='reponseText' placeholder='votre response'></textarea>";
} if($choixType->idType == 2) {
    echo "<label>Note entre 1 et 10</label><br><input type='range' name='reponseRange' min='1' max='10'>";
} if($choixType->idType == 3) {
    echo "<input type='text'>Nom du choix<br><input type='radio'>";
} if ($choixType->idType == 4) {
    echo "<input type='text'>Nom du choix<input type='checkbox'>";
}