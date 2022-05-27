<?php


namespace database;


class Boeking
{
	private $id;
	private $startDatum;
	private $pincode;
	private $tocht;
	private $klant;
	private $status;

	public function __construct($id, $startDatum, $pincode, $tocht, $klant, $status)
	{
		$this->id = $id;
		$this->startDatum = $startDatum;
		$this->pincode = $pincode;
		$this->tocht = $tocht;
		$this->klant = $klant;
		$this->status = $status;
	}

	// -= Get functions =-

	public function getID()
	{
		return $this->id;
	}

	public function getStartDatum()
	{
		return $this->startDatum;
	}

	public function getPincode()
	{
		return $this->pincode;
	}

	public function getTocht()
	{
		return $this->tocht;
	}

	public function getKlant()
	{
		return $this->klant;
	}

	public function getStatus()
	{
		return $this->status;
	}

	// -= Set functions =-
	public function setID($id)
	{
		$this->id = $id;
	}

	public function setStartDatum($startDatum)
	{
		$this->startDatum = $startDatum;
	}

	public function setPincode($pincode)
	{
		$this->pincode = $pincode;
	}

	public function setTocht($tocht)
	{
		$this->tocht = $tocht;
	}

	public function setKlant($klant)
	{
		$this->klant = $klant;
	}

	public function setStatus($status)
	{
		$this->status = $status;
	}
}