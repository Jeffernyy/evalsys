<?php include "db_connect.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=7">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <style>
    .select2-container--default .select2-selection--single .select2-selection__arrow b {
      border-width: 7px 6px 0 6px;
      margin-left: -7.795px;
    }

    .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
      border-width: 0 6px 7px 6px;
    }

    .select2-search--dropdown {
      padding: 10px 10px 0px;
    }

    .select2-results__options::-webkit-scrollbar,
    .select2-results__options::-webkit-scrollbar-track {
      width: 10px;
    }

    .select2-results__options::-webkit-scrollbar-thumb {
      border-radius: 10px;
      background-color: #d9d4d4;
    }
  </style>
</head>

<body>
  <div class="col-md-12">
    <div class="card card-outline card-success">
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <form method="post" novalidate class="needs-validation">
              <div class="dropdown">
                <label for="dropdownMenuButton" class="form-label">Employee</label>
                <select class="custom-select browser-default select2" name="inputOption" id="employee-select">
                  <option disabled selected>Please select an employee</option>
                  <?php
                  $sql = "SELECT * FROM `faculty_list`";
                  $res = mysqli_query($conn, $sql);
                  if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                      $school_id = $row['school_id'];
                      $firstname = $row['firstname'];
                      $lastname = $row['lastname'];
                      echo '<option value="' . $school_id . '">' . $firstname . ' ' . $lastname . '</option>';
                    }
                  }
                  ?>
                </select>
              </div>
              <table class="table table-bordered table-striped table-hover mt-5">
                <thead>
                  <tr>
                    <th scope="col">Checkbox</th>
                    <th scope="col">Deduction</th>
                    <th scope="col">Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT `id`, `deduction_name` FROM `deduction_list`";
                  $res = mysqli_query($conn, $sql);
                  if ($res) {
                    while ($row = mysqli_fetch_assoc($res)) {
                      $deduction_id = $row['id'];
                      $deduction_name = $row['deduction_name'];
                      echo '
                        <tr>
                          <td width="15%" style="position: relative;">
                            <input type="checkbox" name="inputCheckbox[]" value="' . $deduction_id . '" id="inputCheckbox_' . $deduction_id . '" style="position: absolute; top: 50%; left: 17.75px; transform: translateY(-50%);">
                          </td>
                          <td width="60%" style="position: relative;">
                            <span style="position: absolute; top: 50%; left: 17.75px; transform: translateY(-50%);">' . $deduction_name . '</span>
                          </td>
                          <td width="25%">
                            <input type="text" name="inputAmount[]" class="form-control" placeholder="Enter amount">
                          </td>
                        </tr>
                      ';
                    }
                  }
                  ?>
                </tbody>
              </table>
              <div class="form-group pt-3">
                <button type="submit" name="inputSubmit" class="btn btn-primary w-100">Submit Deduction</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>

<?php
if (isset($_POST['inputSubmit'])) {
  $employee_id = $_POST['inputOption'];
  $deduction_ids = $_POST['inputCheckbox'];
  $deduction_amounts = $_POST['inputAmount'];
  $success = true;

  // loop through all deduction ids
  foreach ($deduction_ids as $index => $deduction_id) {
    // check if the checkbox is selected
    if (isset($_POST['inputCheckbox'][$index])) {
      $deduction_amount = isset($deduction_amounts[$index]) ? $deduction_amounts[$index] : '';
      // it needs to be in one insertion
      $sql = "INSERT INTO `employee_deduction_list` (employee_id, deduction_id, amount) VALUES ('$employee_id', '$deduction_id', '$deduction_amount')";
      $res = mysqli_query($conn, $sql);

      if (!$res) {
        $success = false;
        echo 'Error: ' . mysqli_error($conn) . '<br>';
      }
    }
  }

  // loop through all deduction amounts
  // but it needs to check the first checkbox to work the insertion correctly
  // you can leave the first checkbox amount empty to get the fair deduction for all the employee but if there's deduction then put the amount of deduction
  // only if the deduction id is not needed you can leave the amount empty

  // need to comment this foreach loop for the deduction amount to prevent the duplicate insertion

  // foreach ($deduction_amounts as $index => $deduction_amount) {
  //   // check if the amount is !empty in the selected checkbox
  //   if (!empty($deduction_amount)) {
  //     $deduction_id = $deduction_ids[$index];
  //     // it needs to be in one insertion
  //     $sql = "INSERT INTO `employee_deduction_list` (employee_id, deduction_id, amount) VALUES ('$employee_id', '$deduction_id', '$deduction_amount')";
  //     $res = mysqli_query($conn, $sql);

  //     if (!$res) {
  //       $success = false;
  //       echo 'Error: ' . mysqli_error($conn) . '<br>';
  //     }
  //   }
  // }

  // there's a problem that is need to debug pero si ma'am ra ang bahala
  // pag submit sa form it takes two insertion in my employee_deduction_list table
  // first is for the deduction ids
  // second is for the amount
  // if the first checkbox in the list is checked and the form is submitted, the insertion will be duplicated
  // also need to debug pero si ma'am ra ang bahala

  if ($success) {
    echo '
      <script>
        swal({
          title: "Good Job!",
          text: "Data inserted successfully",
          icon: "success",
          buttons: ["Close", "Okay"]
        }).then(() => {
          window.location.href = "index.php?page=employee_deduction";
        });
      </script>
    ';
  }
}
?>