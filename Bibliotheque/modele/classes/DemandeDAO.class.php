<?php
require_once('./modele/classes/Database.class.php');
require_once('./modele/classes/Demande.class.php');

class DemandeDAO
{
	public static function create($x) // Ajouter
	{
		try
		{
			$db = Database::getInstance();
			$pstmt = $db->prepare("INSERT INTO demande (FKCOMPTE, FKEXEMPLAIRE, DATE) VALUES
						(:C, :E, :D)");
			$res =  $pstmt->execute(array(':C' => $x->getFkCompte(),
							':E' => $x->getFkExemplaire(),
                            ':D' => $x->getDate()));
			Database::close();
			return $res;
		}
		catch(PDOException $e)
		{
			throw $e;
		}
	}

    public static function findParCompte($email) //Trouver par email
	{
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM demande WHERE FKCOMPTE = :x");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $email));
        require_once('./modele/classes/Liste.class.php');
        $liste = new Liste();


		while($result = $pstmt->fetch(PDO::FETCH_OBJ))
		{
			$c = new Demande();
			$c->loadFromObject($result);
			$pstmt->closeCursor();
            $liste->add($c);
		}
		$pstmt->closeCursor();
		return ($liste->taille() > 0)?$liste:null;
	}

    public static function findParCompteActif($email,$actif) //Trouver par email
	{
		$db = Database::getInstance();
        //FKCOMPTE = :x
		$pstmt = $db->prepare("SELECT * FROM demande WHERE ETAT = :e AND FKEXEMPLAIRE IN 
                                    (SELECT PKEXEMPLAIRE FROM examplaire WHERE FKCOMPTE = :x)");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $email, ':e' => $actif));
        require_once('./modele/classes/Liste.class.php');
        $liste = new Liste();


		while($result = $pstmt->fetch(PDO::FETCH_OBJ))
		{
			$c = new Demande();
			$c->loadFromObject($result);
			$pstmt->closeCursor();
            $liste->add($c);
		}
		$pstmt->closeCursor();
		return ($liste->taille() > 0)?$liste:null;
	}

    public static function findParPk($pk) //Trouver par email
	{
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM demande WHERE PKDEMANDE = :x");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $pk));

		if($result = $pstmt->fetch(PDO::FETCH_OBJ))
		{
			$c = new Demande();
			$c->loadFromObject($result);
			$pstmt->closeCursor();
            return $c;
		}
		$pstmt->closeCursor();
		return null;
	}

    public function update($x) {

		try
		{
			$db = Database::getInstance();
			$pstmt = $db->prepare("UPDATE demande SET FKCOMPTE = :e, FKEXEMPLAIRE = :n WHERE PKDEMANDE = :eo");
			$res =  $pstmt->execute(array(
                            ':e' => $x->getFkCompte(),
							':n' => $x->getFkExemplaire(),
							':eo' => $x->getPkDemande()));
			Database::close();
			return $res;
		}

		catch(PDOException $e)
		{
			throw $e;
		}
	}
}