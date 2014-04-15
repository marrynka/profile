
<div id="login_form">
<h1>contact</h1>

<?php
echo form_open('contact/submit');
echo form_input('name','Name','id="name"');
echo form_input('email','Email', 'id="email"');
$data= array(
'name' => 'message', 'cols' => 30, 'rows' => 15
);
echo form_textarea($data,'message','id="message"');
echo form_submit('submit','Send','id="submit"');

?>
</div>
<script type="text/javascript">
$('#submit').click(function()
{
var form_data = 
{
name: $('#name').val(),
email: $('#email').val(),
message: $('#message').val(),
ajax: '1'
};
$.ajax(
{
url: "<?php echo site_url('contact/submit'); ?>",
type:'POST',
data: form_data,
success: function(msq)
{
  $('#main_content').html(msq);
}

}
)
 
return false;
}

);
</script>