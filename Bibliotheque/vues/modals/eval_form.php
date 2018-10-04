<!-- Modal -->
<div id="reviews_form" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modification</h4>
            </div>
            <div class="modal-body">
                <!--evaluation a modifier-->
                <div class="container">
                    <table class="table table">
                        <thead>
                            <tr>
                                <th scope="col">Date évaluation</th>
                                <th scope="col">Rating évaluation</th>
                                <th scope="col">Commentaire sur le livre</th>
                                <th scope="col">Compte E_mail de l\'enseignant</th>
                                <th scope="col">Isbn du livre évaluer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?= $_SESSION['review_to_modify']->getCreation() ?>
                                </td>
                                <td>
                                    <?= $_SESSION['review_to_modify']->getRating_ev() ?>
                                </td>
                                <td>
                                    <?= $_SESSION['review_to_modify']->getCommentaire() ?>
                                </td>
                                <td>
                                    <?= $_SESSION['review_to_modify']->getFkCompte() ?>
                                </td>
                                <td>
                                    <?= $_SESSION['review_to_modify']->getFkLivre() ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <div class="container-fluid">
                    <form role="form" method="post" action="?class=review&action=update">
                        <div class="container">
                            <h1>Creation d'utilisateur</h1>
                            <div class="container">
                                <div class="form-group">
                                    <label for="rating" class="control-label">Rating</label>
                                    <input type="text" class="form-control" id="rating" name="RATING_EV" value='<?= $_SESSION['review_to_modify']->getRating_ev()?>' required />
                                </div>
                                <div class="form-group">
                                    <label for="commentaire" class="control-label">Commentaire</label>
                                    <input type="text" class="form-control" id="commentaire" name="COMMENTAIRE" value='<?= $_SESSION['review_to_modify']->getCommentaire()?>' required />
                                </div>
                                <button type="submit" class="btn btn-primary" name="action" value="update">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
        $(document).ready(function()
        {
            $("#reviews_form").modal({backdrop: true});
            $("#reviews_form").modal('handleUpdate');
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