<?php
include_once('./modele/classes/Database.class.php');
include_once('./modele/classes/Evaluation.class.php');
include_once('./modele/classes/Liste.class.php');

class EvaluationDAO
{
	public static function create($x) // Ajouter
	{
		$request = "INSERT INTO evaluation (RATING_EV ,COMMENTAIRE, FKCOMPTE, FKLIVRE,CREATION)".
				" VALUES ('".$x->getRating_ev()."','".$x->getCommentaire()."','".$x->getFkCompte()."','".$x->getFkLivre()."','".$x->getCreation()."')";
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


	public static function insert($x,$OK)
	{
		// create database connection
		$db = Database::getInstance();
        // create SQL request
		$sql = 'INSERT INTO evaluation (RATING_EV,COMMENTAIRE,FKCOMPTE,FKLIVRE,CREATION)
           VALUES(:RATING_EV, :COMMENTAIRE, :FKCOMPTE, :FKLIVRE, NOW())';
	    try
		{
		// prepare the statement
	    	$stmt = $db->prepare($sql);
		// bind the parameters and execute the statement
		    $RATING_EV=$x->getRating_ev();
		    $COMMENTAIRE=$x->getCommentaire();
		    $FKCOMPTE=$x->getFkCompte();
			$FKLIVRE=$x->getFkLivre();

			$stmt->bindParam(':RATING_EV',  $RATING_EV, PDO::PARAM_STR);
			$stmt->bindParam(':COMMENTAIRE',  $COMMENTAIRE, PDO::PARAM_STR);
			$stmt->bindParam(':FKCOMPTE',$FKCOMPTE, PDO::PARAM_STR);
			$stmt->bindParam(':FKLIVRE', $FKLIVRE, PDO::PARAM_STR);
			$stmt->execute();
			$OK = $stmt->rowCount();

        }
		catch(PDOException $e)
		{
			throw $e;
		}
	}

	public static function find($id)
	{
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM evaluation WHERE PKEVALUATION = :x");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $id));

		$result = $pstmt->fetch(PDO::FETCH_OBJ);

		if ($result)
		{
            $e = new Evaluation();
			$e->setPkevaluation($result->PKEVALUATION);
			$e->setRating_ev($result->RATING_EV);
			$e->setCommentaire($result->COMMENTAIRE);
			$e->setFkCompte($result->FKCOMPTE);
			$e->setFkLivre($result->FKLIVRE);
            $e->setCreation($result->CREATION);
			$pstmt->closeCursor();
			return $e;
		}
		$pstmt->closeCursor();
		return null;
	}

	public static function update($x)
	{
		 // create database connection
		 $conn=Database::getInstance();
		// prepare update query
		$query = 'UPDATE evaluation SET RATING_EV = :r, COMMENTAIRE = :c , FKCOMPTE = :fc , FKLIVRE = :fl
		WHERE PKEVALUATION = :pk';
        $stmt = $conn->prepare($query);
		// execute query by passing array of variables
		$stmt->execute(array(':r' => $x->getRating_ev(), ':c' => $x->getCommentaire(),
            'fc' => $x->getFkCompte(), 'fl' => $x->getFkLivre(), 'pk' => $x->getPkevaluation()));
		return $stmt->rowCount();
	}

	public static function readAll()
	{
		$liste = new Liste();
		try
		{
			// create database connection
		 $conn=Database::getInstance();
		 // prepare select query
		 $query = 'SELECT * FROM evaluation ORDER BY  CREATION DESC';
		 //Result query
		 $resultQuerry=$conn->query($query);

		  foreach ($resultQuerry as $row)
		  {
				$evaluation = new Evaluation();
				$evaluation->loadFromArray($row);
			    $liste->add($evaluation);
		  }
		  $resultQuerry->closeCursor();
		  $conn=null;
			return $liste;
        } catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    return $liste;
		}
	}

	public static function findParPK($PK) //Trouver par PKCOMPTE
	{
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM evaluation WHERE PKEVALUATION = :x");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $PK));

		$result = $pstmt->fetch(PDO::FETCH_OBJ);

		if ($result)
		{
			$c = new Evaluation();
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
        $liste = Array();
		$pstmt = $db->prepare("SELECT * FROM evaluation WHERE FKLIVRE = :x");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $isbn));

		$result = $pstmt->fetch(PDO::FETCH_OBJ);

        foreach($result as $row) {
            $c = new Evaluation();
            $c->loadFromArray($row);
            array_push($liste, $c); //$liste->add($c);
        }
        $result->closeCursor();
        Database::close();
        return $liste;
	}

	public static function findParUtilisateur($email) //Trouver par NOM
	{
		$db = Database::getInstance();
        $liste = Array();
		$pstmt = $db->prepare("SELECT * FROM evaluation WHERE FKCOMPTE = :x");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $email));


        $liste = new Liste();

        while($result = $pstmt->fetch(PDO::FETCH_OBJ)) {
            $c = new Evaluation();
            $c->loadFromObject($result);
            $liste->add($c); //$liste->add($c);
        }
        $pstmt->closeCursor();
        Database::close();
        return $liste;
	}

	public static function delete($x) {
        $db = Database::getInstance();
		try
		{
            $pstmt = $db->prepare("DELETE FROM evaluation WHERE PKEVALUATION = :x");//requ�te param�tr�e par un param�tre x.
            return $pstmt->execute(array(':x' => $x->getPkevaluation()));
		}
		catch(PDOException $e)
		{
			throw $e;
		}
	}
}
