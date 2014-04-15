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
      if($options == TRUE)
      {
          
          ?>
          <a href =  '<?php echo base_url();?>index.php/edit/sources''' > sources </a>
          <a href = '<?php echo base_url();?>index.php/edit/achievements'> achievements </a>
          <a href = '<?php echo base_url();?>index.php/edit/badges'> badges </a>
          
          <?php
          
      }
      else
      {

           echo '<h1>Existing '. $items_name.'s : </h1>';
           echo form_open('edit/delete_'.$items_name.'_type');
           echo "<table>";
           echo "<thead><th></th><th>ID</th><th>".$items_name." type</th></thead>";
     
           echo form_hidden('number_of_'.$items_name.'s', count($items));
           $count = 0;
     
           foreach ($items as $row)
           {
              $strid = "id_".$items_name;
              $strtitle = $items_name."_title";
              echo "<tr>
              <td>".form_checkbox('item'.$count, $row->$strid, FALSE)."</td><td>". $row->$strid. "</td><td>". $row->$strtitle. "</td>";
              if($items_name == 'achievement' or $items_name == 'badge')
              {
               
                echo "<td><img src='" .$pictures_url."/".$row->picture."' width=10 /> </td>";
              }
              echo "</tr>";
              $count++;
           }
           echo "</table>";
           echo form_submit("delete","Delete selected ".$items_name);
           echo form_close();
           
           echo "<h2>Add new ".$items_name.":</h2>";
      
        
           echo form_open('edit/add_'.$items_name.'_type');
     
           if($items_name == 'achievement')
           {
               $data['pictures'] = $pictures;
               $data['pictures_url'] =  $pictures_url;
               $this->load->view('edit_achievements_view', $data);
           }
           if($items_name == 'badge')
           {
               $data['pictures'] = $pictures;
               $data['pictures_url'] =  $pictures_url;
               $this->load->view('edit_badges_view', $data);
           }
           $data = array(
              'name'        => 'new_'.$items_name.'_type',
              'id'          => 'new_'.$items_name.'_type',
              'maxlength'   => '100',
              'size'        => '50'
            ); 
           echo "Name of the new ".$items_name.":<br />";
           echo form_input($data);  
           echo '<br />'; 
           echo form_submit('add_'.$items_name.'_type', 'Add '.$items_name.' type');  
           echo form_close();
      }

?>
</body>
