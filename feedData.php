<?php
// Dropstr Inc
// openFeed Feed Data
$rc =1;
$flag = false;
foreach ($ofFeed as $innerArray) {
    //  Check type
    if (is_array($innerArray)){
        //  Scan through inner loop
        
        foreach ($innerArray as $value) {
				if($rc == "1"){
                    if($value == "status"){
                      $flag = true;
                    }
                	} 
                	if($flag == true){
                        echo'<div align="center" class="data-item"><h4 class="list-group-item-heading">You Have 0 $ofStatus</h4></div>'; } else {
                    $excerpt = strip_tags($value["excerpt"], '<br><img>');
                    $title = strip_tags($value["title"]);
                    $title = (strlen($title) > 96) ? substr($title,0,93).'...' : $title;
                    $categories = $value["categories"];
                    $catTokens = $value["categoriesToken"];
                    // Split cats into an array and get results into hash tag
                    $host = parse_url($value["url"], PHP_URL_HOST); 
                  echo'<div class="data-item"><div style="display:inline-block;width:100%;"><p class="list-group-item-text"><div style="float:left;padding:10px;width:100%"><div style="height:40px;"><h4 class="list-group-item-heading"><a href="'.$value["url"].'" target="_blank" style="text-decoration:none;color:#000"><b> '.$title.'</b></a></h4></div><div> '.$excerpt.'</div><div><span class="label" style="color:#000;">'.$host.'</span></div></div></div></div><hr style="margin-top:5px;margin-bottom:15px;"/>';
    
                }
          $rc++;      	
		}
		
	}
}
?>

