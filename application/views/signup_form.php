<h1>Create an account:</h1>
<div id="signup_form">
	<div id="general_info">	
	<fieldset>
	<h3> Login information</h3>
		  
	<?php
	$js = 'onClick="this.select();"';
	echo form_open('login/create_member');
	echo form_input('username', set_value('username','Username'),$js);
	echo "heslo:";
	echo form_password('password', set_value('password','Password'),$js);
	echo "zopakujte heslo:";
	echo form_password('password2', set_value('password2','Password'),$js);

	?>
	</fieldset>
	<fieldset>
	<h3> Personal information</h3>
		  
	<?php

	
	echo form_input('first_name', set_value('first_name','First Name'),$js);
	echo form_input('last_name', set_value('last_name','Last Name'), $js);
	echo form_input('email_address', set_value('email_address','Email Address'),$js);
	$input_data = array(
		'name'        => 'occupation',
		'id'          => 'occupation',
		'value'       => 'student',
		'checked'     => TRUE,
		);

	echo form_radio($input_data); echo "student";
	$input_data = array(
		'name'        => 'occupation',
		'id'          => 'occupation',
		'value'       => 'teacher',
		'checked'     => TRUE,
		);

	echo form_radio($input_data);echo "teacher";
	$input_data = array(
		'name'        => 'occupation',
		'id'          => 'occupation',
		'value'       => 'other',
		'checked'     => TRUE,
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

		echo form_textarea($input_data,set_value('about_short','Napíš niečo krátke o sebe(max 250 znakov)'),$js);
		$input_data = array(
              'name'        => 'about_long',
              'id'          => 'about_long',
             
              'maxlength'   => '250',
              'rows' => '10',
              'cols' => '25',
              
              
            );

		echo form_textarea($input_data,set_value('about_long', 'Môžeš dopísať aj ešte viac(ďalších 250 znakov)'),$js);
		echo validation_errors('<div id="errors">','</div>');
		if(isset($data['errors']))
		{
			echo "<div id='errors'>".$data['errors']."</div>";
		}
?>
	</div>	
	<div id="clear"></div>
	<?php

	echo form_submit('submit','Create Account'); 
	
	echo form_close();
	?>
</div>

