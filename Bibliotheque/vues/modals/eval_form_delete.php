<!-- Modal -->
<div id="displayBeforeDeletion" class="modal fade" role="dialog">
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
                                    <?= $_SESSION['review_to_delete']->getCreation() ?>
                                </td>
                                <td>
                                    <?= $_SESSION['review_to_delete']->getRating_ev() ?>
                                </td>
                                <td>
                                    <?= $_SESSION['review_to_delete']->getCommentaire() ?>
                                </td>
                                <td>
                                    <?= $_SESSION['review_to_delete']->getFkCompte() ?>
                                </td>
                                <td>
                                    <?= $_SESSION['review_to_delete']->getFkLivre() ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary" name="action" value="delete" onclick="confirmDelete('<?= $_SESSION['review_to_delete']->getPkevaluation() ?>')">Submit</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
        $(document).ready(function()
        {
            $("#displayBeforeDeletion").modal({backdrop: true});
            $("#displayBeforeDeletion").modal('handleUpdate');
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
    function confirmDelete(pk) {
        var result = confirm("Etes-vous certain de vouloir supprimer cette evaluation ?");
        if (result) {
                window.location.href = '?class=review&action=delete&PKEVALUATION='+pk;
        }
    }
</script>