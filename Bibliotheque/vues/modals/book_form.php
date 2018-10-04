<!-- Modal -->
<div id="book" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Creation</h4>
            </div>
            <div class="modal-body">
                <form action="?class=books&action=create_book" class="form-horizontal " method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="isbn" class="col-sm-2 form-form-control-label">ISBN</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="ISBN" id="isbn"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="titre" class="col-sm-2 form-form-control-label">Titre</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="TITRE" id="titre" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="auteur" class="col-sm-2 form-form-control-label">Auteur</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="AUTEUR" id="auteur" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="noedition" class="col-sm-2 form-form-control-label">Numero d'edition</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="NOEDITION" id="noedition" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="maison_edition" class="col-sm-2 form-form-control-label">Maison d'edition</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="MAISON_EDITION" id="maison_edition" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="langue" class="col-sm-2 form-form-control-label">Langue</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="LANGUE" id="langue" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="parution" class="col-sm-2 form-form-control-label">Parution</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="PARUTION" id="parution" placeholder="entrer une anne"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="couverture" class="col-sm-2 form-form-control-label">Couverture</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="COUVERTURE" id="couverture" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row col-sm-12">
                            <div class="col-sm-4">
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
            $("#book").modal({backdrop: true});
            $("#book").modal('handleUpdate');
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