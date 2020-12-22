<section id="intro">

    <head>

    </head>
    <div class="jumbotron masthead">
        <div class="container">
            <h2>Your Assignment</h2>
            <table border="1" , id="view_task">
                <tr>
                    <th width="20px" style="text-align:center">No</th>
                    <th width="220px" style="text-align:center">Title</th>
                    <th width="220px" style="text-align:center">Author(s)</th>
                    <th width="220px" style="text-align:center">Filename</th>
                    <th width="220px" style="text-align:center">Date Submitted</th>
                    <th width="220px" style="text-align:center">Status</th>
                </tr>

                <?php
                $i = 0;
                foreach ($assignments as $item) {
                    $i++; ?>
                    <tr>
                        <td style="text-align:center"><?php echo $i; ?></td>
                        <td><?php echo $item['judul']; ?></td>
                        <td><?php echo $item['authors']; ?></td>
                        <td>
                            <a href="<?php echo base_url() . 'index.php/ApplicationCtl/download/' . $item['id_task'] ?>" target="_blank">
                                <?php echo $item['file_location']; ?>
                            </a></td>
                        <td><?php echo date("d M Y", strtotime($item['date_created'])); ?></td>
                        <td style="text-align:center">


                            <?php if ($item['status'] == 3) { ?>
                                <a><span style="color:red">Task rejected</span></a><?php } ?>
                            <?php if ($item['status'] == 6) { ?>
                                <a href="<?php echo base_url() . 'index.php/ApplicationCtl/assignmentdownload/' . $item['id_assignment'] ?>" target="_blank">Completed</a>
                            <?php }; ?>

                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    </div>
</section>