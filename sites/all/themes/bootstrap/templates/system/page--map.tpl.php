<script src="https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css" rel="stylesheet" />
<link href="/sites/all/modules/mymodule/rithook/css/map.css" rel="stylesheet" />

<div class="loading">
	<img src="/sites/all/modules/mymodule/rithook/icon/loading_3.gif"  width="200" />
</div>

<div class="map-wrapper">

	<div class="map-header col-xs-12">
		<div class="col-xs-7">

			<img src="/sites/all/modules/mymodule/rithook/icon/Map-Icon-WW2title.png">
		</div>

		<div class="col-xs-3 lan-switch">
			<a href="/map" class="th">TH</a>
			<a href="/en/map" class="en">EN</a>
			<a href="/ja/map" class="ja">JP</a>
		</div>
		<div class="col-xs-2 about">
			<a href="#" class="about-link">ABOUT</a>	
		</div>
	</div>

	<div class="tab-left">&nbsp;</div>


	<nav id="menu">
		<?php
			$vocabulary = taxonomy_vocabulary_machine_name_load('ww2_category');
			$terms = entity_load('taxonomy_term', FALSE, array('vid' => $vocabulary->vid));
			foreach ($terms as $term) {
	 			print '<a class="active" id="cat-'.$term->tid.'" href="#">';
	 			print '<img width="20px" src="/sites/all/modules/mymodule/rithook/icon/cat-'.$term->tid.'.png" > ';
	 			print $term->name.'</a>';
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
	<div class="tab-right">
		
		<a href="https://www.facebook.com/cmartconversation" target="_blank"><img src="/sites/all/modules/mymodule/rithook/icon/Map-Icon-FB.png"></a>
		<a href="https://www.instagram.com/art.conversation" target="_blank"><img src="/sites/all/modules/mymodule/rithook/icon/Map-Icon-IG.png"></a>
		<a href="https://www.youtube.com/user/CMartconversation" target="_blank"><img src="/sites/all/modules/mymodule/rithook/icon/Map-Icon-YT.png"></a>
	</div>





	<div class="map-footer">
		<?php
			$label_address = t('Address');
			$label_ww2_status = t('Status during the WW2');
			$label_present_status = t('Present status');
			$label_founded = t('Founded (on/by)');
			$label_note = t('Note');
			$label_reference = t('Reference');
			$label_reference_file = t('File Reference');
		?>
		© Chiang Mai Art Conversation and Sutthirat Supaparinya 2020 (cc) BY-NC
คำประกาศสิทธิ: เนื้อหาในเว็บไซต์ ถือสิทธิโดย " Chiang Mai Art Conversation และสุทธิรัตน์ ศุภปริญญา" แต่สามารถนำไปใช้งานได้ตามเงื่อนไข สัญญาอนุญาต Creative Commons (cc) BY-NC กล่าวคือ ต้องอ้างอิงแหล่งที่มา และไม่ใช้เพื่อการค้า
	</div>
	


</div>

<?php

	global $language;
    $lan = $language->language;
?>

<script>

$ = jQuery;

var mapCenter = [99.0501594543, 18.7249499481];
var zoomDefault = 6.5;

mapboxgl.accessToken = 'pk.eyJ1IjoicnVhbmdyaXQiLCJhIjoiY2tlMWFua2VuMGJrdDJ5bXdweWp0M3gyaCJ9.JF08GIkAbniR_wUUVe_80A';
var map = new mapboxgl.Map({
	container: 'map',
	style: 'mapbox://styles/ruangrit/ckfcshb7e4miq19rw6o4isr00',
	center: mapCenter,
	zoom: zoomDefault
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
		'id': 'cat-4-add',
		'type': 'fill',
		'source': 'national-park',
		'paint': {
			'fill-color': '#e0d61f',
			'fill-opacity': 0.7,
			'fill-outline-color': '#000',
		},
		'filter': ['==', '$type', 'Polygon'],

	});

	map.addLayer({
		'id': 'cat-6',
		'type': 'line',
		'source': 'national-park',
		'layout': {
		'line-join': 'round',
		'line-cap': 'round'
		},
		'paint': {
			'line-color': '#e0d61f',
			'line-width': 3
		},
		'filter': ['==', '$type', 'LineString']
	});

	// ======================= route and area event ======================
	var extraCatId = ['cat-4-add', 'cat-6'];
	var arrayLength = extraCatId.length;
	var catId;
	for (var i = 0; i < arrayLength; i++) {
	    catId = extraCatId[i];


	    map.on('click', catId, function (e) {
			showMapDetail(e.features[0].properties);
		
		});

		map.on('mouseenter', catId, function (e) {
			map.getCanvas().style.cursor = 'pointer';
			var coordinates = e.lngLat;
			var description = e.features[0].properties.name;
			popup.setLngLat(coordinates).setHTML(description).addTo(map);

		});
		 
		map.on('mouseleave', catId, function () {
			popup.remove();
			map.getCanvas().style.cursor = '';
		});

	}


	map.loadImage('/sites/all/modules/mymodule/rithook/icon/cat-1.png', function(error, image) {
	    map.addImage('cat-1', image);
	});
	map.loadImage('/sites/all/modules/mymodule/rithook/icon/cat-2.png', function(error, image) {
	    map.addImage('cat-2', image);
	});
	map.loadImage('/sites/all/modules/mymodule/rithook/icon/cat-3.png', function(error, image) {
	    map.addImage('cat-3', image);
	});
	map.loadImage('/sites/all/modules/mymodule/rithook/icon/cat-4.png', function(error, image) {
	    map.addImage('cat-4', image);
	});
	map.loadImage('/sites/all/modules/mymodule/rithook/icon/cat-5.png', function(error, image) {
	    map.addImage('cat-5', image);
	});
	map.loadImage('/sites/all/modules/mymodule/rithook/icon/cat-7.png', function(error, image) {
	    map.addImage('cat-7', image);
	});

	// ============================== Add layer and Event for cat 1, 2, 3, 5, 7
	var iconSize = .4; 
	var pointCatId = [1, 2, 3, 4, 5, 7];
	var catId;
	var arrayLength = pointCatId.length;
	for (var i = 0; i < arrayLength; i++) {
	    catId = pointCatId[i];
		//console.log(catId);

	    // Add layer

	   	map.addLayer({
			'id': 'cat-'+catId,
			'type': 'symbol',
			'source': 'national-park',
			'layout': {
				'visibility': 'visible',
				'icon-image': 'cat-'+catId,
				'icon-size': iconSize
			},
			'filter': ['all',
				['==', '$type', 'Point'],
				['==', 'tid', catId.toString()]
				]
		});
	    
	    // Bind event

	    map.on('click', 'cat-'+catId, function (e) {
			showMapDetail(e.features[0].properties);
			goToPlace(e.lngLat);
		
		});

		map.on('mouseenter', 'cat-'+catId, function (e) {
			map.getCanvas().style.cursor = 'pointer';
			var coordinates = e.features[0].geometry.coordinates.slice();
			var description = e.features[0].properties.name;
			popup.setLngLat(coordinates).setHTML(description).addTo(map);

		});
		 
		map.on('mouseleave', 'cat-'+catId, function () {
			popup.remove();
			map.getCanvas().style.cursor = '';
		});


	}
	// Create a popup, but don't add it to the map yet.
	var popup = new mapboxgl.Popup({
		closeButton: false,
		closeOnClick: false
	});

	loadingDone();

});


