<section id="maincontent">
	<div class="container">
		<div class="row">
			<div class="span12">
				<div class="tagline centered">
					<div class="row">
						<div class="span12">
							<div class="tagline_text">
								<br />
								<h2>Profile Page</h2>
								<div class="row no-gutters">
									<div class="col-md-4">
										<img src="<?= base_url('photos/') . $user['photos']; ?>" class="card-img" width=150 height=200>

									</div>
									<div class="col-md-8">
										<div class="card-body">
											<p class="card-text"><small class="text-muted">Nama anda : <?= $user['nama']; ?></small></p>
											<p class="card-text"><small class="text-muted">Username anda :<?= $user['username']; ?></small></p>
											<p class="card-text"><small class="text-muted">Email anda : <?= $user['email']; ?></small></p>
											<p class="card-text"><small class="text-muted">Anda terdaftar sebagai : <?php echo $user['nama_grup'] ?> </small></p>
											<p class="card-text"><small class="text-muted">Bergabung sejak : <?= $user['date_created']; ?> </small></p>
										</div>
									</div>
								</div>

								<div class="text-center">
									<a class="small" href="<?= base_url('index.php/AccountCtl/editProfile'); ?>">Edit Profile</a>
								</div>
								<div class="text-center">
									<a class="small" href="<?= base_url('index.php'); ?>/AccountCtl/changePassword">Change Password</a>
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