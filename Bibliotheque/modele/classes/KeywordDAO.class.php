<?php
include_once('/Database.class.php'); 

class KeywordDAO
{	
	public static function create($x) // Ajouter
	{
		try
		{
			$db = Database::getInstance();
			$pstmt = $db->prepare("INSERT INTO keyword (KEYWORDDESC) VALUES 
						(:l )");
			$res =  $pstmt->execute(array(':l' => $x));
			
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
		
			$requete = 'SELECT * FROM keyword';
			$cnx = Database::getInstance();
			
			$res = $cnx->query($requete);
		    foreach($res as $row) {
				$c = new Keyword();
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

		$pstmt = $db->prepare("SELECT * FROM keyword WHERE PKKEYWORD = :x");//requ�te param�tr�e par un param�tre x.
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
    
    public static function findParKeyword($desc) //Trouver par NOM
	{
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM keyword WHERE KEYWORDDESC = :x");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $desc));
		
		$result = $pstmt->fetch(PDO::FETCH_OBJ);
		
		if ($result)
		{
			$c = new Keyword();
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
			$pstmt = $db->prepare("UPDATE keyword SET KEYWORDDESC = :r WHERE PKKEYWORD = :p");
			$res =  $pstmt->execute(array(':r' => $x->getPkkeyword()));
			Database::close();
			return $res;
        }
		catch(PDOException $e)
		{
			throw $e;
		}
    }
	
}