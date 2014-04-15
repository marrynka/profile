<h1>Create an account:</h1>
<div id="signup_form">
	<div id="general_info">	
	<fieldset>
	<h3> Login information</h3>
		  
	<?php
	$js = 'onClick="this.select();"';
	echo form_open('login/create_member');
	echo form_input('username', set_value('username','Username'),$js);
	echo form_input('password', set_value('password','Password'),$js);
	echo form_input('password2', set_value('password2','Confirm Password'),$js);

	?>
	</fieldset>
	<fieldset>
	<h3> Personal information</h3>
		  
	<?php

	
	echo form_input('first_name', set_value('first_name','First Name'),$js);
	echo form_input('last_name', set_value('last_name','Last Name'), $js);
	echo form_input('email_address', set_value('email_address','Email Address'),$js);
	$data = array(
		'name'        => 'occupation',
		'id'          => 'occupation',
		'value'       => 'student',
		'checked'     => TRUE,
		);

	echo form_radio($data); echo "student";
	$data = array(
		'name'        => 'occupation',
		'id'          => 'occupation',
		'value'       => 'teacher',
		'checked'     => TRUE,
		);

	echo form_radio($data);echo "teacher";
	$data = array(
		'name'        => 'occupation',
		'id'          => 'occupation',
		'value'       => 'other',
		'checked'     => TRUE,
		);

	echo form_radio($data);echo "other";
	
	?>
	</fieldset>
	</div>
	<div id="about_info">
		<h3> About</h3>
		<?php
		 
		$data = array(
              'name'        => 'about_short',
              'id'          => 'about_short',
           
              'maxlength'   => '250',
              'rows' => '10',
              'cols' => '25',
              
              
            );

		echo form_textarea($data,set_value('about_short','Napíš niečo krátke o sebe(max 250 znakov)'),$js);
		$data = array(
              'name'        => 'about_long',
              'id'          => 'about_long',
             
              'maxlength'   => '250',
              'rows' => '10',
              'cols' => '25',
              
              
            );

		echo form_textarea($data,set_value('about_long', 'Môžeš dopísať aj ešte viac(ďalších 250 znakov)'),$js);
		echo validation_errors('<div id="errors">','</div>');
?>
	</div>	
	<div id="clear"></div>
	<?php

	echo form_submit('submit','Create Account'); 
	
	echo form_close();
	?>
</div>

