<?php


namespace database;


class Boeking
{
	private $id;
	private $startDatum;
	private $pincode;
	private $fkTochtenID;
	private $fkKlantenID;
	private $fkStatussenID;

	public function __construct($id, $startDatum, $pincode, $fkTochtenID, $fkKlantenID, $fkStatussenID)
	{
		$this->id = $id;
		$this->startDatum = $startDatum;
		$this->pincode = $pincode;
		$this->fkTochtenID = $fkTochtenID;
		$this->fkKlantenID = $fkKlantenID;
		$this->fkStatussenID = $fkStatussenID;
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

	public function getFkTochtenID()
	{
		return $this->fkTochtenID;
	}

	public function getFkKlantenID()
	{
		return $this->fkKlantenID;
	}

	public function getFkStatussenID()
	{
		return $this->fkStatussenID;
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

	public function setFkTochtenID($fkTochtenID)
	{
		$this->fkTochtenID = $fkTochtenID;
	}

	public function setFkKlantenID($fkKlantenID)
	{
		$this->fkKlantenID = $fkKlantenID;
	}

	public function setFkStatussenID($fkStatussenID)
	{
		$this->fkStatussenID = $fkStatussenID;
	}
}