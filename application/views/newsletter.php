<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>newsletter</title>
  <style type="text/css">
   label {display:block;}
  </style>
</head>
<body>

<p>hello from newsletter.</p>
<div id="newsletter_from">
  <?php

  echo form_open('email/send'); 
  ?>
   <?php
   $name_data = array(
   'name' => 'name',
   'id' =>'name',
   'value'=> set_value('name')
   );
   ?>
   <p> <label for="name"> Name: </label> <?php echo form_input($name_data); ?></p>
   <p> <label for="name"> Email Adress: </label> <input type="text" name="email" id="email" value="<?php echo set_value('email');?>"></p>
    <?php echo validation_errors('<p class="error">')?>
  <p><?php echo form_submit('submit','Submit');?> </p>
  
  
  <?php echo form_close(); ?>
</div>
</body>
</html>