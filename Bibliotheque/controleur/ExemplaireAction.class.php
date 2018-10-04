<?php
require_once('./controleur/Action.interface.php');

class ExemplaireAction
{
    public function execute($action)
    {
        switch ($action)
        {
            case 'get_form':
                return $this->getForm($_GET['isbn']);
            case 'get_form_delete':
                return $this->getForm($_GET['isbn']);
            case 'demander':
                return $this->demander($_GET['exemplaire'],$_GET['email']);
            case 'proposer':
                return $this->proposer();
            case 'confirmer':
                return $this->confirmer();
            case 'accepter':
                return $this->accepter();
            default :
                return $this->books_();
        }
    }

    public function getForm($isbn)
    {
        if(!isset($_SESSION)) session_start();
        if(isset($_SESSION['connected']))
        {
            require_once('./modele/classes/ExemplaireDAO.class.php');
            require_once('./modele/classes/LivreDAO.class.php');
            $_SESSION['liste_exemplaire'] = ExemplaireDAO::findParLivre($isbn);
            $_SESSION['livre'] = LivreDAO::findParIsbn($isbn);
            return array('body' => 'default', 'modal' =>'demander');
        }
    }

    public function demander($exemplaire,$email)
    {
        if(!isset($_SESSION)) session_start();
        if(isset($_SESSION['connected']))
        {
            require_once('./modele/classes/Demande.class.php');
            require_once('./modele/classes/DemandeDAO.class.php');
            require_once('./modele/classes/Time.class.php');
            require_once('./modele/configs/Constant.php');
            $demande = new Demande();
            $demande->setFkExemplaire($exemplaire);
            $demande->setFkCompte($email);
            $demande->setDate(Time::getDate_(Constant::TIMEZONE,'Y-m-d'));
            DemandeDAO::create($demande);
            return array('body' => 'default');
        }
        return array('body' => 'default');
    }

    public function proposer()
    {

    }

    public function confirmer()
    {

    }

    public function accepter()
    {

    }
}