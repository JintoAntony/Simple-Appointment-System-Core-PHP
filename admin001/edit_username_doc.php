<html>
		<head>
			<title>Edit Username</title>
			<link rel='stylesheet' type='text/css' href='css/edit_username_doc.css'/>
		</head>
		
			<body>
						<div class='canvas'>
							<div class='signup'>
								<!--Sign Up Form-->
								
								<div id='form-content'>
								<h1>
									Edit Username
								</h1>
								<?php
									session_start();
									
									$username=$_SESSION["username"];
								
									echo"
										<form action='edit_usernamedoc_process.php' method='post'>
											<fieldset class='textbox'>
												
												<div class='username'>
													<div class='fieldname'>Username</div>
													<div class='holding'>
														<div class='sidetip-olduname'>Enter your current username.</div>
														<input type='text' class='olduname' name='olduname' value='' required='required'/>
													</div>
													<div class='holding'>
														<div class='sidetip-newuname'>Enter your new username.</div>
														<input type='text' class='newuname' name='newuname' value='' required='required'/>
													</div>
												</div>
												
											</fieldset>
												<input id='submit_btn' type='submit' value='Edit username.' />
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
		