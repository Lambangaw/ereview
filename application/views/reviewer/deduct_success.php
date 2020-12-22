<section id="maincontent">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="tagline centered">
                    <div class="row">
                        <div class="span12">
                            <div class="tagline_text">
                                <br />
                                <h2>Transfer Success</h2>

                                <p>
                                    We have transfer to your bankaccount : <?php echo $account[0]['norek'] ?>.
                                </p>
                                <p>
                                    check your email(<?php echo $account[0]['email'] ?>) for the receipt
                                </p>
                                <p>
                                    <a href="<?php echo base_url() . 'index.php/reviewerCtl/index' ?>" role="button">Back to Home</a>
                                </p>
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