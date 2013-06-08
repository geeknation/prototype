<?php
?>
	<script type="text/javascript" src="jquery_ptk/js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript">
jQuery(document).ready(function($){
	$('#collectionloader').load("collections.php?item=n");
	$("#li_n a").click(function(e){
		e.preventDefault();
		$('#collectionloader').load("collections.php?item=n");
	});

	$("#li_sch a").click(function(e){
		e.preventDefault();
		$("#collectionloader").load("collections.php?item=sch");
	});

	$("#li_atm a").click(function(e){
		$("#collectionloader").load("collections.php?item=atm");
	});	

	$("#li_pass a").click(function(e){
		e.preventDefault();
		$("#collectionloader").load("collections.php?item=pass");
	});


	

});
	</script>
	<style type="text/css">
		#collectionloader{
			width:90%;
			text-align: center;
		}

	</style>
<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active" id="li_n"><a href="#tab1" data-toggle="tab">National IDs</a></li>
    <li id="li_sch"><a href="#tab2" data-toggle="tab">School IDs</a></li>
    <li id="li_atm"><a href="#tab3" data-toggle="tab">Atm Cards</a></li>
    <li id="li_pass"><a href="#tab4" data-toggle="tab">Passports</a></li>
  </ul>
  <div class="tab-content" id="collectionloader">
  	  
  </div>
</div>

