<?php
class Livre {
    private $isbn;
    private $titre;
    private $auteur;
    private $noedition;
    private $maisonedition;
    private $langue;
    private $parution;
    private $couverture;

    private $arrayMotsCles;
    private $arraySujets;
    private $arrayExemplaires;

    public function __construct(/*$isbn, $titre, $auteur, $noedition, $maisonedition, $langue, $parution, $couverture*/) {
        $this->isbn = "";//$isbn;
        $this->titre = "";//$titre;
        $this->auteur = "";//$auteur;
        $this->noedition = "";//$noedition;
        $this->maisonedition = "";//$maisonedition;
        $this->langue = "";//$langue;
        $this->parution = "";//$parution;
        $this->couverture = "";//$couverture;
        $this->arrayMotsCles = "";
        $this->arraySujets = "";
        $this->arrayExemplaires = "";
    }

    public function getIsbn() {
        return $this->isbn;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getAuteur() {
        return $this->auteur;
    }

    public function getNoedition() {
        return $this->noedition;
    }

    public function getMaisonedition() {
        return $this->maisonedition;
    }

    public function getLangue() {
        return $this->langue;
    }

    public function getParution() {
        return $this->parution;
    }

    public function getCouverture() {
        return $this->couverture;
    }

    public function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function setAuteur($auteur) {
        $this->auteur = $auteur;
    }

    public function setNoedition($noedition) {
        $this->noedition = $noedition;
    }

    public function setMaisonedition($maisonedition) {
        $this->maisonedition = $maisonedition;
    }

    public function setLangue($langue) {
        $this->langue = $langue;
    }

    public function setParution($parution) {
        $this->parution = $parution;
    }

    public function setCouverture($couverture) {
        $this->couverture = $couverture;
    }
    public function getArrayMotsCles() {
        return $this->arrayMotsCles;
    }
    public function setArrayMotsCles($arrayMotsCles) {
        $this->arrayMotsCles = $arrayMotsCles;
    }
    public function getArraySujets() {
        return $this->arraySujets;
    }
    public function setArraySujets($arraySujets) {
        $this->arraySujets = $arraySujets;
    }

    public function getArrayExemplaires() {
        return $this->arraySujets;
    }
    public function setArrayExemplaires($arrayExemplaires) {
        $this->arrayExemplaires = $arrayExemplaires;
    }


	public function __toString()
	{
        return "Livre[".$this->isbn.",".$this->titre.",".$this->auteur.",</br>".$this->noedition.",".$this->maisonedition.","
                        .$this->langue.",".$this->parution.",".$this->couverture."]";
	}

	public function affiche()
	{
		echo $this->__toString();
	}

	public function loadFromArray($tab)
	{
        $this->isbn = $tab["ISBN"];
        $this->titre = $tab["TITRE"];
        $this->auteur = $tab["AUTEUR"];
        $this->noedition = $tab["NOEDITION"];
        $this->maisonedition = $tab["MAISON_EDITION"];
        $this->langue = $tab["LANGUE"];
        $this->parution = $tab["PARUTION"];
        $this->couverture = $tab["COUVERTURE"];
	}
	public function loadFromObject($x)
	{
        $this->isbn = $x->ISBN;
        $this->titre = $x->TITRE;
        $this->auteur = $x->AUTEUR;
        $this->noedition = $x->NOEDITION;
        $this->maisonedition = $x->MAISON_EDITION;
        $this->langue = $x->LANGUE;
        $this->parution = $x->PARUTION;
        $this->couverture = $x->COUVERTURE;
	}

}

