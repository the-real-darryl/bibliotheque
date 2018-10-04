<?php
require_once('./modele/configs/Constant.php');
require_once('./modele/classes/Compte.class.php');
require_once('./modele/classes/Livre.class.php');
require_once('./modele/classes/Demande.class.php');
if(!isset($_SESSION)) session_start();
?>



<?php
while($_SESSION['ligne_demande']['personne']->next() && $_SESSION['ligne_demande']['livre']->next())
{
?>

<main>
    <div class="card">
        <div class="card-header">
            <strong>
                <a href='?action=detaillivre&isbn=<?=$_SESSION['ligne_demande']['livre']->current()->getIsbn()?>' target='_blank'>
                    <?=$_SESSION['ligne_demande']['livre']->current()->getTitre()?>
                </a>
            </strong>
            <br />
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-2 img-fluid ml-3">
                    <figure>
                        <img src="<?=Constant::IMAGEPATH.$_SESSION['ligne_demande']['livre']->current()->getCouverture()?>" class="img-thumbnail" alt="Image d\'un livre" width="100" height="150" />
                    </figure>
                </div>
                <div class="col-md-6">
                    <strong> Auteur: </strong><?=$_SESSION['ligne_demande']['livre']->current()->getAuteur()?>
                    <br />
                    <strong> Maison d'edition: </strong><?=$_SESSION['ligne_demande']['livre']->current()->getMaisonedition()?>
                    <br />
                    <strong> Date du parution: </strong><?=$_SESSION['ligne_demande']['livre']->current()->getParution()?>
                    <br />
                    <strong> Langue d'edition: </strong><?=$_SESSION['ligne_demande']['livre']->current()->getLangue()?>
                    <br />
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <strong>Demandeur</strong>
            <br />
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8">
                    <strong> Prenom: </strong><?=$_SESSION['ligne_demande']['personne']->current()->getPrenom()?>
                    <br />
                    <strong> Nom: </strong><?=$_SESSION['ligne_demande']['personne']->current()->getNom()?>
                    <br />
                    <strong> e-mail: </strong><?=$_SESSION['ligne_demande']['personne']->current()->getEmail()?>
                    <br />
                </div>
            </div>
        </div>
    </div>
    <form action="?class=demande&action=approuver" method="post">
        <div class="container">
            <button type="submit" class="btn btn-primary" name="pkdemande" value="<?= $_SESSION['demandes']->current()->getPkDemande() ?>">Approuver</button>
        </div>
    </form>
    <form action="?class=demande&action=refuser" method="post">
        <div class="container">
            <button type="submit" class="btn btn-primary" name="pkdemande" value="<?= $_SESSION['demandes']->current()->getPkDemande() ?>">Refuser</button>
        </div>
    </form>
</main>
    <?php
    $_SESSION['demandes']->next();
}
?>
