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

.info-box {
	width: 400px;
	height: 100%;
	position: absolute;
	top:0;
	right: 0;
	z-index: 201;
	overflow: scroll;
	background: #c5ad8a;
	border: 4px solid #FFF;
	display: none;
	
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


#menu {
	background: #fff;
	position: absolute;
	z-index: 1;
	top: 80px;
	left: 80px;
	border-radius: 3px;
	padding: 5px;
}
 
#menu a {
	font-size: 13px;
	color: #404040;
	display: block;
	margin: 0;
	padding: 0;
	padding: 10px;
	text-decoration: none;
	border-bottom: 1px solid rgba(0, 0, 0, 0.25);
	z-index: 999;
}
 
#menu a:last-child {
	border: none;
}
 
#menu a:hover {
	background-color: #618d9e;
	color: #404040;
}
 
#menu a.active {
	background-color: #446c7b;
	color: #ffffff;
}
 
#menu a.active:hover {
	background: #3074a4;
}



</style>

<div class="map-wrapper">

	<div class="map-header">
	Header
	</div>

	<div class="tab-left">Left</div>


	<nav id="menu">
		<?php
			$vocabulary = taxonomy_vocabulary_machine_name_load('ww2_category');
			$terms = entity_load('taxonomy_term', FALSE, array('vid' => $vocabulary->vid));
			foreach ($terms as $term) {
	 			print '<a class="active" id="cat-'.$term->tid.'" href="#">'.$term->name.'</a>';
			}


		?>
	</nav>

	<div class="info-box">
		
		<div id="info-header"></div>
		<div id="info-body">




		</div>
		<div id="info-close" title="Close"></div>
	</div>
	<div id="map"></div>
	<div class="tab-right">Right</div>





	<div class="map-footer">Footer</div>
	


</div>

<?php

	global $language;
    $lan = $language->language;
?>

<script>

mapboxgl.accessToken = 'pk.eyJ1IjoicnVhbmdyaXQiLCJhIjoiY2tlMWFua2VuMGJrdDJ5bXdweWp0M3gyaCJ9.JF08GIkAbniR_wUUVe_80A';
var map = new mapboxgl.Map({
container: 'map',
style: 'mapbox://styles/ruangrit/ckfcshb7e4miq19rw6o4isr00',
center: [99.0501594543, 18.7249499481],
zoom: 6
});
 
