<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <meta name="generator" content="PSPad editor, www.pspad.com">
  <title></title>
  </head>
  <body>
   <p>hello there</p>
   <p><?php  
              ?></p>
    <pre> <?php /*print_r($records);*/ ?></pre> 
    <?php foreach($records as $row)
    {
    ?>
    <div>
    <?php
    echo "<h1>".$row->title."</h1>";
    echo "<p>".$row->contents."</p>";
    ?>
    </div>
    <?php
    }       
    ?>        
  </body>
</html>
