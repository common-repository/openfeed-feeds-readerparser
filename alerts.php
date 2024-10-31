<?php
// Dropstr Inc
$type = $_GET["type"];
?>
<script>
jQuery(document).ready(function(){
      jQuery("#reload").click(function(evt) {
         jQuery("#feeds").load("<?php echo "$domain/?openfeed=feeds"; ?>")
         evt.preventDefault();
      })
});
</script>
<?php if($type == "feedUpdate"){ ?>
<div class="alert alert-dismissible alert-success" style="margin-top:46px">
  <span class="glyphicon glyphicon-refresh" style="float:left;padding:4px;"></span> <h4> Feed Updates</h4>
  <p>There are new updates to your current feed, please refresh the feed to see changes. <a href="#" id="reload" class="alert-link" data-dismiss="alert">Refresh Now</a>.</p>
</div>
<?php } if($type == "update"){ ?>
<div class="alert alert-dismissible alert-warning" style="margin-top:46px">
  <span class="glyphicon glyphicon-info-sign" style="float:left;padding:4px;"></span> <h4> Service Update</h4>
  <p>There has been an update to the service, please refresh to load changes. <a href="/wp-admin/admin.php?page=openfeed" class="alert-link">Refresh</a></p>
</div>
<?php  } ?>
<?php if($type == "disruption"){ ?>
<div class="alert alert-dismissible alert-danger" style="margin-top:46px">
  <span class="glyphicon glyphicon-info-sign" style="float:left;padding:4px;"></span> <h4> Service Disruption</h4>
  <p> Our monitoring service has detected a disruption, incoming data may be delayed or inaccurate. <a href="https://www.opensuite.io/category/status/" style="color:#FFF;" target="openSuiteStatus">Visit our blog for status updates.</a></p>
</div>
<?php  } ?>