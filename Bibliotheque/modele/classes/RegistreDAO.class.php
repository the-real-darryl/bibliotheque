<?php
require_once('./modele/classes/Database.class.php');
require_once('./modele/classes/Registre.class.php');

class RegistreDAO
{
	public static function create($x) // Ajouter
	{
		try
		{
			$db = Database::getInstance();
			$pstmt = $db->prepare("INSERT INTO registre (FKDETENTEUR, FKEXEMPLAIRE, DATE) VALUES
						(:C, :E, :D)");
			$res =  $pstmt->execute(array(':C' => $x->getFkDetenteur(),
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

    public static function findParDetenteur($email) //Trouver par email
	{
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM registre WHERE FKDETENTEUR = :x");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $email));
        require_once('./modele/classes/Liste.class.php');
        $liste = new Liste();

		while($result = $pstmt->fetch(PDO::FETCH_OBJ))
		{
			$c = new Registre();
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

		$pstmt = $db->prepare("SELECT * FROM registre WHERE PKREGISTRE = :x");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $pk));

		if($result = $pstmt->fetch(PDO::FETCH_OBJ))
		{
			$c = new Registre();
			$c->loadFromObject($result);
			$pstmt->closeCursor();
            return $c;
		}
		$pstmt->closeCursor();
		return null;
	}
}