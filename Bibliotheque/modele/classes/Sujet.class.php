<?php

class Keyword {

    private $pksujet;
    private $sujetdesc;
	
	public function __construct()	//Constructeur
	{
		$this->pksujet = "";
        $this->sujetdesc = "";
    }	
    
    public function getPksujet()
	{
			return $this->pksujet;
	}
	public function setPksujet($value)
	{
        $this->pksujet = $value;
    }
    public function getSujetdesc()
	{
			return $this->sujetdesc;
	}
	public function setSujetdesc($value)
	{
        $this->sujetdesc = $value;
    }
   
    
    public function __toString()
	{
		return "Keyword[".$this->pksujet.",".$this->sujetdesc."]";
	}
    public function affiche()
	{
		echo $this->__toString();
    }
    public function loadFromArray($tab)
	{
		$this->pk = $tab["PKSUJET"];
		$this->email = $tab["SUJETDESC"];
	}	
	public function loadFromObject($x)
	{
		$this->pk = $x->PKSUJET;
        $this->email = $x->SUJETDESC;
	}
}
//http://www.dofactory.com/sql/join
//http://www.sql-join.com/