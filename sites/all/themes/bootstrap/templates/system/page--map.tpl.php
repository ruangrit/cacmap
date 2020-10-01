<?php
	global $language;
    $lan = $language->language;
?>

<?php 

	if(isset($_GET['ww2']) && $_GET['ww2'] == 'qazsdwef220597') {

	}
	else {


		$text = '<h2>The site is UNDER CONSTRUCTION</h2>';

		$text .= '
		<div class="text-th" style="margin-bottom: 20px">
		โครงการสถานที่เกี่ยวกับสงครามโลกครั้งที่ 2 ในภาคเหนือของประเทศไทย 
		<br />
วันและเวลา : โครงการออนไลน์นี้จะเริ่มเปิดตัวตั้งแต่วันที่ 14 ตุลาคม 2563 เป็นต้นไป ในเวลา 20.00 น. ตามเวลาประเทศไทย หรือในเวลา 22.00 น. ตามเวลาญี่ปุ่น 
		</div>
		';

		$text .= '
		<div class="text-th" style="margin-bottom: 20px">
		World War II Sites Northern Thailand Project
		<br />
Date & Time: This online project will be launched from 14 October 2020 onwards - 20.00 GMT +7h = 22.00 JST
		</div>
		';

		$text .= '
		<div class="text-th" style="margin-bottom: 20px">
第二次世界大戦遺跡 タイ北部プロジェクト
<br />

日時: 2020年10月14日 日本時間22:00(タイ時間20:00)から
		</div>
		';

		print '<div class="man-mode" style="margin-left: 100px">';



			print $text;

		print '</div>';

	return false;
}

	?>


<script src="https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css" rel="stylesheet" />
<link href="/sites/all/modules/mymodule/rithook/css/map.css" rel="stylesheet" />

<div class="loading">
	<img src="/sites/all/modules/mymodule/rithook/icon/loading_3.gif"  width="200" />
</div>

<div class="map-wrapper">

	<div class="map-header col-xs-12">
		<div class="col-xs-4 image-logo">

			<img src="/sites/all/modules/mymodule/rithook/images/Map-Icon-WW2title2.png">
		</div>

		<div class="col-xs-6 lan-switch">

			<?php

			function _return_language_object($langCode){ 
			    $languages = language_list(); 
			    return $languages[$langCode];
			}


			?>
			<?php 

			print l('ภาษาไทย', '<front>', 
				array(
					'language' => _return_language_object('th'),
					'query' => array(

							'ww2' => $_GET['ww2'],
					),
				)
			);
			print l('English', '<front>', 
				array(
					'language' => _return_language_object('en'),
					'query' => array(

							'ww2' => $_GET['ww2'],
					),
				)
			);
			print l('日本語', '<front>', 
				array(
					'language' => _return_language_object('ja'),
					'query' => array(

							'ww2' => $_GET['ww2'],
					),
				)
			);
			?>
		</div>
		<div class="col-xs-2 about">
			<a href="#" class="about-link" data-toggle="modal" data-target="#exampleModalLong">ABOUT</a>	
		</div>
	</div>

	<div class="tab-left">&nbsp;</div>


	<nav id="menu">
		<div class="menu-toggle col-xs-12 none-padding">
			<div class="col-xs-6 none-padding">
				<h4>Site Legend</h4>
			</div>
			<div class="col-xs-6 none-padding text-right">
				<span class="glyphicon glyphicon-chevron-up"></span>
				<span class="glyphicon glyphicon-chevron-down"></span>
			</div>

		</div>

		
		<div class="menu-info">
			<h4>WW2 Historical Map Northern Thailand</h4>

		</div>
		<div class="menu-inner">
			<?php
				$vocabulary = taxonomy_vocabulary_machine_name_load('ww2_category');
				$terms = entity_load('taxonomy_term', FALSE, array('vid' => $vocabulary->vid));
				foreach ($terms as $term) {
		 			print '<a class="active" id="cat-'.$term->tid.'" href="#">';
		 			print '<img width="20px" src="/sites/all/modules/mymodule/rithook/icon/cat-'.$term->tid.'.png" > ';
		 			print $term->name.'</a>';
				}


			?>
			

		</div>
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
			$label_reference_file = t('Reference paper file');
		?>
		© Chiang Mai Art Conversation 2020(cc) BY-NC. Unless otherwise noted.
คำประกาศสิทธิ: เนื้อหาในเว็บไซต์ ถือสิทธิโดย " Chiang Mai Art Conversation " เว้นแต่ได้ระบุเป็นอย่างอื่นไว้ สามารถนำไปใช้งานได้ตามเงื่อนไข สัญญาอนุญาต Creative Commons (cc) BY-NC กล่าวคือ ต้องอ้างอิงแหล่งที่มา และไม่ใช้เพื่อการค้า
	</div>
	


</div>

<?php



    // Load about content
    $about = node_load(12);
    $about_content = $about->body[$lan][0]['value'];
?>


<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">ABOUT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php print $about_content;?>
      </div>
      
    </div>
  </div>
</div>



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
	'data': '/'+ lan +'/map/json',
	});

// Add a layer showing the state polygons.
// Add a symbol layer
	map.addLayer({
		'id': 'cat-4-add',
		'type': 'fill',
		'source': 'national-park',
		'paint': {
			'fill-color': '#FFF',
			'fill-opacity': 0.4,
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
		html += '<div><span class="label"> '+label_address+':</span> '+data.address+'</div>';
	}

	if(data.ww2_status) {
		html += '<div><span class="label"> '+label_ww2_status+':</span> '+data.ww2_status+'</div>';
	}

	if(data.present_status) {
		html += '<div><span class="label"> '+label_present_status+':</span> '+data.present_status+'</div>';
	}
	if(data.founded) {
		html += '<div><span class="label"> '+label_founded+':</span> '+data.founded+'</div>';
	}
	if(data.note) {
		html += '<div><span class="label"> '+label_note+':</span> '+data.note+'</div>';
	}
	if(data.reference) {
		html += '<div><span class="label"> '+label_reference+':</span> '+data.reference+'</div>';
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

$( "#menu a" ).each(function( index ) {

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

$('.menu-toggle').click(function (e) {

	console.log($('.menu-inner').css('display'));

	if ( $('.menu-inner').css('display') != 'none'){
		$('.menu-inner').slideUp();
		$('.glyphicon-chevron-up').hide();
		$('.glyphicon-chevron-down').show();
	}
	else {
		$('.menu-inner').slideDown();
		$('.glyphicon-chevron-down').hide();
		$('.glyphicon-chevron-up').show();

	}
    

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


