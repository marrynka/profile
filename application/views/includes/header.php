<!DOCTYPE html>
<html lang = "en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo $title;?></title>
    <link rel="stylesheet" href="<?php echo base_url();?>css/style_layrus.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="<?php echo base_url();?>css/main_layrus.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="<?php echo base_url();?>css/style_profile.css" type="text/css" media="screen" title="no title" charset="utf-8">
	
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript" charset="utf-8">
</script>

</head>
<body>

  <div id="uni_nav_portals">
        <div class="portlet topmenuPortlet">
          
          <ul>
			<li>
              <a href="http://matfyz.sk/">matfyz.sk</a>
            </li>
            <?php foreach($apps as $app)
            {
            ?>
            <li>
				<a href="<?php echo $app->home_uri ?>"> <?php echo $app->client_id ?></a>
			</li>	
            <?php
			}
            ?>
            <li>
              <a href="http://devblog.matfyz.sk/about">o nás</a>
            </li>
            <li class="menu_help last">
              <a href="http://devblog.matfyz.sk/help">pomoc</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="portlet loginPortlet">
      <?php
      if(!$is_logged_in)
      {
      ?>
		
     
			  <a href="<?php echo site_url();?>/login/signup"> Registrácia </a>
		      <?php
		      $query = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
              $url =$this->config->site_url()."/".$this->uri->uri_string(). $query; 
              
		      ?>
			  <a id="loginAnchorInHeader" href="<?php echo site_url();?>/login?returnUrl=<?php echo $url; ?> "> Prihlásenie </a>
		  
    <?php 
		}
		else
		{?>
		
			  <a href="http://<?php echo $is_logged_in;?>.profile.matfyz.sk"> <?php echo $is_logged_in;?></a>
		  
			  <a id="loginAnchorInHeader" href="<?php echo site_url();?>/login/logout"> Odhlásenie</a>
		  
	 </ul>
		
		
		<?php
		} ?>
		</div>
    <div id="wheader">
      <div id="header">
        <div id="header-shrinker">
          <div id="header-user">
           <?php echo $header ?>
          </div>
          <?php
           $base = base_url();
		   $pos = strpos($base,'://');
           $baseurl = substr($base,$pos+3,strlen($base));
        
          ?>
          <a href="<?php echo "http://profile.matfyz.sk";?>">  
            <span class="logo"></span>
          </a>
        </div>
      </div>
      <div id="header_separator"></div>
    </div>


