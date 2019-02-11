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
?>

<form method='GET' action=''>
<input type='text' name='nombreDeRadio'>Nombre de bouton radio
<input type='submit'>Valider</form>

<?php
} if(isset($_GET['nombreDeRadio'])) {

$nombreDeRadio = $_GET['nombreDeRadio'];

$i=1;
$idBoutonRadio == 1;

while($i <= $nombreDeRadio) {
?>
<label>Nom de la réponse</label><input type='text'><input type='radio' name='reponseRadio<?php echo $idBoutonRadio; ?>'>
<?php
$i++;
$idDeRadio++;
}

} if ($choixType->idType == 4) {
?>

<form method='GET' action=''>
<input type='text' name='nombreDeCheckbox'>Nombre de bouton checkbox
<input type='submit'>Valider</form>

<?php

} if(isset($_GET['nombreDeCheckbox'])) {

$nombreDeCheckbox = $_GET['nombreDeCheckbox'];

$i=1;

while($i <= $nombreDeCheckbox) {
$idCheckBox == 1;
?>
<label>Nom de la réponse</label><input type="text"><input type="checkbox" name="reponseCheckbox<?php echo $idCheckBox; ?>">
<?php
$i++;
$idCheckBox++;
}}