<section id="maincontent">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="tagline centered">
                    <div class="row">
                        <div class="span12">
                            <div class="tagline_text">
                                <br />
                                <h2>Change Role</h2>
                                <div class="row no-gutters">
                                    <p></p>
                                    <div align="center" class="col-md-4">
                                        <table>
                                            <tr>
                                                <td>Anda sedang mengakses sebagai </td>
                                                <td>:</td>
                                                <td><?php echo $current_role ?></td>
                                            </tr>
                                            <br>
                                            <?php if ($roles == 1) : ?>
                                                <tr>
                                                    <td>Anda berhak untuk mengakses </td>
                                                    <td>:</td>
                                                    <td><?php echo $current_role ?></td>
                                                </tr>
                                                <?php ?>
                                            <?php elseif ($roles > 1) : ?>
                                                <tr>
                                                    <td>Anda berhak untuk mengakses </td>
                                                    <td>:</td>
                                                    <td><a href="<?php echo base_url() . 'index.php/accountctl/changingrole'; ?>"><?php echo $roles[0]['nama_grup'] ?></a></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td><a href="<?php echo base_url() . 'index.php/accountctl/changingrole'; ?>"> <?php echo $roles[1]['nama_grup'] ?></a></td>
                                                </tr>
                                                <?php ?>
                                            <?php endif; ?>
                                        </table>


                                    </div>
                                    <div class=" col-md-8">
                                        <div class="card-body">

                                        </div>
                                    </div>
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