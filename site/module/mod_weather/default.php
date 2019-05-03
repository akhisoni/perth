<?php
$op=array("place"=>" toronto,canada","degrees"=>"c");
$obj=new SimpleWeather($op);
$results=$obj->getResult();
//echo "<pre>"; print_r($results); die;
?>
<div class="weather">
	<h3>WEATHER</h3>
	<ul>
		<li><?php echo $results->location->city; ?></li>
		<li><?php echo $results->current_condition->date; ?> </li>
		<li><?php echo $results->current_condition->temp; ?>&deg; C <?php echo $results->current_condition->text; ?></li>
		
	</ul>
	<span style="display:block; text-align:right; padding-right:20px;"><a href="<?php echo CreateLink(array("weather")); ?>">Weather..</a></span>
</div>