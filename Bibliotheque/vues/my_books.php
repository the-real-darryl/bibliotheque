
<?php
    require_once('./modele/configs/Constant.php');
    require_once('./modele/classes/LivreDAO.class.php');

    echo '<div class="row col-sm-12">
                <button type="submit" class="btn btn-success btn-lg" onclick="javascript:window.location.href=\'?class=books&action=get_form\'">Ajouter livre</button>
            </div>';
echo '<span class="glyphicon glyphicon-star" aria-hidden="true"></span>';
    $livre = new Livre();
    foreach($_SESSION['my_books'] as $livre) {
?>
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
                <button type="submit" class=" btn btn-info btn-sm" onclick="javascript:window.location.href='?class=books&action=details&isbn=<?=$livre->getIsbn()?>';"><span class="fas fa-info-circle"></span> Details</button>
                <button type="submit" class=" btn btn-warning btn-sm"  onclick="javascript:window.location.href='?class=books&action=modify&isbn=<?=$livre->getIsbn()?>';"><span class="fas fa-edit"></span> Modifier</button>
                <button type="submit" class=" btn btn-warning btn-sm"  onclick="javascript:window.location.href='?class=review&action=get_form_create&isbn=<?=$livre->getIsbn()?>';"><span class="fas fa-star"></span> Evaluer</button>
                </div>
            <div class="col-md-1">
                <button type="submit" class=" btn btn-success btn-sm" name="action" value="ajouterexemplaire&isbn=<?=$livre->getIsbn()?>"><span class="fas fa-book"></span>   Ajouter Exemplaire</button><br><br>
            </div>
        </div>
    </div> 
</div> 
<br> 
<?php  
    }
?>
</main>