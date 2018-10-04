<script type="text/javascript">
        $(document).ready(function()
        {
        $("#myModal").modal({backdrop: true});
        $("#myModal").modal('handleUpdate');
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
<script src='./javascript/form_validation.js'></script>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <?php
                    if(!ISSET($_SESSION)) session_start();
                    $username = '';
                    $valid_username = false;
                    $username_field_message = '';

                    $password = '';
                    $valid_password = false;
                    $password_field_message = '';

                    if(ISSET($_SESSION['login_attempt']))
                    {
                        $username = $_SESSION['login_attempt']['username'];
                        $password = $_SESSION['login_attempt']['password'];
                        if(ISSET($_SESSION['login_attempt']['message']))
                        {
                            if(ISSET($_SESSION['login_attempt']['message']['username']))
                            {
                                $username_field_message = $_SESSION['login_attempt']['message']['username'];
                                if(ISSET($_SESSION['login_attempt']['account']))
                                {
                                    if($_SESSION['login_attempt']['account']->getActif())
                                    {
                                        $valid_username = true;
                                    }
                                    else
                                    {
                                        $valid_username = false;
                                    }
                                }
                                else
                                {
                                    $valid_username = false;
                                }
                            }
                            else if(ISSET($_SESSION['login_attempt']['message']['password']))
                            {
                                $password_field_message = $_SESSION['login_attempt']['message']['password'];
                                $valid_username = true;
                            }
                        }
                    }
                    ?>
                    <form role="form" action="?class=account&action=login" method="post">
                        <div class="container">
                            <h1>Authentification</h1>
                            <div class="container">
                                <div class="form-group">
                                    <label for="inputEmail" class="control-label">e-mail</label>
                                    <input type="email" class="form-control 
				<?= (ISSET($_SESSION['login_attempt']))?($valid_username?'is-valid':'is-invalid'):'' ?>"
                                        id="inputEmail" name="username"
                                        placeholder="Email" onkeyup="validateEmail('inputEmail','validEmail')" value="<?= $username ?>" required />
                                    <div class="<?= (ISSET($_SESSION['login_attempt']))?($valid_username?'valid-feedback':'invalid-feedback'):'' ?>" id="validEmail">
                                        <?= $username_field_message ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="control-label">Mot de passe</label>
                                    <div class="form-group">
                                        <input type="password" class="form-control <?= (ISSET($_SESSION['login_attempt']) && $valid_password == false && $valid_username == true)?'is-invalid':'' ?>"
                                            id="inputPassword" name="password" placeholder="Password" onkeyup="validatePassword('inputPassword','validPassword','inputPasswordConfirm','passwordMatches')" value="<?= $password ?>"
                                            required />
                                        <div class="<?= (ISSET($_SESSION['login_attempt']) && $valid_password == false && $valid_username == true)?'invalid-feedback':'' ?>" id="validPassword">
                                            <?= $password_field_message ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="submit" value="login">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
