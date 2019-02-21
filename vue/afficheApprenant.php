<?php include '../modele/pdo.php';
include '../include/fonctions.php'; ?>

<div class='container' style="margin-bottom: 5%;">

                
                    <?php
                        $selection = $_GET['idSelectFormation'];
                        $lieux = $pdo->query("SELECT * FROM apprenant NATURAL JOIN session NATURAL JOIN formation NATURAL JOIN ville  WHERE idFormation = '$selection'");
                        $selectFormations = $lieux->fetchAll();?>
                        <div class="container">
                                    <div class="row">
                        
                                        <div class="col-2 titreTableau">NOM</div>
                                        <div class="col-2 titreTableau">PRENOM</div>
                                        <div class="col-2 titreTableau">PSEUDO</div>
                                        <div class="col-2 titreTableau">REF SESSION</div>
                                        <div class="col-2 titreTableau">NOM DE LA FORMATION</div>
                                        <div class="col-2 titreTableau">LIEN QUESTIONNAIRE IMPRESSION</div>
                                 
                                    </div>
                        </div>
                        <?php
                        foreach($selectFormations as $selectFormation) { 
                         ?>
                        <div class="row">
                                
                                <div class="col-2 donneesTableauApprenant"><?php echo $selectFormation->nomApprenant ?></div>
                                <div class="col-2 donneesTableauApprenant"><?php echo $selectFormation->prenomApprenant ?></div>
                                <div class="col-2 donneesTableauApprenant"><?php echo $selectFormation->pseudo ?></div>
                                <div class="col-2 donneesTableauApprenant"><?php echo $selectFormation->SessionRef ?></div>
                                <div class="col-2 donneesTableauApprenant"><?php echo $selectFormation->nomFormation ?></div>
                                <div class="col-2 donneesTableauApprenant"><a href="afficheQuestionnaireRemplis.php?idApprenant=<?php echo $selectFormation->idApprenant ?>">Voir questionnaire</a></div>
                            
                            </div>
<?php
}
?>

<script src="../js/ajax.js"></script>