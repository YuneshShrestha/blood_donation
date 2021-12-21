<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.76.0/dist/L.Control.Locate.min.css" />

   <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        #map{
            width: 100%;
            height: 100vh;
        }
        a{
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div id="map"></div>
    
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.76.0/dist/L.Control.Locate.min.js" charset="utf-8"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="{{ asset('marker.js') }}"></script> --}}
    <script>
         
        var map = L.map('map').setView([28.3949, 84.1240], 8);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map); 
        L.Control.geocoder().addTo(map);
        L.control.locate().addTo(map);
        let marker;
        let html;
        $(document).ready(function(){
            $.getJSON('/user_json',function(data){
                $.each(data, function(index){
                    var hotelIcon = L.icon({
                        iconUrl: 'https://cdn4.iconfinder.com/data/icons/web-ui-color/128/Marker_red-256.png',
                        iconSize: [24,28],
                        // shadowSize: [50,64]
                    });
                    // alert(data[index].longitude + " " +data[index].latitude);
                    html = '<div>';

                    // html += '../../public/image'+data[index].image;
                    html += '<p> Name:';
                    html += data[index].name;
                    html += '</p>';
                    html += '<p> Blood Group:';
                    html += data[index].blood_group;
                    html += '</p>';
                    html += '<a href="/data" class="btn-sm btn-primary text-white">';
                    html += 'Send Message';
                    html += '</a>';
                    html += '</div>';
                    marker = L.marker([parseFloat(data[index].lat), parseFloat(data[index].lon)],{icon: hotelIcon}).addTo(map);
                    marker.bindPopup(html);
                });
            });
        });
       

    //    For Json Data
    //     L.geoJSON(markerJson,{
    //     onEachFeature: function(feature,layer){
    //         layer.bindPopup(feature.properties.location)
    //     }
    //    }).addTo(map);
     
    </script>
</body>
</html>