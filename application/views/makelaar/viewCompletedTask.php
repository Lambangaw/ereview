<section id="intro">

  <head>
    <style>
      #view_task {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }

      #view_task td,
      #view_task th {
        border: 1px solid #ddd;
        padding: 8px;
      }

      #view_task tr:nth-child(even) {
        background-color: #f2f2f2;
      }

      #view_task tr:hover {
        background-color: #ddd;
      }

      #view_task th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
      }
    </style>
  </head>
  <div class="jumbotron masthead">
    <div class="container">
      <h2>All Completed Task List </h2>
      <table border="1" , id="view_task">
        <tr>
          <th width="20px">No</th>
          <th width="220px">Title</th>
          <th width="220px">Keywords</th>
          <th width="220px">Amount</th>
          <th width="220px">Bank Account</th>
          <th width="220px">Paid </th>
          <th width="220px">Progress</th>
          <th width="220px">Proof</th>
          <th width="220px">Confirm?</th>
        </tr>

        <?php
        $i = 0;
        foreach ($tasks as $item) {
          $i++;
        ?>
          <tr>
            <td><?= $i; ?></td>
            <td><?= $item['judul']; ?></td>
            <td><?= $item['keywords']; ?></td>
            <td><?= $item['saldo']; ?></td>
            <td><?= $item['no_rek']; ?></td>
            <td><?= date("d M Y", strtotime($item['date_created'])); ?></td>
            <td style="text-align:center">

              <?php if ($item['status'] == 4) { ?>
                <a><span style="color:green">Task completed</span></a><?php } ?>
              <?php if ($item['status'] == 5) { ?>
                <a><span style="color:red">waiting payment</span></a><?php } ?>

              <?php if ($item['status'] == 6) { ?>
                <a href="<?php echo base_url() . 'ApplicationCtl/assignmentdownload/' . $item['id_assignment'] ?>" target="_blank">Completed</a>
              <?php }; ?>
            </td>
            <td><a href="<?= base_url() . 'index.php/ApplicationCtl/downloadFile/' . $item['id_assignment']; ?>"><?= $item['bukti']; ?></a></td>
            <td><a href="<?= base_url() . 'index.php/MakelaarCtl/confirmPayment/' . $item['id_task'] . '/' . $item['id_assignment'] . '/' . $item['id_user']; ?>" class="badge badge-success">Confirm</a></td>

          </tr>
        <?php }  ?>
      </table>
    </div>
  </div>
  </div>
</section>