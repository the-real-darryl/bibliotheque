<?php

class Exemplaire {

    private $pkExemplaire;
    private $fkLivre;
    private $fkProprietaire;
	private $fkDetenteur;
    private $creation;

	public function __construct()	//Constructeur
	{
		$this->pkExemplaire = "";
        $this->fkLivre = "";
        $this->fkProprietaire = "";
        $this->fkDetenteur = "";
    }

    public function getPkExemplaire()
	{
			return $this->pkExemplaire;
	}
	public function setPkExemplaire($value)
	{
        $this->pkExemplaire = $value;
    }
    public function getFkLivre()
	{
			return $this->fkLivre;
	}
	public function setFkLivre($value)
	{
        $this->fkLivre = $value;
    }
    public function getFkProprietaire()
	{
			return $this->fkProprietaire;
	}
	public function setFkProprietaire($value)
	{
        $this->fkProprietaire = $value;
    }
    public function getFkDetenteur()
	{
			return $this->fkDetenteur;
	}
	public function setFkDetenteur($value)
	{
        $this->fkDetenteur = $value;
    }
    public function getCreation()
	{
        return $this->creation;
	}
	public function setCreation($value)
	{
        $this->creation = $value;
    }

    public function __toString()
	{
		return "Exemplaire[".$this->pkExemplaire.",".$this->fkLivre.",".$this->fkProprietaire.",".$this->fkDetenteur."]";
	}
    public function affiche()
	{
		echo $this->__toString();
    }
    public function loadFromArray($tab)
	{
		$this->pkExemplaire = $tab["PKEXEMPLAIRE"];
		$this->fkLivre = $tab["FKLIVRE"];
		$this->fkProprietaire = $tab["FKPROPRIETAIRE"];
        $this->fkDetenteur = $tab["FKDETENTEUR"];
	}
	public function loadFromObject($x)
	{
		$this->pkExemplaire = $x->PKEXEMPLAIRE;
        $this->fkLivre = $x->FKLIVRE;
		$this->fkProprietaire = $x->FKPROPRIETAIRE;
        $this->fkDetenteur = $x->FKDETENTEUR;
	}
}