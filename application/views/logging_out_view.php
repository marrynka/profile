<?php
		
	  if($data['error'] != '')
	  {
		  echo $data['error'];
		  
	  }		  
	  else if($data['logging_out_app'] != '')
	  {
		  
		  if($data['logged_in_apps']->num_rows > 1)
		  {
			 
			  echo "Apart from ". $data['logging_out_app']. "<br />you are also logged in:<br />";
			  foreach($data['logged_in_apps']->result() as $row)
			  {
				  if($row->client_id != $data['logging_out_app'])
				  echo $row->client_id."<br />";
			  }
			  echo "<a href='../logout_app/".$data['logging_out_app']."'>Logout</a> or <a href='../logout_all'>logout from all apps</a>";
		  }
		  else
		  { 
			  echo "You want to <a href='../logout_theonlyapp/".$data['logging_out_app']."'>logout</a> from " .$data['logging_out_app']."?";
		  }
		  
	  }
	  else
	  {
		  
		  if($data['logged_in_apps']->num_rows > 0)
		  {
			  echo "you are logged in: <br />";
			  foreach($data['logged_in_apps']->result() as $row)
			  {
				  echo $row->client_id."<br />";
			  }
			  echo "<a href='logout_all'>logout from all apps</a>";
		  }
		  
	  }
?>
