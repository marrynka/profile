<div id="profile">
	<h3>Používatelia s najvyšším ratingom</h3>
	<?php
	
	$base = base_url();
    $pos = strpos($base,'://');
    $baseurl = substr($base,$pos+3,strlen($base));
    ?>
    
    <div id="listofUsers">
    <?php
	for($i = 0; $i < $data['bestUsers']['amount']; $i++)
	{
		?>
		
	        <div id='bestUser' >
			
				<a href="<?php echo 'http://'.$data['bestUsers'][$i]->username.'.'.$baseurl; ?>"><img src="<?php echo base_url().'/images/users/'.$data['bestUsers'][$i]->username.'/avatar.jpg'; ?>" width="120" height="120"  /></a>
			
			<?php echo $data['bestUsers'][$i]->first_name." ". $data['bestUsers'][$i]->surname?>
			
			</div>  
		<?php
	}
	?>
	</div>
		<div id="clear"></div>
	<h3>Najnovší používatelia</h3>
	<div id="listofUsers">
	<?php	
	
	for($i = 0; $i < $data['newUsers']['amount']; $i++)
	{
		?>
		
	        <div id='bestUser' >
			
				<a href="<?php echo 'http://'.$data['newUsers'][$i]->username.'.'.$baseurl; ?>"><img src="<?php echo base_url().'/images/users/'.$data['newUsers'][$i]->username.'/avatar.jpg'; ?>" width="120" height="120"  /></a>
			
			<?php echo $data['newUsers'][$i]->first_name." ". $data['newUsers'][$i]->surname?>
			
			</div>  
		<?php
	}
		?>
	</div>
	<div id="clear"></div>
	<h3>Ďalší používatelia</h3>
	<div id="listofUsers">
	<?php	
	
	for($i = 0; $i < $data['randomUsers']['amount']; $i++)
	{
		
		?>
		
	        <div id='bestUser' >
			   
				<a href="<?php echo 'http://'.$data['randomUsers'][$i]->username.'.'.$baseurl; ?>"><img src="<?php echo base_url().'/images/users/'.$data['randomUsers'][$i]->username.'/avatar.jpg'; ?>" width="120" height="120"  /></a>
			
			<?php echo $data['randomUsers'][$i]->first_name." ". $data['randomUsers'][$i]->surname?>
			
			</div>  
		<?php
	}
		?>
	</div>
	
	
	
	
</div>
