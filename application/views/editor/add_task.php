<section id="intro">
</section>
<section id="maincontent">
	<div align="center">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="tagline centered">
						<div class="row">
							<div class="span12">
								<div class="tagline_text">
									<h2>Add New Reviewing Task</h2>
									<p>
										Please fill in data about the article that you would like to be reviewed.
										<?php if (strlen($error) > 0) {
											echo '<span style="color: red">' . $error . '</span>';
										} ?>
									</p>
									<div align="center">
										<!-- <form action="<?php echo base_url() . "index.php/AccountCtl/signingUp"; ?>" method="post" enctype="multipart/form-data"> -->
										<?php echo form_open_multipart(base_url() . 'index.php/EditorCtl/addingtask'); ?>
										<!-- <form action="<?php echo base_url() . "index.php/AccountCtl/signingUp" ?>" method="post" enctype="multipart/form-data"> -->

										<table>
											<tr>
												<td>*Title</td>
												<td>:</td>
												<td><input type="text" id="judul" name="judul" width="100" /></td>
											</tr>
											<tr>
												<td>*Keywords</td>
												<td>:</td>
												<td><input type="text" id="katakunci" name="katakunci" width="100" /></td>
											</tr>
											<tr>
												<td>*Authors</td>
												<td>:</td>
												<td><input type="text" id="authors" name="authors" width="100" /></td>
											</tr>
											<tr>
												<td>*Article</td>
												<td>:</td>
												<td><input type="file" id="userfile" name="userfile" width="100" /></td>
											</tr>
											<tr>
												<td>*Jumlah halaman jurnal</td>
												<td>:</td>
												<td><input type="text" id="page" name="page" width="100" /></td>
											</tr>
										</table>

										<input type="submit" value="Upload">
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
	</div>
</section>