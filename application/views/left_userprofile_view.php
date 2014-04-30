<div class="inside">
	<div class="sideportlet">
		   
			
			 <div class="avatar">
			<img src="<?php echo base_url().'/images/users/'.$data['records']->username.'/avatar.jpg'; ?>"   />
		  </div>
		   <?php
		    if($data['is_logged_in']) echo "<div id='edit_userprofile'><a href='".site_url()."/edit_userprofile'>edit my profile</a></div>";
		    ?>
		  <?php if($data['records']->occupation != 'other')
		  {?>
		  <h3>Kto som</h3>
		  <div id="occupation">
			<img src="<?php echo base_url().'/css/'.$data['records']->occupation.'.png';?>" /><label><?php echo $data['records']->occupation; ?></label>
		  </div>
		  <?php
		  } 
		  ?>
		  <h3>Čo robím</h3>
		  <div id="aboutShort">
			<?php echo $data['records']->about_short; ?>
		  </div>
	  </div>
				
              
                  
                 
</div>
