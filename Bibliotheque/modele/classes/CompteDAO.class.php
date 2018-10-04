<?php

include_once('./modele/classes/Database.class.php');
include_once('./modele/classes/Compte.class.php');
include_once('./modele/classes/Liste.class.php');
include_once('./modele/configs/Constant.php');
include_once('./modele/classes/Time.class.php');


class CompteDAO
{
	public static function create($x) // Ajouter
	{
		try
		{
			$db = Database::getInstance();
			$pstmt = $db->prepare("INSERT INTO COMPTE (E_MAIL ,NOM ,PRENOM, PASSWORD, ACTIF, DCREATION, DMODIFICATION, ADMIN) VALUES
						(:e , :n, :p, :s, :a, :c, :m, :d)");
			$res =  $pstmt->execute(array(':e' => $x->getEmail(),
							':n' => $x->getNom(),
							':p' => $x->getPrenom(),
							':s' => $x->getPassword(),
							':a' => $x->getActif(),
							':c' => $x->getCreation(),
							':m' => $x->getModification(),
                            ':d' => $x->getAdmin()));
			Database::close();
			return $res;
		}
		catch(PDOException $e)
		{
			throw $e;
		}
	}



	public static function auto_update($new,$old) // Ajouter
	{
		$union = new Compte();
		$a = array();

		$union->copyConstructor($old);

		$statement = "UPDATE COMPTE SET ";

		if($new->getEmail() != $old->getEmail())
		{
		    $statement .= "E_MAIL = :email_new ";
		    $union->setEmail($new->getEmail());
		    $a[':email_new'] = $union->getEmail();
		}

		if($new->getNom() != $old->getNom())
		{
            if(count($a) > 0) $statement .= ',';
		    $statement .= "NOM = :last_name ";
		    $union->setNom($new->getNom());
		    $a[':last_name'] = $union->getNom();
		}

		if($new->getPrenom() != $old->getPrenom())
		{
            if(count($a) > 0) $statement .= ',';
		    $statement .= "PRENOM = :first_name ";
		    $union->setPrenom($new->getPrenom());
		    $a[':first_name'] = $union->getPrenom();
		}

		if($new->getPassword() != $old->getPassword())
		{
            if(count($a) > 0) $statement .= ',';
		    $statement .= "PASSWORD = :password ";
		    $union->setPassword($new->getPassword());
		    $a[':password'] = $union->getPassword();
		}

		if($new->getActif() != $old->getActif())
		{
            if(count($a) > 0) $statement .= ',';
		    $statement .= "ACTIF = :active ";
		    $union->setActif($new->getActif());
		    $a[':active'] = $union->getActif();
		}

		if($new->getAdmin() != $old->getAdmin())
		{
            if(count($a) > 0) $statement .= ',';
		    $statement .= "ADMIN = :admin ";
		    $union->setAdmin($new->getAdmin());
		    $a[':admin'] = $union->getAdmin();
		}

		//the modification date always needs to be updated
        if(count($a) > 0) $statement .= ',';
		$statement .= "DMODIFICATION = :modification ";
		$union->setModification(Time::getDate_(Constant::TIMEZONE,'Y-m-d'));
		$a[':modification'] = $union->getModification();

		//we now need a parameter to identify the wow that need to be updated
		$statement .= "WHERE E_MAIL = :email_old";
		$a[':email_old'] = $old->getEmail();

		try
		{
			$db = Database::getInstance();
			$pstmt = $db->prepare($statement);
			$pstmt->execute($a);
			Database::close();
			return $union;
		}
		catch(PDOException $e)
		{
			throw $e;
		}
	}

	public static function findAll() //Trouver tout
	{
		try {
			$liste = new Liste();

			$requete = 'SELECT * FROM compte';
			$cnx = Database::getInstance();

			$res = $cnx->query($requete);
		    foreach($res as $row) {
				$c = new Compte();
				$c->loadFromArray($row);
				$liste->add($c);
		    }
			$res->closeCursor();
			Database::close();
			return $liste;
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    return $liste;
		}
	}

	public static function findParEmail($email) //Trouver par email
	{
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM compte WHERE E_MAIL = :x");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $email));

		$result = $pstmt->fetch(PDO::FETCH_OBJ);

		if ($result)
		{
			$c = new Compte();
			$c->loadFromObject($result);
			$pstmt->closeCursor();
			return $c;
		}
		$pstmt->closeCursor();
		return NULL;
	}

	public static function findParNom($nom) //Trouver par NOM
	{
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM compte WHERE NOM = :x");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $nom));

		$result = $pstmt->fetch(PDO::FETCH_OBJ);

		if ($result)
		{
			$c = new Compte();
			$c->loadFromObject($result);
			$pstmt->closeCursor();
			return $c;
		}
		$pstmt->closeCursor();
		return NULL;
	}

	public static function findParPrenom($prenom) //Trouver par PRENOM
	{
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM compte WHERE PRENOM = :x");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $prenom));

		$result = $pstmt->fetch(PDO::FETCH_OBJ);

		if ($result)
		{
			$c = new Compte();
			$c->loadFromObject($result);
			$pstmt->closeCursor();
			return $c;
		}
		$pstmt->closeCursor();
		return NULL;
	}

	public function update($x) {

		try
		{
			$db = Database::getInstance();
			$pstmt = $db->prepare("UPDATE compte SET E_MAIL = :e, NOM = :n, PRENOM = :p,
			PASSWORD = :s, ACTIF = :a, DCREATION = :c, DMODIFICATION = :m, ADMIN = :ad WHERE E_MAIL = :eo");
			$res =  $pstmt->execute(array(':e' => $x->getEmail(),
							':n' => $x->getNom(),
							':p' => $x->getPrenom(),
							':s' => $x->getPassword(),
							':a' => $x->getActif(),
							':c' => $x->getCreation(),
							':m' => $x->getModification(),
                            ':ad' => $x->getAdmin(),
							':eo' => $x->getEmail()));
			Database::close();
			return $res;
		}

		//$request = "UPDATE compte SET NOM = '".$x->getNom()."', PRENOM = '".$x->getPrenom()."', PASSWORD = '".$x->getPassword()."', E_MAIL ='".$x->getEmail()."'"." WHERE PKCOMPTE = '".$x->getPKcompte()."'";

		catch(PDOException $e)
		{
			throw $e;
		}
	}

	public static function authentify($form)
	{
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM compte WHERE E_MAIL = :x AND PASSWORD = :p");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $form['username'], ':p' => $form['password']));

		$result = $pstmt->fetch(PDO::FETCH_OBJ);

		if ($result)
		{
			$c = new Compte();
			$c->loadFromObject($result);
			$pstmt->closeCursor();
			return $c;
		}
		$pstmt->closeCursor();
		return NULL;
	}

}
