<div id="my_profile">
	<div id="left_profile_column">
			<div id="about_long">
			<h3>Niečo viac o mne</h3>
			<p><?php echo $data['records']->about_long ?></p>
			</div>
			
			<div id="contact">
			<h3>Kontakt</h3>
			<?php
			$name = substr($data['records']->email , 0, strpos($data['records']->email, '@'));
			$where = substr($data['records']->email, strpos($data['records']->email, '@') + 1, strlen($data['records']->email)); 
			echo $name. " (zavináč) ".$where; 
			?>
			</div>
			 
			<div id="badgesWrapper_small">
			<h3>Moje najnovšie odznaky</h3>
			
			<?php
			if(isset($data['badges']))
			 {
				foreach($data['badges'] as $row)
				{
					
					echo "<div id='badge_outside_small'>";
					echo "<div><img src='".  base_url()."css/blank_badge_green_small.png' /></div>";
					echo $row->badge_title;
					echo "</div>";
				}
			 }
			?><div id="clear"></div>
			<?php
			if($data['username']!= $data['is_logged_in'])
			{
			?>
				<div id="giveBadge"><a href="<?php echo site_url('give')?>">udeľ odznak</a></div>
			<?php
			}
			if(isset($data['badges']))
			{
			?>
			<div id="showAll" ><a href="<?php echo site_url('userprofile/about')?>" id="about_button" >Všetky odznaky</a></div>
			<?php
		    }
		    ?>
			</div>
			
			<?php
			//}
			if(isset($data['achievements']))
			{	
			?>

			<div id="achievementsWrapper_small">
			<h3>Moje najnovšie ocenenia</h3>
			<?php
			
				foreach($data['achievements'] as $row)
				{
					
					echo "<div id='achievement_outside_small'>";
					echo "<div><img src='".  base_url()."css/blank_achievement_green_small.png' /></div>";
					echo $row->achievement_title;
					echo "</div>";
					
					
				}
				
			?>
			</div>
			<div id="clear"></div>
			<?php
			  if(isset($data['achievements']))
			  {
				?>
			<div id="showAll" ><a href="<?php echo site_url('userprofile/about')?>" id="about_button">Všetky ocenenia</a></div>
			<?php
		      }
			}
			 ?>
	
	</div>	
	
	<div id="right_profile_column">
    <div id="activitiesWrapper">
	<h3>Moje aktivity<?php if (isset($data['which_activities']) && $data['which_activities'] != '') echo " na ".$data['which_activities']; ?></h3>
<?php

if(isset($data['activities']))
{
	foreach($data['activities'] as $row)
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
	?>			<div id="showAll" ><a href="<?php echo site_url('userprofile/activities')?>" id="activities_button" >Všetky aktivity</a></div>
<?php
}
else
{
	echo "Zatiaľ nebola vykonaná žiadna aktivita";
}

?>
</div>
    </div>	
</div>	

<script type="text/javascript">

$('#about_button').click(function()
{
	
var form_data = 
{

	 username: '<?php echo $data['username']; ?>' ,
	ajax: '1'
	};
	$.ajax(
	{
	url: "<?php echo site_url('userprofile/about'); ?>",
	type:'POST',
	data: form_data,
	success: function(msq)
	{
	  $('#info').html(msq);
	  /*$('#selected').replaceWith($('#selected').html());
	  $('#about_option').html('<div id="selected">'+$('#about_option').html()+"</div>");
*/
	
	}

	}
	)
	
	return false;
}

);
	
	</script>
    
   

    
    
