<?php include '../modele/pdo.php';
include '../include/fonctions.php'; ?>

<div class='container' style="margin-bottom: 5%;">

                <select id="select" class="form-control" name="afficheResultatLieux" class="selLieu">
                    <?php
                    $selection = $_GET['idVille'];

                        $lieux = $pdo->query("SELECT * FROM formation WHERE idFormation = '$selection'");
                        $selectFormations = $lieux->fetchAll();
                        ?><option value="">Choisir la formation</option> <?php
                        foreach($selectFormations as $selectFormation) { ?>
                        <option value="<?php echo $selectFormation->idFormation; ?>"><?php echo $selectFormation->nomFormation; ?></option>
                        <?php  } ?>
                        
                        
                </select>

</div>
<script src="../js/ajax.js"></script>
