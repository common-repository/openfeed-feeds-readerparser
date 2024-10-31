<?php

// Dropstr Inc
// Feeds
global $current_user;
get_currentuserinfo();
$myID = $current_user->ID;
if ( is_user_logged_in() ) { 

include("userData.php");
$timeframe = $myData["timeframe"];
$bookmarks = $myData["bookmarks"];
$follows = $myData["follow"];
$myTrendFeed = $myData["feeds"];

// If Channel is changed, use command
if($_GET["channel"]){
 $myTrendFeed = $_GET["channel"];   
}

// Check if trending or RT feed

// Check if user using an old outdated feed type
if($timeframe == "30" || $timeframe == "1" || $timeframe == "3" || $timeframe == "rt" || $timeframe == "6"){
    $timeframe = "6";
} else { $timeframe = "24"; }

    $myData = wp_remote_get('https://api.dropstr.com/openFeed/v1/?c=getFeed&feed='.$myTrendFeed.'&type=trending&timeline='.$timeframe.'&key='.$myApiKey.'', array( 'sslverify' => false ));
    $feedType = " Games";
    $feedTime = " Trending / $timeframe";


$body = $myData['body'];
$ofFeed = json_decode($body, true);
setcookie("feedTokenCache_".$myTrendFeed."", $ofFeed["cacheToken"], time() + (86400 * 30), "/");

?>
<style type="text/css">
#loading-div{
    display: none;
}
</style>
<script>

 <?php
if($timeframe == "rt" || $myTimeFrame == "follow"){
echo ' if ( jQuery("#button-more").is(":visible") ){';
echo "jQuery('#button-more').hide(); }";
}
 ?> 
/**
 * @author Shaumik Daityari
 * @copyright Copyright © 2013 All rights reserved.
 */

var lazyload = lazyload || {};

(function(jQuery, lazyload) {
    "use strict";

    var page = 2,
        buttonId = "#button-more",
        loadingId = "#loading-div",
        container = "#data-container";

    lazyload.load = function() {

        var url = "<?php echo $domain; ?>/?openfeed=more&offset=" + page + "";

        jQuery(buttonId).hide();
        jQuery(loadingId).show();

        jQuery.ajax({
            url: url,
            success: function(response) {
                if (!response || response.trim() == "NONE") {
                    jQuery(buttonId).fadeOut();
                    jQuery(loadingId).text("No more entries to load!");
                    return;
                }
                appendContests(response);
            },
            error: function(response) {
                jQuery(loadingId).text("Sorry, there was some error with the request. Please refresh the page.");
            }
        });
    };

    var appendContests = function(response) {
        var id = jQuery(buttonId);

        jQuery(buttonId).show();
        jQuery(loadingId).hide();

        jQuery(response).appendTo(jQuery(container));
        page += 1;
    };

})(jQuery, lazyload);
</script>
<body>         
 <div id="data-container" class="list-group"><div style="height:58px"></div>
 
<?php
include("feedData.php");

			   ?>
			   </div><a href="#" id="button-more" onclick="lazyload.load();return false" class="btn btn-default btn-lg btn-block">Load More</a><div id="loading-div">
                loading more items
            </div>
            <p><br /></p>
</body>
</html>
<?php  } ?>
