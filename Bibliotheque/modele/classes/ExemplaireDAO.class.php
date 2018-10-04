<?php
require_once('./modele/classes/Database.class.php');
require_once('./modele/classes/Exemplaire.class.php');

class ExemplaireDAO
{
	public static function create($x) // Ajouter
	{
		try
		{
			$db = Database::getInstance();
			$pstmt = $db->prepare("INSERT INTO examplaire (FKLIVRE ,FKPROPRIETAIRE, FKDETENTEUR, CREATION) VALUES
						(:l , :p, :d, :c)");
			$res =  $pstmt->execute(array(':l' => $x->getFklivre(),
							':p' => $x->getFkproprietaire(),
							':d' => $x->getFkdetenteur(),
                            ':c' => $x->getCreation()));
			Database::close();
			return $res;
		}
		catch(PDOException $e)
		{
			throw $e;
		}
	}

    public static function findAll() //Trouver tout
	{
		try {
			$liste = Array();//new Liste();

			$requete = 'SELECT * FROM exemplaire';
			$cnx = Database::getInstance();

			$res = $cnx->query($requete);
		    foreach($res as $row) {
				$c = new Exemplaire();
				$c->loadFromArray($row);
				array_push($liste, $c); //$liste->add($c);
		    }
			$res->closeCursor();
			Database::close();
			return $liste;
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    return $liste;
		}
    }


	public static function findParPk($PK) //Trouver par PKCOMPTE
	{
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM examplaire WHERE PKEXEMPLAIRE = :x");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $PK));

		$result = $pstmt->fetch(PDO::FETCH_OBJ);

		if ($result)
		{
			$c = new Exemplaire();
			$c->loadFromObject($result);
			$pstmt->closeCursor();
			return $c;
		}
		$pstmt->closeCursor();
		return NULL;
    }

    public static function findParLivre($isbn) //Trouver par NOM
	{
		$db = Database::getInstance();
        require_once('./modele/classes/Liste.class.php');
        require_once('./modele/classes/Exemplaire.class.php');
        $liste = new Liste();
		$pstmt = $db->prepare("SELECT * FROM examplaire WHERE FKLIVRE = :x");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $isbn));

        while($result = $pstmt->fetch(PDO::FETCH_OBJ))
        {
            $c = new Exemplaire();
            $c->loadFromObject($result);
            $liste->add($c); //$liste->add($c);
        }
        $pstmt->closeCursor();
        Database::close();
        return $liste;
	}

    public static function findListeDetenteurLivre($isbn) //Trouver par NOM
	{
		$db = Database::getInstance();
        require_once('./modele/classes/Liste.class.php');
        require_once('./modele/classes/Compte.class.php');
        $liste = new Liste();
		$pstmt = $db->prepare("SELECT * FROM compte IN (SELECT FKDETENTEUR FROM examplaire WHERE FKLIVRE = :x)");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $isbn));

        while($result = $pstmt->fetch(PDO::FETCH_OBJ))
        {
            $c = new Compte();
            $c->loadFromObject($row);
            $liste->add($c); //$liste->add($c);
        }
        $pstmt->closeCursor();
        Database::close();
        return $liste;
	}

	public static function findParProprietaire($user) //Trouver par NOM
	{
		$db = Database::getInstance();
        $liste = Array();
		$pstmt = $db->prepare("SELECT * FROM examplaire WHERE FKPROPRIETAIRE = :x");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $user));

		$result = $pstmt->fetch(PDO::FETCH_OBJ);

        foreach($result as $row) {
            $c = new Exemplaire();
            $c->loadFromArray($row);
            array_push($liste, $c); //$liste->add($c);
        }
        $pstmt->closeCursor();
        Database::close();
        return $liste;
	}

	public static function findParDetenteur($email) //Trouver par NOM
	{
		$db = Database::getInstance();
        $liste = Array();
		$pstmt = $db->prepare("SELECT * FROM examplaire WHERE FKDETENTEUR = :x");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $email));

		$result = $pstmt->fetch(PDO::FETCH_OBJ);

        foreach($result as $row) {
            $c = new Exemplaire();
            $c->loadFromArray($row);
            array_push($liste, $c); //$liste->add($c);
        }
        $pstmt->closeCursor();
        Database::close();
        return $liste;
	}

    public static function findLivreParDetenteur($email) //Trouver par NOM
	{
        require_once('./modele/classes/Livre.class.php');
		$db = Database::getInstance();
        $liste = Array();
		$pstmt = $db->prepare("SELECT DISTINCT * FROM livre WHERE ISBN IN (SELECT FKLIVRE FROM examplaire WHERE FKDETENTEUR = :x)");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $email));

        while($result = $pstmt->fetch(PDO::FETCH_OBJ)) {
            $c = new Livre();
            $c->loadFromObject($result);
            array_push($liste, $c); //$liste->add($c);
        }
        $pstmt->closeCursor();
        Database::close();
        return $liste;
	}

	public function update($x) {
		try
		{
			$db = Database::getInstance();
			$pstmt = $db->prepare("UPDATE examplaire SET FKLIVRE = :r, COMMENTAIRE = :c WHERE PKEVALUATION = :p");
			$res =  $pstmt->execute(array(':r' => $x->getRating_ev(),
							':c' => $x->getCommentaire(),
							':p' => $x->getPkevaluation()));
			Database::close();
			return $res;
        }
		catch(PDOException $e)
		{
			throw $e;
		}
    }

}