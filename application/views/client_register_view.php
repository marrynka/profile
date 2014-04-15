<h1>Register new client<h1>
<fieldset>
<legend> Client details</legend>
      
<?php
echo form_open('profile/client_register');
echo form_input('client_key', set_value('client_key','Client Key'));
echo form_input('client_about', set_value('client_about','About Client'));
 


echo form_submit('submit','Register App'); 
 echo validation_errors('<p class="error">')
?>
</fieldset>
<?php
//$this->load->view('includes/tut_info');
?>