function loadingDone() {
	
	$('.loading').fadeOut();
}

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



	var label_address = '<?php print $label_address;?>';
	var label_ww2_status = '<?php print $label_ww2_status;?>';
	var label_present_status = '<?php print $label_present_status;?>';
	var label_founded = '<?php print $label_founded;?>';
	var label_note = '<?php print $label_note;?>';
	var label_reference = '<?php print $label_reference;?>';
	var label_reference_file = '<?php print $label_reference_file;?>';

	
	if(data.address) {
		html += '<div><span class="label"> '+label_address+': </span>'+data.address+'</div>';
	}

	if(data.ww2_status) {
		html += '<div><span class="label"> '+label_ww2_status+': </span>'+data.ww2_status+'</div>';
	}

	if(data.present_status) {
		html += '<div><span class="label"> '+label_present_status+': </span>'+data.present_status+'</div>';
	}
	if(data.founded) {
		html += '<div><span class="label"> '+label_founded+': </span>'+data.founded+'</div>';
	}
	if(data.note) {
		html += '<div><span class="label"> '+label_note+': </span>'+data.note+'</div>';
	}
	if(data.reference) {
		html += '<div><span class="label"> '+label_reference+': </span>'+data.reference+'</div>';
	}


	if (data.reference_file) {

		var reference_file = JSON.parse(data.reference_file);
		var url_file;
		var title_file;
		html += '<div class="ref-file">';
		html += '<span class="label"> '+label_reference_file+'</span>';
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
	goOriginal();
});

$( "#menu > a" ).each(function( index ) {

	$(this).click(function(e) {

		goOriginal();


		$('.info-box').slideUp();
		// Todo fixbug when interval on
		clearInterval(refreshIntervalId);
		var is_active = $(this).attr('class');
		var clickedLayer = this.id;
		e.preventDefault();
		e.stopPropagation();
		 
		// toggle layer visibility by changing the layout object's visibility property
		if (is_active) {

			if (map.getLayer(clickedLayer)) {
				map.setLayoutProperty(clickedLayer, 'visibility', 'none');
			}

			if (map.getLayer(clickedLayer+'-add')) {
				map.setLayoutProperty(clickedLayer+'-add', 'visibility', 'none');
			}

			this.className = '';
		} else {

			this.className = 'active';
			if (map.getLayer(clickedLayer)) {
				map.setLayoutProperty(clickedLayer, 'visibility', 'visible');
			}

			if (map.getLayer(clickedLayer+'-add')) {
				map.setLayoutProperty(clickedLayer+'-add', 'visibility', 'visible');
			}
			
		}
	})
});

function goOriginal() {

	map.flyTo({

		center: mapCenter,
		zoom: zoomDefault,
		bearing: 0,
		 
		speed: 0.7, // make the flying slow
		curve: 1, // change the speed at which it zooms out
		 
		easing: function (t) {
			return t;
		},
		essential: true
	});

}

function goToPlace(lngLat) {

	map.flyTo({

		center: lngLat,
		zoom: 11,
		bearing: 0,
		 
		speed: 0.8, // make the flying slow
		curve: 1, // change the speed at which it zooms out
		 
		easing: function (t) {
			return t;
		},
		essential: true
	});
}

</script>


