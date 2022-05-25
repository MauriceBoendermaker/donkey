<?php
// boekingen
// ID INT
// StartDatum DATE
// PINCode INT
// FKtochtenID INT (foreign key)
// FKklantenID INT (foreign key)
// FKstatussenID INT (foreign key)

// herbergen
// ID INT
// Naam VARCHAR(50)
// Adres VARCHAR(50)
// Email VARCHAR(100)
// Telefoon VARCHAR(20)
// Coordinaten VARCHAR(20)
// Gewijzigd TIMESTAMP

// klanten
// ID INT
// Naam VARCHAR(50)
// Email VARCHAR(100)
// Telefoon VARCHAR(20)
// Wachtwoord VARCHAR(100)
// Gewijzigd TIMESTAMP

// overnachtingen
// ID INT
// FKboekingenID INT (foreign key)
// FKherbergenID INT (foreign key)
// FKstatussenID INT (foreign key)

// pauzeplaatsen
// ID INT
// FKboekingenID INT (foreign key)
// FKrestaurantsID INT (foreign key)
// FKstatussenID INT (foreign key)

// restaurants
// ID INT
// Naam VARCHAR(50)
// Adres VARCHAR(50)
// Email VARCHAR(50)
// Telefoon VARCHAR(20)
// Coordinaten VARCHAR(20)
// Gewijzigd TIMESTAMP

// statussen
// ID INT
// StatusCode TINYINT(4)
// Status VARCHAR(40)
// Verwijderbaar BIT
// PINtoekennen BIT

// tochten
// ID INT
// Omschrijving VARCHAR(40)
// Route VARCHAR(50)
// AantalDagen INT

// trackers
// ID INT
// PINCode INT
// Lat DOUBLE
// Lon DOUBLE
// Time BIGINT(20)

namespace database;

class Database {
    private $db;
    private $host;
    private $user;
    private $password;
    private $database;
    private $port;
    
