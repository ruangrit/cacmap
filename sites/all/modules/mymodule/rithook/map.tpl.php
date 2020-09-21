<?php

	$node1 = node_load(1);
	
	//dpm($node);

	$geojson_obj1 = leaflet_widget_geojson_feature($node1->field_location['und'][0]['wkt']);
	$geojson_obj1['properties']['name'] = 'xxxxxxx';
	dpm($geojson_obj1);
?>