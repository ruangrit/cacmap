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
style: 'mapbox://styles/ruangrit/ckfcvtzyx5nj919nplfyzxvul',
center: [99.8355102539, 18.2997729453],
zoom: 8
});
 
map.on('load', function () {
	// Add a source for the state polygons.
	map.addSource('national-park', {
	'type': 'geojson',
	'data': 'http://localhost:8888/map/json',
	});
	 
	// Add a layer showing the state polygons.
// Add a symbol layer
	map.addLayer({
		'id': 'park-boundary',
		'type': 'fill',
		'source': 'national-park',
		'paint': {
		'fill-color': '#FF0000',
		'fill-opacity': 0.4
		},
		'filter': ['==', '$type', 'Polygon'],

	});
	 
	map.addLayer({
		'id': 'park-volcanoes',
		'type': 'circle',
		'source': 'national-park',
		'paint': {
		'circle-radius': 6,
		'circle-color': '#B42222'
		},
		'filter': ['==', '$type', 'Point']
	});

	map.addLayer({
		'id': 'route',
		'type': 'line',
		'source': 'national-park',
		'layout': {
		'line-join': 'round',
		'line-cap': 'round'
		},
		'paint': {
			'line-color': '#888',
			'line-width': 2
		},
		'filter': ['==', '$type', 'LineString']
	});


	 
	// When a click event occurs on a feature in the states layer, open a popup at the
	// location of the click, with description HTML from its properties.
	map.on('click', 'route', function (e) {
	new mapboxgl.Popup()
	.setLngLat(e.lngLat)
	.setHTML(e.features[0].properties.name)
	.addTo(map);
	});


	map.on('click', 'park-boundary', function (e) {
	new mapboxgl.Popup()
	.setLngLat(e.lngLat)
	.setHTML(e.features[0].properties.name)
	.addTo(map);
	});
	 
	// Change the cursor to a pointer when the mouse is over the states layer.
	map.on('mouseenter', 'route', function () {
	map.getCanvas().style.cursor = 'pointer';
	});
	 
	// Change it back to a pointer when it leaves.
	map.on('mouseleave', 'route', function () {
	map.getCanvas().style.cursor = '';
	});
});
</script>
 
</body>
</html>
