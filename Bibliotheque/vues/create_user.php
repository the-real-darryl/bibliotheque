    <form role="form" method="post" action="creer_utilisateur.php">
    <div class="container">
        <h1>Creation d'utilisateur</h1>
        <div class="container">
            <div class="form-group">
                <label for="last_name" class="control-label">nom</label>
                <input type="text" class="form-control" id="last_name" name="nom" placeholder="nom" value=<?= utils::getFieldConditionnally('nom',$_POST,$e_mail_available,null) ?> onkeyup="validateNames('last_name','validLastName')" required>
                <div class="" id=validLastName></div>
            </div>
            <div class="form-group">
                <label for="first_name" class="control-label">prenom</label>
                <input type="text" class="form-control" id="first_name" name="prenom" placeholder="prenom" value=<?= utils::getFieldConditionnally('prenom',$_POST,$e_mail_available,null) ?> onkeyup="validateNames('first_name','validFirstName')" required>
                <div class="" id="validFirstName"></div>
            </div>
            <div class="form-group">
                <label for="inputEmail" class="control-label">e-mail</label>
                <input type="email" class="form-control" id="inputEmail" name="e_mail" placeholder="Email" value=<?= utils::getFieldConditionnally('e_mail',$_POST,$e_mail_available,null) ?>  onkeyup="validateEmail('inputEmail','validEmail')" required>
                <div class="" id="validEmail"></div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="control-label">Mot de passe</label>
                    <div class="form-group">
                        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password" value=<?= utils::getFieldConditionnally('password',$_POST,$e_mail_available,null) ?> onkeyup="validatePassword('inputPassword','validPassword','inputPasswordConfirm','passwordMatches')" required>
                        <div class="" id="validPassword"></div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="inputPasswordConfirm" name="password_confirmation" value=<?= utils::getFieldConditionnally('password_confirmation',$_POST,$e_mail_available,null) ?> placeholder="Confirm" disabled onkeyup="validatePasswords('inputPassword','inputPasswordConfirm','passwordMatches')" required>
                        <div class="" id="passwordMatches"></div>
                    </div>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="true">Submit</button>
        </div>
    </div>
    </form>