    public function __construct($host, $user, $password, $database, $port) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
        $this->port = $port;
    }
    
    public function connect() {
        $this->db = new \mysqli($this->host, $this->user, $this->password, $this->database, $this->port);
        if ($this->db->connect_errno) {
            echo "Failed to connect to MySQL: (" . $this->db->connect_errno . ") " . $this->db->connect_error;
        }
    }
    
    public function close() {
        $this->db->close();
    }
    
    public function getBoekingen() {
        $this->connect();
        $result = $this->db->query("SELECT * FROM boekingen");
        $boekingen = array();
        while ($row = $result->fetch_assoc()) {
            $boekingen[] = new Boekingen($row["ID"], $row["StartDatum"], $row["PINCode"], $row["FKtochtenID"], $row["FKklantenID"], $row["FKstatussenID"]);
        }
        $this->close();
        return $boekingen;
    }
    
    public function getBoekingenByID($id) {
        $this->connect();
        $result = $this->db->query("SELECT * FROM boekingen WHERE ID = $id");
        $boekingen = array();
        while ($row = $result->fetch_assoc()) {
            $boekingen[] = new Boekingen($row["ID"], $row["StartDatum"], $row["PINCode"], $row["FKtochtenID"], $row["FKklantenID"], $row["FKstatussenID"]);
        }
        $this->close();
        return $boekingen;
    }

    public function getBoekingenByKlantID($id) {
        $this->connect();
        $result = $this->db->query("SELECT * FROM boekingen WHERE FKklantenID = $id");
        $boekingen = array();
        while ($row = $result->fetch_assoc()) {
            $boekingen[] = new Boekingen($row["ID"], $row["StartDatum"], $row["PINCode"], $row["FKtochtenID"], $row["FKklantenID"], $row["FKstatussenID"]);
        }
        $this->close();
        return $boekingen;
    }

    public function getBoekingenByStatusID($id) {
        $this->connect();
        $result = $this->db->query("SELECT * FROM boekingen WHERE FKstatussenID = $id");
        $boekingen = array();
        while ($row = $result->fetch_assoc()) {
            $boekingen[] = new Boekingen($row["ID"], $row["StartDatum"], $row["PINCode"], $row["FKtochtenID"], $row["FKklantenID"], $row["FKstatussenID"]);
        }
        $this->close();
        return $boekingen;
    }

    public function getHerbergen() {
        $this->connect();
        $result = $this->db->query("SELECT * FROM herbergen");
        $herbergen = array();
        while ($row = $result->fetch_assoc()) {
            $herbergen[] = new Herbergen($row["ID"], $row["Omschrijving"], $row["Route"], $row["AantalDagen"]);
        }
        $this->close();
        return $herbergen;
    }

    public function getHerbergenByID($id) {
        $this->connect();
        $result = $this->db->query("SELECT * FROM herbergen WHERE ID = $id");
        $herbergen = array();
        while ($row = $result->fetch_assoc()) {
            $herbergen[] = new Herbergen($row["ID"], $row["Omschrijving"], $row["Route"], $row["AantalDagen"]);
        }
        $this->close();
        return $herbergen;
    }

    public function getKlanten() {
        $this->connect();
        $result = $this->db->query("SELECT * FROM klanten");
        $klanten = array();
        while ($row = $result->fetch_assoc()) {
            $klanten[] = new Klanten($row["ID"], $row["Voornaam"], $row["Achternaam"], $row["Email"], $row["Telefoonnummer"]);
        }
        $this->close();
        return $klanten;
    }

    public function getKlantenByID($id) {
        $this->connect();
        $result = $this->db->query("SELECT * FROM klanten WHERE ID = $id");
        $klanten = array();
        while ($row = $result->fetch_assoc()) {
            $klanten[] = new Klanten($row["ID"], $row["Voornaam"], $row["Achternaam"], $row["Email"], $row["Telefoonnummer"]);
        }
        $this->close();
        return $klanten;
    }

    public function getStatussen() {
        $this->connect();
        $result = $this->db->query("SELECT * FROM statussen");
        $statussen = array();
        while ($row = $result->fetch_assoc()) {
            $statussen[] = new Statussen($row["ID"], $row["StatusCode"], $row["Verwijderbaar"], $row["PINToekennen"]);
        }
        $this->close();
        return $statussen;
    }

    public function getStatussenByID($id) {
        $this->connect();
        $result = $this->db->query("SELECT * FROM statussen WHERE ID = $id");
        $statussen = array();
        while ($row = $result->fetch_assoc()) {
            $statussen[] = new Statussen($row["ID"], $row["StatusCode"], $row["Verwijderbaar"], $row["PINToekennen"]);
        }
        $this->close();
        return $statussen;
    }

    public function getTochten() {
        $this->connect();
        $result = $this->db->query("SELECT * FROM tochten");
        $tochten = array();
        while ($row = $result->fetch_assoc()) {
            $tochten[] = new Tochten($row["ID"], $row["Omschrijving"], $row["AantalPersonen"], $row["Prijs"]);
        }
        $this->close();
        return $tochten;
    }

    public function getTochtenByID($id) {
        $this->connect();
        $result = $this->db->query("SELECT * FROM tochten WHERE ID = $id");
        $tochten = array();
        while ($row = $result->fetch_assoc()) {
            $tochten[] = new Tochten($row["ID"], $row["Omschrijving"], $row["AantalPersonen"], $row["Prijs"]);
        }
        $this->close();
        return $tochten;
    }

    public function getTrackers() {
        $this->connect();
        $result = $this->db->query("SELECT * FROM trackers");
        $trackers = array();
        while ($row = $result->fetch_assoc()) {
            $trackers[] = new Trackers($row["ID"], $row["PINCode"], $row["Lat"], $row["Lon"], $row["Time"]);
        }
        $this->close();
        return $trackers;
    }
}

class Boekingen
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