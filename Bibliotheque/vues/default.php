<?php
        require_once('./modele/configs/Constant.php');
        require_once('./modele/classes/LivreDAO.class.php');
        if(!isset($_SESSION)) session_start();
?>



<?php
    $dao = new LivreDAO();
    $livres = $dao->findAll();
    $livre = new Livre();
    foreach($livres as $livre) {
?>

<main>
<div class="card">
    <div class="card-header">
        <strong><a href='?action=detaillivre&isbn=<?=$livre->getIsbn()?>' target='_blank'><?=$livre->getTitre()?></a></strong><br>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-2 img-fluid ml-3">
                <figure>
                <img src="<?=Constant::IMAGEPATH.$livre->getCouverture()?>"  class="img-thumbnail" alt="Image d\'un livre" width="100" height="150"/>
                </figure>
            </div>
            <div class="col-md-6">
                <strong> Auteur: </strong> <?=$livre->getAuteur()?><br>
                <strong> Maison d'edition: </strong><?=$livre->getMaisonedition()?><br>
                <strong> Date du parution: </strong><?=$livre->getParution()?><br>
                <strong> Langue d'edition: </strong><?=$livre->getLangue()?><br>
                <?php if(ISSET($_SESSION['connected'])) echo '<button type="submit" class=" btn btn-info btn-sm" onclick="javascript:window.location.href=\'?class=books&action=details&isbn='.$livre->getIsbn().'\';"><span class="fas fa-info-circle"></span> Details</button>'; ?>
            </div>
            <?php if(ISSET($_SESSION['connected'])) echo '<a href=\'?class=exemplaire&action=get_form&isbn='.$livre->getIsbn().'\'><span class="fas fa-exchange-alt"></span>Demander Exemplaire</a>'; ?>
        </div>
    </div> 
</div> 
<?php  
    }
?>
</main>