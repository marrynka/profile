<?php
       echo "Choose picture:<br />";
       foreach($pictures as $picture)
               {
                   
                   $data = array(
                            'name'        => 'new_achievement_picture',
                            'id'          => 'new_achievement_picture',
                            'value'       => $picture,
                            );
                  echo  form_radio($data);
                   //echo '<label><img src="'.$pictures_url.'/'.$picture.'" /></label>'; 
                  echo form_label('<img src="'.$pictures_url.'/'.$picture.'" width=100/>');
               }
        echo "<br />";
        echo "Achievement description:<br />";
        $data = array(
              'name'        => 'new_achievement_description',
              'id'          => 'new_achievement_description',
              'maxlength'   => '500',
              'cols'        => '50',
              'rows'        => '2',
              
            );
        echo form_textarea($data);
        echo "<br />";
        $data = array(
              'name'        => 'new_achievement_max',
              'id'          => 'new_achievement_max',
              'maxlength'   => 10,
              'size'        => 3,
              
            );
        echo "Maximum amount of this achievement:<br />";
        echo form_input();
        echo "<br />";    
?>