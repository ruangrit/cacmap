<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Show polygon information on click</title>
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
<script src="https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css" rel="stylesheet" />
<style>
	body { margin: 0; padding: 0; }
	#map { position: absolute; top: 0; bottom: 0; width: 100%; }
</style>
</head>
<body>
<style>
.mapboxgl-popup {
max-width: 400px;
font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
}
</style>
<div id="map"></div>
<script>
	mapboxgl.accessToken = 'pk.eyJ1IjoicnVhbmdyaXQiLCJhIjoiY2tlMWFua2VuMGJrdDJ5bXdweWp0M3gyaCJ9.JF08GIkAbniR_wUUVe_80A';
var map = new mapboxgl.Map({
container: 'map',
style: 'mapbox://styles/mapbox/streets-v11',
center: [99.8355102539, 18.2997729453],
zoom: 8
});
 
map.on('load', function () {
// Add a source for the state polygons.
map.addSource('states', {
'type': 'geojson',
'data':
'http://localhost:8888/map/json'
});
 
// Add a layer showing the state polygons.
map.addLayer({
'id': 'states-layer',
'type': 'fill',
'source': 'states',
'paint': {
'fill-color': 'rgba(200, 100, 240, 0.4)',
'fill-outline-color': 'rgba(200, 100, 240, 1)'
}
});
 
// When a click event occurs on a feature in the states layer, open a popup at the
// location of the click, with description HTML from its properties.
map.on('click', 'states-layer', function (e) {
new mapboxgl.Popup()
.setLngLat(e.lngLat)
.setHTML(e.features[0].properties.name)
.addTo(map);
});
 
// Change the cursor to a pointer when the mouse is over the states layer.
map.on('mouseenter', 'states-layer', function () {
map.getCanvas().style.cursor = 'pointer';
});
 
// Change it back to a pointer when it leaves.
map.on('mouseleave', 'states-layer', function () {
map.getCanvas().style.cursor = '';
});
});
</script>
 
</body>
</html>
