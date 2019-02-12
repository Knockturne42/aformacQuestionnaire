<?php
include '../controleur/input.php';
$i = 0;

if (isset($_GET['askDiv']) && $_GET['askDiv'] == 'question') {
	echo "<div>";
	$inputQuestion = new input('question'.$i, 'text', 'Question', 'question', '', '');
	echo $inputQuestion->assembleInput();
	echo "<select>";
	echo '<option value="toto">toto</option>';
	echo '<option value="toto1">toto1</option>';
	echo '<option value="toto2">toto2</option>';
	echo '<option value="toto3">toto3</option>';
	echo "</select>";
	echo '<div class=""></div>';
	echo "</div>";
}

if (isset($_GET['askDiv']) && $_GET['askDiv'] == 'reponses')
{
	$inputReponse = new input('reponse'.$i, $_GET['typeInp'], '', 'question', $_GET['min'], $_GET['max']);
	echo $inputReponse;
}

?>