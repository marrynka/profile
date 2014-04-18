<?php
if(isset($data['records']))
{
	foreach($data['records'] as $row)
	{echo "<div id='activityWrap'>";
		echo "<div id='activity'>";
		echo "<div id='activityUpperbar'>";
		echo "<div id='activity_time'>".$row->time."</div>";
		echo "<div id='activity_title'>". $row->activity_title. "</div>";
		echo "</div>";
		echo $row->activity;
		
		
		echo "</div>";
		echo "</div>";
	}
}
else
{
	echo "Zatiaľ nebola vykonaná žiadna aktivita";
}
?>
