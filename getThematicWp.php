<?php
// 1 POST LAT, LON AND WALKING DISTANCE BETWEEN START POINT AND DESTINATION POINT
/*
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
*/
$DEBUGMODE = false;

dbConnect();

function dbConnect(){
	//Connection to database
	$dbHost = 'localhost';
	$dbUser = 'hot_thess';
	$dbPass = 'hot_thess1234';
	$dbName = 'hot_thess';
	$connection = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName)
			or die('Error Connecting to MySQL DataBase');
	mysqli_set_charset($connection, "utf8");
	
	$data = file_get_contents('php://input');
	$data = json_decode($data,true);
	
	dbSelect($connection,$data);
}

function dbSelect($con,$data){
	global $DEBUGMODE;
	$waypoints=array();
	$distance=0;
	$slat = $data['slat'];
	$slon = $data['slon'];
	$elat = $data['elat'];
	$elon = $data['elon'];
	$distance = $data['d'];
	$theme = $data['t'];
	
	if($DEBUGMODE){
		echo "call haversine($slat,$slon,$elat,$elon,$theme,$distance)";
		print_r($data);
	}
	
	unset($data['d']);
	unset($data['t']);
	
	//GET THEMATIC ROUTES POIS FROM DATABASE
	$result = mysqli_query($con,"call haversine(".$slat.",".$slon.",".$elat.",".$elon.",'".$theme."',".$distance.")");
	while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
		$waypoints[] = $row;
	}
	sort($waypoints);
	filterWp($waypoints);
	
	if($DEBUGMODE){
		//echo "<pre>";
		print_r($waypoints);
		//echo "</pre>";
	}
	
	dbClose($con);
}

function filterWp($waypoints){
	global $DEBUGMODE;
	$filteredWp = array();
	$region=0;
	$previous_dest=$distance;
	foreach($waypoints as $key=>$value){
		if(isset($value['bid'])){
			if($region == $value['bid']){
				unset($waypoints[$key]);
				continue;
			}

			if($key==0){
				$filteredWp[] = array("bid"=> $value['bid'], "lat"=>$value['lat'], "lon"=>$value['lon'], "name"=>$value['name'], "start"=>$value['d_start'], "dest"=>$value['d_dest'], "descr"=>$value['description'], "image"=>$value['image'], "url"=>$value['url']);
				$region = $value['bid'];
				$previous_dest = $value['d_dest'];
			} else {
				if($value['d_dest']<$previous_dest){
					$filteredWp[] = array("bid"=> $value['bid'], "lat"=>$value['lat'], "lon"=>$value['lon'], "name"=>$value['name'], "start"=>$value['d_start'], "dest"=>$value['d_dest'],"descr"=>$value['description'], "image"=>$value['image'], "url"=>$value['url']);
					$previous_dest = $value['d_dest'];
					$region = $value['bid'];
				}
			}
		}
	}
	if($DEBUGMODE){
		//echo "<pre>";
		print_r($filteredWp);
		//echo "</pre>";
	}else
		echo json_encode($filteredWp,JSON_NUMERIC_CHECK);
}

function dbClose($con){
	mysqli_close($con);
}
?>