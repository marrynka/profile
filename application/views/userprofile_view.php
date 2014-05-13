
  <div id="main_wrapper">
	  
	  <div id="navigationProfile">
	  <div class="centerTitle">
	  <ul id="navigation">
	  <li id="profile_option" 
	  <?php
	  if($data['main_content'] == 'my_profile')
	  {
		  echo "class='selected'"; 
	  }
	  ?>
	  ><a href="<?php echo site_url('userprofile/my_profile');?>" id="profile_button" > Profil </a></li>
	
	  <li id="about_option" 
	  <?php
	  if($data['main_content'] == 'about')
	  {
		  echo "class='selected'"; 
	  }
	  ?>
	  
	  ><a href="<?php echo site_url('userprofile/about');?>" id="about_button" > O mne </a></li>
	   <li id="general_option" 
	   
	   <?php
	  if($data['main_content'] == 'activities')
	  {
		  echo "class='selected'"; 
	  }
	  ?>
	   
	   ><a href="<?php echo site_url('userprofile/activities');?>" id="general_button"> Aktivity </a></li>
	 <!-- <li id="blog_option"><a href="activities/blog" id="blog_button"> Blog </a></li>
	  <li id="courses_option"><a href="activities/courses" id="courses_button"> Courses </a></li>
	  <li id="wiki_option"><a href="activities/wiki" id="wiki_button"> Wiki </a></li>
	  -->
	  </ul>
	  </div>
	  </div>
	  
	  
	  <div id="info">
	  <?php $data['data'] = $data['main_contents_data'];
	  
	  $this->load->view('userprofile_view-'.$data['main_content'],$data);   ?>
	  </div>
  </div>


<script type="text/javascript">
	
$('#profile_button').click(function()
{
	
var form_data = 
{

	 username: '<?php echo $data['username']; ?>' ,
	ajax: '1'
	};
	$.ajax(
	{
	url: "<?php echo site_url('userprofile/my_profile'); ?>",
	type:'POST',
	data: form_data,
	success: function(msq)
	{
	  $('#info').html(msq);
	  /*$('#selected').replaceWith($('#selected').html());
	  $('#about_option').html('<div id="selected">'+$('#about_option').html()+"</div>");
*/
	$('#navigation li').removeClass('selected');
	//$(this).html('tento tu');
	$('#profile_option').addClass('selected');
	}

	}
	)
	
	return false;
}

);



	
$('#about_button').click(function()
{
	
var form_data = 
{

	 username: '<?php echo $data['username']; ?>' ,
	ajax: '1'
	};
	$.ajax(
	{
	url: "<?php echo site_url('userprofile/about'); ?>",
	type:'POST',
	data: form_data,
	success: function(msq)
	{
	  $('#info').html(msq);
	  /*$('#selected').replaceWith($('#selected').html());
	  $('#about_option').html('<div id="selected">'+$('#about_option').html()+"</div>");
*/
	$('#navigation li').removeClass('selected');
	//$(this).html('tento tu');
	$('#about_option').addClass('selected');
	}

	}
	)
	
	return false;
}

);
$('#navigation li').click(function()
{
var form_data = 
{
 username: '<?php echo $data['username']; ?>' ,
ajax: '1'
};
$.ajax(
{
url: "<?php echo site_url('userprofile/activities'); ?>",
type:'POST',
data: form_data,
success: function(msq)
{
  $('#info').html(msq);
  /*$('#selected').replaceWith($('#selected').html());
  $('#general_option').html('<div id="selected">'+$('#general_option').html()+"</div>");
  */
  $('#navigation li').removeClass('selected');
	$('#general_option').addClass('selected');
}

}
)
 
return false;
}

);

$('#blog_button').click(function()
{
var form_data = 
{
username: '<?php echo $data['username']; ?>' ,
ajax: '1' ,
client_id: 'blog'
};
$.ajax(
{
url: "<?php echo site_url('userprofile/activities'); ?>",
type:'POST',
data: form_data,
success: function(msq)
{
  $('#info').html(msq);
  $('#navigation li').removeClass('selected');
	$('#blog_option').addClass('selected');
}

}
)
 
return false;
}

);
$('#courses_button').click(function()
{
var form_data = 
{
username: '<?php echo $data['username']; ?>' ,
ajax: '1' ,
client_id: 'courses'
};
$.ajax(
{
url: "<?php echo site_url('userprofile/activities'); ?>",
type:'POST',
data: form_data,
success: function(msq)
{
  $('#info').html(msq);
  $('#navigation li').removeClass('selected');
	$('#courses_option').addClass('selected');
}

}
)
 
return false;
}

);
$('#wiki_button').click(function()
{
var form_data = 
{
username: '<?php echo $data['username']; ?>' ,
ajax: '1' ,
client_id: 'wiki'
};
$.ajax(
{
url: "<?php echo site_url('userprofile/activities'); ?>",
type:'POST',
data: form_data,
success: function(msq)
{
  $('#info').html(msq);
  $('#navigation li').removeClass('selected');
  $('#wiki_option').addClass('selected');
}

}
)
 
return false;
}

);
</script>

</body>
</html>
