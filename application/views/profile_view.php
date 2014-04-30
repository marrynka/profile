	<div id="profile">
	<div id="mozaicUsers-left">
    <?php 
    $k=0;
    for($j=6;$j>0;$j=$j-1)
    { 
      ?> <div id="mozaic_row<?php //echo 6-$j;?>"> 
      <?php
      for($i=0;$i<$j;$i=$i+1)
      { 
        ?>
        <div id="mozaic">
        <?php
        $base = base_url();
        $pos = strpos($base,'://');
        $baseurl = substr($base,$pos+3,strlen($base));
        
       
        
        ?>
        <a href="<?php echo 'http://'.$data['mozaic'][$k]->username.'.'.$baseurl; ?>"><img src="<?php echo base_url().'/images/users/'.$data['mozaic'][$k]->username.'/avatar.jpg'; ?>" width="50" height="50"  /></a>
        </div>
        
        
        <?php
        $k=$k+1;
        if($k == $data['amount'])
        {
        $k = 0;
        }
      }
        if(($j == 6 && $i == 6))
        {
		?>
			
		<?php
		}
        if(($j == 5 && $i == 5))
        {
		?>
			
			<div id='bestUser'>
			<h3>Najlepší užívateľ</h3>
			<a href="<?php echo 'http://'.$data['bestUser']->username.'.'.$baseurl; ?>"><img src="<?php echo base_url().'/images/users/'.$data['bestUser']->username.'/avatar.jpg'; ?>" width="120" height="120"  /></a>
			<?php echo $data['bestUser']->first_name." ". $data['bestUser']->surname?>
			</div>  
		<?php
		}
		if(($j == 2 && $i == 2))
        {
		?>
			
			<div id='bestUser2' >
			<h3>Najlepší bloger</h3>
			
				<a href="<?php echo 'http://'.$data['bestUser2']->username.'.'.$baseurl; ?>"><img src="<?php echo base_url().'/images/users/'.$data['bestUser2']->username.'/avatar.jpg'; ?>" width="120" height="120"  /></a>
			
			<?php echo $data['bestUser2']->first_name." ". $data['bestUser2']->surname?>
			
			</div>  
		<?php
		}
        
      ?> 
      </div>
      
      
      <?php
    }
    ?>
    </div>
    
     
     
    <div id="mozaicUsers-right">
    <?php
     
    
    for($j=1;$j<=6;$j=$j+1)
    { 
      ?> <div id="mozaic_row<?php //echo 6-$j;?>"> 
      <?php
      for($i=0;$i<$j;$i=$i+1)
      { //if(($j == 6 && $i == 0)|| ($j == 6 && $i == 1)) continue;
        ?>
        <div id="mozaic">
        <?php
        $base = base_url();
        $pos = strpos($base,'://');
        $baseurl = substr($base,$pos+3,strlen($base));
        
       
        
        ?>
        <a href="<?php echo 'http://'.$data['mozaic'][$k]->username.'.'.$baseurl; ?>"><img src="<?php echo base_url().'/images/users/'.$data['mozaic'][$k]->username.'/avatar.jpg'; ?>" width="50" height="50"  /></a>
        </div>
        <?php
        $k=$k+1;
        if($k == $data['amount'])
        {
        $k = 0;
        }
      }
      
      ?> 
      </div>
      <div id="clearing_div"> </div>
      <?php
    }
    ?>
    </div>
    </div>
    
   
    
    
    
    
  





