<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />
</head>

<body style="margin: 0;">
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

        /* -----------= Custom Icons =----------- */
        let herbergIcon = L.icon({
            iconUrl: 'https://www.svgrepo.com/show/39715/bed.svg',
            iconSize: [30, 30], // width and height of the image in pixels
            iconAnchor: [15, 15], // point of the icon which will correspond to marker's location
            popupAnchor: [0, -15] // point from which the popup should open relative to the iconAnchor
        })

        let restaurantIcon = L.icon({
            iconUrl: 'https://www.svgrepo.com/show/52135/room-service.svg',
            iconSize: [30, 30], // width and height of the image in pixels
            iconAnchor: [15, 15], // point of the icon which will correspond to marker's location
            popupAnchor: [0, -15] // point from which the popup should open relative to the iconAnchor
        })

        let donkeyIcon = L.icon({
            iconUrl: 'ezel met huifkar.png',
            iconSize: [50, 50], // width and height of the image in pixels
            iconAnchor: [20, 40], // point of the icon which will correspond to marker's location
            popupAnchor: [0, -30] // point from which the popup should open relative to the iconAnchor
        })
        /* -------------------------------------- */

        var gpx = './test.gpx'; // URL to your GPX file or the GPX itself
        new L.GPX(gpx, {
            async: true,
            marker_options: {
                startIconUrl: 'https://raw.githubusercontent.com/mpetazzoni/leaflet-gpx/main/pin-icon-start.png',
                endIconUrl: 'https://raw.githubusercontent.com/mpetazzoni/leaflet-gpx/main/pin-icon-end.png',
                shadowUrl: 'https://raw.githubusercontent.com/mpetazzoni/leaflet-gpx/main/pin-shadow.png',
                wptIcons: {
                    '': donkeyIcon //'ezel met huifkar.png'
                }
            },
            polyline_options: {
                color: 'blue',
                opacity: 0.75,
                weight: 2,
                lineCap: 'round',
                lineJoin: 'arcs',
                dashArray: '4'
            }
        }).on('loaded', function(e) {
            map.fitBounds(e.target.getBounds());
        }).addTo(map);

        function createCustomIcon(feature, latlng) {
            if (feature.properties && feature.properties.marker_symbol) {
                switch (feature.properties.marker_symbol) {
                    case "restaurant":
                        return L.marker(latlng, {
                            icon: restaurantIcon
                        });
                    case "hostel":
                        return L.marker(latlng, {
                            icon: herbergIcon
                        });
                }
            }
            return L.marker(latlng);
        }

        function onEachFeature(feature, layer) {
            if (feature.properties) {
                var popupContent = '';
                if (feature.properties.name)
                    popupContent += '<p><b>' + feature.properties.name + '</b></p>';

                if (feature.properties.popupContent)
                    popupContent += '<p>' + feature.properties.popupContent + '</p>';

                layer.bindPopup(popupContent);
            }
        }

        $.getJSON("./api/markers.json", function(data) {
            L.geoJSON(data, {
                onEachFeature: onEachFeature,
                pointToLayer: createCustomIcon
            }).addTo(map);
        });
    </script>
</body>

</html>