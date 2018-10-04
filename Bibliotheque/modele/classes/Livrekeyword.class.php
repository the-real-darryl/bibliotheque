<?php
include_once('/Livre.class.php'); 

class Livrekeyword {

    private $pklivre;
    private $pkkeyword;
	
	public function __construct()	//Constructeur
	{
		$this->pklivre = "";
        $this->pkkeyword = "";
    }	
    
    public function getPkkeyword()
	{
			return $this->pkkeyword;
	}
	public function setPkkeyword($value)
	{
        $this->pkkeyword = $value;
    }
    public function getPklivre()
	{
			return $this->pklivre;
	}
	public function setPklivre($value)
	{
        $this->pklivre = $value;
    }
   
    
    public function __toString()
	{
		return "LivreKeyword[".$this->pklivre.",".$this->pkkeyword."]";
	}
    public function affiche()
	{
		echo $this->__toString();
    }
    public function loadFromArray($tab)
	{
		$this->pklivre = $tab["FKLIVRE"];
		$this->pkkeyword = $tab["FKKEYWORD"];
	}	
	public function loadFromObject($x)
	{
		$this->pklivre = $x->FKLIVRE;
        $this->pkkeyword = $x->FKKEYWORD;
	}
}