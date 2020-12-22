<br><br><br>
<div align="center">
	<section id="maincontent" mx-aut align="center">
		<div align="center">
			<div class="conatiner">
				<div class="row">
					<div class="span12">
						<div class="tagline centered">
							<div class="row">
								<div class="span12">
									<div class="tagline_text">
										<h2>Login</h2>
										<p>
											You should login to the system before you can submit or review any article.

										</p>

										<div align="center">

											<form action="<?php echo base_url() . 'index.php/accountctl/checkinglogin'; ?> " method="post">
												<table>
													<tr>
														<td>
															username :
														</td>
														<td>
															<input type="text" id="username" name="username" width="100">
														</td>
													</tr>
													<tr>
														<td>Password :</td>
														<td><input type="password" id="sandi" name="sandi" width="100"></td>
													</tr>
												</table>
										</div>
										<input type="submit" value="Submit">

									</div>
									<br>
									<p>
										Don't have an account? <a href="<?= base_url() . 'index.php/welcome/signup' ?> "> Sign up </a>
									</p>
								</div>
							</div>
						</div>
						<!-- end tagline -->
					</div>
				</div>
			</div>
		</div>
	</section>
</div>