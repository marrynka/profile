<?php

foreach($records as $row)
{echo "<div id='activityWrap'>";
	echo "<div id='activity'>";
	echo "<div id='activityUpperbar'>";
	echo "<div id='activity_time'>".$row->time."</div>";
	echo "<div id='activity_client_id'>".$row->client_id."</div>";
	//echo $row->activity_type;
	echo "</div>";
	echo $row->activity;
	
	
	echo "</div>";
	echo "</div>";
}
?>
