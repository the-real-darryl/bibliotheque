<?php
require_once('./controleur/Action.interface.php');
class demandeAction implements Action
{
    public function execute($action)
    {
        switch($action)
        {
            case 'get_form':
                return array('body' => 'MembersList');
            case 'approuver':
                return $this->approuver($_POST['pkdemande']);
            case 'refuser':
                return $this->refuser($_POST['pkdemande']);
            case 'view_list':
                return$this->viewList();
        }
    }

    public function viewList()
    {
        require_once('./modele/classes/Compte.class.php');
        require_once('./modele/classes/CompteDAO.class.php');
        require_once('./modele/classes/Demande.class.php');
        require_once('./modele/classes/DemandeDAO.class.php');
        require_once('./modele/classes/Livre.class.php');
        require_once('./modele/classes/LivreDAO.class.php');
        require_once('./modele/classes/ExemplaireDAO.class.php');
        if(!isset($_SESSION)) session_start();
        if(isset($_SESSION['connected']))
        {
            $false = false;
            $_SESSION['demandes'] = DemandeDAO::findParCompteActif($_SESSION['connected']->getEmail(),$false);

            $_SESSION['ligne_demande']['personne'] = new Liste();
            $_SESSION['ligne_demande']['livre'] = new Liste();
            while($_SESSION['demandes']->next())
            {
                $_SESSION['ligne_demande']['personne']->add(CompteDAO::findParEmail($_SESSION['demandes']->current()->getFkCompte()));
                $_SESSION['ligne_demande']['livre']->add(LivreDAO::findParIsbn(ExemplaireDAO::findParPk($_SESSION['demandes']->current()->getFkExemplaire())->getFkLivre()));
            }
            return array('body' => 'liste_demande');
        }
        return array('body' => 'default', 'modal' => 'login');
    }

    public function approuver($pk)
    {
        require_once('./modele/classes/Demande.class.php');
        require_once('./modele/classes/DemandeDAO.class.php');
        require_once('./modele/classes/Registre.class.php');
        require_once('./modele/classes/RegistreDAO.class.php');

        if(!isset($_SESSION)) session_start();
        if(isset($_SESSION['connected']))
        {
            $_SESSION['demande'] = DemandeDAO::findParPk($pk);

            $_SESSION['demande']->setEtat(1);

            DemandeDAO::update($_SESSION['demande']);

            $registre = new Registre();
            $registre->setFkDetenteur($_SESSION['demande']->getFkCompte());
            $registre->setFkExemplaire($_SESSION['demande']->getFkExemplaire());
            $registre->setDate($_SESSION['demande']->getDate());

            RegistreDAO::create($registre);
            return array('body' => 'liste_demande');
        }
        return array('body' => 'default', 'modal' => 'login');
    }

    public function refuser($pk)
    {
        require_once('./modele/classes/Demande.class.php');
        require_once('./modele/classes/DemandeDAO.class.php');
        require_once('./modele/classes/Registre.class.php');
        require_once('./modele/classes/RegistreDAO.class.php');

        if(!isset($_SESSION)) session_start();
        if(isset($_SESSION['connecter']))
        {
            $_SESSION['demande'] = DemandeDAO::findParPk($pk);

            $_SESSION['demande']->setEtat(1);

            DemandeDAO::update($_SESSION['demande']);

            return array('body' => 'liste_demande');
        }
        return array('body' => 'default', 'modal' => 'login');
    }
}