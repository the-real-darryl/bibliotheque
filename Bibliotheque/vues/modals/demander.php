<?php
    require_once('./modele/classes/Livre.class.php');
    require_once('./modele/classes/Exemplaire.class.php');
    require_once('./modele/classes/Compte.class.php');
    if(!isset($_SESSION)) session_start();
?>
<!-- Modal -->
<div id="demander_exemplaire" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Demander exemplaire</h4>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                        <strong>
                            <a href='?action=detaillivre&isbn=<?=$_SESSION['livre']->getIsbn()?>' target='_blank'>
                                <?=$livre->getTitre()?>
                            </a>
                        </strong>
                        <br />
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2 img-fluid ml-3">
                                <figure>
                                    <img src="<?=Constant::IMAGEPATH.$_SESSION['livre']->getCouverture()?>" class="img-thumbnail" alt="Image d\'un livre" width="100" height="150" />
                                </figure>
                            </div>
                            <div class="col-md-6">
                                <strong> Auteur: </strong><?=$_SESSION['livre']->getAuteur()?>
                                <br />
                                <strong> Maison d'edition: </strong><?=$_SESSION['livre']->getMaisonedition()?>
                                <br />
                                <strong> Date du parution: </strong><?=$_SESSION['livre']->getParution()?>
                                <br />
                                <strong> Langue d'edition: </strong><?=$_SESSION['livre']->getLangue()?>
                                <br />
                            </div>
                        </div>
                    </div>
                </div>

                <table class="table table-hover table-responsive" id="maTable">
                    <thead>
                        <tr>
                            <th scope="col">e-mail detenteur</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for($row = 0;$row != $_SESSION['liste_exemplaire']->taille(); $row++)
                        {
                        ?>
                        <tr scope="row" onclick='location.href="?class=exemplaire&action=demander&email=<?= $_SESSION['liste_exemplaire']->get($row)->getFkDetenteur() ?>&exemplaire=<?= $_SESSION['liste_exemplaire']->get($row)->getPkExemplaire() ?>"'>
                            <td>
                                <?= $_SESSION['liste_exemplaire']->get($row)->getFkDetenteur() ?>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
        $(document).ready(function()
        {
            $("#demander_exemplaire").modal({backdrop: true});
            $("#demander_exemplaire").modal('handleUpdate');
        function alignModal(){
            var modalDialog = $(this).find(".modal-dialog");
        /* Applying the top margin on modal dialog to align it vertically center */
        modalDialog.css("margin-top", Math.max(0, ($(window).height() - modalDialog.height()) / 2));
        }
         $(window).on("resize", function()
        {
            $(".modal:visible").each(alignModal);
        });
        });
</script>