<!DOCTYPE html>
<html lang = "en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>profile.matfyz.sk</title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/style_profile.css" type="text/css" media="screen" title="no title" charset="utf-8">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript" charset="utf-8">
</script>
 <script src="http://code.jquery.com/jquery-1.9.1.js"></script>

</head>

<body>


  <div id="logoWrap">
    <a href="<?php echo base_url()?>index.php/userprofile" id="logo"></a>
  </div>
  
    
    <?php 
    $k=0;
    for($j=6;$j>0;$j=$j-1)
    { 
      ?> <div id="mozaic_row<?php echo 6-$j;?>"> 
      <?php
      for($i=0;$i<$j;$i=$i+1)
      { if(($j == 6 && $i == 0)|| ($j == 6 && $i == 1)) continue;
        ?>
        <div id="mozaic">
        <?php
        $base = base_url();
        $pos = strpos($base,'://');
        $baseurl = substr($base,$pos+3,strlen($base));
        
       
        
        ?>
        <a href="<?php echo 'http://'.$mozaic[$k]->username.'.'.$baseurl; ?>">
        <img src="<?php echo base_url().'/images/users/'.$mozaic[$k]->username.'/avatar.jpg'; ?>" width="100" height="100"  />
        </a>
        </div>
        <?php
        $k=$k+1;
        if($k == $amount)
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
   
    
    
    
    
  








</body>
</html>
<?php



?>