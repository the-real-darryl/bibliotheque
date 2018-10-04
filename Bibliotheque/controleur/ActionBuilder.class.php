<?php
require_once('./controleur/DefaultAction.class.php');
require_once('./controleur/Account.class.php');
require_once('./controleur/Books.class.php');
require_once('./controleur/Members.class.php');
require_once('./controleur/Review.class.php');
require_once('./controleur/ExemplaireAction.class.php');
require_once('./controleur/DemandeAction.class.php');
class ActionBuilder{
	public static function getAction($class){
		switch ($class)
		{
			case 'account' :
				return new Account();
			case 'books' :
				return new Books();
			case 'historic' :
				return new Historic();
			case 'members' :
				return new Members();
			case 'review' :
				return new Review();
            case 'exemplaire' :
				return new ExemplaireAction();
            case 'demande' :
				return new demandeAction();
			default :
				return new DefaultAction();
		}
	}
}
