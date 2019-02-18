<?php
include '../controleur/class/input.php';
include '../modele/pdo.php';
$i = 0;

if (isset($_GET['askDiv']) && $_GET['askDiv'] == 'question') {
	echo "<div>";
	$inputQuestion = new input('question'.$i, 'text', 'Question', 'question', '', '');
	echo $inputQuestion->assembleInput();?>
	<select class="choixType" name="choixType">
            <?php 
                
                $types = $pdo->prepare("SELECT * FROM types ");
                $types->execute(array());
                while($choixType = $types->fetch())
               	{
               		$choixType = json_decode(json_encode($choixType), true);
                	echo '<option value="'.$choixType['idType'].'" name="depSel">'.$choixType['nomType'].'</option>';
                } 

                ?>
            </select><?php
	echo '<div class=""></div>';
	echo "</div>";
}

if (isset($_GET['askDiv']) && $_GET['askDiv'] == 'reponses')
{
	$inputReponse = new input('reponse'.$i, $_GET['typeInp'], '', 'question', '1', '10');
	echo $inputReponse;
}

?>