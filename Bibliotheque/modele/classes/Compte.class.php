<?php
class Compte {
    private $email;
    private $nom;
    private $prenom;
	private $password;
	private $actif;
	private $creation;
	private $modification;
	private $admin;
	
	public function __construct()	//Constructeur
	{
        $this->email = "";
        $this->nom = "";
        $this->prenom = "";
		$this->password = "";
		$this->actif = "";
        $this->creation = "";
		$this->modification = "";
		$this->admin = "";
	}	

	
	public function getEmail()
	{
			return $this->email;
	}
	
	public function setEmail($value)
	{
        $this->email = $value;
	}
	
    public function getNom()
	{
			return $this->nom;
	}
	
	public function setNom($value)
	{
        $this->nom = $value;
    }
    public function getPrenom()
	{
			return $this->prenom;
	}
	
	public function setPrenom($value)
	{
        $this->prenom = $value;
    }
    public function getPassword()
	{
			return $this->password;
	}
	
	public function setPassword($value)
	{
        $this->password = $value;
	}

	public function getActif()
	{
			return $this->actif;
	}
	
	public function setActif($value)
	{
        $this->actif = $value;
    }
    public function getCreation()
	{
			return $this->creation;
	}
	
	public function setCreation($value)
	{
        $this->creation = $value;
    }
    public function getModification()
	{
			return $this->modification;
	}
	
	public function setModification($value)
	{
        $this->modification = $value;
	}

	public function getAdmin()
	{
			return $this->admin;
	}
	
	public function setAdmin($value)
	{
        $this->admin = $value;
	}
    
	
	public function __toString()
	{
		return "Compte[".$this->email.",".$this->nom.",".$this->prenom.",".$this->password.",".$this->actif.",".$this->creation.",".$this->modification.",".$this->admin."]";
	}

	public function affiche()
	{
		echo $this->__toString();
	}
	
	public function loadFromArray($tab)
	{
		$this->email = $tab["E_MAIL"];
		$this->nom = $tab["NOM"];
        $this->prenom = $tab["PRENOM"];
		$this->password = $tab["PASSWORD"];
		$this->actif = $tab["ACTIF"];
        $this->creation = $tab["DCREATION"];
		$this->modification = $tab["DMODIFICATION"];
		$this->admin = $tab["ADMIN"];
	}	
	public function loadFromObject($x)
	{
        $this->email = $x->E_MAIL;
		$this->nom = $x->NOM;
        $this->prenom = $x->PRENOM;
		$this->password = $x->PASSWORD;
		$this->actif = $x->ACTIF;
        $this->creation = $x->DCREATION;
		$this->modification = $x->DMODIFICATION;
		$this->admin = $x->ADMIN;
	}	

	public function copyConstructor($x)
	{
        $this->email = $x->getEmail();
		$this->nom = $x->getNom();
        $this->prenom = $x->getPrenom();
		$this->password = $x->getPassword();
		$this->actif = $x->getActif();
        $this->creation = $x->getCreation();
		$this->modification = $x->getModification();
		$this->admin = $x->getAdmin();
	}	
	
	
	public function loadFromFormulaire($tab)
	{
		$this->email = $tab["e_mail"];
		$this->nom = $tab["last_name"];
        $this->prenom = $tab["first_name"];
		$this->password = $tab["password"];
		$this->actif = $tab["active"];
		$this->admin = $tab["admin"];
	}
}
