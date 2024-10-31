<?php
// Dropstr Inc
// Feeds
global $current_user;
get_currentuserinfo();
$myID = $current_user->ID;
if ( is_user_logged_in() ) { 

include("userData.php");
$timeframe = $myData["timeframe"];
$myTrendFeed = $myData["feeds"];
$offset = $_GET["offset"];


$myData = wp_remote_get("https://api.openfeed.io/v1/?c=getFeed&feed=".$myTrendFeed."&type=trending&timeline=$timeframe&offset=$offset&key=$myApiKey", array( 'sslverify' => false ));
$body = $myData['body'];
$ofFeed = json_decode($body, true);

if($offset == "2"){ $rc = 51;}elseif ($offset == "3") {$rc = 101;} else {$rc = 151;}

        foreach ($ofFeed as $innerArray) {
            //  Check type
            if (is_array($innerArray)){
                //  Scan through inner loop
                
                foreach ($innerArray as $value) {
                    $excerpt = strip_tags($value["excerpt"], '<br><img>');
                    $title = strip_tags($value["title"]);
                    $title = (strlen($title) > 96) ? substr($title,0,93).'...' : $title;
                    $categories = $value["categories"];
                    $catTokens = $value["categoriesToken"];
                    // Split cats into an array and get results into hash tag
                    $host = parse_url($value["url"], PHP_URL_HOST); 
                  echo'<div class="data-item"><div style="display:inline-block;width:100%;"><p class="list-group-item-text"><div style="float:left;padding:10px;width:100%"><div style="height:40px;"><h4 class="list-group-item-heading"><a href="'.$value["url"].'" target="_blank" style="text-decoration:none;color:#000"><b> '.$title.'</b></a></h4></div><div> '.$excerpt.'</div><div><span class="label" style="color:#000;">'.$host.'</span></div></div></div></div><hr style="margin-top:5px;margin-bottom:15px;"/>';
          $rc++;     	
		}
		
	}
}

	}		   ?>
