
      <?php
      if($data['options'] == TRUE)
      {
          
          ?>
          <a href =  '<?php echo base_url();?>index.php/edit/sources''' > sources </a>
          <a href = '<?php echo base_url();?>index.php/edit/achievements'> achievements </a>
          <a href = '<?php echo base_url();?>index.php/edit/badges'> badges </a>
          
          <?php
          
      }
      else
      {

           echo '<h1>Existing '. $data['items_name'].'s : </h1>';
           echo form_open('edit/delete_'.$data['items_name'].'_type');
           echo "<table>";
           echo "<thead><th></th><th>ID</th><th>".$data['items_name']." type</th></thead>";
     
           echo form_hidden('number_of_'.$data['items_name'].'s', count($data['items']));
           $count = 0;
     
           foreach ($data['items'] as $row)
           {
              $strid = "id_".$data['items_name'];
              $strtitle = $data['items_name']."_title";
              echo "<tr>
              <td>".form_checkbox('item'.$count, $row->$strid, FALSE)."</td><td>". $row->$strid. "</td><td>". $row->$strtitle. "</td>";
              if($data['items_name'] == 'achievement' or $data['items_name'] == 'badge')
              {
               
                echo "<td><img src='" .$data['pictures_url']."/".$row->picture."' width=10 /> </td>";
              }
              echo "</tr>";
              $count++;
           }
           echo "</table>";
           echo form_submit("delete","Delete selected ".$data['items_name']);
           echo form_close();
           
           echo "<h2>Add new ".$data['items_name'].":</h2>";
      
        
           echo form_open('edit/add_'.$data['items_name'].'_type');
     
           if($data['items_name'] == 'achievement')
           {
               $content_data['pictures'] = $pictures;
               $content_data['pictures_url'] =  $data['pictures_url'];
               $this->load->view('edit_achievements_view', $content_data);
           }
           if($data['items_name'] == 'badge')
           {
               $content_data['pictures'] = $pictures;
               $content_data['pictures_url'] =  $data['pictures_url'];
               $this->load->view('edit_badges_view', $content_data);
           }
           $content_data = array(
              'name'        => 'new_'.$data['items_name'].'_type',
              'id'          => 'new_'.$data['items_name'].'_type',
              'maxlength'   => '100',
              'size'        => '50'
            ); 
           echo "Name of the new ".$data['items_name'].":<br />";
           echo form_input($content_data);  
           echo '<br />'; 
           echo form_submit('add_'.$data['items_name'].'_type', 'Add '.$data['items_name'].' type');  
           echo form_close();
      }

?>
</body>
