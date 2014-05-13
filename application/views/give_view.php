<?php		   
		   $js = 'onClick="this.select();"';
		   echo '<h1>Choose '. $data['items_name'].'</h1>';
           echo form_open('give/'.$data['items_name']);
           echo "<table>";
           echo "<thead><th></th><th>ID</th><th>".$data['items_name']." type</th></thead>";
     
           echo form_hidden('number_of_'.$data['items_name'].'s', count($data['items']));
           $count = 0;
     
           foreach ($data['items'] as $row)
           {
              $strid = $data['items_name']."_type";
              $strtitle = $data['items_name']."_title";
              echo "<tr>
              <td>".form_radio('item', $row->$strid, FALSE)."</td><td>". $row->$strid. "</td><td>". $row->$strtitle. "</td>";
              if($data['items_name'] == 'achievement' or $data['items_name'] == 'badge')
              {
               
                echo "<td><img src='" .$data['pictures_url']."/".$row->picture."' width=10 /> </td>";
              }
              echo "</tr>";
              $count++;
           }
           echo "</table>";
           echo form_textarea('comment','Comment', $js);
           echo form_submit("give","Give ".$data['items_name']);
           echo form_close();
          
?>
