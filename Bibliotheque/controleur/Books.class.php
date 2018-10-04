<?php
require_once('./controleur/Action.interface.php');
require_once('./modele/classes/Livre.class.php');
require_once('./modele/classes/LivreDAO.class.php');
class Books implements Action
{
    public function books_()
    {
        return array('body'=>'default');
    }

    public function myBooks()
    {
        if(!ISSET($_SESSION)) session_start();
        if(isset($_SESSION['connected']))
        {
            require_once('./modele/classes/Exemplaire.class.php');
            require_once('./modele/classes/ExemplaireDAO.class.php');
            $_SESSION['my_books'] = ExemplaireDAO::findLivreParDetenteur($_SESSION['connected']->getEmail());
            return array('body' => 'my_books');
        }
        return array('body' => 'view_list');
    }

    public function execute($action)
    {
        switch ($action)
        {
            case 'view_list':
                return $this->books_();
            case 'my_books':
                return $this->myBooks();
            case 'get_form':
                return $this->getForm();
            case 'create_book':
                return $this->createBook($_POST);
            default :
                return $this->books_();
        }
    }

    public function getForm()
    {
        if(!ISSET($_SESSION)) session_start();
        if(isset($_SESSION['connected']))
        {
            return array('body' =>'my_books', 'modal' => 'book_form');
        }
        return array('body' => 'view_list');
    }

    public function createBook($form)
    {
        require_once('./modele/classes/Compte.class.php');
        if(!ISSET($_SESSION)) session_start();
        if(isset($_SESSION['connected']))
        {
            require_once('./modele/classes/Exemplaire.class.php');
            require_once('./modele/classes/ExemplaireDAO.class.php');
            require_once('./modele/configs/Constant.php');
            require_once('./modele/classes/Time.class.php');

            $exemplaire = new Exemplaire();
            $livre = new Livre();

            $livre->loadFromArray($form);
            $livre->setCouverture(($_FILES['COUVERTURE']['name']));
            if(LivreDAO::create($livre)) move_uploaded_file($_FILES['COUVERTURE']['name'], Constant::IMAGEPATH.$livre->getCouverture());
            unset($_FILES['COUVERTURE']);
            $exemplaire->setFkLivre($livre->getIsbn());
            $exemplaire->setFkProprietaire($_SESSION['connected']->getEmail());
            $exemplaire->setFkDetenteur($_SESSION['connected']->getEmail());
            $exemplaire->setCreation(Time::getDate_(Constant::TIMEZONE,'Y-m-d'));
            ExemplaireDAO::create($exemplaire);
            return array('body' => 'my_books');
        }
        return array('body' => 'view_list');
    }
}