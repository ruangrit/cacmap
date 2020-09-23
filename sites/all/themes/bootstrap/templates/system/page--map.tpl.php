<script src="https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css" rel="stylesheet" />
<style>
#map { 
	position: absolute;
	top: 0;
	bottom: 0;
	width: 100%;
	height: 100%;
	
}

body { 
	margin: 0; 
	padding: 0; 
	position: inherit;
}

.map-wrapper {
	width: 100%;
	height: 100%;
	overflow: hidden;
	
	
}
.filter-box {
	width: 265px;
	background: #f0c084;
	position: absolute;
	bottom: 38px;
	left: 38px;
	display: flex;
	flex-direction: column;
	justify-content: center;
	z-index: 200;
	padding: 35px 27px;
}

.info-box {
	width: 30vw;
	height: 100vh;
	position: absolute;
	top:0;
	right: 0;
	z-index: 200;
	overflow: hidden;
	display: none;
}

.mapboxgl-map {
	
}
.map-header, .map-footer {
	height: 50px;
	position: absolute;
	z-index: 200;
	width: 100%;
	
}

.map-header {
	padding-left: 50px;
}

.map-header, .map-footer, .tab-left, .tab-right {
	background: #fff;

} 

.map-footer {
	bottom: 0px;
}
.tab-left, .tab-right {
	position: absolute;
	z-index: 200;
	width: 50px;
	height: 100%;
	
}

.tab-right {
	right: 0px;
}




.mapboxgl-popup {
max-width: 400px;
font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
}

</style>

<div class="map-wrapper">

	<div class="map-header">Header</div>
	<div class="filter-box">filter</div>
	<div class="info-box">infooooooooooo</div>

	<div class="tab-left">Left</div>
	<div id="map"></div>
	<div class="tab-right">Right</div>





	<div class="map-footer">Footer</div>
	


</div>


<script>

mapboxgl.accessToken = 'pk.eyJ1IjoicnVhbmdyaXQiLCJhIjoiY2tlMWFua2VuMGJrdDJ5bXdweWp0M3gyaCJ9.JF08GIkAbniR_wUUVe_80A';
var map = new mapboxgl.Map({
container: 'map',
style: 'mapbox://styles/ruangrit/ckfcshb7e4miq19rw6o4isr00',
center: [99.0501594543, 18.7249499481],
zoom: 6
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
	 
	// circle tid is 1 
	map.addLayer({
		'id': 'cat-1',
		'type': 'circle',
		'source': 'national-park',
		'paint': {
		'circle-radius': 10,
		'circle-color': '#B42222'
		},
		'filter': ['all',
			['==', '$type', 'Point'],
			['==', 'tid', '1']
			]
	});

	// circle tid is 2
	map.addLayer({
		'id': 'cat-2',
		'type': 'circle',
		'source': 'national-park',
		'paint': {
		'circle-radius': 10,
		'circle-color': '#2f7f59'
		},
		'filter': ['all',
			['==', '$type', 'Point'],
			['==', 'tid', '2']
			]
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
			'line-color': '#753259',
			'line-width': 3
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

	map.on('click', 'park-volcanoes', function (e) {
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


