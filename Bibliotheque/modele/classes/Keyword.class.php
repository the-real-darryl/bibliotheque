<?php

class Keyword {

    private $pkkeyword;
    private $keyworddesc;
	
	public function __construct()	//Constructeur
	{
		$this->pkkeyword = "";
        $this->keyworddesc = "";
    }	
    
    public function getPkkeyword()
	{
			return $this->pkkeyword;
	}
	public function setPkkeyword($value)
	{
        $this->pkkeyword = $value;
    }
    public function getKeyworddesc()
	{
			return $this->keyworddesc;
	}
	public function setKeyworddesc($value)
	{
        $this->keyworddesc = $value;
    }
   
    
    public function __toString()
	{
		return "Keyword[".$this->pkkeyword.",".$this->keyworddesc."]";
	}
    public function affiche()
	{
		echo $this->__toString();
    }
    public function loadFromArray($tab)
	{
		$this->pkkeyword = $tab["PKKEYWORD"];
		$this->keyworddesc = $tab["KEYWORDDESC"];
	}	
	public function loadFromObject($x)
	{
		$this->pkkeyword = $x->PKKEYWORD;
        $this->keyworddesc = $x->KEYWORDDESC;
	}
}