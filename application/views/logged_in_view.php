
<?php
		?>
		<h3>
		
		<?php echo $data['text']; ?>
		</h3>
	    <?php
	    echo form_open('login/logout');
		echo form_submit('submit','Odhlásiť');
        echo form_close();
?>
