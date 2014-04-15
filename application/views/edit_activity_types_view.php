<!DOCTYPE html>
<html lang = "en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript" charset="utf-8">
</script>
 <script src="http://code.jquery.com/jquery-1.9.1.js"></script>

</head>
<body>
  <script type="text/javascript">
    function source_add_form() 
    {
       var e = document.getElementById('source_add_form');
       
          e.style.display = 'block';
    }
</script>


      <?php

      
    

     echo '<h1>Existing activities: </h1>';
     echo form_open('edit/delete_activity_type');
     echo "<table>";
     echo "<thead><th></th><th>ID</th><th>Activity type</th></thead>";
     
     echo form_hidden('number_of_activity_types', count($activity_types));
     $count = 0;
     
     foreach ($activity_types as $row)
      {
       echo "<tr>
       <td>".form_checkbox('activity'.$count, $row->id_activity, FALSE)."</td><td>". $row->id_activity. "</td><td>". $row->activity_title. "</td>
       </tr>";
       $count++;
      }
      echo "</table>";
      echo form_submit("delete","Delete selected activities");
      echo form_close();
      echo "<h2>Add new activity:</h2>";
       foreach ($sources as $row)
      {
       $existing_sources[$row->id_source] = $row->source_title ;
      }
       echo 'Choose source: ';   
      ?>
      <div id="source_add_form" style="display:none">
        <?php
        
        echo form_open('edit/add_source_type');
        echo form_hidden('return', 'edit_activity_types');
        $data = array(
              'name'        => 'new_source_type',
              'id'          => 'new_source_type',
              'maxlength'   => '100',
              'size'        => '50'
            );
        echo form_input($data);
        echo form_submit('add_source', 'Add source');
        echo form_close();
       ?>  
      </div>
      <?php  
      echo form_open('edit/add_activity_type');
     
      if(isset($selected)) { echo form_dropdown('source', $existing_sources, $selected);}
      else { echo form_dropdown('source', $existing_sources); }
      echo '<a href="#" onclick="source_add_form();">
       Add
       </a><br / >';
       
      $data = array(
              'name'        => 'new_activity_type',
              'id'          => 'new_activity_type',
              'maxlength'   => '100',
              'size'        => '50'
            ); 
     echo form_input($data);  
     echo '<br />'; 
     echo form_submit('add_activity_type', 'Add activity type');  
     echo form_close();


?>
</body>
