<br> <br>
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
                <h2>Complete your Assignment</h2>
                <p>
                  Please upload your file</span>
                </p>
                <div align="center">
                  <?php echo form_open_multipart(base_url() . "index.php/ReviewerCtl/completingReviewTask/" . $id_task); ?>
                  <div align="center">

                    <p>Upload Reviewed Task </p>

                  </div>
                  <table>
                    <tr>
                      <td><input type="file" id="userfile" name="userfile" width="20" /></td>
                    </tr>
                  </table>
                  <br>
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
</section>