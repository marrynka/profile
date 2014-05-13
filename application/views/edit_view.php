
      <?php
      if($data['options'] == TRUE)
      {
          
          ?>
          <h1>Vyberte, čo chcete editovať: </h1>
          <h3><a href =  '<?php echo base_url();?>index.php/edit/clients' > subportals </a></h3>
          <h3><a href = '<?php echo base_url();?>index.php/edit/achievements'> achievements </a></h3>
          <h3><a href = '<?php echo base_url();?>index.php/edit/badges'> badges </a></h3>
          <h3><a href =  '<?php echo base_url();?>index.php/edit/activities' > activities </a></h3>
          <?php
          
      }
      else if($data['items_name'] == 'badge' || $data['items_name'] == 'achievement')
      {

           echo '<h1>Existing '. $data['items_name'].'s : </h1>';
           echo form_open('edit/delete_'.$data['items_name'].'_type');
           echo "<table>";
           echo "<thead><th></th><th>ID</th><th>".$data['items_name']." type</th></thead>";
     
           echo form_hidden('number_of_'.$data['items_name'].'s', count($data['items']));
           $count = 0;
     
           foreach ($data['items'] as $row)
           {
              $strid = $data['items_name']."_type";
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
      else if($data['items_name'] == 'client')
      {
		
		echo $this->table->generate($data['items']);  
	
        echo "<h1> Add new subportal: </h1>";
        echo "<div id='add_client'>";
        echo form_open('edit/add_client');
        echo form_hidden('return', 'edit/clients');
        $data = array(
              'name'        => 'client_id',
              'id'          => 'client_id',
              'maxlength'   => '100',
              'size'        => '50'
            );
        echo "client id:";
        echo form_input($data);
        $data = array(
              'name'        => 'client_secret',
              'id'          => 'client_secret',
              'maxlength'   => '100',
              'size'        => '50'
            );
         echo "client secret:" ;  
        echo form_input($data);
        $data = array(
              'name'        => 'home_uri',
              'id'          => 'home_uri',
              'maxlength'   => '1900',
              'size'        => '50'
            );
            echo "home uri:" ;  
        echo form_input($data);
        $data = array(
              'name'        => 'requests_uri',
              'id'          => 'requests_uri',
              'maxlength'   => '1900',
              'size'        => '50'
            );
            echo "requests uri:" ;  
        echo form_input($data);
        $data = array(
              'name'        => 'redirect_uri',
              'id'          => 'redirect_uri',
              'maxlength'   => '1900',
              'size'        => '50'
            );
            echo "redirect uri:" ;  
        echo form_input($data);
        
        
        
        echo form_submit('add_client', 'Add client');
        echo form_close();
       echo "</div>";
	  }
	  else if($data['items_name'] == 'activity')
	  {
		     echo '<h1>Existing activities: </h1>';
			 echo form_open('edit/delete_activity_type');
			 echo "<table>";
			 echo "<thead><th></th><th>ID</th><th>Activity type</th><th>Subportal</th></thead>";
			 
			 echo form_hidden('number_of_activity_types', count($data['items']));
			 $count = 0;
			 
			 foreach ($data['items'] as $row)
			  {
			   echo "<tr>
			   <td>".form_checkbox('activity'.$count, $row->activity_type, FALSE)."</td><td>". $row->activity_type. "</td><td>". $row->activity_title. "</td><td>". $row->client_id. "</td>
			   </tr>";
			   $count++;
			  }
			  echo "</table>";
			  echo form_submit("delete","Delete selected activities");
			  echo form_close();
			  echo "<h2>Add new activity:</h2>";
			   foreach ($data['clients'] as $row)
			  {
			   $existing_sources[$row->client_id] = $row->client_id;
			  }
			   echo 'Choose source: ';   
			  ?>
			 
			  <?php  
			  echo form_open('edit/add_activity_type');
			 
			  if(isset($selected)) { echo form_dropdown('source', $existing_sources, $selected);}
			  else { echo form_dropdown('source', $existing_sources); }
			 
			   
			  $data = array(
					  'name'        => 'new_activity_type',
					  'id'          => 'new_activity_type',
					  'maxlength'   => '100',
					  'size'        => '50'
					); 
			 echo "<br />Name of the new activity:<br />";
			 echo form_input($data);  
			 echo '<br />'; 
			 echo form_submit('add_activity_type', 'Add activity type');  
			 echo form_close();
				  
				  
				  
				  
		  
		  
	  }

?>
</body>
