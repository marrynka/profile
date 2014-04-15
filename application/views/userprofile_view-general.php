<?php

foreach($records as $row)
{echo "<div id='activityWrap'>";
	echo "<div id='activity'>";
	echo "<div id='activity app'>".$row->client_id."</div>";
	//echo $row->activity_type;
	
	echo $row->activity;
	
	echo "<div id='activity_time'>".$row->time."</div>";
	echo "</div>";
	echo "</div>";
}
?>
