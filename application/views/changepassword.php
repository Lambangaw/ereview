<br> <br>
<section id="maincontent">
  <div class="container">
    <div class="row">
      <div class="span12">
        <div class="tagline centered">
          <div class="row">
            <div class="span12">
              <div class="tagline_text">
                <br />
                <h2>Change Password Page</h2>
                <?= $this->session->flashdata('message'); ?>
                <form action="changingPassword" method="post">
                  <table>
                    <tr>
                      <td>Username:</td>
                      <td><input type="text" id="username" name="username" width="100" value="<?= $user['username']; ?>" readonly></td>
                    </tr>
                    <tr>
                      <td>Current Password:</td>
                      <td><input type="password" id="currentpassword" name="currentpassword" width="100" /></td>
                      <?= form_error('currentpassword', '<small class="text-danger pl-3">', '</small>'); ?>
                    </tr>
                    <tr>
                      <td>New Password:</td>
                      <td><input type="password" id="newpassword1" name="newpassword1" width="100" /></td>
                      <?= form_error('newpassword1', '<small class="text-danger pl-3">', '</small>'); ?>

                    </tr>
                    <tr>
                      <td>Repeat Password:</td>
                      <td><input type="password" id="newpassword2" name="newpassword2" width="100" /></td>
                      <?= form_error('newpassword2', '<small class="text-danger pl-3">', '</small>'); ?>
                    </tr>

                  </table>
                  <div class="form-group row">
                    <div class="col-sm">
                      <button type="submit" class="btn btn-primary">Change</button>
                    </div>
                  </div>

                </form>
                <?= form_close(); ?>
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