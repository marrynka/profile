<div class="inside">
	<div class="sideportlet">
		   
		<h3>Zmena hesla</h3>
		<?php
		$js = 'onClick="this.select();"';
		echo form_open(site_url().'/edit_userprofile/password_change');
		echo form_hidden('username',$this->session->userdata('username'));
		echo "staré heslo:";
		echo form_password('password','heslo',$js);
		echo "nové heslo:";
		echo form_password('new_password','heslo',$js);
		echo "Zopakujte nové heslo: ";
		echo form_password('new_password2','olseh',$js);
		if(isset($data['errors']))
		{
			echo "<div id='errors'>".$data['errors']."</div>";
		}
		echo validation_errors('<div id="errors">','</div>');
		
		echo form_submit('Submit','Zmeň');
		?>
			
			
	</div>
				
              
                  
                 
</div>

