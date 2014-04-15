<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>options</title>
     <style type="text/css">
   label {display:block;}
  </style>
</head>                                                       
<body>

<h2>Create</h2>
<?php 
echo form_open('crud/create');

?>
  <p>
  <label for='title'> Title </label>
  <input type='text' name='title' id='title' />
  </p>
  <p>
  <label for='contents'> Contents </label>
  <input type='text' name='contents' id='contents' />
  </p>
  <p>
  <input type='submit' value='submit'/>
  </p>  
<?php
echo form_close();

?>

<hr />
 
 <?php
    if(isset($records))
    {
      foreach($records as $row)
      {
         echo anchor("crud/delte/$row->id", $row->title)." ";
         echo $row->contents." ";
         echo "<br />";
      }
    }
    else
    {
    echo "no records";
    }
  ?>
  <hr />
  <h2>deleete</h2>
  <p>
  just click on a title
  </p>
</body>
</html>