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
	background: #e8d2b0;
	
	display: none;
	
}

#info-body, #info-header {
	margin: 12px;
	
}

.close {
	opacity: 1 !important;
}

h1 {
	font-weight: bold;
	font-size: 25px !important;
}
#info-body h3, #info-body .label {
	color: #6b430a;
	font-weight: bold;
}

#info-body .label {
	font-size: 90% !important;
	padding: 0px !important;
}

#info-body, #info-body li a {
	color: #866535;
	
}

#info-body li a {
	
	font-size: 85%;
}

#info-body .ref-file {
	border-top: 1px dotted #6b430a;
}

#carouselExampleControls {
	margin-bottom: 10px;
}

.carousel-caption {
	position: unset !important;
	text-shadow: none;
	color: #6b430a !important;
	font-size: 85%;
	padding-top: 5px !important;
	padding-bottom: 5px !important;

}


.map-header, .map-footer {
	height: 50px;
	position: absolute;
	z-index: 200;
	
}

.map-header {
	padding-left: 50px;
}

.map-header, .map-footer, .tab-left, .tab-right {
	background: #fff;
} 

.map-footer {
	bottom: 0px;
	margin-left: 50px;
	margin-right: 50px;


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


@font-face {
    font-family: 'Noto-Sans-Thai';
    src: url('/sites/all/modules/mymodule/rithook/font/subset-NotoSansThaiUI-Regular.woff2') format('woff2'),
         url('/sites/all/modules/mymodule/rithook/font/subset-NotoSansThaiUI-Regular.woff') format('woff');
    font-weight: normal;
    font-style: normal;
}

@font-face {
    font-family: 'Noto-Sans-Thai';
    src: url('/sites/all/modules/mymodule/rithook/font/subset-NotoSansThaiUI-Bold.woff2') format('woff2'),
         url('/sites/all/modules/mymodule/rithook/font/subset-NotoSansThaiUI-Bold.woff') format('woff');
	
    font-weight: bold;
    font-style: normal;
}

body {
	font-family: 'Noto-Sans-Thai', sans-serif !important;
	letter-spacing: 0.6px !important; 
	line-height: 1.5em;
}

</style>

<div class="map-wrapper">

	<div class="map-header col-xs-12">
		<div class="col-xs-7">

			<h1>WW2 SITES NTH</h1>
		</div>

		<div class="col-xs-3">
		th en jp 
		</div>
		<div class="col-xs-2">
		ABOUT
		</div>
	</div>

	<div class="tab-left">&nbsp;</div>


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
		

		<div id="info-header">
			

		<button type="button" class="close close-info-box" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>

		</div>
		<div id="info-body">




		</div>
		
	</div>
	<div id="map"></div>
	<div class="tab-right">Right</div>





	<div class="map-footer">
		
		© Chiang Mai Art Conversation and Sutthirat Supaparinya 2020 (cc) BY-NC
คำประกาศสิทธิ: เนื้อหาในเว็บไซต์ ถือสิทธิโดย " Chiang Mai Art Conversation และสุทธิรัตน์ ศุภปริญญา" แต่สามารถนำไปใช้งานได้ตามเงื่อนไข สัญญาอนุญาต Creative Commons (cc) BY-NC กล่าวคือ ต้องอ้างอิงแหล่งที่มา และไม่ใช้เพื่อการค้า
	</div>
	


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

		html += '<h3>'+data.name+'</h3>';
	}

	if(data.image) {

		var images = JSON.parse(data.image);

		var url;
		var title;
		var slideImage = '<div id="carouselExampleControls" class="carousel slide" data-ride="carousel"> ';

		/* ===============  dot control
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

		*/

		slideImage += '<div class="carousel-inner"> ';


		var runNumImage = 1;
		Object.keys(images).forEach(function(key) {
		    url = images[key]['url'];
		    title = images[key]['title'];

		    var itemClass = 'item'; 
		    if (runNumImage == 1) {
		    	itemClass = 'item active';
		    }
		    slideImage += '<div class="'+itemClass+'"> <img src="'+url+'" alt="'+title+'">';

		    if (title) {
			    slideImage += '<div class="carousel-caption">'+title+'</div>';
		    }
		    slideImage += ' </div> ';
		    runNumImage++;

		});

		slideImage += '</div>'

		slideImage += '<a class="left carousel-control" href="#carouselExampleControls" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#carouselExampleControls" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> <span class="sr-only">Next</span> </a>'; 
		slideImage += '</div>';
		html += slideImage;


	}

	
	if(data.address) {
		html += '<div><span class="label"> Address: </span>'+data.address+'</div>';
	}

	if(data.ww2_status) {
		html += '<div><span class="label"> WW2 status: </span>'+data.ww2_status+'</div>';
	}

	if(data.present_status) {
		html += '<div><span class="label"> Present status: </span>'+data.present_status+'</div>';
	}
	if(data.founded) {
		html += '<div><span class="label"> Founded: </span>'+data.founded+'</div>';
	}
	if(data.note) {
		html += '<div><span class="label"> Note: </span>'+data.note+'</div>';
	}
	if(data.reference) {
		html += '<div><span class="label"> Reference: </span>'+data.reference+'</div>';
	}


	if (data.reference_file) {

		var reference_file = JSON.parse(data.reference_file);
		var url_file;
		var title_file;
		html += '<div class="ref-file">';
		html += '<span class="label"> Reference Files</span>';
		html += '<ul>';
		Object.keys(reference_file).forEach(function(key) {
			url_file = reference_file[key]['url'];
		    title_file = reference_file[key]['title'];

		    html += '<li><a href="'+url_file+'" target="_blank">'+title_file+'</a></li>'
		});
		html += '<ul>';
		html += '</div>';
	}
	$('#info-body').html(html);
	$('.info-box').slideDown();
	$('.carousel').carousel({
  		interval: 2000
	})
}
$('.close-info-box').click(function () {

	$('.info-box').slideUp();
});

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


