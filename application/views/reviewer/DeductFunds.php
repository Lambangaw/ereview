<section id="maincontent">
	<div class="container">
		<div class="row">
			<div class="span12">
				<div class="tagline centered">
					<div class="row">
						<div class="span12">
							<div class="tagline_text">
								<br />
								<h2>Let's move your credits into Bank Account</h2>
								<p>
									Please don't deduct fund more than your credits.
								</p>
								<div align="center">
									<form action="<?php echo base_url() . 'index.php/reviewerCtl/deductFunding'; ?>" method="post">

										<table>
											<tr>
												<td>Username</td>
												<td><input type="text" id="username" name="username" width="100" value="<?= $username; ?>" readonly /></td>
											</tr>

											<tr>
												<td>Your Balance</td>
												<td>:</td>
												<td><?= $saldo[0]['saldo']; ?></td>

											</tr>
											<tr>
												<td>Deduct Fund Credits</td>
												<td><input type="text" id="potongansaldo" name="potongansaldo" required="required" width="60" /></td>
											</tr>
										</table>
										<div class="form-group row">
											<div class="col-sm">
												<button type="submit" class="btn btn-primary">Process</button>
											</div>
										</div>
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