<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" />
    
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"></script>
    <style type="text/css">
      html, body { width:100%;padding:0;margin:0; }
      .container { width:95%;max-width:980px;padding:1% 2%;margin:0 auto }
      #lat, #lon { text-align:right }
      #map { width:100%;height: 400px;padding:0;margin:0; }
      .address { cursor:pointer }
      .address:hover { color:#AA0000;text-decoration:underline }
      a{text-decoration: none}
    </style>
    <title></title>
  </head>
  <body class="bg-dark">
    @yield('navbar')
    @yield('content')

    {{-- Map --}}
    <script type="text/javascript">

      // Nepal
      var startlat = 26.8065;
      var startlon = 87.2846;
      
      var options = {
       center: [startlat, startlon],
       zoom: 9
      }
      
      document.getElementById('lat').value = startlat;
      document.getElementById('lon').value = startlon;
      
      var map = L.map('map', options);
      var nzoom = 12;
      
      L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {attribution: 'OSM'}).addTo(map);
      
      var myMarker = L.marker([startlat, startlon], {title: "Coordinates", alt: "Coordinates", draggable: true}).addTo(map).on('dragend', function() {
       var lat = myMarker.getLatLng().lat.toFixed(8);
       var lon = myMarker.getLatLng().lng.toFixed(8);
       var czoom = map.getZoom();
       if(czoom < 18) { nzoom = czoom + 2; }
       if(nzoom > 18) { nzoom = 18; }
       if(czoom != 18) { map.setView([lat,lon], nzoom); } else { map.setView([lat,lon]); }
       document.getElementById('lat').value = lat;
       document.getElementById('lon').value = lon;
       myMarker.bindPopup("Lat " + lat + "<br />Lon " + lon).openPopup();
      });
      
      function chooseAddr(lat1, lng1)
      {
       myMarker.closePopup();
       map.setView([lat1, lng1],18);
       myMarker.setLatLng([lat1, lng1]);
       lat = lat1.toFixed(8);
       lon = lng1.toFixed(8);
       document.getElementById('lat').value = lat;
       document.getElementById('lon').value = lon;
       document.getElementById('user_address').value = document.getElementById('addr').value ;
       myMarker.bindPopup("Lat " + lat + "<br />Lon " + lon).openPopup();
  
      }
      
      function myFunction(arr)
      {
       var out = "<br />";
       var i;
      
       if(arr.length > 0)
       {
        for(i = 0; i < arr.length; i++)
        {
         out += "<div class='address' id='select_address' title='Show Location and Coordinates' onclick='chooseAddr(" + arr[i].lat + ", " + arr[i].lon + ");return false;'>" + arr[i].display_name + "</div>";
        }
        document.getElementById('results').innerHTML = out;
       }
       else
       {
        document.getElementById('results').innerHTML = "Sorry, no results...";
       }
      
      }
      
      function addr_search()
      {
       var inp = document.getElementById("addr");
       var xmlhttp = new XMLHttpRequest();
       var url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + inp.value;
       xmlhttp.onreadystatechange = function()
       {
         if (this.readyState == 4 && this.status == 200)
         {
          var myArr = JSON.parse(this.responseText);
          myFunction(myArr);
         }
       };
       xmlhttp.open("GET", url, true);
       xmlhttp.send();
      }
      
      </script>
      
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>