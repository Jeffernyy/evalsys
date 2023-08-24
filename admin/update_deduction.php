<?php
include "db_connect.php";
$id = $_GET['updateId'];
$sql = "SELECT * FROM `deduction_list` WHERE id=$id";
$res = mysqli_query($conn, $sql);
if ($res) {
  $row = mysqli_fetch_assoc($res);
  $deduction_name = $row['deduction_name'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=7">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
  <div class="col-lg-12">
    <div class="card card-outline card-success">
      <div class="card-body">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <form method="post" novalidate class="row needs-validation">
                <div class="col-md-12">
                  <div class="form-group mb-3">
                    <label for="inputDeducName" class="form-label">Deduction Name</label>
                    <input type="text" name="inputDeducName" id="inputDeducName" value="<?php echo $deduction_name; ?>"
                      required class="form-control">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <button type="submit" name="inputSubmit" class="btn btn-primary"><i class="fas fa-edit"></i>&nbsp;
                      Update Deduction</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

<?php
if (isset($_POST['inputSubmit'])) {
  $id = $_GET['updateId'];
  $deduction_name = $_POST['inputDeducName'];
  $sql = "UPDATE `deduction_list` SET id=$id, deduction_name='$deduction_name' WHERE id=$id";
  $res = mysqli_query($conn, $sql);
  if ($res) {
    echo '
    <script>
      swal({
        title: "Good Job!",
        text: "Data updated successfully",
        icon: "success",
        buttons: ["Close", "Aww Yiss!"]
      }).then(() => {
        window.location.href = "index.php?page=deduction_list";
      })
    </script>
    ';
  }
}
?>