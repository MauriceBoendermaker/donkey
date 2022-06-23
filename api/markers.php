<?php

//GEOJSON:
//{
//  "type": "Feature",
//  "geometry": {
//    "type": "Point",
//    "coordinates": [125.6, 10.1]
//  },
//  "properties": {
//    "name": "Dinagat Islands"
//  }
//}

header('Content-Type: application/json');
require_once('./config.php');
require_once('./database/database.php');

$db = new database\Database($db_host, $db_user, $db_pass, $db_name, $db_port);

$json = array();

if (!isset($_GET['pin'])) { 
    // No pincode specified so get normal markers

    $json["type"] = "FeatureCollection";
    $json["features"] = array();

    $restaurants = $db->getRestaurants();
    $herbergen = $db->getHerbergen();

    foreach ($restaurants as $restaurant) {
        $feature = array();

        $feature['type'] = "Feature";

        $coordsCleaned = preg_replace("/[^0-9. ]/", "", $restaurant->getCoordinaten());
        $coords = explode(' ', trim($coordsCleaned));

        if (count($coords) != 2) continue;

        $feature['properties']['name'] = $restaurant->getNaam();
        $feature['properties']['marker_symbol'] = "restaurant";
        $feature['properties']['marker_color'] = "#ff0000";
        $feature['properties']['popupContent'] = "Restaurant";

        $feature['geometry']['type'] = "Point";
        $feature['geometry']['coordinates'] = array(floatval($coords[0]), floatval($coords[1]));
        
        array_push($json['features'], $feature);
    }

    foreach ($herbergen as $herberg) {
        $feature = array();

        $feature['type'] = "Feature";

        $coordsCleaned = preg_replace("/[^0-9. ]/", "", $herberg->getCoordinaten());
        $coords = explode(' ', trim($coordsCleaned));

        if (count($coords) != 2) continue;

        $feature['properties']['name'] = $herberg->getNaam();
        $feature['properties']['marker_symbol'] = "hostel";
        $feature['properties']['marker_color'] = "#00ff00";
        $feature['properties']['popupContent'] = "Herberg";

        $feature['geometry']['type'] = "Point";
        $feature['geometry']['coordinates'] = array(floatval($coords[0]), floatval($coords[1]));

        array_push($json['features'], $feature);
    }
}
else
{
    // Pincode specified so show tracker if correct;
    $tracker = $db->getTrackerByPincode($_GET['pin']);
    if (!is_null($tracker))
    {
        $json['coordinates'] = array(floatval($tracker->getLat()), floatval($tracker->getLon()));
        $json['time'] = $tracker->getTime();
    }
}

echo json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);