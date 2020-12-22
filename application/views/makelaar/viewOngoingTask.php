<section id="intro">

  <head>

  </head>
  <div class="jumbotron masthead">
    <div class="container">
      <h2>List of Requested Tasks</h2>
      <table border="1" , id="view_task">
        <tr>
          <th width="20px" style="text-align:center">No</th>
          <th width="220px" style="text-align:center">Title</th>
          <th width="220px" style="text-align:center">Keywords</th>
          <th width="220px" style="text-align:center">Filename</th>
          <th width="220px" style="text-align:center">Page Count</th>
          <th width="220px" style="text-align:center">Date Accepted</th>
          <th width="220px" style="text-align:center">Reviewer</th>
        </tr>

        <?php
        $i = 0;
        foreach ($tasks as $item) {
          $i++; ?>
          <tr>
            <td style="text-align:center"><?php echo $i; ?></td>
            <td><?php echo $item['judul']; ?></td>
            <td><?php echo $item['keywords']; ?></td>
            <td><a href="<?php echo base_url() . 'ApplicationCtl/download/' . $item['id_task'] ?>" target="_blank"><?php echo $item['file_location']; ?></a></td>
            <td style="text-align:center"><?php echo $item['page']; ?></td>
            <td><?php echo date("d M Y", strtotime($item['date_updated'])); ?></td>
            <td><?php echo $item['nama']; ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>
  </div>
</section>