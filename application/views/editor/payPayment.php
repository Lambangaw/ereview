<section id="maincontent">
  <div class="container">
    <div class="row">
      <div class="span12">
        <div class="tagline centered">
          <div class="row">
            <div class="span12">
              <div class="tagline_text">
                <br />
                <h2>Please Complete Payment</h2>
                <p>
                  For see the result from your Reviewer!
                </p>
                <div align="center">

                  <?php
                  foreach ($tasks as $item) {
                  ?>
                    <?= form_open_multipart(base_url() . 'index.php/PaymentCtl/payPayment/' . $item['id_assignment'] . '/' . $item['id_task']); ?>
                    <?php echo "this php" ?>

                    <table>
                      <tr>
                        <td>Title </td>
                        <td><input type="text" id="judul" name="judul" width="100" value="<?= $item['judul'] ?>" readonly /></td>
                      </tr>
                      <tr>
                      <tr>
                        <td>Reviewed by</td>
                        <td><input type="text" id="username" name="username" width="100" value="<?= $item['nama'] ?>" readonly></td>
                      </tr>
                      <tr>
                        <td>Bank Account of Reviewer</td>
                        <td><input type="text" id="username" name="username" width="100" value="<?= $item['nama'] ?>" readonly></td>
                      </tr>
                      <tr>
                        <td>Price</td>
                        <td><input type="text" id="username" name="username" width="100" value="<?= $item['price'] ?>" readonly></td>
                      </tr>
                      <tr>
                        <td>Already paid?</td>
                        <td class="col-lg-9">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="userfile" name="userfile"></input>
                          </div>
                        </td>
                      </tr>

                    </table>
                    <div class="form-group row">
                      <div class="col-sm">
                        <button type="submit" class="btn btn-primary">Upload</button>
                      </div>
                    </div>
                    </form>

                    <?= form_close(); ?>
                  <?php }  ?>
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