<?php
require_once('./modele/classes/Compte.class.php');
if(!ISSET($_SESSION)) SESSION_START();
?>
<script type="text/javascript">
        $(document).ready(function()
        {
        $("#members_form_creation").modal({backdrop: true});
        $("#members_form_creation").modal('handleUpdate');
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
<!-- Modal -->
<div id="members_form_creation" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Creation</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form role="form" method="post" action="?class=members&action=create">
                        <div class="container">
                            <h1>Creation d'utilisateur</h1>
                            <div class="container">
                                <div class="form-group">
                                    <label for="last_name" class="control-label">nom</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="nom" value='<?= ISSET($_SESSION['account_to_create'][0])?$_SESSION['account_to_create'][0]->getNom():"" ?>' onkeyup="validateNames('last_name','validLastName')" required />
                                    <div class="" id=validLastName></div>
                                </div>
                                <div class="form-group">
                                    <label for="first_name" class="control-label">prenom</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="prenom" value='<?= ISSET($_SESSION['account_to_create'][0])?$_SESSION['account_to_create'][0]->getPrenom():'' ?>' onkeyup="validateNames('first_name','validFirstName')" required />
                                    <div class="" id="validFirstName"></div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="control-label">e-mail</label>
                                    <input type="email" class="form-control" id="inputEmail" name="e_mail" placeholder="Email" value='<?= ISSET($_SESSION['account_to_create'][0])?$_SESSION['account_to_create'][0]->getEmail():'' ?>'  onkeyup="validateEmail('inputEmail','validEmail')" required>
                                    <div class="" id="validEmail"></div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword" class="control-label">Mot de passe</label>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password" value='<?= ISSET($_SESSION['account_to_create'][0])?$_SESSION['account_to_create'][0]->getPassword():'' ?>' onkeyup="validatePassword('inputPassword','validPassword','inputPasswordConfirm','passwordMatches')" required>
                                            <div class="" id="validPassword"></div>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="inputPasswordConfirm" name="password_confirmation" value='<?= ISSET($_SESSION['account_to_create'][1])?$_SESSION['account_to_create'][1]->getPassword():'' ?>' placeholder="Confirm" onkeyup="validatePasswords('inputPassword','inputPasswordConfirm','passwordMatches')" required>
                                            <div class="" id="passwordMatches"></div>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="admin" class="control-label">Admin</label>
                                        <input type="checkbox" id="admin" name="admin" <?php if(ISSET($_SESSION['account_to_create'][0])) if($_SESSION['account_to_create'][0]->getAdmin()) echo 'checked';?> value=1 />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="active" class="control-label">Actif</label>
                                        <input type="checkbox" id="active" name="active" <?php if(ISSET($_SESSION['account_to_create'][0])) if($_SESSION['account_to_create'][0]->getActif()) echo 'checked';?> value=1 />
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" name="submit" value="true">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="./javascript/form_validation.js"></script>
<?php
if(ISSET($_SESSION['account_to_create'][1]))
{
    if($_SESSION['account_to_create'][1]->getEmail() == "")
    {
        echo '<script type="text/javascript">
        emailIsAlreadyTaken(\'last_name\',\'validLastName\',\'first_name\',\'validFirstName\',\'inputEmail\',\'validEmail\',
        \'inputPassword\',\'validPassword\',\'inputPasswordConfirm\',\'passwordMatches\');
        </script>';
    }
}
?>