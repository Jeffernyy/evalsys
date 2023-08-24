<?php include 'db_connect.php' ?>
<div class="col-lg-12">
  <div class="card card-outline card-success">
    <div class="card-header">
      <div class="card-tools">
        <a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=new_deduction"><i
            class="fa fa-plus"></i>&nbsp; New Deduction</a>
      </div>
    </div>
    <div class="card-body">
      <div class="col-md-12 border p-0">
        <table class="table table-striped table-bordered table-hover mb-0">
          <tbody>
            <?php
            $sql = "SELECT * FROM `deduction_list`";
            $res = mysqli_query($conn, $sql);
            $reset_number = 1;
            if ($res) {
              while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $deduction_name = $row['deduction_name'];
                echo '
                    <tr class="d-flex align-items-center justify-content-between">
                      <td style="border: none;">' . $reset_number . '. &nbsp;' . $deduction_name . '</td>
                      <td style="border: none;" width=222px>
                        <button class="btn btn-primary"><a href="index.php?page=update_deduction&updateId=' . $id . '" class="text-center text-light"><i class="fas fa-edit"></i> Update</a></button>
                        <button class="btn btn-danger"><a href="index.php?page=delete_deduction&deleteId=' . $id . '" class="text-center text-light"><i class="fas fa-trash"></i> Remove</a></button>
                      </td>
                    </tr>
                    ';
                $reset_number++;
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {
    $('#list').dataTable()
  })
</script>