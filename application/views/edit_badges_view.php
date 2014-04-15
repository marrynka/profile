<?php
       echo "Choose picture:<br />";
       
       {foreach($pictures as $picture)
               {
                   
                   $data = array(
                            'name'        => 'new_badge_picture',
                            'id'          => 'new_badge_picture',
                            'value'       => $picture,
                            );
                  echo  form_radio($data);
                   //echo '<label><img src="'.$pictures_url.'/'.$picture.'" /></label>'; 
                  echo form_label('<img src="'.$pictures_url.'/'.$picture.'" width=100/>');
               }
        }
        echo "<br />";
        echo "Badge description:<br />";
        $data = array(
              'name'        => 'new_badge_description',
              'id'          => 'new_badge_description',
              'maxlength'   => '500',
              'cols'        => '50',
              'rows'        => '2',
              
            );
        echo form_textarea($data);
      
        echo "<br />";    
?>