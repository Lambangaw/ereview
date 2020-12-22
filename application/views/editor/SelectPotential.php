<br> <br>
<section id="intro">
    <div class="jumbotron masthead">
        <div class="container">
            <h2>List of Reviewer</h2>
            <table border="1" , id="view_task">
                <tr>
                    <th width="20px">No</th>
                    <th width="220px">Name</th>
                    <th width="220px">E-mail</th>
                    <th width="220px">Bank Account</th>
                    <th width="220px">Send Request!</th>
                </tr>

                <?php
                $i = 0;
                foreach ($reviewers as $item) {
                    $i++; ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $item['nama']; ?></td>
                        <td><?php echo $item['email']; ?></td>
                        <td><?php echo $item['username']; ?></td>

                        <td>
                            <a href="<?php echo base_url() . 'index.php/editorctl/requestedtask/' . $id_task . '/' . $item['id_reviewer']; ?>"><span style="color:green"> Select </a>
                        </td>

                    </tr>
                <?php } ?>

            </table>

        </div>
    </div>
</section>



</table>
</div>
</div>