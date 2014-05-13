	<div id="about_long">
	<h3>Niečo viac o mne</h3>
    <p><?php echo $data['records']->about_long ?></p>
    </div>
    <div id="contact">
    <h3>Kontakt</h3>
    <div id="giveBadge"><a href="<?php echo site_url('give');  ?>">udeľ mi odznak</a></div>
    
    <div id="contact_address">
	<?php
	$name = substr($data['records']->email , 0, strpos($data['records']->email, '@'));
	$where = substr($data['records']->email, strpos($data['records']->email, '@') + 1, strlen($data['records']->email)); 
	echo $name. " (zavináč) ".$where; 
	
	?></div>
    
    <div id="clear"></div>
    </div>
    <?php
    //if(isset($data['badges']))
    //{
	?>
	<div id="badgesWrapper">
    <h3>Moje odznaky</h3>
    <?php
    if($data['username']!= $data['is_logged_in'])
    {
    ?>
		
    <?php
	}
    ?>
    <?php
    if(isset($data['badges']))
     {
		foreach($data['badges'] as $row)
		{
			
			echo "<div id='badgeWrap'>";
			echo "<div id='badgeUpperbar'>" .$row->badge_description ."</div>";
			echo "<div id='badge_description'>" . "</div>";
			echo "<div id='badge_outside'><img src=". base_url().'images/files/badges/'.$row->picture." /></div>";
			echo "<div id='badge_comment'> ";
			if($row->comment != '')
			{
			?>
			<blockquote class="style1"><span>
			<?php
			echo $row->comment;
			?>
			</span><a href='http://<?php echo $row->username; ?>.profile.matfyz.sk'><?php echo $row->username;?></a><br />
			<div id="timeAward"><?php echo $row->time;?></div>
			</blockquote>

			<?php
			
			}
			else
			{
			?>
			<div id="badge_giver"><a href='http://<?php echo $row->username; ?>.profile.matfyz.sk'><?php echo $row->username;?></a><br />
			 <?php
			 echo $row->time; ?>
			</div>
			<?php
			}
			
			
		    echo "</div>";
		    
			echo "</div>";
		}
	 }
	?>
	</div>
	
	<?php
	//}
	if(isset($data['achievements']))
    {	
	?>

	<div id="achievementsWrapper">
    <h3>Moje ocenenia</h3>
    <?php
    
		foreach($data['achievements'] as $row)
		{
			
			echo "<div id='achievementWrap'>";
			echo "<div id='achievementUpperbar'>". $row->achievement_description. "</div>";
			echo "<div id='achievement_outside'>";
			echo "<img src=". base_url().'images/files/achievements/'.$row->picture." />";
			echo "</div>";
			echo "<div id='achievement_comment'>";
			echo "<div id='achievement_giver'>". $row->source."<br /><div id='timeAward'>" . $row->time. "</div></div>";
			echo "</div>";
			echo "</div>";
		}
		
	?>
	</div>
  
    <?php
    }
     ?>

    
    
