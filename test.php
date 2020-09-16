<!DOCTYPE html>
<html>
  <head>
    <title>Data Layer: Event Handling</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfWrRIdCO89LG5iydTRP3obm2Ix9iScG4&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
    <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 80%;
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      #info-box {
        background-color: white;
        border: 1px solid black;
        bottom: 30px;
        height: 20px;
        padding: 10px;
        position: absolute;
        left: 30px;
      }
    </style>
    <script>
      "use strict";

      let map;

      function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
          zoom: 8,
          center: {
            lat: 18.3558,
            lng: 99.4606 
          }
        }); // Load GeoJSON.

        map.data.loadGeoJson(
          "http://localhost:8888/map/json"
        ); // Add some style.

        map.data.setStyle(feature => {
          return (
            /** @type {google.maps.Data.StyleOptions} */
            ({
              fillColor: feature.getProperty("color"),
              strokeWeight: 1
            })
          );
        }); // Set mouseover event for each feature.

        map.data.addListener("mouseover", event => {
          document.getElementById(
            "info-box"
          ).textContent = event.feature.getProperty("letter");
        });
      }
    </script>
  </head>
  <body>
    <div id="map"></div>
    <div id="info-box">?</div>
  </body>
</html>
