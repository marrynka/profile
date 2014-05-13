<div class="inside">
                  <div class="sideportlet">
                    <h3>Najvyšší rating majú:</h3>
                    <div id="userList">
                    <?php
                    $base = base_url();
					$pos = strpos($base,'://');
					$baseurl = substr($base,$pos+3,strlen($base));
                    
                    
                    for($i = 0; $i < $data['bestUsers']['amount']; $i++)
	                {?>
					<a href="<?php echo 'http://'.$data['bestUsers'][$i]->username;?>.profile.matfyz.sk"><img src="<?php echo base_url().'/images/users/'.$data['bestUsers'][$i]->username.'/avatar.jpg'; ?>" width="40" height="40"  /></a>
			
					<?php
					}
					
                   ?>
                   </div>
                  </div>
                  <div class="sideportlet">
                    <h3>Noví používatelia sú:</h3>
                    <div id="userList"> 
                     <?php
                     for($i = 0; $i < $data['newUsers']['amount']; $i++)
	                {?>
					<a href="<?php echo 'http://'.$data['newUsers'][$i]->username;?>.profile.matfyz.sk"><img src="<?php echo base_url().'/images/users/'.$data['newUsers'][$i]->username.'/avatar.jpg'; ?>" width="40" height="40"  /></a>
			
					<?php
					}
                   ?>
                    
                   </div>
                  </div>
</div>
