<section id="intro">
    <div class="jumbotron masthead">
        <div class="container">
            <h2>My Task List</h2>
            <table border="1" , id="view_task">
                <tr>
                    <th width="20px">No</th>
                    <th width="220px">Title</th>
                    <th width="220px">Keywords</th>
                    <th width="220px">Filename</th>
                    <th width="220px">Pages</th>
                    <th width="220px">Submitted</th>
                    <th width="220px">Progress</th>
                    <th width="220px">Payment</th>
                    <th width="800px">Reviewed by Reviewer</th>
                    <th width="220px">Reviewer</th>
                </tr>


                <?php
                $i = 0;
                foreach ($tasks as $item) {
                    $i++;
                ?>
                    <tr>
                        <td style="text-align: center"><?= $i; ?></td>
                        <td style="text-align: center"><?= $item['judul']; ?></td>
                        <td style="text-align: center"><?= $item['keywords']; ?></td>
                        <td><a href="<?= base_url() . 'index.php/ApplicationCtl/download/' . $item['id_task']; ?>" target="_blank"><?= $item['file_location']; ?></a></td>
                        <td style="text-align: center"><?= $item['page']; ?></td>
                        <td style="text-align: center"><?= date("d M Y", strtotime($item['date_created'])); ?></td>
                        <?php if ($item['sts_task'] == 0) : ?>
                            <td style="text-align: center">Requested</td>
                        <?php elseif ($item['sts_task'] == 2) : ?>
                            <td style="text-align: center">On Progress</td>
                        <?php elseif ($item['sts_task'] == 3) : ?>
                            <td style="text-align: center">Rejected</td>
                        <?php elseif ($item['sts_task'] == 4) : ?>
                            <td style="text-align: center">Waiting Payment </td>
                        <?php elseif ($item['sts_task'] == 5) : ?>
                            <td style="text-align: center">Checking Payment</td>
                        <?php elseif ($item['sts_task'] == 6) : ?>
                            <td style="text-align: center">completed </td>
                        <?php endif; ?>

                        <?php if ($item['sts_task'] == 4) : ?>
                            <td style="text-align: center"><a href="<?php echo base_url() . 'index.php/PaymentCtl/AddPayment/' . $item['id_task'] ?>">Add Payment</a></td>
                        <?php else : ?>
                            <td style="text-align: center"><a href="">---</a></td>

                        <?php endif; ?>
                        <?php if ($item['sts_task'] == 6) : ?>
                            <td style="text-align: center"><a href="<?php echo base_url() . 'index.php/ApplicationCtl/editorassignmentDownload/' . $item['id_task']; ?>" target="_blank">Download</a></td>
                        <?php else : ?>
                            <td style="text-align: center"><a href="">---</a></td>

                        <?php endif; ?>
                        <td>
                            <a href="<?php echo base_url() . 'index.php/editorctl/selectPotentialReviewer/' . $item['id_task'] ?>">Choose reviewer</a>
                        </td>
                    </tr>
                <?php }  ?>
            </table>
        </div>
    </div>
    </div>
</section>