<?php

class Registre
{
    private $pkRegistre;
    private $fkExemplaire;
    private $fkDetenteur;
	private $date;

	public function __construct()	//Constructeur
	{
        require_once('./modele/classes/Time.class.php');
        require_once('./modele/configs/Constant.php');
		$this->pkRegistre = "";
        $this->fkExemplaire = "";
        $this->fkCompte = "";
        $this->date = Time::getDate_(Constant::TIMEZONE,'Y-m-d');
        $this->etat = "";
    }

    public function getPkRegistre()
	{
        return $this->pkRegistre;
	}
	public function setPkRegistre($value)
	{
        $this->pkRegistre = $value;
    }
    public function getFkExemplaire()
	{
        return $this->fkExemplaire;
	}
	public function setFkExemplaire($value)
	{
        $this->fkExemplaire = $value;
    }
    public function getFkDetenteur()
	{
        return $this->fkDetenteur;
	}
	public function setFkDetenteur($value)
	{
        $this->fkDetenteur = $value;
    }
    public function getDate()
	{
        return $this->date;
	}
	public function setDate($value)
	{
        $this->date = $value;
    }

	public function loadFromObject($x)
	{
        $this->pkRegistre = $x->PKREGISTRE;
        $this->fkExemplaire = $x->FKEXEMPLAIRE;
        $this->fkDetenteur = $x->FKDETENTEUR;
        $this->date = $x->DATE;
	}
}