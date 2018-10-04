<?php
include_once('/Database.class.php'); 
include_once('/Livre.class.php'); 
include_once('/Keyword.class.php'); 
include_once('/KeywordDAO.class.php');
include_once('/Livrekeyword.class.php'); 

class LivrekeywordDAO
{	
	public static function create($x) // Ajouter
	{
		try
		{
			$db = Database::getInstance();
			$pstmt = $db->prepare("INSERT INTO livrekeyword (FKLIVRE, FKKEYWORD) VALUES 
						(:l, :k )");
            $res =  $pstmt->execute(array(':l' => $x->getPklivre(),
                                        ':k' => $x->getPkkeyword()));
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
		
			$requete = 'SELECT * FROM livrekeyword';
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


	public static function findParPkLivre($PK) //Trouver par PKCOMPTE
	{
        $liste = Array();
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM livrekeyword WHERE FKLIVRE = :x");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $PK));
		
		$result = $pstmt->fetch(PDO::FETCH_OBJ);
		
		foreach($res as $row) {
            $c = new Keyword();
            $c->loadFromArray($row);
            array_push($liste, $c); //$liste->add($c);
        }
        $res->closeCursor();
			Database::close();
			return $liste;

    }
    
    public static function findParPkKeyword($desc) //Trouver par NOM
	{
        $liste = Array();
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM livrekeyword WHERE FKKEYWORD = :x");//requ�te param�tr�e par un param�tre x.
		$pstmt->execute(array(':x' => $PK));
		
		$result = $pstmt->fetch(PDO::FETCH_OBJ);
		
		foreach($res as $row) {
            $c = new Keyword();
            $c->loadFromArray($row);
            array_push($liste, $c); //$liste->add($c);
        }
        $res->closeCursor();
			Database::close();
			return $liste;
	}
    
	public static function createLKpourLivre($isbn, $arrayMots){
		$db = Database::getInstance();

			foreach($arrayMots as $k){
				$keyword = new Keyword();
				var_dump($keyword);	
				$keyword = KeywordDAO::findParKeyword($k);
				var_dump($keyword);	
				if($keyword!==null){
					$b = new Livrekeyword();
					$b->setPklivre($isbn);
					$b->setPkkeyword($keyword->getPkkeyword());
					LivreKeywordDAO::create($b);
				} else {
                    KeywordDAO::create($k);
					$kb = LivreKeywordDAO::findKeywordParDescription($k);
					$lk = new Livrekeyword();
					$lk->setPklivre($isbn);
					$lk->setPkkeyword($kb->getPkkeyword());
                    LivreKeywordDAO::create($lk);
                }
			}
	}
	
	public static function findKeywordParDescription($desc) 
	{
		$db = Database::getInstance();

		$pstmt = $db->prepare("SELECT * FROM keyword WHERE KEYWORDDESC = :x");
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

	public static function icreateLKpourLivre($isbn, $arrayMots){
		$db = Database::getInstance();
		$db->beginTransaction();
		try{
			foreach($arrayMots as $k){
			$keyword = new Keyword();
			$querySearchKeyword = $db->prepare("SELECT * FROM keyword WHERE KEYWORDDESC = :x");
			$querySearchKeyword->execute(array(':x' => $k));
			$result = $querySearchKeyword->fetch(PDO::FETCH_OBJ);
			if ($result){
			$keyword->loadFromObject($result);
			$b = new Livrekeyword();
			$b->setPklivre($isbn);
			$b->setPkkeyword($keyword->getPkkeyword());
			$b->affiche();
			$pstmt = $db->prepare("INSERT INTO livrekeyword (FKLIVRE, FKKEYWORD) VALUES (:l, :k )");
			$res =  $pstmt->execute(array(':l' => $b->getPklivre(),
									':k' => $b->getPkkeyword()));
			} else {
				$pstmt = $db->prepare("INSERT INTO keyword (KEYWORDDESC) VALUES 
						(:l )");
				$rs =  $pstmt->execute(array(':l' => $k));

			
				$pstmt = $db->prepare("SELECT * FROM keyword WHERE KEYWORDDESC = :x");
				$pstmt->execute(array(':x' => $k));
				$result = $pstmt->fetch(PDO::FETCH_OBJ);
				if ($result)
				{
					$newLK = new Livrekeyword();
					$newLK->loadFromObject($result);
					var_dump($newLK);
					$lkfinal = new Livrekeyword();
					$lkfinal->setPklivre($isbn);
					$lkfinal->setPkkeyword($newLK->getPkkeyword());
					$pstmt = $db->prepare("INSERT INTO livrekeyword (FKLIVRE, FKKEYWORD) VALUES (:l, :k )");
					$res =  $pstmt->execute(array(':l' => $lkfinal->getPklivre(),
											':k' => $lkfinal->getPkkeyword()));
				}

			}
		}


			$db->commit();
		} catch( Exception $e) {
			$db->rollback();
    		var_dump($e->errorInfo);
		}

//ancienne
			// foreach($arrayMots as $k){
			// 	$keyword = new Keyword();
			// 	//var_dump($keyword);	
			// 	$keyword = LivreKeywordDAO::findKeywordParDescription($k);
			// 	//var_dump($keyword);	
			// 	if($keyword!==null){
			// 		$b = new Livrekeyword();
			// 		$b->setPklivre($isbn);
			// 		$b->setPkkeyword($keyword->getPkkeyword());
			// 		LivreKeywordDAO::create($b);//
			// 	} else {
            //         LivreKeywordDAO::createKeyword($k);
			// 		$kb = LivreKeywordDAO::findKeywordParDescription($k); /// second select?!
			// 		$lk = new Livrekeyword();
			// 		$lk->setPklivre($isbn);
			// 		$lk->setPkkeyword($kb->getPkkeyword());
            //         LivreKeywordDAO::create($lk);
            //     }
			// }
	}

	public static function createKeyword($x) // Ajouter
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
	
}