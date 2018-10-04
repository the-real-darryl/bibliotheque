<?php

require_once('./modele/classes/Database.class.php');
require_once('./modele/classes/Livre.class.php');
require_once('./modele/classes/Liste.class.php');
require_once('./modele/classes/LivrekeywordDAO.class.php');


class LivreDAO{
    public static function create($x) // Ajouter
	{
		try
		{
			$db = Database::getInstance();
			$pstmt = $db->prepare("INSERT INTO livre (ISBN ,TITRE ,AUTEUR, NOEDITION, MAISON_EDITION, LANGUE, PARUTION, COUVERTURE) VALUES
						(:i, :t, :a, :n, :m, :l, :p, :c)");
			$res =  $pstmt->execute(array(
							':i' => $x->getIsbn(),
							':t' => $x->getTitre(),
							':a' => $x->getAuteur(),
							':n' => $x->getNoedition(),
							':m' => $x->getMaisonedition(),
							':l' => $x->getLangue(),
                            ':p' => $x->getParution(),
                            ':c' => $x->getCouverture()));
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

			$requete = 'SELECT * FROM livre';
			$cnx = Database::getInstance();

			$res = $cnx->query($requete);
		    foreach($res as $row) {
				$c = new Livre();
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

    public static function findParIsbn($isbn) //Trouver par isbn
	{
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM livre WHERE ISBN = :x");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $isbn));

		$result = $pstmt->fetch(PDO::FETCH_OBJ);

		if ($result)
		{
			$c = new Livre();
			$c->loadFromObject($result);
			$pstmt->closeCursor();
			return $c;
		}
		$pstmt->closeCursor();
        $db::close();
		return NULL;
	}

	public static function findParTitrePartial($titre) //Trouver par isbn
	{
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM livre WHERE TITRE LIKE '%:x%'");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $titre));

		$result = $pstmt->fetch(PDO::FETCH_OBJ);

		if ($result)
		{
			$c = new Livre();
			$c->loadFromObject($result);
			$pstmt->closeCursor();
			return $c;
		}
		$pstmt->closeCursor();
		return NULL;
	}

	public static function findParAuteurPartial($auteur) //Trouver par isbn
	{
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM livre WHERE AUTEUR LIKE '%:x%'");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $auteur));

		$result = $pstmt->fetch(PDO::FETCH_OBJ);

		if ($result)
		{
			$c = new Livre();
			$c->loadFromObject($result);
			$pstmt->closeCursor();
			return $c;
		}
		$pstmt->closeCursor();
		return NULL;
	}

	public static function findParMaisonPartial($maison) //Trouver par isbn
	{
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM livre WHERE MAISON_EDITION LIKE '%:x%'");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $maison));

		$result = $pstmt->fetch(PDO::FETCH_OBJ);

		if ($result)
		{
			$c = new Livre();
			$c->loadFromObject($result);
			$pstmt->closeCursor();
			return $c;
		}
		$pstmt->closeCursor();
		return NULL;
	}

	public static function findParLanguePartial($langue) //Trouver par isbn
	{
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM livre WHERE LANGUE LIKE '%:x%'");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $langue));

		$result = $pstmt->fetch(PDO::FETCH_OBJ);

		if ($result)
		{
			$c = new Livre();
			$c->loadFromObject($result);
			$pstmt->closeCursor();
			return $c;
		}
		$pstmt->closeCursor();
		return NULL;
	}

	public static function findParParutionConcrete($parution) //Trouver par isbn
	{
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM livre WHERE PARUTION = :x");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $parution));

		$result = $pstmt->fetch(PDO::FETCH_OBJ);

		if ($result)
		{
			$c = new Livre();
			$c->loadFromObject($result);
			$pstmt->closeCursor();
			return $c;
		}
		$pstmt->closeCursor();
		return NULL;
	}

	public static function findParParutionApres($parution) //Trouver par isbn
	{
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM livre WHERE PARUTION >= :x");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $parution));

		$result = $pstmt->fetch(PDO::FETCH_OBJ);

		if ($result)
		{
			$c = new Livre();
			$c->loadFromObject($result);
			$pstmt->closeCursor();
			return $c;
		}
		$pstmt->closeCursor();
		return NULL;
	}

	public static function findParParutionAvant($parution) //Trouver par isbn
	{
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM livre WHERE PARUTION <= :x");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $parution));

		$result = $pstmt->fetch(PDO::FETCH_OBJ);

		if ($result)
		{
			$c = new Livre();
			$c->loadFromObject($result);
			$pstmt->closeCursor();
			return $c;
		}
		$pstmt->closeCursor();
		return NULL;
	}

    public static function update($x) {
        $request = "UPDATE livre SET TITRE = '".$x->getTitre()."', AUTEUR = '".$x->getAuteur()."', NOEDITION ='".$x->getNoedition()."',
        MAISON_EDITION = '".$x->getMaisonedition()."', LANGUE = '".$x->getLangue()."', PARUTION = '".$x->getParution()."',
        COUVERTURE ='".$x->getCouverture()."'"." WHERE ISBN = '".$x->getIsbn()."'";
		try
		{
			$db = Database::getInstance();
			return $db->exec($request);
		}
		catch(PDOException $e)
		{
			throw $e;
		}
	}

	public static function delete($x) {
        $request = "DELETE FROM livre WHERE ISBN = '".$x->getIsbn()."'";
		try
		{
			$db = Database::getInstance();
			//return $db->exec($request);
		}
		catch(PDOException $e)
		{
			throw $e;
		}
	}
}
