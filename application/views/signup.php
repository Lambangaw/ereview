<div align="center">
	<section id="intro">
	</section>
	<section id="maincontent">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="tagline centered">
						<div class="row">
							<div class="span12">
								<div class="tagline_text">
									<h2>Sign-Up Form</h2>
									<p>
										Please fill in your account details! Field with <span style="color: red">*</span> is mandatory.
										<?php if (strlen($error) > 0) {
											echo '<span style="color: red">' . $error . '</span>';
										} ?>
									</p>
									<div align="center">
										<!-- <form action="<?php echo base_url() . "index.php/AccountCtl/signingUp"; ?>" method="post" enctype="multipart/form-data"> -->
										<?php echo form_open_multipart(base_url() . 'index.php/AccountCtl/signingUp'); ?>
										<!-- <form action="<?php echo base_url() . "index.php/AccountCtl/signingUp" ?>" method="post" enctype="multipart/form-data"> -->

										<table>
											<tr>
												<td>*Nama</td>
												<td>:</td>
												<td><input type="text" id="nama" name="nama" width="100" /></td>
											</tr>
											<tr>
												<td>*Username</td>
												<td>:</td>
												<td><input type="text" id="username" name="username" width="100" /></td>
											</tr>
											<tr>
												<td>*Password</td>
												<td>:</td>
												<td><input type="password" id="password" name="sandi" width="100" /></td>
											</tr>
											<tr>
												<td>*Email</td>
												<td>:</td>
												<td><input type="text" id="email" name="email" width="100" /></td>
											</tr>
											<tr>
												<td>*Nomer Rekening</td>
												<td>:</td>
												<td><input type="number" id="norek" name="norek" width="100" /></td>
											</tr>
											<tr>
												<td>Roles</td>
												<td>:</td>
												<td><input type="checkbox" id="editor" name="roles[]" value="1" checked />Editor <br>
													<input type="checkbox" id="reviewer" name="roles[]" value="2" />Reviewer</td>
											</tr>
											<tr>
												<td>*Photo</td>
												<td>:</td>
												<td><input type="file" id="photo" name="userfile" width="100" /></td>
											</tr>
										</table>

										<input type="submit" value="Sign-Up">
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- end tagline -->
				</div>
			</div>
		</div>
	</section>
</div>