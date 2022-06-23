<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
</head>

<body>
    <div id="map" style="height: 100vh;"></div>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-gpx/1.7.0/gpx.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var map = L.map('map');
        L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="http://www.osm.org">OpenStreetMap</a>'
        }).addTo(map);

        /*
        var myIcon = L.icon({
            iconUrl: 'ezel met huifkar.png',
            iconSize: [75, 75],
            iconAnchor: [22, 94],
            popupAnchor: [-3, -76],
            shadowSize: [68, 95],
            shadowAnchor: [22, 94]
        });

        var marker = L.marker([51.5, -0.09], {
            icon: myIcon
        }).addTo(map);
        */

        var gpx = './test.gpx'; // URL to your GPX file or the GPX itself
        new L.GPX(gpx, {
            async: true,
            marker_options: {
                startIconUrl: 'https://raw.githubusercontent.com/mpetazzoni/leaflet-gpx/main/pin-icon-start.png',
                endIconUrl: 'https://raw.githubusercontent.com/mpetazzoni/leaflet-gpx/main/pin-icon-end.png',
                shadowUrl: 'https://raw.githubusercontent.com/mpetazzoni/leaflet-gpx/main/pin-shadow.png',
                wptIconUrls: {
                    '': 'ezel met huifkar.png'
                }
            }
        }).on('loaded', function(e) {
            map.fitBounds(e.target.getBounds());
        }).addTo(map);

        function createCustomIcon(feature, latlng) {
            let myIcon = L.icon({
                iconUrl: 'https://www.shareicon.net/data/256x256/2016/10/07/840704_hotel_512x512.png',
                iconSize: [25, 25], // width and height of the image in pixels
                iconAnchor: [12, 12], // point of the icon which will correspond to marker's location
                popupAnchor: [0, 0] // point from which the popup should open relative to the iconAnchor
            })
            return L.marker(latlng, {
                icon: myIcon
            })
        }

        // create an options object that specifies which function will called on each feature
        let myLayerOptions = {
            pointToLayer: createCustomIcon
        }

        $.getJSON("./api/markers.json", function(data) {
            L.geoJSON(data, myLayerOptions).addTo(map);
        });
    </script>
</body>

</html>