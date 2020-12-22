<div class="jumbotron masthead">
    <div class="container">
        <h2>My Task List</h2>
        <table border="1" , id="view_task">
            <tr>
                <th width="40px" style="text-align: center">No</th>
                <th width="220px" style="text-align: center">Title</th>
                <th width="220px" style="text-align: center">Authors</th>
                <th width="160px" style="text-align: center">Filename</th>
                <th width="100px" style="text-align: center">Date Submitted</th>
                <th width="100px" style="text-align: center">Status</th>
                <th width="150px" style="text-align: center">Choose</th>
            </tr>
            <?php
            $i = 0;
            foreach ($assignments as $item) {
                $i++;
            ?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $item['judul']; ?></td>
                    <td><?= $item['authors']; ?></td>
                    <td><a href="<?= base_url() . 'index.php/ReviewerCtl/AcceptTask/' . $item['id_task'] ?>"><?= $item['file_location']; ?></a></td>
                    <td><?= Date("d M Y", strtotime($item['date_created'])); ?></td>
                    <td><?= $item['status']; ?></td>
                    <td>
                        <a href="<?= base_url() . 'index.php/ReviewerCtl/rejectTask/' . $item['id_assignment'] ?>" class="badge badge-danger">Reject</a>
                        <a href="" class="badge badge-primary">Confirm</a>
                    </td>


                </tr>


            <?php } ?>

        </table>
    </div>
</div>