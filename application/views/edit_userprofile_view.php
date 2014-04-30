

<h1>Zmena údajov:</h1>
<div id="edit_userprofile_form">
	<div id="general_info">	
	<fieldset>
		<h3>Avatar</h3>
		<div class="avatar">
			<img src="<?php echo base_url().'/images/users/'.$data['records']->username.'/avatar.jpg'; ?>"   />
		</div>
		
		</form>
		<form method="post" action='<? echo site_url();?>/edit_userprofile/avatar_change' enctype="multipart/form-data" >
		<input type="file" name="userfile" size="20" />
		<input type=submit value='upload' />
		</form>
	</fieldset>
	
	<fieldset>
	<h3> Personal information</h3>
		  
	<?php
	$js = 'onClick="this.select();"';
    echo form_open(site_url().'/edit_userprofile/information_change');
	
	echo form_input('first_name', set_value('first_name',$data['records']->first_name),$js);
	echo form_input('last_name', set_value('last_name',$data['records']->surname), $js);
	echo form_input('email_address', set_value('email_address',$data['records']->email),$js);
	$input_data = array(
		'name'        => 'occupation',
		'id'          => 'occupation',
		'value'       => 'student',
		'checked'     => $data['records']->occupation == 'student',
		);

	echo form_radio($input_data); echo "student";
	//nechceme aby sa mohli studenti samovolne zmenit na ucitelov
	//nechceme aby sa mohli studenti samovolne zmenit na ucitelov
	/*
	$input_data = array(
		'name'        => 'occupation',
		'id'          => 'occupation',
		'value'       => 'teacher',
		'checked'     => $data['records']->occupation == 'teacher',
		);
    
	echo form_radio($input_data);echo "teacher";
	*/
	
	$input_data = array(
		'name'        => 'occupation',
		'id'          => 'occupation',
		'value'       => 'other',
		'checked'     => $data['records']->occupation == 'other',
		);

	echo form_radio($input_data);echo "other";
	
	?>
	</fieldset>
	
	</div>
	<div id="about_info">
		<h3> About</h3>
		<?php
		 
		$input_data = array(
              'name'        => 'about_short',
              'id'          => 'about_short',
           
              'maxlength'   => '250',
              'rows' => '10',
              'cols' => '25',
              
              
            );

		echo form_textarea($input_data,set_value('about_short',$data['records']->about_short),$js);
		$input_data = array(
              'name'        => 'about_long',
              'id'          => 'about_long',
             
              'maxlength'   => '250',
              'rows' => '10',
              'cols' => '25',
              
              
            );

		echo form_textarea($input_data,set_value('about_long', $data['records']->about_long),$js);
		echo validation_errors('<div id="errors">','</div>');
		if(isset($data['errors']))
		{
			echo "<div id='errors'>".$data['errors']."</div>";
		}
?>
	</div>	
	<div id="clear"></div>
	<?php

	echo form_submit('submit','Uložiť'); 
	
	echo form_close();
	?>
</div>







