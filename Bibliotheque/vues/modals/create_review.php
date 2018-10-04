<!-- Modal -->
<div id="create_review" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Creation</h4>
            </div>
            <div class="modal-body">
                <span align="center">
                    <h1>Insert new Evaluation</h1>
                </span>
                <?php
                require_once('./modele/classes/Compte.class.php');
                require_once('./modele/classes/Livre.class.php');
                require_once('./modele/configs/Constant.php');
                if(!ISSET($_SESSION)) SESSION_START();
                ?>
                <div class="card">
                    <div class="card-header">
                        <strong>
                            <span align="center">
                                <h2>
                                    <?=$_SESSION['livre_a_evaluer']->getTitre()?>
                                </h2>
                            </span>
                        </strong>
                        <br />

                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-2 img-fluid ml-3">
                                <figure>
                                    <img src="<?=Constant::IMAGEPATH.$_SESSION['livre_a_evaluer']->getCouverture()?>" class="img-thumbnail" alt="Image d\'un livre" width="100" height="150" />
                                </figure>
                            </div>
                            <div class="col-md-6">
                                <strong> Auteur: </strong><?=$_SESSION['livre_a_evaluer']->getAuteur()?>
                                <br />
                                <strong> Maison d'edition: </strong><?=$_SESSION['livre_a_evaluer']->getMaisonedition()?>
                                <br />
                                <strong> Date du parution: </strong><?=$_SESSION['livre_a_evaluer']->getParution()?>
                                <br />
                                <strong> Langue d'edition: </strong><?=$_SESSION['livre_a_evaluer']->getLangue()?>
                                <br />
                            </div>
                        </div>
                    </div>
                </div>

                <form action="?class=review&action=create_review" class="form-horizontal " method="post">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="RATING_EV" class="col-sm-2 form-form-control-label">RATING_EV</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="RATING_EV" id="RATING_EV" placeholder="Entrer évaluation" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="commentaire" class="col-sm-2 form-form-control-label">COMMENTAIRE</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="COMMENTAIRE" id="COMMENTAIRE" placeholder="Entrer votre commentaire" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row col-sm-12">
                            <div class="col-sm-4">
                                <input type="hidden" name="action" value="insert" id="insert" />
                                <input type="submit" name="insert" class=" btn btn-success btn-lg " value="Insert" id="insert" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
        $(document).ready(function()
        {
            $("#create_review").modal({backdrop: true});
            $("#create_review").modal('handleUpdate');
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