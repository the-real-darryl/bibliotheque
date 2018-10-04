<?php

class Evaluation {

    private $PKEVALUATION;
    private $RATING_EV;
    private $COMMENTAIRE;
	private $FKCOMPTE;
	private $FKLIVRE;
	private $CREATION;


	public function __construct()	//Constructeur
	{
		$this->PKEVALUATION= 0;
        $this->RATING_EV = "";
        $this->COMMENTAIRE = "";
        $this->FKCOMPTE = "";
		$this->FKLIVRE = "";
		$this->CREATION = "";
    }

    public function getPkevaluation()
	{
        return $this->PKEVALUATION;
	}
	public function setPkevaluation($value)
	{
        $this->PKEVALUATION = $value;
    }
    public function getRating_ev()
	{
        return $this->RATING_EV;
	}
	public function setRating_ev($value)
	{
        $this->RATING_EV = $value;
    }
    public function getCommentaire()
	{
        return $this->COMMENTAIRE;
	}
	public function setCommentaire($value)
	{
        $this->COMMENTAIRE = $value;
    }
    public function getFkCompte()
	{
        return $this->FKCOMPTE;
	}
	public function setFkCompte($value)
	{
        $this->FKCOMPTE = $value;
    }
    public function getFkLivre()
	{
        return $this->FKLIVRE;
	}
	public function setFkLivre($value)
	{
        $this->FKLIVRE = $value;
	}
	public function getCreation()
	{
        return $this->CREATION;
	}
	public function setCreation($value)
	{
        $this->CREATION = $value;
    }
    public function __toString()
	{
		return "Evaluation[".$this->PKEVALUATION.",".$this->RATING_EV.",".$this->COMMENTAIRE.",".$this->FKCOMPTE.",".$this->FKLIVRE.",".$this->CREATION."]";
	}
    public function affiche()
	{
		echo $this->__toString();
    }
    public function loadFromArray($tab)
	{
		$this->PKEVALUATION   = $tab["PKEVALUATION"];
		$this->RATING_EV      = $tab["RATING_EV"];
		$this->COMMENTAIRE    = $tab["COMMENTAIRE"];
        $this->FKCOMPTE    = $tab["FKCOMPTE"];
		$this->FKLIVRE           = $tab["FKLIVRE"];
		$this->CREATION = $tab["CREATION"];
	}
	public function loadFromObject($x)
	{
		$this->PKEVALUATION   = $x->PKEVALUATION;
        $this->RATING_EV      = $x->RATING_EV;
		$this->COMMENTAIRE    = $x->COMMENTAIRE;
        $this->FKCOMPTE    = $x->FKCOMPTE;
		$this->FKLIVRE           = $x->FKLIVRE;
		$this->CREATION = $x->CREATION;

	}
}