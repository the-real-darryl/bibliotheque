<?php
require_once('./controleur/Action.interface.php');
require_once('./modele/classes/Compte.class.php');
require_once('./modele/classes/CompteDAO.class.php');
require_once('./modele/configs/Constant.php');
require_once('./modele/classes/Time.class.php');

class Members implements Action
{
    public function execute($action)
    {
        switch($action)
        {
            case 'view_list':
            return array('body' => 'MembersList');
            case 'modify_member':
            return $this->modifyMember();
            case 'get_form':
            if(!ISSET($_SESSION)) SESSION_START();
            if(ISSET($_SESSION['connected']))
            if($_SESSION['connected']->getAdmin())
                return $this->getForm($_GET['email']);
            case 'get_form_creation':
                if(!ISSET($_SESSION)) SESSION_START();
                if(ISSET($_SESSION['connected']))
                if($_SESSION['connected']->getAdmin())
                    return $this->getFormCreation();
            case 'create':
                if(!ISSET($_SESSION)) SESSION_START();
                if(ISSET($_SESSION['connected']))
                if($_SESSION['connected']->getAdmin())
                    return $this->create($_POST);
            return array('body' => 'MembersList');
        }
    }

    public function modifyMember()
    {
        if(!ISSET($_SESSION)) SESSION_START();
        $_SESSION['e_mail'] = ISSET($_POST['e_mail'])?$_POST['e_mail']:'';
        if(!ISSET($_SESSION['connected'])) return array('body' => 'default','modal' => 'login_form');
        if($_SESSION['connected']->getAdmin() && ISSET($_POST['submit']))//we now that the user is authentified as admin
        {
            $compte_after_update = new Compte();
            $compte_after_update->loadFromFormulaire($_POST);
            if($compte_after_update->getAdmin() == null) $compte_after_update->setAdmin(0);
            if($compte_after_update->getActif() == null) $compte_after_update->setActif(0);
            //on tient l'utilisateur de la session a jour
            if($t = CompteDAO::auto_update($compte_after_update,$_SESSION['account_to_modify']))
            if($_SESSION['account_to_modify']->getEmail() == $_SESSION['connected']->getEmail())
            {
                $_SESSION['connected'] = $t;
            }
            return array('body' => 'MembersList');
        }
        return array('body' => 'MembersList');
    }

    public function getForm($email)
    {
        if(!ISSET($_SESSION)) SESSION_START();
        $_SESSION['account_to_modify'] = CompteDAO::findParEmail($email);
        return array('body' => 'MembersList','modal' => 'members_form');
    }

    public function getFormCreation()
    {
        if(!ISSET($_SESSION)) SESSION_START();
        if($_SESSION['connected']->getAdmin())
        {
            return array('body' => 'MembersList','modal' => 'members_form_creation');
        }
        return array('body' => 'MembersList');
    }

    public function create($account_to_create)
    {
        if(!ISSET($_SESSION)) SESSION_START();
        if($_SESSION['connected']->getAdmin())
        {
            $_SESSION['account_to_create'][0] = new Compte();
            $_SESSION['account_to_create'][0]->loadFromFormulaire($account_to_create);
            if($_SESSION['account_to_create'][0]->getActif() == null)
            {
                $_SESSION['account_to_create'][0]->setActif(false);
            }
            else
            {
                $_SESSION['account_to_create'][0]->setActif(true);
            }
            if($_SESSION['account_to_create'][0]->getAdmin() == null)
            {
                $_SESSION['account_to_create'][0]->setAdmin(false);
            }
            else
            {
                $_SESSION['account_to_create'][0]->setAdmin(true);
            }
            $_SESSION['account_to_create'][1] = new Compte();
            $_SESSION['account_to_create'][1]->setPassword($account_to_create['password_confirmation']);
            if(CompteDAO::findParEmail($_SESSION['account_to_create'][0]->getEmail()) == null)
            {
                $_SESSION['account_to_create'][1]->setEmail($_SESSION['account_to_create'][0]->getEmail());
                if($_SESSION['account_to_create'][0]->getNom() != "" && $_SESSION['account_to_create'][0]->getPrenom() != ""
                && $_SESSION['account_to_create'][0]->getEmail() != "" && $_SESSION['account_to_create'][0]->getPassword() != "")
                {
                    require_once('./modele/classes/Time.class.php');
                    $_SESSION['account_to_create'][0]->setCreation(Time::getDate_(Constant::TIMEZONE,'Y-m-d'));
                    $_SESSION['account_to_create'][0]->setModification(Time::getDate_(Constant::TIMEZONE,'Y-m-d'));
                    if(CompteDAO::create($_SESSION['account_to_create'][0]))
                    {
                        $_SESSION['account_to_create'][0] = null;
                        return array('body' => 'MembersList');
                    }
                    return array('body' => 'MembersList','modal' => 'members_form_creation');
                }
                return array('body' => 'MembersList','modal' => 'members_form_creation');
            }
            return array('body' => 'MembersList','modal' => 'members_form_creation');
        }
        return array('body' => 'MembersList');
    }
}