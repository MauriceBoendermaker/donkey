<?php

namespace database;

require_once 'boeking.php';
require_once 'herberg.php';
require_once 'klant.php';
require_once 'overnachting.php';
require_once 'pauzeplaats.php';
require_once 'restaurant.php';
require_once 'status.php';
require_once 'tocht.php';
require_once 'tracker.php';


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
    
    // boekingen
    // ID INT
    // StartDatum DATE
    // PINCode INT
    // FKtochtenID INT (foreign key)
    // FKklantenID INT (foreign key)
    // FKstatussenID INT (foreign key)
    public function getBoekingen() {
        $this->connect();
        $result = $this->db->query("SELECT * FROM boekingen");
        $boekingen = array();
        while ($row = $result->fetch_assoc()) {
            $boekingen[] = new Boeking($row["ID"], $row["StartDatum"], $row["PINCode"], $row["FKtochtenID"], $row["FKklantenID"], $row["FKstatussenID"]);
        }
        $this->close();
        return $boekingen;
    }
    
    public function getBoekingenByID($id) {
        $this->connect();
        $result = $this->db->query("SELECT * FROM boekingen WHERE ID = $id");
        $boekingen = array();
        while ($row = $result->fetch_assoc()) {
            $boekingen[] = new Boeking($row["ID"], $row["StartDatum"], $row["PINCode"], $row["FKtochtenID"], $row["FKklantenID"], $row["FKstatussenID"]);
        }
        $this->close();
        return $boekingen;
    }

    public function getBoekingenByKlantID($id) {
        $this->connect();
        $result = $this->db->query("SELECT * FROM boekingen WHERE FKklantenID = $id");
        $boekingen = array();
        while ($row = $result->fetch_assoc()) {
            $boekingen[] = new Boeking($row["ID"], $row["StartDatum"], $row["PINCode"], $row["FKtochtenID"], $row["FKklantenID"], $row["FKstatussenID"]);
        }
        $this->close();
        return $boekingen;
    }

    public function getBoekingenByStatusID($id) {
        $this->connect();
        $result = $this->db->query("SELECT * FROM boekingen WHERE FKstatussenID = $id");
        $boekingen = array();
        while ($row = $result->fetch_assoc()) {
            $boekingen[] = new Boeking($row["ID"], $row["StartDatum"], $row["PINCode"], $row["FKtochtenID"], $row["FKklantenID"], $row["FKstatussenID"]);
        }
        $this->close();
        return $boekingen;
    }

    public function setBoekingen($id, $startDatum, $pinCode, $fkTochtenID, $fkKlantenID, $fkStatussenID) {
        $this->connect();
        if (is_null($id)) {
            $result = $this->db->query("INSERT INTO boekingen (StartDatum, PINCode, FKtochtenID, FKklantenID, FKstatussenID) VALUES ('$startDatum', '$pinCode', '$fkTochtenID', '$fkKlantenID', '$fkStatussenID')");
        } else {
            $result = $this->db->query("UPDATE boekingen SET StartDatum = '$startDatum', PINCode = '$pinCode', FKtochtenID = '$fkTochtenID', FKklantenID = '$fkKlantenID', FKstatussenID = '$fkStatussenID' WHERE ID = $id");
        }
        $this->close();
    }

    // herbergen
    // ID INT
    // Naam VARCHAR(50)
    // Adres VARCHAR(50)
    // Email VARCHAR(100)
    // Telefoon VARCHAR(20)
    // Coordinaten VARCHAR(20)
    // Gewijzigd TIMESTAMP
    public function getHerbergen() {
        $this->connect();
        $result = $this->db->query("SELECT * FROM herbergen");
        $herbergen = array();
        while ($row = $result->fetch_assoc()) {
            $herbergen[] = new Herberg($row["ID"], $row["Omschrijving"], $row["Route"], $row["AantalDagen"]);
        }
        $this->close();
        return $herbergen;
    }

    public function getHerbergenByID($id) {
        $this->connect();
        $result = $this->db->query("SELECT * FROM herbergen WHERE ID = $id");
        $herbergen = array();
        while ($row = $result->fetch_assoc()) {
            $herbergen[] = new Herberg($row["ID"], $row["Omschrijving"], $row["Route"], $row["AantalDagen"]);
        }
        $this->close();
        return $herbergen;
    }

    // klanten
    // ID INT
    // Naam VARCHAR(50)
    // Email VARCHAR(100)
    // Telefoon VARCHAR(20)
    // Wachtwoord VARCHAR(100)
    // Gewijzigd TIMESTAMP
    public function getKlanten() {
        $this->connect();
        $result = $this->db->query("SELECT * FROM klanten");
        $klanten = array();
        while ($row = $result->fetch_assoc()) {
            $klanten[] = new Klant($row["ID"], $row["Voornaam"], $row["Achternaam"], $row["Email"], $row["Telefoonnummer"]);
        }
        $this->close();
        return $klanten;
    }

    public function getKlantenByID($id) {
        $this->connect();
        $result = $this->db->query("SELECT * FROM klanten WHERE ID = $id");
        $klanten = array();
        while ($row = $result->fetch_assoc()) {
            $klanten[] = new Klant($row["ID"], $row["Voornaam"], $row["Achternaam"], $row["Email"], $row["Telefoonnummer"]);
        }
        $this->close();
        return $klanten;
    }

    // overnachtingen
    // ID INT
    // FKboekingenID INT (foreign key)
    // FKherbergenID INT (foreign key)
    // FKstatussenID INT (foreign key)
    public function getOvernachtingen() {
        $this->connect();
        $result = $this->db->query("SELECT * FROM overnachtingen");
        $overnachtingen = array();
        while ($row = $result->fetch_assoc()) {
            $overnachtingen[] = new Overnachting($row["ID"], $row["FKboekingenID"], $row["FKherbergenID"], $row["FKstatussenID"]);
        }
        $this->close();
        return $overnachtingen;
    }
    
    public function getOvernachtingByID($id) {
        $this->connect();
        $result = $this->db->query("SELECT * FROM overnachtingen WHERE ID = $id");
        $overnachtingen = array();
        while ($row = $result->fetch_assoc()) {
            $overnachtingen[] = new Overnachting($row["ID"], $row["FKboekingenID"], $row["FKherbergenID"], $row["FKstatussenID"]);
        }
        $this->close();
        return $overnachtingen;
    }

    public function setOvernachting($id, $fkBoekingenID, $fkHerbergenID, $fkStatussenID) {
        $this->connect();
        if (is_null($id)) {
            $result = $this->db->query("INSERT INTO overnachtingen (FKboekingenID, FKherbergenID, FKstatussenID) VALUES ('$fkBoekingenID', '$fkHerbergenID', '$fkStatussenID')");
        } else {
            $result = $this->db->query("UPDATE overnachtingen SET FKboekingenID = '$fkBoekingenID', FKherbergenID = '$fkHerbergenID', FKstatussenID = '$fkStatussenID' WHERE ID = $id");
        }
        $this->close();
    }

    // pauzeplaatsen
    // ID INT
    // FKboekingenID INT (foreign key)
    // FKrestaurantsID INT (foreign key)
    // FKstatussenID INT (foreign key)

	public function getPauzeplaatsen() {
		$this->connect();
		$result = $this->db->query("SELECT * FROM pauzeplaatsen");
		$pauzeplaatsen = array();
		while ($row = $result->fetch_assoc()) {
			$pauzeplaatsen[] = new Pauzeplaats($row["ID"], $row["FKboekingenID"], $row["FKrestaurantsID"], $row["FKstatussenID"]);
		}
		$this->close();
		return $pauzeplaatsen;
	}

	public function getPauzeplaatsByID($id) {
		$this->connect();
		$result = $this->db->query("SELECT * FROM pauzeplaatsen WHERE ID = $id");
		$pauzeplaatsen = array();
		while ($row = $result->fetch_assoc()) {
			$pauzeplaatsen[] = new Pauzeplaats($row["ID"], $row["FKboekingenID"], $row["FKrestaurantsID"], $row["FKstatussenID"]);
		}
		$this->close();
		return $pauzeplaatsen;
	}

	public function setPauzeplaats($id, $fkBoekingenID, $fkRestaurantsID, $fkStatussenID) {
		$this->connect();
		if (is_null($id)) {
			$result = $this->db->query("INSERT INTO pauzeplaatsen (FKboekingenID, FKrestaurantsID, FKstatussenID) VALUES ('$fkBoekingenID', '$fkRestaurantsID', '$fkStatussenID')");
		} else {
			$result = $this->db->query("UPDATE pauzeplaatsen SET FKboekingenID = '$fkBoekingenID', FKrestaurantsID = '$fkRestaurantsID', FKstatussenID = '$fkStatussenID' WHERE ID = $id");
		}
		$this->close();
	}

    // restaurants
    // ID INT
    // Naam VARCHAR(50)
    // Adres VARCHAR(50)
    // Email VARCHAR(50)
    // Telefoon VARCHAR(20)
    // Coordinaten VARCHAR(20)
    // Gewijzigd TIMESTAMP
    public function getRestaurants() {
        $this->connect();
        $result = $this->db->query("SELECT * FROM restaurants");
        $restaurants = array();
        while ($row = $result->fetch_assoc()) {
            $restaurants[] = new Restaurant($row["ID"], $row["Naam"], $row["Adres"], $row["Email"], $row["Telefoonnummer"]);
        }
        $this->close();
        return $restaurants;
    }

    public function getRestaurantsByID($id) {
        $this->connect();
        $result = $this->db->query("SELECT * FROM restaurants WHERE ID = $id");
        $restaurants = array();
        while ($row = $result->fetch_assoc()) {
            $restaurants[] = new Restaurant($row["ID"], $row["Naam"], $row["Adres"], $row["Email"], $row["Telefoonnummer"]);
        }
        $this->close();
        return $restaurants;
    }

    public function setRestaurant($id, $naam, $adres, $email, $telefoonnummer) {
        $this->connect();
        if (is_null($id)) {
            $result = $this->db->query("INSERT INTO restaurants (Naam, Adres, Email, Telefoonnummer) VALUES ('$naam', '$adres', '$email', '$telefoonnummer')");
        } else {
            $result = $this->db->query("UPDATE restaurants SET Naam = '$naam', Adres = '$adres', Email = '$email', Telefoonnummer = '$telefoonnummer' WHERE ID = $id");
        }
        $this->close();
    }

    // statussen
    // ID INT
    // StatusCode TINYINT(4)
    // Status VARCHAR(40)
    // Verwijderbaar BIT
    // PINtoekennen BIT
    public function getStatussen() {
        $this->connect();
        $result = $this->db->query("SELECT * FROM statussen");
        $statussen = array();
        while ($row = $result->fetch_assoc()) {
            $statussen[] = new Status($row["ID"], $row["StatusCode"], $row["Status"], boolval($row["Verwijderbaar"]), boolval($row["PINtoekennen"]));
        }
        $this->close();
        return $statussen;
    }

    public function getStatussenByID($id) {
        $this->connect();
        $result = $this->db->query("SELECT * FROM statussen WHERE ID = $id");
        $statussen = array();
        while ($row = $result->fetch_assoc()) {
            $statussen[] = new Status($row["ID"], $row["StatusCode"], $row["Status"], boolval($row["Verwijderbaar"]), boolval($row["PINtoekennen"]));
        }
        $this->close();
        return $statussen;
    }
    
    // tochten
    // ID INT
    // Omschrijving VARCHAR(40)
    // Route VARCHAR(50)
    // AantalDagen INT
    public function getTochten() {
        $this->connect();
        $result = $this->db->query("SELECT * FROM tochten");
        $tochten = array();
        while ($row = $result->fetch_assoc()) {
            $tochten[] = new Tocht($row["ID"], $row["Omschrijving"], $row["AantalPersonen"], $row["Prijs"]);
        }
        $this->close();
        return $tochten;
    }

    public function getTochtByID($id) {
        $this->connect();
        $result = $this->db->query("SELECT * FROM tochten WHERE ID = $id");
        $tochten = array();
        while ($row = $result->fetch_assoc()) {
            $tochten[] = new Tocht($row["ID"], $row["Omschrijving"], $row["AantalPersonen"], $row["Prijs"]);
        }
        $this->close();
        return $tochten;
    }

    public function setTocht($id, $omschrijving, $aantalPersonen, $prijs) {
        $this->connect();
        if (is_null($id)) {
            $result = $this->db->query("INSERT INTO tochten (Omschrijving, AantalPersonen, Prijs) VALUES ('$omschrijving', $aantalPersonen, $prijs)");
        } else {
            $result = $this->db->query("UPDATE tochten SET Omschrijving = '$omschrijving', AantalPersonen = $aantalPersonen, Prijs = $prijs WHERE ID = $id");
        }
        $this->close();
    }

    // trackers
    // ID INT
    // PINCode INT
    // Lat DOUBLE
    // Lon DOUBLE
    // Time BIGINT(20)
    public function getTrackers() {
        $this->connect();
        $result = $this->db->query("SELECT * FROM trackers");
        $trackers = array();
        while ($row = $result->fetch_assoc()) {
            $trackers[] = new Tracker($row["ID"], $row["PINCode"], $row["Lat"], $row["Lon"], $row["Time"]);
        }
        $this->close();
        return $trackers;
    }

    public function getTrackerByID($id) {
        $this->connect();
        $result = $this->db->query("SELECT * FROM trackers WHERE ID = $id");
        $trackers = array();
        while ($row = $result->fetch_assoc()) {
            $trackers[] = new Tracker($row["ID"], $row["PINCode"], $row["Lat"], $row["Lon"], $row["Time"]);
        }
        $this->close();
        return $trackers;
    }

    public function setTracker($id, $pin, $lat, $lon, $time) {
        $this->connect();
        if (is_null($id)) {
            $result = $this->db->query("INSERT INTO trackers (PINCode, Lat, Lon, Time) VALUES ($pin, $lat, $lon, $time)");
        } else {
            $result = $this->db->query("UPDATE trackers SET PINCode = $pin, Lat = $lat, Lon = $lon, Time = $time WHERE ID = $id");
        }
        $this->close();
    }
}