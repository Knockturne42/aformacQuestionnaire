<?php

include '../modele/pdo.php';
include '../controleur/class/input.php';

if (isset($_GET['idQuestionnaire'])) {
	?>
	<form action="" method="post">
	<div id="question"><?php 
		$question = $pdo->query('SELECT * FROM questions NATURAL JOIN questionnaires NATURAL JOIN reponses NATURAL JOIN appartientquestion WHERE idQuestion = 4');
		$question = $question->fetch();
		echo $question->intituleQuestion;
	 ?></div>
	<div class="reponse"><?php
		$reponses = $pdo->query('SELECT * FROM reponses NATURAL JOIN questionnaires NATURAL JOIN questions NATURAL JOIN appartientquestion NATURAL JOIN types WHERE idQuestion = 4');
		$reponses = $reponses->fetchAll();
		$idRep = 0;
		while ($idRep < count($reponses)) {
			echo $reponses[$idRep]->intituleReponse;
			$idNom = $idRep;
			if ($reponses[$idRep]->nomType == 'radio')
				$idNom = 0;
			$inputRep = new input('reponse'.$idNom, $reponses[$idRep]->nomType, $reponses[$idRep]->intituleReponse, 'reponse', '0', '9');
			echo $inputRep->assembleInput();
			$idRep++;
		}
	?><div id="next"></div></div></form>
	<?php
}


?>