<html>
		<head>
			<title>Edit Password</title>
			<link rel='stylesheet' type='text/css' href='css/edit_password_doc.css'/>
		</head>
		
		
				
			
				<body>

			
					<div class='canvas'>
						<div class='signup'>
							<!--Sign Up Form-->
							
							<div id='form-content'>
							<h1>
								Edit Password
							</h1>
							<?php
								session_start();

								echo"
									<form action='edit_passworddoc_process.php' method='post'>
									<fieldset class='textbox'>
										
										<div class='password'>
											<div class='fieldname'>Password</div>
											<div class='holding'>
												<div class='sidetip-oldpass'>Enter old password.</div>
													<input class='old-pass' type='password' name='old-pass' value='' required='required'/>
												<div class='sidetip-newpass'>Enter new password.</div>
													<input class='new-pass' type='password' name='new-pass' value='' required='required'/>
											</div>
										</div>
										
									</fieldset>
										<input id='submit_btn' type='submit' value='Edit password.' />
									</form>
								";
							?>	
							</div>
						
							<!--Footer-->
							<div id='footer'></div>
							
						</div>
					</div>
			</body>
		</html>
		