var refreshIntervalId;
map.on('load', function () {
	// Add a source for the state polygons.
	var lan = '<?php print $lan;?>';
	map.addSource('national-park', {
	'type': 'geojson',
	'data': 'http://localhost:8888/'+ lan +'/map/json',
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

/*	map.loadImage('{{asset("sites/all/modules/mymodule/rithook/icon/cat-1.png")}}', function(error, image) {
	  if (error) throw error;
	    map.addImage('cat-1', image);
	  });
	});
*/

	map.loadImage('/sites/all/modules/mymodule/rithook/icon/cat-1.png', function(error, image) {
	    map.addImage('cat-1', image);
	});
	 
	// circle tid is 1 
	map.addLayer({
		'id': 'cat-1',
		'type': 'symbol',
		'source': 'national-park',
		'layout': {
			'visibility': 'visible',
			'icon-image': 'cat-1',
			'icon-size': .4
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
		'layout': {
			'visibility': 'visible'
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

	// Create a popup, but don't add it to the map yet.
	var popup = new mapboxgl.Popup({
		closeButton: false,
		closeOnClick: false
	});



	 
	// When a click event occurs on a feature in the states layer, open a popup at the
	// location of the click, with description HTML from its properties.
	map.on('click', 'route', function (e) {
		new mapboxgl.Popup()
		.setLngLat(e.lngLat)
		.setHTML(e.features[0].properties.name)
		.addTo(map);

	});

	map.on('mouseenter', 'route', function (e) {
		map.getCanvas().style.cursor = 'pointer';
		var coordinates = e.lngLat;
		var description = e.features[0].properties.name;
		popup.setLngLat(coordinates).setHTML(description).addTo(map);

	});
	 
	map.on('mouseleave', 'route', function () {
		popup.remove();
		map.getCanvas().style.cursor = '';
		//==== clear interval
		//====clearInterval(refreshIntervalId);
		//map.setPaintProperty('cat-1', 'circle-radius', 10);
	});
	//===================================


	map.on('click', 'park-boundary', function (e) {
		new mapboxgl.Popup()
		.setLngLat(e.lngLat)
		.setHTML(e.features[0].properties.name)
		.addTo(map);
	});

	// ============================== Cat1
	map.on('click', 'cat-1', function (e) {
		// Show detail on map
		showMapDetail(e.features[0].properties);
		
	});
	map.on('mouseenter', 'cat-1', function (e) {
		map.getCanvas().style.cursor = 'pointer';
		var coordinates = e.features[0].geometry.coordinates.slice();
		var description = e.features[0].properties.name;
		popup.setLngLat(coordinates).setHTML(description).addTo(map);

	});
	 
	map.on('mouseleave', 'cat-1', function () {
		popup.remove();
		map.getCanvas().style.cursor = '';
		//==== clear interval
		//====clearInterval(refreshIntervalId);
		//map.setPaintProperty('cat-1', 'circle-radius', 10);
	});
	//================================
	 
	// Change the cursor to a pointer when the mouse is over the states layer.
	map.on('mouseenter', 'route', function () {
		map.getCanvas().style.cursor = 'pointer';
	});
	 
	// Change it back to a pointer when it leaves.
	map.on('mouseleave', 'route', function () {
		map.getCanvas().style.cursor = '';
	});
});



$ = jQuery;

function showMapDetail(data) {

	var html = '';
	if(data.name) {

		html += '<h2>'+data.name+'</h2>';
	}

	if(data.image) {

		var images = JSON.parse(data.image);
		var url;
		var title;
		var slideImage = '<div id="carouselExampleControls" class="carousel slide" data-ride="carousel"> ';

		slideImage += '<ol class="carousel-indicators">';
		var runNumImage2 = 0;
		Object.keys(images).forEach(function(key) {

		    var itemClass2 = ''; 
		    if (runNumImage2 == 0) {
		    	itemClass2 = 'active';
		    }

			slideImage += '<li data-target="#carouselExampleControls" data-slide-to="'+runNumImage2+'" class="'+itemClass2+'"></li>';
			runNumImage2++;
		});

		slideImage += '</ol>';

		slideImage += '<div class="carousel-inner"> ';


		var runNumImage = 1;
		Object.keys(images).forEach(function(key) {
		    url = images[key]['url'];
		    title = images[key]['title'];

		    var itemClass = 'item'; 
		    if (runNumImage == 1) {
		    	itemClass = 'item active';
		    }
		    slideImage += '<div class="'+itemClass+'"> <img src="'+url+'" alt="'+title+'"> <div class="carousel-caption d-none d-md-block"><p>'+title+'</p> </div> </div> ';
		    runNumImage++;

		});

		slideImage += '</div>'

		slideImage += '<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>';
		slideImage += '</div>'


		html += slideImage;

		$('#info-body').html(html);
		$('.carousel').carousel();

		$('.info-box').slideDown();

	}
}

$( "#menu > a" ).each(function( index ) {
	$(this).click(function(e) {
		$('.info-box').slideUp();
		// Todo fixbug when interval on
		clearInterval(refreshIntervalId);
		var is_active = $(this).attr('class');
		var clickedLayer = this.id;
		e.preventDefault();
		e.stopPropagation();
		 
		// toggle layer visibility by changing the layout object's visibility property
		if (is_active) {
			map.setLayoutProperty(clickedLayer, 'visibility', 'none');
			this.className = '';
		} else {
			this.className = 'active';
			map.setLayoutProperty(clickedLayer, 'visibility', 'visible');
		}
	})
});

</script>


