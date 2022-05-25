<?php


namespace database;

// pauzeplaatsen
// ID INT
// FKboekingenID INT (foreign key)
// FKrestaurantsID INT (foreign key)
// FKstatussenID INT (foreign key)

class Pauzeplaats
{
	private $id;
	private $fkboekingenid;
	private $fkrestaurantsid;
	private $fkstatussenid;

	public function __construct($id, $fkboekingenid, $fkrestaurantsid, $fkstatussenid)
	{
		$this->id = $id;
		$this->fkboekingenid = $fkboekingenid;
		$this->fkrestaurantsid = $fkrestaurantsid;
		$this->fkstatussenid = $fkstatussenid;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getFkboekingenid()
	{
		return $this->fkboekingenid;
	}

	public function getFkrestaurantsid()
	{
		return $this->fkrestaurantsid;
	}

	public function getFkstatussenid()
	{
		return $this->fkstatussenid;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function setFkboekingenid($fkboekingenid)
	{
		$this->fkboekingenid = $fkboekingenid;
	}

	public function setFkrestaurantsid($fkrestaurantsid)
	{
		$this->fkrestaurantsid = $fkrestaurantsid;
	}

	public function setFkstatussenid($fkstatussenid)
	{
		$this->fkstatussenid = $fkstatussenid;
	}
}