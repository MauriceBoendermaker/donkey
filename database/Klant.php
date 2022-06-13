<?php

namespace database;

// klanten
// ID INT
// Naam VARCHAR(50)
// Email VARCHAR(100)
// Telefoon VARCHAR(20)
// Wachtwoord VARCHAR(100)
// FKgebruikersrechtenID INT (foreign key)
// Gewijzigd TIMESTAMP

class Klant
{
	private $id;
	private $naam;
	private $email;
	private $telefoon;
	private $wachtwoord;
	private $FKgebruikersrechtenID;
	private $gewijzigd;

	public function __construct($id, $naam, $email, $telefoon, $wachtwoord, $FKgebruikersrechtenID, $gewijzigd)
	{
		$this->id = $id;
		$this->naam = $naam;
		$this->email = $email;
		$this->telefoon = $telefoon;
		$this->wachtwoord = $wachtwoord;
		$this->FKgebruikersrechtenID = $FKgebruikersrechtenID;
		$this->gewijzigd = $gewijzigd;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getNaam()
	{
		return $this->naam;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getTelefoon()
	{
		return $this->telefoon;
	}

	public function getWachtwoord()
	{
		return $this->wachtwoord;
	}

	public function getFKgebruikersrechtenID()
	{
		return $this->FKgebruikersrechtenID;
	}

	public function getGewijzigd()
	{
		return $this->gewijzigd;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setNaam($naam)
	{
		$this->naam = $naam;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function setTelefoon($telefoon)
	{
		$this->telefoon = $telefoon;
	}

	public function setWachtwoord($wachtwoord)
	{
		$this->wachtwoord = $wachtwoord;
	}

	public function setFKgebruikersrechtenID($FKgebruikersrechtenID)
	{
		$this->FKgebruikersrechtenID = $FKgebruikersrechtenID;
	}

	public function setGewijzigd($gewijzigd)
	{
		$this->gewijzigd = $gewijzigd;
	}

	public function save()
	{
		$db = new Database("localhost", "root", "", "donkey", null);
		$db->applyKlant($this, true);
	}
}