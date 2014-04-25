<div class="inside">
				  <div class="sideportlet">
					  <h3>Hľadaj</h3>
				  <div id="searchForm">
					<?php
					$js = 'onClick="this.select();"';
					echo form_open('profile/search');
					echo form_input('search',set_value('search','Meno alebo prezývka'),$js);
					echo form_submit('submit','Hľadaj');
					echo form_close();
					?>
					</div>
				  </div>
                  <div class="sideportlet">
                    <h3>Podľa priezviska</h3>
                    <?php
                    $letters = range('A', 'Z');
                    foreach($letters as $letter)
                    {
						?>
						<a href=" <?php echo site_url().'/profile/sort_name/'.$letter; ?>"> 
						<?php
						echo $letter;
						?>
						</a>
						<?php
					}
                    ?>
                    
                    
                    
                    <h3>Podľa ratingu</h3>
                    <a href="<? echo site_url();?>/profile/sort_rating/asc"> Vzostupne </a><br/>
                   <a href="<? echo site_url();?>/profile/sort_rating/desc"> Zostupne </a><br/>
                   
                  </div>
                  
</div>
