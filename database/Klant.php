<?php


namespace database;

// klanten
// ID INT
// Naam VARCHAR(50)
// Email VARCHAR(100)
// Telefoon VARCHAR(20)
// Wachtwoord VARCHAR(100)
// Gewijzigd TIMESTAMP

class Klant
{
	private $id;
	private $naam;
	private $email;
	private $telefoon;
	private $wachtwoord;
	private $gewijzigd;

	public function __construct($id, $naam, $email, $telefoon, $wachtwoord, $gewijzigd)
	{
		$this->id = $id;
		$this->naam = $naam;
		$this->email = $email;
		$this->telefoon = $telefoon;
		$this->wachtwoord = $wachtwoord;
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

	public function setGewijzigd($gewijzigd)
	{
		$this->gewijzigd = $gewijzigd;
	}
}