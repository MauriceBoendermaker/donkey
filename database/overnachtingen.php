<?php


namespace database;


// overnachtingen
// ID INT
// FKboekingenID INT (foreign key)
// FKherbergenID INT (foreign key)
// FKstatussenID INT (foreign key)
class Overnachting {
    private $id;
    private $fkboekingenid;
    private $fkherbergenid;
    private $fkstatussenid;

    public function __construct($id, $fkboekingenid, $fkherbergenid, $fkstatussenid) {
        $this->id = $id;
        $this->fkboekingenid = $fkboekingenid;
        $this->fkherbergenid = $fkherbergenid;
        $this->fkstatussenid = $fkstatussenid;
    }

    public function getId() {
        return $this->id;
    }

    public function getFkboekingenid() {
        return $this->fkboekingenid;
    }

    public function getFkherbergenid() {
        return $this->fkherbergenid;
    }

    public function getFkstatussenid() {
        return $this->fkstatussenid;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setFkboekingenid($fkboekingenid) {
        $this->fkboekingenid = $fkboekingenid;
    }

    public function setFkherbergenid($fkherbergenid) {
        $this->fkherbergenid = $fkherbergenid;
    }

    public function setFkstatussenid($fkstatussenid) {
        $this->fkstatussenid = $fkstatussenid;
    }
}