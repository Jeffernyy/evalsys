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
        <div class="col-md-12">
          <form method="post" novalidate class="row needs-validation">
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="inputDeducName" class="form-label">Deduction Name</label>
                <input type="text" name="inputDeducName" id="inputDeducName" autofocus required class="form-control">
                <div class="invalid-feedback">
                  Please enter your deduction
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <button type="submit" name="inputSubmit" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;
                  Add Deduction</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    const form = document.querySelectorAll('.needs-validation');
    Array.from(form).forEach(form => {
      form.addEventListener('submit', e => {
        if (!form.checkValidity()) {
          e.preventDefault();
          e.stopPropagation();
        } form.classList.add('was-validated');
      })
    })
  </script>
</body>

</html>

<?php
include "db_connect.php";
if (isset($_POST['inputSubmit'])) {
  $deductionName = $_POST['inputDeducName'];

  $sql = "INSERT INTO `deduction_list` (deduction_name) VALUES ('$deductionName')";
  $res = mysqli_query($conn, $sql);

  if ($res) {
    echo '
    <script>
      swal({
        title: "Good Job!",
        text: "Data inserted successfully",
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