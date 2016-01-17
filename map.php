<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hot Thess | Welcome</title>
    <style>
        html, body, #map-canvas {
			width:100%;
            height: 100%;
            margin: 0px;
            padding: 0px
        }
		.navbar {
			margin-bottom: 2px !important;
		}
        #panel {
			margin-top:52px;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #999;
            box-shadow:2px 2px 4px rgba(0,0,0,.5);
            opacity:0.9;
        }
        #progress {
            position: absolute;
            top: 20%;
            left: 60%;
            margin-left: -180px;
            z-index: 5;
            padding: 5px;
            display: none;
        }
        #map-container {
		  position: fixed;
		  top: 0;
		  left: 0;
		  right: 0;
		  bottom:0;

		}

		#map-canvas {
		  width: 100%;
		  height: 100%;
		}

		#pano,#pano2, #pano3 {
          width:480px;
          height: 350px;
          margin:0 auto;
        }

    </style>
	<link rel="stylesheet" type="text/css" href="dist/css/map-icons.css">   
	<link rel="stylesheet" type="text/css" href="http://cdn.jsdelivr.net/bootswatch/3.3.6/paper/bootstrap.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<!--<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">-->
</head>
<?php
if($_POST){
}
?>
<body>
	<div id="logobar" style="width:100%;height:50px;background-color:#41C17D">
		<div style="padding:1em"><img src="capture/img/logo/logo.png" class="pull-left"/>
			<img src="capture/img/foursq.png" class="pull-right"/>
		</div>
	</div>
	<div id="panel">
		<ul class="nav nav-pills">
		  <li role="presentation"><a href="#" data-toggle="collapse" id="togglepanel" data-target=".tab-content"><i class="fa fa-bars"></i></a></li>
		  <li role="presentation" class="active"><a href="#pois" data-toggle="pill">Σημεία Ενδιαφέροντος</a></li>
		  <li role="presentation"><a href="#hotpois" data-toggle="pill">Hot Σημεία τώρα</a></li>
		  <li role="presentation" id="routepill"><a href="#theme" data-toggle="pill">Διαδρομές</a></li>
		</ul>
		<div class="tab-content collapse in">	  
			<div id="theme" class="tab-pane fade" >
				<div class="form-group">
					<label for="start" class="col-lg-1 control-label">Αρχή</label>
					<div class="col-lg-11"><input placeholder="Επιλέξτε στον χάρτη σημείο εκκίνησης" id="start" type="text" name="start" onfocus="setActiveInput(true);" class="form-control" size="25" maxlength="255"></div>
				</div>
				<div class="form-group">
					<label for="end" class="col-lg-1 control-label">Τέλος</label> 
					<div class="col-lg-11"><input placeholder="Επιλέξτε στον χάρτη σημείο προορισμού" id="end" type="text" name="end" onfocus="setActiveInput(false);" class="form-control" size="25" maxlength="255"></div>
				</div>
				<button class="btn btn-primary btn-sm" onclick="showShortRoute()" style="margin:1em 0 1em 1em">Συντομη</button>
				<button id="hotBtn" class="btn btn-danger btn-sm" onclick="showHotnessRoute()" style="margin:1em 0 1em 1em;">Hot</button>
				<div style="border:thin solid rgba(0,0,0,0.2); margin:1em"></div>
				<div class="form-group">
					 <label for="theme" class="col-lg-1 control-label">Τύπος</label>
					 <div class="col-lg-11">
						<select id="thematic" class="form-control">
							<option value="4bf58dd8d48988d181941735" data-icon='museum' data-color="#27ae60">Μουσεία</option>
							<option value="4deefb944765f83613cdba6e" data-icon='point-of-interest' data-color="#00CCBB">Εξωτερικές τοποθεσίες(Αξιοθέατα)</option>
							<option value="4bf58dd8d48988d164941735" data-icon='map-pin' data-color="#6331AE">Πλατείες</option>
						</select>
					</div>
				</div><br>
				<button class="btn btn-success btn-sm" onclick="showThematicRoute()" style="margin:1em 0 1em 1em">Θεματικη</button>
			</div>
			<div id="pois" class="tab-pane fade in active">
				 <div class="row">
					<div class="col-lg-5">
						 <button class="btn btn-link content2" id="theat" onclick="toggleHeatmap()">heatmap</button>
					</div>
					<div class="col-lg-5">
						<button class="btn btn-link content2" id="tmark" onclick="toggleMarkers()">Σημεια</button>
					</div>
				</div>
				<h6>Δείτε τις πολυσύχναστες περιοχές για:</h6>
				<!--Days-->
				<div class="row">
					<div class="form-group">
						 <label for="days" class="col-lg-2 control-label">Ημέρα: </label>
						 <div class="col-lg-10">
						<select id="days" class="form-control">
							<option value="null">Σήμερα</option>
							<option value="Monday">Δευτέρα</option>
							<option value="Tuesday">Τρίτη</option>
							<option value="Wednesday">Τετάρτη</option>
							<option value="Thursday">Πέμπτη</option>
							<option value="Friday">Παρασκευή</option>
							<option value="Saturday">Σάββατο</option>
							<option value="Sunday">Κυριακή</option>
						</select>
						</div>
					</div>
				</div>
				<!--Hours-->
				<div class="row content2">
					<div class="form-group">
						 <label for="hour" class="col-lg-2 control-label">Ώρα: </label>
						 <div class="col-lg-10">
						<select id="hour" class="form-control">
							<option value="0">00:00</option>
							<option value="1">01:00</option>
							<option value="2">02:00</option>
							<option value="3">03:00</option>
							<option value="4">04:00</option>
							<option value="5">05:00</option>
							<option value="6">06:00</option>
							<option value="7">07:00</option>
							<option value="8">08:00</option>
							<option value="9">09:00</option>
							<option value="10">10:00</option>
							<option value="11">11:00</option>
							<option value="12">12:00</option>
							<option value="13">13:00</option>
							<option value="14">14:00</option>
							<option value="15">15:00</option>
							<option value="16">16:00</option>
							<option value="17">17:00</option>
							<option value="18">18:00</option>
							<option value="19">19:00</option>
							<option value="20">20:00</option>
							<option value="21">21:00</option>
							<option value="22">22:00</option>
							<option value="23">23:00</option>
						</select>
						</div>
					</div>
				</div><br>
				<button class="text-uppercase col-md-offset-4 btn btn-success" onclick="getHeatData(days.value,hour.value,false)">Ανανεωση</button>

				<h6>Κατηγορίες:</h6>
				<!--Categories-->
				<div class="list-group" style="height:200px;overflow:auto">
					<div class="checkbox list-group-item">
					  <label>
						   <input type="checkbox" value="4d4b7105d754a06374d81259" name="cats" onchange="filter();" CHECKED/> Φαγητό
					  </label>
					   <img src="img/pins/32x32/4d4b7105d754a06374d81259.png" width-"32px" height="32px" alt="" class="pull-right">
					</div>
					<div class="checkbox list-group-item">
					  <label>
						  <input type="checkbox" value="4d4b7105d754a06376d81259" name="cats" onchange="filter();" CHECKED/> Νυχτερινή ζωή
					  </label>
					  <img src="img/pins/32x32/4d4b7105d754a06376d81259.png" width-"32px" height="32px" alt="" class="pull-right">
					</div>
					<div class="checkbox list-group-item">
					  <label>
						  <input type="checkbox" value="4d4b7104d754a06370d81259" name="cats" onchange="filter();" CHECKED/> Τέχνες & Διασκέδαση
					  </label>
					  <img src="img/pins/32x32/4d4b7104d754a06370d81259.png" width-"32px" height="32px" alt="" class="pull-right">
					</div>
					<div class="checkbox list-group-item">
					  <label>
						  <input type="checkbox" value="4d4b7105d754a06377d81259" name="cats" onchange="filter();" CHECKED/> Εξωτερικοί Χώροι
					  </label>
					   <img src="img/pins/32x32/4d4b7105d754a06377d81259.png" width-"32px" height="32px" alt="" class="pull-right">
					</div>
					<div class="checkbox list-group-item">
					  <label>
						  <input type="checkbox" value="4d4b7105d754a06378d81259" name="cats" onchange="filter();" CHECKED/> Καταστήματα & Υπηρεσίες
					  </label>
					  <img src="img/pins/32x32/4d4b7105d754a06378d81259.png" width-"32px" height="32px" alt="" class="pull-right">
					</div>
					<div class="checkbox list-group-item">
					  <label>
						  <input type="checkbox" value="4d4b7105d754a06372d81259" name="cats" onchange="filter();" CHECKED/> Πανεπιστήμιο & Κολλέγιο
					  </label>
					   <img src="img/pins/32x32/4d4b7105d754a06372d81259.png" width-"32px" height="32px" alt="" class="pull-right">
					</div>
					<div class="checkbox list-group-item">
					  <label>
						  <input type="checkbox" value="4d4b7105d754a06379d81259" name="cats" onchange="filter();" CHECKED/> Μεταφορές & Μετακίνηση
					  </label>
					  <img src="img/pins/32x32/4d4b7105d754a06379d81259.png" width-"32px" height="32px" alt="" class="pull-right">
					</div>
					
					<div class="checkbox list-group-item">
					  <label>
						  <input type="checkbox" value="4e67e38e036454776db1fb3a" name="cats" onchange="filter();" CHECKED/> Κατοικίες
					  </label>
					   <img src="img/pins/32x32/4e67e38e036454776db1fb3a.png" width-"32px" height="32px" alt="" class="pull-right">
					</div>
					<div class="checkbox list-group-item">
					  <label>
						  <input type="checkbox" value="4d4b7105d754a06375d81259" name="cats" onchange="filter();" CHECKED/> Γραφεία & Επιχειρήσεις
					  </label>
					   <img src="img/pins/32x32/4d4b7105d754a06375d81259.png" width-"32px" height="32px" alt="" class="pull-right">
					</div>
					<div class="checkbox list-group-item">
					  <label>
						  <input type="checkbox" value="4d4b7105d754a06373d81259" name="cats" onchange="filter();" CHECKED/> Δρώμενο
					  </label>
					  <img src="img/pins/32x32/4d4b7105d754a06373d81259.png" width-"32px" height="32px" alt="" class="pull-right">
					</div>
				</div>
		
			</div>
			<div id="hotpois" class="tab-pane fade">
				<div class="list-group">
				  <h6><a class="list-group-item">
					Τα πιο καυτά μέρη είναι για <span id="daysPanel" style="color:#CB171E"></span> στις <span id="hourPanel" style="color:#CB171E"></span>: 
				  </a></h6>
				  <div id="hotPlaces"></div>
			   </div>
			</div>
		</div>
	</div>
	
    <div id="progress">
     <img src="img/spin.gif" width="50%" height="auto">
    </div>

    <div id="map-container">
  		<div id="map-canvas"></div>
	</div>

    <script src="https://maps.googleapis.com/maps/api/js?v=3&libraries=visualization"></script>
    <script>
    	const HOT_PLACES_NUM = 5;

        var map;
        var x;
        var marker;
        var infowindow = new google.maps.InfoWindow();
        var panorama;
        var startLatLon;
        var endLatLon;
        var distance;
        var theme = document.getElementById('thematic');
        var themeColor='#27ae60';
		var themevalue = '4bf58dd8d48988d181941735';
		var directionsService,directionsDisplay;
		var markers = [];
		var hotmarkers = [];
		var startInputFocused = true;
        //--variables for places
        var places = [];
        var markerPlaces = [];
        var theat = document.getElementById('theat');
        var tmark = document.getElementById('tmark');
		var routepill = document.getElementById('routepill');
        //---variables for heatmap feature---
        var heatmap;
        var heatmapData = [];
        var days = document.getElementById('days');
        var hour = document.getElementById('hour');
		
		var clickFlag = 0;

        var initialize = function() {
        	var startmarker,endmarker;        	
			tmark.style.color = '#439A46';
			theat.style.color = '#439A46';
            var latLon = new google.maps.LatLng(40.633596, 22.949594);

            var mapOptions = {
                zoom: 15,
                center: latLon,
				mapTypeControl: false,
				streetViewControl:false,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
			map.controls[google.maps.ControlPosition.TOP_LEFT].push(document.getElementById('panel'));
			map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('logobar'));
			
            map.addListener('click', function(e) {
            	var lat = e.latLng.lat();
                var lon = e.latLng.lng();
                var latlng = new google.maps.LatLng(lat, lon);
                if(routepill.className === 'active'){
                if(clickFlag === 0){
                	if(!startmarker){
						startmarker = new google.maps.Marker({
						position: latlng,
						map: map,
						draggable:true,
						title:'start',
						icon: "http://maps.google.com/mapfiles/markerA.png"
						});
						geocode(lat,lon,document.getElementById('start'));
						startLatLon = latlng;
						startmarker.addListener('dragend', function(e) {
							geocode(e.latLng.lat(),e.latLng.lng(),document.getElementById('start'));
							startLatLon = new google.maps.LatLng(e.latLng.lat(),e.latLng.lng());
						});
					} else {
						if(startInputFocused){
							startmarker.setPosition(latlng);
							geocode(lat,lon,document.getElementById('start'));
							startLatLon = latlng;
						}
					}
					document.getElementById("end").focus();
					clickFlag = 1;
                }else{
                	if(!endmarker){
						endmarker = new google.maps.Marker({
						position: latlng,
						map: map,
						draggable:true,
						title:'end',
						icon: "http://maps.google.com/mapfiles/markerB.png"
						});
						geocode(lat,lon,document.getElementById('end'));
						endLatLon = latlng;
						endmarker.addListener('dragend', function(e) {
							geocode(e.latLng.lat(),e.latLng.lng(),document.getElementById('end'));
							endLatLon = new google.maps.LatLng(e.latLng.lat(),e.latLng.lng());
						});
					} else {
						if(!startInputFocused){
							endmarker.setPosition(latlng);
							geocode(lat,lon,document.getElementById('end'));
							endLatLon = latlng;
						}
					}
					document.getElementById("start").focus();
					clickFlag = 0;
                }
                }else {
                	clearRetinaMarkers(markers);
                	clearRetinaMarkers(hotmarkers);
                	if(startmarker){
                		startmarker.setMap(null);
                		directionsDisplay.setMap(null);
                	}
                	if(endmarker){
                		endmarker.setMap(null);
                	}
                }
            });

            theme.addEventListener("change", function(){
                themevalue = this.value;
            });
            
            directionsService = new google.maps.DirectionsService;
			directionsDisplay = new google.maps.DirectionsRenderer;
			directionsDisplay.setMap(map);

            //----HeatMap---//
            initHeatmap();

        };
		
		var geocode = function(lat,lon,x){
			var geocoder = new google.maps.Geocoder;
			var latlng = {lat: lat, lng: lon};
			return geocoder.geocode({'location': latlng}, function(results, status) {
				if (status === google.maps.GeocoderStatus.OK) {
				  if (results[0]) {
					//console.log(results);
					if(x!==null)
						 x.value=results[0].address_components[1].short_name+" "+results[0].address_components[0].short_name;
				  } else 
					window.alert('No results found')
				} else 
				  window.alert('Geocoder failed due to: ' + status);
			  });
		};

        var showShortRoute = function(){
            if(startLatLon && endLatLon){
                calculateRoute('shortRoute');
            }else{
                alert('Please provide points');
            }
        };

        var showThematicRoute = function(){
			if(startLatLon && endLatLon){
				calculateRoute('thematicRoute');
			}
        };

        var showHotnessRoute = function(){
            if(startLatLon && endLatLon){
            	if(heatmap.getMap()===null){
            		heatmap.setMap(map);
            		theat.style.color = '#439A46';
                }
                calculateRoute('hotnessRoute');
            }
        };

        var calculateRoute = function(routeMode){

            directionsService.route({
                origin: startLatLon,
                destination: endLatLon,
                travelMode: google.maps.TravelMode.WALKING
            }, function(response, status) {
                if (status === google.maps.DirectionsStatus.OK) {
					//Get Walking Distance
                    distance = response.routes[0].legs[0].distance.value;

					if(routeMode === 'shortRoute'){
						polylineopt = {
        					strokeColor: '#2196F3'
			        	};
						directionsDisplay.setOptions({polylineOptions:polylineopt,suppressMarkers:true});
						clearRetinaMarkers(markers);
			        	clearRetinaMarkers(hotmarkers);
						directionsDisplay.setDirections(response);
					}else if(routeMode === 'thematicRoute'){
						getThematicWps();
					}else if(routeMode === 'hotnessRoute'){
						getHotnessWps();
					}else{
						console.log('none');
					}

                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        };
		
		var getThematicWps = function(){
			
			clearRetinaMarkers(markers);
        	clearRetinaMarkers(hotmarkers);

            if(!startLatLon && !endLatLon && distance) return;

            var routeData =  {
                slat: startLatLon.lat(),
                slon: startLatLon.lng(),
                elat: endLatLon.lat(),
                elon: endLatLon.lng(),
                d: distance,
                t: themevalue
            };

            document.getElementById("panel").style.display = 'none';
            document.getElementById("progress").style.display = 'block';

            var xmlhttp;

            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    
					var polylineColor = {
						strokeColor: themeColor
					};

					try {
						var data = JSON.parse(xmlhttp.responseText);
						createWaypts(data);	
					} catch(error) {
						console.log("Working on debug mode. Contact your administrator to change site's settings"+error);
						console.log(xmlhttp.responseText);
					}
					document.getElementById("panel").style.display = 'block';
					document.getElementById("progress").style.display = 'none';
                }
            }
            xmlhttp.open("POST", "getThematicWp.php", true);
            xmlhttp.send(JSON.stringify(routeData));
		};
        var infowindow2 = new google.maps.InfoWindow();
        var createWaypts = function(json){
        	var waypts = [];
        	var content = '';
        
			//Create dynamically waypoints returns from AJAX
			for (var i = 0, len= json.length;i < len; i++) {

				var name = json[i].name;
				var descr = json[i].descr;
				var image = json[i].image;
				var url = json[i].url;
				
				waypts.push({
					location: new google.maps.LatLng(json[i].lat,json[i].lon),
					stopover: true
				});
				var selectedTheme = thematic.options[ thematic.selectedIndex ];

				var wpmarker = new Marker({
					id:i,
					title : name,
					position: {'lat':json[i].lat, 'lng':json[i].lon},
					map:map,
					icon: {
						path: SQUARE_ROUNDED,
						fillColor: selectedTheme.dataset.color,
						fillOpacity: 1,
						strokeColor: '',
						strokeWeight: 0
					},
					map_icon_label: '<span class="map-icon map-icon-'+selectedTheme.dataset.icon+'"></span>'
				});

				content= '<h5>'+name+'</h5>'+	
			              	'<button id="add" title="Προσθήκη σημείου" class="btn btn-success" onclick="addPoint('+i+',0);infowindow2.close();" style="margin-right:10px"><i class="fa fa-check"></i></button>'+
			              	'<button id="remove" title="Αφαίρεση σημείου" class="btn btn-danger" onclick="removePoint('+i+',0);infowindow2.close();"><i class="fa fa-trash"></i></button><br><br>'+
			              	'<div id="pano2"></div><p>'+descr+'</p><br><p><a href="'+url+'" target="_blank">Περισσότερα...</a></p>';

				google.maps.event.addListener(wpmarker,'click', (function(wpmarker, infowindow2, content, i){
			          return function() {
				          	infowindow2.setContent(content);
			              	infowindow2.open(map,this);

			              	var pano = null;
				            google.maps.event.addListener(infowindow2, 'domready', function () {
			                    if (pano != null) {
			                        pano.unbind("position");
			                        pano.setVisible(false);
			                    }
			                    pano = new google.maps.StreetViewPanorama(document.getElementById("pano2"), {
			                        navigationControl: true,
			                        enableCloseButton: false,
			                        addressControl: false,
			                        linksControl: false
			                    });
			                    pano.bindTo("position", wpmarker);
			                    pano.setVisible(true);
			                });

			                google.maps.event.addListener(infowindow2, 'closeclick', function () {
			                    pano.unbind("position");
			                    pano.setVisible(false);
			                    pano = null;
			                });
			          };
			    })(wpmarker,infowindow2, content, i));

				markers.push({marker: wpmarker, flag: 1});

			}

			computeRoute(waypts,0);
			
			
        };

		var infowindow3 = new google.maps.InfoWindow();
        var getHotnessWps = function(){
			var content='';
			
			clearRetinaMarkers(markers);
        	clearRetinaMarkers(hotmarkers);

        	var waypts = [];
			
			for (var i=0; i < markerPlaces.length; i++) {
                if(i < HOT_PLACES_NUM){

                	var hotmarker = new Marker({
                		id:i,
						title : 'hot',
						position: {'lat': markerPlaces[i].marker.position.lat(), 'lng': markerPlaces[i].marker.position.lng()},
						map:map,
						icon: {
							path: SQUARE_ROUNDED,
							fillColor: '#E8363D',
							fillOpacity: 1,
							strokeColor: '',
							strokeWeight: 0
						},
						map_icon_label: '<span class="map-icon map-icon-fire-station"></span>'
					});
					
				 	content = '<h5>Hot Περιοχή</h5><button id="add" title="Προσθήκη σημείου" class="btn btn-success" onclick="addPoint('+i+',1);infowindow3.close();"'+ 'style="margin-right:10px"><i class="fa fa-check"></i></button>'+
			        '<button id="remove" title="Αφαίρεση σημείου" class="btn btn-danger"'+ 'onclick="removePoint('+i+',1);infowindow3.close();"><i class="fa fa-trash"></i></button><div id="pano3"></div>';
					
					google.maps.event.addListener(hotmarker,'click', (function(hotmarker, content, infowindow3, i){
			          return function() {
			              infowindow3.setContent(content);
			              infowindow3.open(map,this);
			              
			              var pano = null;
				            google.maps.event.addListener(infowindow3, 'domready', function () {
			                    if (pano != null) {
			                        pano.unbind("position");
			                        pano.setVisible(false);
			                    }
			                    pano = new google.maps.StreetViewPanorama(document.getElementById("pano3"), {
			                        navigationControl: true,
			                        enableCloseButton: false,
			                        addressControl: false,
			                        linksControl: false
			                    });
			                    pano.bindTo("position", hotmarker);
			                    pano.setVisible(true);
			                });

			                google.maps.event.addListener(infowindow3, 'closeclick', function () {
			                    pano.unbind("position");
			                    pano.setVisible(false);
			                    pano = null;
			                });
			           };
			    	})(hotmarker, content, infowindow3, i));

					hotmarkers.push({marker: hotmarker, flag: 1});

	                 waypts.push({
						location: new google.maps.LatLng(markerPlaces[i].marker.position.lat(), markerPlaces[i].marker.position.lng()),
						stopover: true
					});
                }
            }

            computeRoute(waypts, 1);
        };



        var computeRoute = function(waypts, flag){	
        	polylineopt = {
        		strokeColor: getThemeColor()
        	};	
			if(flag === 1)
				polylineopt.strokeColor= '#D91A21';
			console.log(waypts);
			directionsDisplay.setOptions({polylineOptions:polylineopt,suppressMarkers:true});
        	directionsService.route({
				origin: startLatLon,//40.637547, 22.937185
				destination: endLatLon,//40.638336, 22.947980
				waypoints: waypts,
				optimizeWaypoints: true,
				travelMode: google.maps.TravelMode.WALKING
			}, function(response, status) {
				if (status === google.maps.DirectionsStatus.OK) {
					directionsDisplay.setDirections(response);

				} else {
					window.alert('Directions request failed due to ' + status);
				}
				document.getElementById("panel").style.display = 'block';
                document.getElementById("progress").style.display = 'none';
			});
        };

        var removePoint = function(id, flag){//wplat, wplng
        	var arr;
        	if(flag === 0){
        		arr = markers;
        	}else{
        		arr = hotmarkers;
        	}

    		var waypts = [];

    		document.getElementById("panel").style.display = 'none';
            document.getElementById("progress").style.display = 'block';

    		for(var i=0; i<arr.length; i++){

    			//if(arr[i].marker.position.lat() !== wplat && arr[i].marker.position.lng() !== wplng && arr[i].flag === 1){
				if(arr[i].marker.id !== id && arr[i].flag === 1){
					waypts.push({
						location: new google.maps.LatLng(arr[i].marker.position.lat(), arr[i].marker.position.lng()),
						stopover: true
					});

    			}else{
    				arr[i].marker.setOpacity(0.5);
    				arr[i].flag=0;
    			}
    		}

    		computeRoute(waypts, flag);
        };

        var addPoint = function(id, flag){//wplat, wplng
        	var arr;
        	if(flag === 0){
        		arr = markers;
        	}else{
        		arr = hotmarkers;
        	}

    		var waypts = [];

    		document.getElementById("panel").style.display = 'none';
            document.getElementById("progress").style.display = 'block';

    		for(var i=0; i<arr.length; i++){

    			//if(arr[i].marker.position.lat() === wplat && arr[i].marker.position.lng() === wplng && arr[i].flag === 0){
    			if(arr[i].marker.id === id && arr[i].flag === 0){

					waypts.push({
						location: new google.maps.LatLng(arr[i].marker.position.lat(), arr[i].marker.position.lng()),
						stopover: true
					});
					arr[i].marker.setOpacity(1);
    				arr[i].flag=1;

    			}else if(arr[i].flag === 1){

    				waypts.push({
						location: new google.maps.LatLng(arr[i].marker.position.lat(), arr[i].marker.position.lng()),
						stopover: true
					});

    			}
    		}

    		computeRoute(waypts, flag);
        };


        /*var startTime = function() {
            var now = new Date();
            var d = now.getHours();
            var a = now.getMinutes();
            var c = now.getSeconds();
            a = checkTime(a);
            c = checkTime(c);
            //document.getElementById("clock").innerHTML = d + ":" + a + ":" + c;
            var t = setTimeout("startTime()", 500);
        };*/

       /* var checkTime = function(a) {
            if (a < 10) {
                a = "0" + a;
            }
            return a;
        };*/
        
        var initHeatmap = function(){
            //startTime();
            heatmap = new google.maps.visualization.HeatmapLayer({radius: 100,});
            var now = new Date();
            var oneHourBeforeNow = now.getHours();//(now > 0) ? (now.getHours() - 1) : 23;
			var weekday = [];
			weekday[0]=  "Sunday";
			weekday[1] = "Monday";
			weekday[2] = "Tuesday";
			weekday[3] = "Wednesday";
			weekday[4] = "Thursday";
			weekday[5] = "Friday";
			weekday[6] = "Saturday";

			var day = weekday[now.getDay()]; 
            getHeatData(day, oneHourBeforeNow,true);
        };

        var getHeatData = function(d, h,init) {
            var xmlhttp;
            
            document.getElementById("hotBtn").setAttribute("disabled","true");
	        document.getElementById("daysPanel").innerHTML = getGreekDay(d);
	        document.getElementById("hourPanel").innerHTML = h+":00";
	        
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                   
                    var response = xmlhttp.responseText;

                    if(response){
                        var data = JSON.parse(response);

                        //clear data when getHeatData function is called
                        //clearMarkers();
                        heatmapData = [];
                        //markerPlaces = [];
                        //places = [];
                        

                        for (var i = 0; i < data.length; i++) {
                            var lat = parseFloat(data[i].lat);
                            var lon = parseFloat(data[i].lon); 
                            var count =  parseInt(data[i].tcheckins);
                            var mastercat = data[i].mastercat;
                            var subcat = data[i].subcat;
                            var name = data[i].name;
                            
                            //Weighted data points: https://developers.google.com/maps/documentation/javascript/heatmaplayer
                            heatmapData.push({location: new google.maps.LatLng(lat, lon), weight: count});
							if(init)
	                            places.push({lat:lat, lon:lon, count:count, mastercat: mastercat, name:name, subcat:subcat});

                          
                        };

                        heatmap.setData(heatmapData);
                        heatmap.setMap(map);
                        if(init)
	                        createPOIMarkers();
                      
                        deleteDOMElements("hotPlaces");

                       for (var i = 0; i< places.length; i++) {

                            if(i < HOT_PLACES_NUM){
								createDOMElements("hotPlaces", markerPlaces[i].place.name, markerPlaces[i].place.subcat, markerPlaces[i].place.lat, markerPlaces[i].place.lon, i);
                            }
                       }

                       document.getElementById("hotBtn").removeAttribute("disabled");


                    }else{
                        console.log("no results");
                    }

                    
                }
            };
            xmlhttp.open("GET", "gen_points3_json.php?exec=true&day=" + d + "&hour=" + h, true);
            xmlhttp.send();
        };
        
        var createPOIMarkers = function(){
        	for(var i=0,len=places.length;i<len;i++){
        		 var marker = new google.maps.Marker({
						position: new google.maps.LatLng(places[i].lat, places[i].lon),
						map: map,
						icon: 'img/pins/48x48/'+places[i].mastercat+'.png',
						title: places[i].name
					});

					google.maps.event.addListener(marker,'click', (function(marker, infowindow, i){
						  return function() {
							  infowindow.setContent('<h5>'+places[i].name+'</h5><div id="pano"></div>');
							  infowindow.open(map,this);

							  var pano = null;
							  google.maps.event.addListener(infowindow, 'domready', function () {
								if (pano != null) {
									pano.unbind("position");
									pano.setVisible(false);
								}
								pano = new google.maps.StreetViewPanorama(document.getElementById("pano"), {
									navigationControl: true,
									enableCloseButton: false,
									addressControl: false,
									linksControl: false
								});
								pano.bindTo("position", marker);
								pano.setVisible(true);
							   });

								google.maps.event.addListener(infowindow, 'closeclick', function () {
									pano.unbind("position");
									pano.setVisible(false);
									pano = null;
								});
						  };
					 })(marker,infowindow, i));

					markerPlaces.push({place: places[i], marker: marker});
        	}
        }

        var toggleHeatmap = function() {
                heatmap.setMap(heatmap.getMap() ? null : map);
                heatmap.getMap()===null ? theat.style.color = '#626262': theat.style.color = '#439A46';
        };

        var toggleMarkersFlag = 1;
        var toggleMarkers = function() {

            if(toggleMarkersFlag === 1){

                for (var i=0; i < markerPlaces.length; i++) {
                    if(markerPlaces[i].marker.getMap() === map){
                        markerPlaces[i].marker.setMap(null);
                    }
                }
                //document.getElementById("categories").style.display = 'none';
                toggleMarkersFlag = 0;
                tmark.style.color = '#626262';

            }else{

                for (var i=0; i < markerPlaces.length; i++) {
                    if(markerPlaces[i].marker.getMap() === null){
                        markerPlaces[i].marker.setMap(map);
                    }
                }
                //document.getElementById("categories").style.display = 'block';
                toggleMarkersFlag = 1;
				tmark.style.color = '#439A46';
				
                var categories = document.getElementsByName("cats");
                for (i = 0; i < categories.length; i++) {
                    categories[i].checked = true;
                }
            }

            
        };

        var clearMarkers = function(){
            for(var i=0; i< markerPlaces.length; i++){
                markerPlaces[i].marker.setMap(null);
            };
        };

        var clearRetinaMarkers = function(arr){
        	if(arr.length>0){
        		arr.forEach(function(element, index, array){
        			element.marker.setMap(null);
        		});
        	}
        };

        var filter = function(){
            var categories = document.getElementsByName("cats");
            
            for (var i = 0; i < markerPlaces.length; i++) {
                 for (var j = 0; j < categories.length; j++) {

                    if(markerPlaces[i].place.mastercat === categories[j].value){
                            
                        if (categories[j].checked) {
                            markerPlaces[i].marker.setMap(map);
                        }else{
                            markerPlaces[i].marker.setMap(null);
                        }
                           
                    }

                 } 
            }
        };

        var getThemeColor = function(){
        	var selectedTheme = thematic.options[ thematic.selectedIndex ];
            switch(selectedTheme.value){
                case '4bf58dd8d48988d181941735': //Museum
                    themeColor='#27ae60';
                    break;
                case '4deefb944765f83613cdba6e': //Outdoor (Sites)
                    themeColor='#00CCBB';
                    break;
                case '4bf58dd8d48988d164941735': //Plaza
                    themeColor='#6331AE';
                    break;
                default:
                    themeColor='#2196F3';
                    break;
            }
            console.log(themeColor);
            return themeColor;
        };


        var deleteDOMElements = function(id){
        	var myNode = document.getElementById(id);
			while (myNode.firstChild) {
			    myNode.removeChild(myNode.firstChild);
			}
        };
        
        var getGreekDay = function(day){
        	var grday = '';
        	switch (day){
        		case 'Monday': grday = 'Δευτέρα';break;
        		case 'Tuesday': grday = 'Τρίτη';break;
        		case 'Wednesday': grday = 'Τετάρτη';break;
        		case 'Thursday': grday = 'Πέμπτη';break;
        		case 'Friday': grday = 'Παρασκευή';break;
        		case 'Saturday': grday = 'Σάββατο';break;
        		case 'Sunday': grday = 'Κύριακη';break;
        		default: grday='Σήμερα';break;
        	}
        	
        	return grday;
        }

        var createDOMElements = function(id, name, subcat, lat, lon, i){

			var a = document.createElement("a");

			var src = document.createAttribute("href");
			src.value = "#";
			a.setAttributeNode(src);

			var cl = document.createAttribute("class");
			cl.value = "list-group-item";
			a.setAttributeNode(cl);

			var attr = document.createAttribute("onclick");
			attr.value = "map.panTo(new google.maps.LatLng("+lat+","+ lon+")); google.maps.event.trigger(markerPlaces["+i+"].marker, 'click');";
			a.setAttributeNode(attr);   	 	 


			var img = document.createElement("img");
			var src = document.createAttribute("src");
			src.value = "img/hot.png";
			var width = document.createAttribute("width");
			width.value = "10px";
			var height = document.createAttribute("height");
			height.value = "12px";
			img.setAttributeNode(src);
			img.setAttributeNode(width);
			img.setAttributeNode(height);
			a.appendChild(img);

			var t = document.createTextNode(" "+name+ " ( "+subcat+" )");       
			a.appendChild(t);


			document.getElementById(id).appendChild(a);  
        };
        var setActiveInput = function(focused){
        	startInputFocused = focused;
        };
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
	<!--<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.min.js"></script>-->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript" src="dist/js/map-icons.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>

</html>