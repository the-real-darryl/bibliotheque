<!-- Modal -->
<div id="members_form" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modification</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form role="form" method="post" action="?class=members&action=modify_member">
                        <div class="container">
                            <h1>Creation d'utilisateur</h1>
                            <div class="container">
                                <div class="form-group">
                                    <label for="last_name" class="control-label">nom</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="nom" onkeyup="validateNames('last_name','validLastName')" value=<?= $_SESSION['account_to_modify']->getNom()?> required />
                                    <div class="" id=validLastName></div>
                                </div>
                                <div class="form-group">
                                    <label for="first_name" class="control-label">prenom</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="prenom" onkeyup="validateNames('first_name','validFirstName')" value=<?= $_SESSION['account_to_modify']->getPrenom()?> required />
                                    <div class="" id="validFirstName"></div>
                                </div>
                                <div class="form-group">
                                    <label for="e_mail" class="control-label">e-mail</label>
                                    <input type="email" class="form-control" id="e_mail" name="e_mail" placeholder="Email" onkeyup="validateEmail('inputEmail','validEmail')" value=<?= $_SESSION['account_to_modify']->getEmail()?> required />
                                    <div class="" id="validEmail"></div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="control-label">Mot de passe</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="password" name="password" placeholder="Password" onkeyup="validatePassword('inputPassword','validPassword','inputPasswordConfirm','passwordMatches')" value=<?= $_SESSION['account_to_modify']->getPassword()?> required />
                                        <div class="" id="validPassword"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="admin" class="control-label">Admin</label>
                                        <input type="checkbox" id="admin" name="admin" <?= $_SESSION['account_to_modify']->getAdmin()?'checked':''?> value=<?= $_SESSION['account_to_modify']->getAdmin() ?> />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="active" class="control-label">Actif</label>
                                        <input type="checkbox" id="active" name="active" <?= $_SESSION['account_to_modify']->getActif()?'checked':''?> value=<?= $_SESSION['account_to_modify']->getActif() ?> />
                                    </div>
                                </div>
                                <!-- <input type="radio" name="gender" value="male"> -->
                                <button type="submit" class="btn btn-primary" name="submit" value="true">Submit</button>
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
        $("#members_form").modal({backdrop: true});
        $("#members_form").modal('handleUpdate');
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
<script src="./javascript/form_validation.js"></script>