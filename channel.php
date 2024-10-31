<?php
// openFeed Channel Selector
if($_GET["set"]){
	 $myTrendFeed = $_GET["set"]; }
	
else {

 global $current_user;
get_currentuserinfo();
$myID = $current_user->ID;

    if ( is_user_logged_in() ) {
      include("userData.php");
      $myTrendFeed = $myData["feeds"];
      }     
  }
?> 
<a href="#" id="<?php echo $myTrendFeed; ?>" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color:#FFF;text-decoration:none;padding-top:10px;">        
    <?php
        if($myTrendFeed == "games"){
          echo "Games";
        } else { echo "Technology"; }
        ?> <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#" id="<?php
        if($myTrendFeed == "games"){
          echo "technology";
        } else { echo "games"; }
        ?>" class="changeTrend">    <?php
        if($myTrendFeed == "games"){
          echo "Technology";
        } else { echo "Games"; }
        ?></a></li>
          </ul>
