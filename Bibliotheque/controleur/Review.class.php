<?php
require_once('./controleur/Action.interface.php');
class Review implements Action
{
    public function execute($action)
    {
        switch($action)
        {
            case 'view_list':
                return $this->viewList();
            case 'display_form':
                return $this->displayForm($_GET['PKEVALUATION']);
            case 'update':
                return $this->update($_GET['PKEVALUATION']);
            case 'displayBeforeDeletion':
                return $this->displayBeforeDeletion($_GET['PKEVALUATION']);
            case 'delete':
                return $this->delete();
            case 'my_reviews':
                return $this->myReviews();
            case 'get_form_create':
                return $this->getFormCreate($_GET['isbn']);
            case 'create_review':
                return $this->createReview($_POST);
            default:
                return array('body' => 'default');

        }
    }

    public function viewList()
    {
        return array('body' => 'liste_evaluation');
    }
    public function update($pk)
    {
        require_once('./modele/classes/Compte.class.php');
        require_once('./modele/classes/Evaluation.class.php');

        if(!isset($_SESSION)) session_start();
        if(isset($_SESSION['connected']))
        {
            require_once('./modele/classes/EvaluationDAO.class.php');
            $eval_new = new Evaluation();

            //valeurs modifiable servant a creer le nouvel objet
            $eval_new->setRating_ev($_POST["RATING_EV"]);
            $eval_new->setCommentaire($_POST["COMMENTAIRE"]);
            //valeurs constante appartenant a l'objet d'origine
            $eval_new->setPkevaluation($_SESSION['review_to_modify']->getPkevaluation());
            $eval_new->setFkCompte($_SESSION['review_to_modify']->getFkCompte());
            $eval_new->setFkLivre($_SESSION['review_to_modify']->getFkLivre());
            $eval_new->setCreation($_SESSION['review_to_modify']->getCreation());
            if(EvaluationDAO::update($eval_new))
            {
                $_SESSION['review_to_modify'] = null;
                return array('body' => 'liste_evaluation');
            }
            else
            {
                return array('body' => 'liste_evaluation', 'modal' => 'eval_form');
            }
        }
        return array('body' => 'liste_evaluation');
    }
    public function displayForm($pk)
    {
        require_once('./modele/classes/Compte.class.php');

        if(!isset($_SESSION)) session_start();
        if(isset($_SESSION['connected']))
        {
            require_once('./modele/classes/EvaluationDAO.class.php');
            $_SESSION['review_to_modify'] = EvaluationDAO::find($pk);
            if($_SESSION['review_to_modify'])
            {
                return array('body' => 'liste_evaluation', 'modal' => 'eval_form');
            }
            else
            {
                return array('body' => 'liste_evaluation');
            }
        }
        else
        {
            return array('body' => 'default', 'modal' => 'login_form');
        }
    }
    public function displayBeforeDeletion($pk)
    {
        require_once('./modele/classes/Compte.class.php');

        if(!isset($_SESSION)) session_start();
        if(isset($_SESSION['connected']))
        {
            require_once('./modele/classes/EvaluationDAO.class.php');
            $_SESSION['review_to_delete'] = EvaluationDAO::find($pk);
            if($_SESSION['review_to_delete'])
            {
                return array('body' => 'liste_evaluation', 'modal' => 'eval_form_delete');
            }
            return array('body' => 'liste_evaluation');
        }
        return array('body' => 'default', 'modal' => 'login');
    }
    public function delete()
    {
        require_once('./modele/classes/Compte.class.php');
        require_once('./modele/classes/EvaluationDAO.class.php');

        if(!isset($_SESSION)) session_start();
        if(isset($_SESSION['connected']))
        {
            if(EvaluationDAO::delete($_SESSION['review_to_delete']))
            {
                return array('body' => 'liste_evaluation');
            }
            return array('body' => 'liste_evaluation');
        }
        return array('body' => 'default', 'modal' => 'login');
    }

    public function getFormCreate($isbn)
    {
        require_once('./modele/classes/Compte.class.php');
        require_once('./modele/classes/Livre.class.php');
        require_once('./modele/classes/LivreDAO.class.php');
        if(!isset($_SESSION)) session_start();
        if(isset($_SESSION['connected']))
        {
            $_SESSION['livre_a_evaluer'] = LivreDAO::findParIsbn($isbn);
            return array('body' => 'my_books', 'modal' => 'create_review');
        }
        return array('body' => 'default', 'modal' => 'login_form');
    }

    public function createReview($form)
    {
        require_once('./modele/classes/Compte.class.php');
        require_once('./modele/classes/Livre.class.php');
        if(!isset($_SESSION)) session_start();
        if(isset($_SESSION['connected']))
        {
            require_once('./modele/classes/Evaluation.class.php');
            require_once('./modele/classes/EvaluationDAO.class.php');
            require_once('./modele/classes/Time.class.php');
            require_once('./modele/configs/Constant.php');
            $evaluation = new Evaluation();
            $evaluation->setCommentaire($form['COMMENTAIRE']);
            $evaluation->setRating_ev($form['RATING_EV']);
            $evaluation->setFkLivre($_SESSION['livre_a_evaluer']->getIsbn());
            $evaluation->setFkCompte($_SESSION['connected']->getEmail());
            $evaluation->setCreation(Time::getDate_(Constant::TIMEZONE,'Y-m-d'));
            EvaluationDAO::create($evaluation);
            $_SESSION['my_reviews'] = EvaluationDAO::findParUtilisateur($_SESSION['connected']->getEmail());
            return array('body' => 'my_reviews');
        }
        return array('body' => 'default', 'modal' => 'login');
    }

    public function myReviews()
    {
        require_once('./modele/classes/Compte.class.php');
        require_once('./modele/classes/Evaluation.class.php');
        require_once('./modele/classes/EvaluationDAO.class.php');

        if(!isset($_SESSION)) session_start();
        if(isset($_SESSION['connected']))
        {
            $_SESSION['my_reviews'] = EvaluationDAO::findParUtilisateur($_SESSION['connected']->getEmail());
            return array('body' => 'my_reviews');
        }
        return array('body' => 'default', 'modal' => 'login');
    }
}