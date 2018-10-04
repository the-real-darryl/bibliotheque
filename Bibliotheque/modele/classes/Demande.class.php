<?php

class Demande {

    private $pkDemande;
    private $fkExemplaire;
    private $fkCompte;
	private $date;
    private $etat;

	public function __construct()	//Constructeur
	{
        require_once('./modele/classes/Time.class.php');
        require_once('./modele/configs/Constant.php');
		$this->pkDemande = "";
        $this->fkExemplaire = "";
        $this->fkCompte = "";
        $this->date = Time::getDate_(Constant::TIMEZONE,'Y-m-d');
        $this->etat = "";
    }

    public function getPkDemande()
	{
        return $this->pkDemande;
	}
	public function setPkDemande($value)
	{
        $this->pkDemande = $value;
    }
    public function getFkExemplaire()
	{
        return $this->fkExemplaire;
	}
	public function setFkExemplaire($value)
	{
        $this->fkExemplaire = $value;
    }
    public function getFkCompte()
	{
        return $this->fkCompte;
	}
	public function setFkCompte($value)
	{
        $this->fkCompte = $value;
    }
    public function getDate()
	{
        return $this->date;
	}
	public function setDate($value)
	{
        $this->date = $value;
    }

    public function getEtat()
	{
        return $this->etat;
	}
	public function setEtat($value)
	{
        $this->etat = $value;
    }

	public function loadFromObject($x)
	{
        $this->pkDemande = $x->PKDEMANDE;
        $this->fkExemplaire = $x->FKEXEMPLAIRE;
        $this->fkCompte = $x->FKCOMPTE;
        $this->date = $x->DATE;
        $this->etat = $x->ETAT;
	}
}