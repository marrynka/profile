    
    
    
                        <div id="login_form">
							<h1>Prihlás sa</h1>
							<?php
							$js = 'onClick="this.select();"';
							echo form_open('login/validate_credentials');
							echo form_input('username','Username',$js);
							echo form_password('password','Password',$js);
							if($data['errors'] != null) 
							{
								?>
								<div id="errors">
								<?php
								echo $data['errors'];
							     ?>
							     </div>
							     <?php
							}
							echo form_submit('submit','Login');
							if(isset($data['returnUrl']))
							{
							echo form_hidden('returnUrl',$data['returnUrl']);
							}
							echo anchor('login/signup','Create Account');
							?>
						</div>
                      
