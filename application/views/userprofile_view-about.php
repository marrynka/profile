	<div id="about_long">
	<h3>Niečo viac o mne</h3>
    <p><?php echo $data['records']->about_long ?></p>
    </div>
    <div id="contact">
    <h3>Kontakt</h3>
    <?php echo $data['records']->email ?>
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
		<div id="giveBadge"><a href="give">udeľ odznak</a></div>
    <?php
	}
    ?>
    <?php
    if(isset($data['badges']))
     {
		foreach($data['badges'] as $row)
		{
			
			echo "<div id='badge_outside'>";
			echo "<img src=". base_url().'images/files/badges/'.$row->picture." />";
			echo "</div>";
		}
	 }
	?>
	</div>
	<div id="clear"></div>
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
			
			echo "<div id='achievement_outside'>";
			echo "<img src=". base_url().'images/files/achievements/'.$row->picture." />";
			echo "</div>";
		}
		
	?>
	</div>
    <div id="clear"></div>
    <?php
    }
     ?>

    
    
