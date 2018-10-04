<?php
require_once('./controleur/Action.interface.php');
class Account implements Action
{
    public function login()
    {
        require_once('./modele/classes/CompteDAO.class.php');

        if (!ISSET($_SESSION)) session_start();
        if (ISSET($_SESSION['connected']))
        {
            return array('body'=>'default');
        }
        else
        {
            $_SESSION['login_attempt'] = null;//now that the user is succesfully connected, we dont need the messages
            if(ISSET($_POST))
            {
                if(ISSET($_POST['username']))//WE ASSUME PASSWORD IS SET BECAUSE BOTH FIELDS ARE REQUIERED TO SUBMIT THE FORM
                {
                    if($_SESSION['login_attempt']['account'] = CompteDAO::findParEmail($_POST['username']))//verifying if email is in the database
                    {
                        if($_SESSION['login_attempt']['account']->getPassword() == $_POST['password'])//user succesfully authentified !!
                        {
                            if($_SESSION['login_attempt']['account']->getActif())//verrifying if the account is still active
                            {
                                $_SESSION['connected'] = $_SESSION['login_attempt']['account'];
                                $_SESSION['login_attempt'] = null;
                                return array('body'=>'default');
                            }
                            else
                            {
                                $_SESSION['login_attempt']['password'] = $_POST['password'];
                                $_SESSION['login_attempt']['username'] = $_POST['username'];
                                $_SESSION['login_attempt']['message']['username'] = 'ce compte est desactive';
                                return array('body'=>'default','modal'=>'login_form');
                            }
                        }
                        else//good username(email) bad password
                        {
                            $_SESSION['login_attempt']['password'] = $_POST['password'];
                            $_SESSION['login_attempt']['username'] = $_POST['username'];
                            $_SESSION['login_attempt']['message']['password'] = 'vous avez entrer un mauvais mot de passe';
                            return array('body'=>'default','modal'=>'login_form');
                        }
                    }
                    else//wrong username(email)
                    {
                        $_SESSION['login_attempt']['password'] = $_POST['password'];
                        $_SESSION['login_attempt']['username'] = $_POST['username'];
                        $_SESSION['login_attempt']['message']['username'] = 'vous avez entrer un mauvais nom d\'utilisateur';
                        return array('body'=>'default','modal'=>'login_form');
                    }
                }
            }
            return array('body'=>'default','modal'=>'login_form');
        }
    }

    public function logout()
    {
        session_start();
        $_SESSION = [];
        session_destroy();
		return array('body' => 'default');
    }

    public function execute($action)
    {
        switch ($action)
        {
            case 'login':
            return $this->login();
            case 'logout':
            return $this->logout();
            default:
            return array('body' => 'default');
        }
    }
}